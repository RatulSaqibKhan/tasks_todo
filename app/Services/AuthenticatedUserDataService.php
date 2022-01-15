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
        \session()->put('user_designation', $authUser->designation);
        \session()->put('user_phone_no', $authUser->phone_no);
        \session()->put('user_address', $authUser->address);
    }
}
