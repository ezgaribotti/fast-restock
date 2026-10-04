<?php

namespace Modules\Auth\src\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Modules\Auth\src\Enums\OperatorStatus;
use Modules\Auth\src\Http\Requests\ForgotPasswordRequest;
use Modules\Auth\src\Http\Requests\LoginRequest;
use Modules\Auth\src\Http\Requests\ResetPasswordRequest;
use Modules\Auth\src\Http\Resources\AccessTokenResource;
use Modules\Auth\src\Http\Resources\OperatorResource;
use Modules\Auth\src\Interfaces\OperatorRepositoryInterface;
use Modules\Auth\src\Interfaces\PasswordResetCodeRepositoryInterface;
use Modules\Auth\src\Mail\ResetPassword;

class AuthController extends Controller
{
    public function __construct(
        protected OperatorRepositoryInterface $operatorRepository,
        protected PasswordResetCodeRepositoryInterface $passwordResetCodeRepository,
    )
    {
    }

    public function login(LoginRequest $request)
    {
        $operator = $this->operatorRepository->findByInternalCode($request->internal_code);
        if ($operator && Hash::check($request->password, $operator->password)) {
            if ($operator->status !== OperatorStatus::Active) {

                // Any other status is restricted

                abort(403, 'Your account has been restricted.');
            }

            $abilities = [];
            foreach ($operator->permissions as $permission) {
                $abilities[] = $permission->ability;
            }

            $accessToken = $operator->createToken($request->ip(), $abilities)->plainTextToken;
            return new AccessTokenResource($accessToken);
        }
        abort(401, 'The internal code or password is wrong.');
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return new MessageResource('Logged out successfully.');
    }

    public function currentOperator(Request $request)
    {
        return new OperatorResource($request->user());
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $operator = $this->operatorRepository->findByEmail($request->email);
        if (! $operator || $operator->status === OperatorStatus::Blocked) {

            // Prevent recovery for blocked or non-existent operators

            abort(403, 'Password recovery is not available for this account.');
        }

        // Delete previous codes

        $this->passwordResetCodeRepository->deleteByEmail($operator->email);
        $code = strtoupper(Str::random(6));

        // Codes do not expire, but each email has one unique hashed code

        $this->passwordResetCodeRepository->create([
            'email' => $operator->email,
            'code' => $code,
        ]);

        // Only the operator has the code without hashing

        Mail::to($operator)->send(new ResetPassword($operator->full_name, $code));

        return new MessageResource('Password reset code sent to your email.');
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $passwordResetCode = $this->passwordResetCodeRepository->findByEmail($request->email);
        if ($passwordResetCode && Hash::check($request->code, $passwordResetCode->code)) {
            $operator = $this->operatorRepository->findByEmail($request->email);

            // Activate the account if it is suspended

            $this->operatorRepository->update($operator, [
                'status' => OperatorStatus::Active,
                'password' => $request->password,
            ]);

            return new MessageResource('Password successfully reset.');
        }
        abort(403, 'Invalid code.');
    }
}
