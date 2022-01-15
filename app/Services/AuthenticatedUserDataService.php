<?php

namespace App\Services;

class AuthenticatedUserDataService
{
    public function setData()
    {
        $authUser = auth()->user();
        \session()->put('userid', $authUser->id);
        \session()->put('username', $authUser->name);
        \session()->put('user_email', $authUser->email);
    }
}
