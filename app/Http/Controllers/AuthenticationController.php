<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticatedRequest;
use App\Services\AuthenticatedUserDataService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthenticationController extends Controller
{
    /**
     * View Login page
     * 
     * @return View
     */
    public function login(): View
    {
        return view('login');
    }

    /**
     * Redirect to application dashboard for authorized user otherwise to login page
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function application(): RedirectResponse
    {
        $redirection_url = (auth()->check() && auth()->user()->id) ? '/dashboard' : '/login';

        return redirect($redirection_url);
    }

    /**
     * User Authentication
     * 
     * @param App\Http\Requests\AuthenticatedRequest
     * @return Illuminate\Http\RedirectResponse
     */
    public function signin(AuthenticatedRequest $request): RedirectResponse
    {
        try {
            if (\auth()->attempt($request->except('_token'))) {
                (new AuthenticatedUserDataService)->setData();
                return \redirect('/dashboard');
            }
            session()->flash('error', 'Email or Password does not match!');
        } catch (Exception $e) {
            $error_msg = $e->getMessage();
            session()->flash('error', 'Something Went Wrong!');
        }
        return redirect()->back()->withInput()->withErrorMessage($error_msg ?? null);
    }

    /**
     * Logout from the application
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        auth()->logout();
        session()->flush();
        cache()->flush();

        return redirect('/');
    }
}
