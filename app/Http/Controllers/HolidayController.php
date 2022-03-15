<?php

namespace App\Http\Controllers;

use App\Actions\Holiday\HolidayDataFetchAction;
use App\Actions\Holiday\HolidayDestroyAction;
use App\Actions\Holiday\HolidayFormViewRenderAction;
use App\Actions\Holiday\HolidayStoreAction;
use App\Actions\Holiday\HolidayUpdateAction;
use App\Http\Requests\HolidayRequest;
use App\Models\Holiday;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class HolidayController extends Controller
{
    /**
     * Get List of Holiday
     * 
     * @return View
     */
    public function index(): View
    {
        $data = (new HolidayDataFetchAction)->action();

        return view('holidays.list', $data);
    }

    /**
     * Create Form for Holiday
     * 
     * @return JsonResponse
     */
    public function create(): JsonResponse
    {
        $response = (new HolidayFormViewRenderAction())->action();
        
        return response()->json($response);
    }

    /**
     * Store New Holiday
     * 
     * @param App\Http\Requests\HolidayRequest
     * @return JsonResponse
     */
    public function store(HolidayRequest $request): JsonResponse
    {
        $response = (new HolidayStoreAction($request))->action();
        
        return response()->json($response, $response['status']);
    }

    /**
     * Edit Form for Holiday
     * 
     * @param App\Models\Holiday
     * @return JsonResponse
     */
    public function edit(Holiday $holiday): JsonResponse
    {
        $response = (new HolidayFormViewRenderAction($holiday))->action();
        
        return response()->json($response);
    }

     /**
     * Update existing Holiday
     * 
     * @param App\Http\Requests\HolidayRequest
     * @param App\Models\Holiday
     * @return JsonResponse
     */
    public function update(HolidayRequest $request, Holiday $holiday): JsonResponse
    {
        $response = (new HolidayUpdateAction($request, $holiday))->action();
        
        return response()->json($response, $response['status']);
    }

    /**
     * Delete existing Holiday
     * 
     * @param App\Models\Holiday
     * @return JsonResponse
     */
    public function destroy(Holiday $holiday): JsonResponse
    {
        $response = (new HolidayDestroyAction($holiday))->action();
        
        return response()->json($response, $response['status']);
    }
}
