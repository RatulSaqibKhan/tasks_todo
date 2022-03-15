<?php

namespace App\Http\Controllers;

use App\Actions\JobType\JobTypeDataFetchAction;
use App\Actions\JobType\JobTypeDestroyAction;
use App\Actions\JobType\JobTypeFormViewRenderAction;
use App\Actions\JobType\JobTypeStoreAction;
use App\Actions\JobType\JobTypeUpdateAction;
use App\Http\Requests\JobTypeRequest;
use App\Models\JobType;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class JobTypeController extends Controller
{
    /**
     * Get List of JobType
     * 
     * @return View
     */
    public function index(): View
    {
        $data = (new JobTypeDataFetchAction)->action();

        return view('job-types.list', $data);
    }

    /**
     * Create Form for JobType
     * 
     * @return JsonResponse
     */
    public function create(): JsonResponse
    {
        $response = (new JobTypeFormViewRenderAction())->action();
        
        return response()->json($response);
    }

    /**
     * Store New JobType
     * 
     * @param App\Http\Requests\JobTypeRequest
     * @return JsonResponse
     */
    public function store(JobTypeRequest $request): JsonResponse
    {
        $response = (new JobTypeStoreAction($request))->action();
        
        return response()->json($response, $response['status']);
    }

    /**
     * Edit Form for JobType
     * 
     * @param App\Models\JobType
     * @return JsonResponse
     */
    public function edit(JobType $job_type): JsonResponse
    {
        $response = (new JobTypeFormViewRenderAction($job_type))->action();
        
        return response()->json($response);
    }

     /**
     * Update existing JobType
     * 
     * @param App\Http\Requests\JobTypeRequest
     * @param App\Models\JobType
     * @return JsonResponse
     */
    public function update(JobTypeRequest $request, JobType $job_type): JsonResponse
    {
        $response = (new JobTypeUpdateAction($request, $job_type))->action();
        
        return response()->json($response, $response['status']);
    }

    /**
     * Delete existing JobType
     * 
     * @param App\Models\JobType
     * @return JsonResponse
     */
    public function destroy(JobType $job_type): JsonResponse
    {
        $response = (new JobTypeDestroyAction($job_type))->action();
        
        return response()->json($response, $response['status']);
    }
}
