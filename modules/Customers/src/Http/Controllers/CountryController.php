<?php

namespace Modules\Customers\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Customers\src\Http\Resources\CountryResource;
use Modules\Customers\src\Interfaces\CountryRepositoryInterface;

class CountryController extends Controller
{
    public function __construct(
        protected CountryRepositoryInterface $countryRepository,
    )
    {
    }

    public function index(): object
    {
        $countries = $this->countryRepository->all();
        return response()->success(CountryResource::collection($countries));
    }
}
