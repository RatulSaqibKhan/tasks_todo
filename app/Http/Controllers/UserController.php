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
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $data = (new UserDataFetchAction)->action();

        return view('users.list', $data);
    }

    public function create()
    {
        $response = (new UserFormViewRenderAction())->action();
        
        return response()->json($response);
    }

    public function store(UserRequest $request)
    {
        $response = (new UserStoreAction($request))->action();
        
        return response()->json($response);
    }

    public function edit(User $user)
    {
        $response = (new UserFormViewRenderAction($user))->action();
        
        return response()->json($response);
    }

    public function update(UserRequest $request, User $user)
    {
        $response = (new UserUpdateAction($request, $user))->action();
        
        return response()->json($response);
    }

    public function destroy(User $user)
    {
        $response = (new UserDestroyAction($user))->action();
        
        return response()->json($response);
    }
}
