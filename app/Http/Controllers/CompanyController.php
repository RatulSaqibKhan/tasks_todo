<?php

namespace App\Http\Controllers;

use App\Actions\Company\CompanyDataFetchAction;
use App\Actions\Company\CompanyDestroyAction;
use App\Actions\Company\CompanyFormViewRenderAction;
use App\Actions\Company\CompanyStoreAction;
use App\Actions\Company\CompanyUpdateAction;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class CompanyController extends Controller
{
    /**
     * Get List of Company
     * 
     * @return View
     */
    public function index(): View
    {
        $data = (new CompanyDataFetchAction)->action();

        return view('companies.list', $data);
    }

    /**
     * Create Form for Company
     * 
     * @return JsonResponse
     */
    public function create(): JsonResponse
    {
        $response = (new CompanyFormViewRenderAction())->action();
        
        return response()->json($response);
    }

    /**
     * Store New Company
     * 
     * @param App\Http\Requests\CompanyRequest
     * @return JsonResponse
     */
    public function store(CompanyRequest $request): JsonResponse
    {
        $response = (new CompanyStoreAction($request))->action();
        
        return response()->json($response, $response['status']);
    }

    /**
     * Edit Form for Company
     * 
     * @param App\Models\Company
     * @return JsonResponse
     */
    public function edit(Company $company): JsonResponse
    {
        $response = (new CompanyFormViewRenderAction($company))->action();
        
        return response()->json($response);
    }

     /**
     * Update existing Company
     * 
     * @param App\Http\Requests\CompanyRequest
     * @param App\Models\Company
     * @return JsonResponse
     */
    public function update(CompanyRequest $request, Company $company): JsonResponse
    {
        $response = (new CompanyUpdateAction($request, $company))->action();
        
        return response()->json($response, $response['status']);
    }

    /**
     * Delete existing Company
     * 
     * @param App\Models\Company
     * @return JsonResponse
     */
    public function destroy(Company $company): JsonResponse
    {
        $response = (new CompanyDestroyAction($company))->action();
        
        return response()->json($response, $response['status']);
    }
}
