<?php

namespace App\Http\Controllers;

use App\Actions\Template\TemplateDataFetchAction;
use App\Actions\Template\TemplateDestroyAction;
use App\Actions\Template\TemplateFormViewRenderAction;
use App\Actions\Template\TemplateSearchSelectAction;
use App\Actions\Template\TemplateStoreAction;
use App\Actions\Template\TemplateUpdateAction;
use App\Http\Requests\TemplateRequest;
use App\Models\Template;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TemplateController extends Controller
{
    /**
     * Get List of Template
     * 
     * @return View
     */
    public function index(): View
    {
        $data = (new TemplateDataFetchAction)->action();

        return view('templates.list', $data);
    }

    /**
     * Create Form for Template
     * 
     * @return JsonResponse
     */
    public function create(): JsonResponse
    {
        $response = (new TemplateFormViewRenderAction())->action();
        
        return response()->json($response);
    }

    /**
     * Store New Template
     * 
     * @param App\Http\Requests\TemplateRequest
     * @return JsonResponse
     */
    public function store(TemplateRequest $request): JsonResponse
    {
        $response = (new TemplateStoreAction($request))->action();
        
        return response()->json($response, $response['status']);
    }

    /**
     * Edit Form for Template
     * 
     * @param App\Models\Template
     * @return JsonResponse
     */
    public function edit(Template $template): JsonResponse
    {
        $response = (new TemplateFormViewRenderAction($template))->action();
        
        return response()->json($response);
    }

     /**
     * Update existing Template
     * 
     * @param App\Http\Requests\TemplateRequest
     * @param App\Models\Template
     * @return JsonResponse
     */
    public function update(TemplateRequest $request, Template $template): JsonResponse
    {
        $response = (new TemplateUpdateAction($request, $template))->action();
        
        return response()->json($response, $response['status']);
    }

    /**
     * Delete existing Template
     * 
     * @param App\Models\Template
     * @return JsonResponse
     */
    public function destroy(Template $template): JsonResponse
    {
        $response = (new TemplateDestroyAction($template))->action();
        
        return response()->json($response, $response['status']);
    }

    /**
     * Template search data for select2 component
     * 
     * @param Illuminate\Http\Request
     * @return JsonResponse
     */
    public function searchSelect(Request $request): JsonResponse
    {
        $response = (new TemplateSearchSelectAction($request))->action();
        
        return response()->json($response, $response['status']);
    }
}
