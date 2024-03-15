<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct(){
        $this->middleware("isAdmin")->except(['index', 'login', 'auth', 'logout']);
    }

    public function index(){
        return view('users', [
            'title' => 'Semua User',
            'users' => User::orderBy('username')->paginate(15),
        ]);
    }

    public function register(){
        return view('auth.register', [
            'title' => 'Registrasi',
        ]);
    }

    public function createUser(Request $request){
        $validated = $request->validate([
            'username' => 'required',
            'password'=> 'required|min:8',
            'email' => 'required|email:dns',
            'level' => 'required',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        User::create($validated);

        return redirect('/user')->with('success', 'User baru berhasil ditambahkan !');
    }

    public function login(){
        return view("auth.login", [
            'title' => 'Login',
        ]);
    }

    public function auth(Request $request){
        $validated = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        if(Auth::attempt($validated)){
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Berhasil Login !');
        }

        return back()->with('fail', 'Email dan Password salah, silahkan coba kembali !');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Berhasil Logout !');
    }

    public function destroy(String $id){
        User::find($id)->delete();
        return back()->with('success', 'Pengguna berhasil dihapus !');
    }
}
