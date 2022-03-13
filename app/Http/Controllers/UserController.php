<?php

namespace App\Http\Controllers;

use App\Actions\Users\UserDataFetchAction;
use App\Actions\Users\UserDestroyAction;
use App\Actions\Users\UserFormViewRenderAction;
use App\Actions\Users\UserStoreAction;
use App\Actions\Users\UserUpdateAction;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Get List of Users
     * 
     * @return View
     */
    public function index(): View
    {
        $data = (new UserDataFetchAction)->action();

        return view('users.list', $data);
    }

    /**
     * Create Form for User
     * 
     * @return JsonResponse
     */
    public function create(): JsonResponse
    {
        $response = (new UserFormViewRenderAction())->action();
        
        return response()->json($response);
    }

    /**
     * Store New User
     * 
     * @param App\Http\Requests\UserRequest
     * @return JsonResponse
     */
    public function store(UserRequest $request): JsonResponse
    {
        $response = (new UserStoreAction($request))->action();
        
        return response()->json($response);
    }

    /**
     * Edit Form for User
     * 
     * @param App\Models\User
     * @return JsonResponse
     */
    public function edit(User $user): JsonResponse
    {
        $response = (new UserFormViewRenderAction($user))->action();
        
        return response()->json($response);
    }

     /**
     * Update existing User
     * 
     * @param App\Http\Requests\UserRequest
     * @param App\Models\User
     * @return JsonResponse
     */
    public function update(UserRequest $request, User $user): JsonResponse
    {
        $response = (new UserUpdateAction($request, $user))->action();
        
        return response()->json($response);
    }

    /**
     * Delete existing User
     * 
     * @param App\Models\User
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        $response = (new UserDestroyAction($user))->action();
        
        return response()->json($response);
    }
}
