<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        return view('admin.auth.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = strip_tags($request->email);
        $password = strip_tags($request->password);
        $nama_lengkap = strip_tags($request->nama_lengkap);

        $users = Users::where('email', $email)->first();

        if (!empty($users)) {
            $data = [
                'email' => $users->email,
                'password' => $password,
            ];

            if (Auth::attempt($data)) {
                if ($users->level_user == 'Admin') {
                    return redirect()
                        ->route('dashboard')
                        ->with('status', 'success')
                        ->with('message', 'Selamat Datang' . $users->nama_lengkap);
                } else {
                    return redirect()->route('userDashboard')
                        ->with('status', 'success')
                        ->with('message', 'Selamat Datang' . $users->nama_lengkap);
                }
            } else {
                return redirect()
                    ->route('login')
                    ->with('status', 'error')
                    ->with('message', 'akun tidak terdaftar!');
            }
        } else {
            return redirect()
                ->route('login')
                ->with('status', 'error')
                ->with('message', 'Akun tidak terdaftar');
        }
    }

    public function logout()
    {
        Auth::logout();
        session_start();
        session_destroy();

        return redirect()
            ->route('login')
            ->with('status', 'success')
            ->with('message', 'Berhasil logout');
    }
}
