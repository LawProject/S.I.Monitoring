<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Handle an authenticated request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\Response
     */
    public function authenticated(Request $request, $user)
    {
        // Jika pengguna memiliki peran "admin", arahkan ke rute admin.index
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.index');
        }
        // Jika pengguna memiliki peran "user", arahkan ke rute user.user.index dengan menyertakan ID pengguna
        elseif ($user->hasRole('user')) {
            return redirect()->route('user.user.index', ['id' => $user->id]);
        }
        // Jika pengguna memiliki peran "organisasi", arahkan ke rute organisasi.index dengan menyertakan ID pengguna
        elseif ($user->hasRole('organisasi')) {
            return redirect()->route('organisasi.index', ['id' => $user->id]);
        }

        // Jika tidak ada peran yang sesuai, arahkan ke rute home
        return redirect()->route('home');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Terapkan middleware "guest" kecuali untuk metode "logout"
        $this->middleware('guest')->except('logout');
    }
}
