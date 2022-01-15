<?php

if (!function_exists('currentUser')) {
    function currentUser()
    {
        return auth()->user();
    }
}

if (!function_exists('currentUserId')) {
    function currentUserId()
    {
        return session()->get('userid') ?? auth()->user()->id;
    }
}

if (!function_exists('currentUserName')) {
    function currentUserName()
    {
        return session()->get('username') ?? auth()->user()->name;
    }
}

if (!function_exists('currentUserEmail')) {
    function currentUserEmail()
    {
        return session()->get('user_email') ?? auth()->user()->email;
    }
}