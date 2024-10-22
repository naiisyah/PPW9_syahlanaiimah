<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRegistrasiController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:205',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed', // Menambahkan validasi untuk password
        ]);
    
        // Membuat pengguna baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password) // Hanya hash di sini
        ]);
    
        // Login pengguna
        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
    
        // Redirect ke dashboard dengan pesan sukses
        return redirect()->route('dashboard')
            ->withSuccess('You have successfully registered & logged in!');
    }
    
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        // Validasi kredensial
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Mencoba autentikasi
        if (Auth::attempt($credentials)) {
            // Mengubah session untuk mencegah serangan session fixation
            $request->session()->regenerate();
    
            // Redirect ke dashboard dengan pesan sukses
            return redirect()->route('dashboard')
                ->withSuccess('You have successfully logged in!');
        }
    
        // Jika kredensial tidak valid, kembalikan dengan kesalahan
        return back()->withErrors([
            'email' => 'Your provided credentials do not match our records.', // Perbaikan typo
        ])->onlyInput('email'); // Menyimpan input email yang diberikan
    }
    
    public function dashboard()
    {
        if(Auth::check()){
            return view('auth.dashboard');
        }

        return redirect()->route('login')
            ->withErrors([
                'email'=>'Please login to access teh dashboard',
            ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');;
    }
}
