<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function index()
    {
        return view('Pages.Auth.Login', [
            'title' => 'Login',
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $remember = $request->remember ? true : false;
        if (Auth::attempt($credentials, $remember) && Auth::user()->role != 'admin') {
            $request->session()->regenerate();
            Alert::success('Login Berhasil!', 'Harap isi data tamu terlebih dahulu');
            return redirect()->intended('/guestbook');
        }
         else {
            return redirect()->intended('/');
        }
        Alert::error('Login Gagal!', 'Silahkan Cek Kembali Kredensial Anda!');
        return back()->withErrors([
            'username' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
        ])->onlyInput('username');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        Alert::success('Anda Berhasil Logout!', 'Terima Kasih Telah Berkunjung! 👋');
        return redirect('/');
    }
}
