<?php

namespace App\Http\Controllers;

use App\Actions\Users\UserDataFetchAction;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data = (new UserDataFetchAction)->action();

        return view('users.list', $data);
    }
}
