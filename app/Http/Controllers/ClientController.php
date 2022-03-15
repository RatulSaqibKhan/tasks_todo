<?php

namespace App\Http\Controllers;

use App\Actions\Client\ClientDataFetchAction;
use App\Actions\Client\ClientDestroyAction;
use App\Actions\Client\ClientFormViewRenderAction;
use App\Actions\Client\ClientStoreAction;
use App\Actions\Client\ClientUpdateAction;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ClientController extends Controller
{
    /**
     * Get List of Client
     * 
     * @return View
     */
    public function index(): View
    {
        $data = (new ClientDataFetchAction)->action();

        return view('clients.list', $data);
    }

    /**
     * Create Form for Client
     * 
     * @return JsonResponse
     */
    public function create(): JsonResponse
    {
        $response = (new ClientFormViewRenderAction())->action();
        
        return response()->json($response);
    }

    /**
     * Store New Client
     * 
     * @param App\Http\Requests\ClientRequest
     * @return JsonResponse
     */
    public function store(ClientRequest $request): JsonResponse
    {
        $response = (new ClientStoreAction($request))->action();
        
        return response()->json($response, $response['status']);
    }

    /**
     * Edit Form for Client
     * 
     * @param App\Models\Client
     * @return JsonResponse
     */
    public function edit(Client $client): JsonResponse
    {
        $response = (new ClientFormViewRenderAction($client))->action();
        
        return response()->json($response);
    }

     /**
     * Update existing Client
     * 
     * @param App\Http\Requests\ClientRequest
     * @param App\Models\Client
     * @return JsonResponse
     */
    public function update(ClientRequest $request, Client $client): JsonResponse
    {
        $response = (new ClientUpdateAction($request, $client))->action();
        
        return response()->json($response, $response['status']);
    }

    /**
     * Delete existing Client
     * 
     * @param App\Models\Client
     * @return JsonResponse
     */
    public function destroy(Client $client): JsonResponse
    {
        $response = (new ClientDestroyAction($client))->action();
        
        return response()->json($response, $response['status']);
    }
}
