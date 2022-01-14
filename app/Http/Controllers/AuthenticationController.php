<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticatedRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthenticationController extends Controller
{
    public function login(): View
    {
        return view('login');
    }

    public function application()
    {
        $redirection_url = (auth()->check() && auth()->user()->id) ? '/dashboard' : '/login';

        return redirect($redirection_url);
    }

    public function signin(AuthenticatedRequest $request)
    {
        try {
            if (\auth()->attempt($request->except('_token'))) {
                return \redirect('/dashboard');
            }
            session()->flash('error', 'Email or Password does not match!');
        } catch (Exception $e) {
            $error_msg = $e->getMessage();
            session()->flash('error', 'Something Went Wrong!');
        }
        return redirect()->back()->withInput()->withErrorMessage($error_msg ?? null);
    }

    public function logout()
    {
        auth()->logout();
        session()->flush();
        cache()->flush();

        return redirect('/');
    }
}
