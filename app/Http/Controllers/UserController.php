<?php

namespace App\Http\Controllers;

use App\Actions\Users\UserDataFetchAction;
use App\Actions\Users\UserDestroyAction;
use App\Actions\Users\UserStoreAction;
use App\Actions\Users\UserUpdateAction;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data = (new UserDataFetchAction)->action();

        return view('users.list', $data);
    }

    public function create()
    {
        return view('users.form', [
            'user' => null
        ]);
    }

    public function store(UserRequest $request)
    {
        $response = (new UserStoreAction($request))->action();
        
        return response()->json($response);
    }

    public function edit(User $user)
    {
        return view('users.form', [
            'user' => $user
        ]);
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
