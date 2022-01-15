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

if (!function_exists('currentUserDesignation')) {
    function currentUserDesignation()
    {
        return session()->get('user_designation') ?? auth()->user()->designation;
    }
}

if (!function_exists('currentUserAddress')) {
    function currentUserAddress()
    {
        return session()->get('user_address') ?? auth()->user()->address;
    }
}

if (!function_exists('currentUserPhone')) {
    function currentUserPhone()
    {
        return session()->get('user_phone_no') ?? auth()->user()->phone_no;
    }
}