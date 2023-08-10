<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Repositories\CompanyRepository;
use Illuminate\Http\JsonResponse;

class CompanyController extends Controller
{
    private CompanyRepository $companyRepository;

    function __construct(companyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function index(): JsonResponse
    {
        $payload = [
            'data' => Company::with([
                'city',
                'state',
                'category'
            ])->select()->get()
        ];

        return response()->json($payload);
    }

    public function store(CompanyRequest $request): JsonResponse
    {
        try {
            return response()->json(
                $this->companyRepository->store($request->all())
            );
        } catch (\Exception $e) {
            return $this->checkStatusCodeError($e);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            return response()->json(
                $this->companyRepository->show($id)
            );
        } catch (\Exception $e) {
            return $this->checkStatusCodeError($e);
        }
    }
}
