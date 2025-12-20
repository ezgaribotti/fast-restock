<?php

namespace Modules\Auth\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Modules\Auth\src\Enums\OperatorStatus;
use Modules\Auth\src\Http\Requests\LoginRequest;
use Modules\Auth\src\Http\Requests\ResetPasswordRequest;
use Modules\Auth\src\Http\Requests\SendResetLinkRequest;
use Modules\Auth\src\Http\Resources\AccessTokenResource;
use Modules\Auth\src\Http\Resources\OperatorResource;
use Modules\Auth\src\Interfaces\OperatorRepositoryInterface;
use Modules\Auth\src\Interfaces\PasswordResetTokenRepositoryInterface;
use Modules\Auth\src\Mail\ResetPassword;

class AuthController extends Controller
{
    public function __construct(
        protected OperatorRepositoryInterface $operatorRepository,
        protected PasswordResetTokenRepositoryInterface $passwordResetTokenRepository,
    )
    {
    }

    public function login(LoginRequest $request): object
    {
        $operator = $this->operatorRepository->findByInternalCode($request->internal_code);
        if ($operator && Hash::check($request->password, $operator->password)) {
            if ($operator->status === OperatorStatus::Suspended) {
                abort(403, 'Your account has been suspended.');
            }

            if ($operator->status == OperatorStatus::Blocked) {
                abort(403, 'Your account has been blocked.');
            }
            $abilities = [];
            foreach ($operator->permissions as $permission) {
                $abilities[] = $permission->slug;
            }

            $accessToken = $operator->createToken($request->ip(), $abilities)->plainTextToken;
            return response()->success(new AccessTokenResource($accessToken));
        }
        abort(401, 'The internal code or password is wrong.');
    }

    public function logout(Request $request): object
    {
        $request->user()->tokens()->delete();
        return response()->justMessage('Logged out successfully.');
    }

    public function currentOperator(Request $request): object
    {
        $operator = $request->user();
        return response()->success(new OperatorResource($operator));
    }

    public function sendResetLink(SendResetLinkRequest $request): object
    {
        $operator = $this->operatorRepository->findByEmail($request->email);
        if ($operator->status == OperatorStatus::Blocked) {
            abort(403, 'Your account has been blocked.');
        }
        $token = Str::random(63);

        $url = $request->return_url . chr(63) . http_build_query([
            'email' => $operator->email,
            'token' => $token,
        ]);

        Mail::to($operator->email)
            ->send(new ResetPassword($operator->full_name, $url));

        $this->passwordResetTokenRepository->deleteByEmail($operator->email);
        $this->passwordResetTokenRepository->create([
            'email' => $operator->email,
            'token' => Hash::make($token),
        ]);
        return response()->justMessage('Password reset link sent to your email.');
    }

    public function resetPassword(ResetPasswordRequest $request, string $token): object
    {
        $passwordReset = $this->passwordResetTokenRepository->findByEmail($request->email);

        if (!Hash::check($token, $passwordReset->token)) {
            abort(403, 'Invalid token.');
        }
        $this->passwordResetTokenRepository->deleteByEmail($passwordReset->email);

        // If the operator is suspended, it is reactivated

        $this->operatorRepository->updateByEmail([
            'status' => OperatorStatus::Active,
            'password' => Hash::make($request->password),
        ], $passwordReset->email);

        return response()->justMessage('Password successfully updated.');
    }
}
