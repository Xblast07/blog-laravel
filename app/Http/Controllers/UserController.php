<?php
// Ceci est un commentaire de qualité
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create()
    {
        return view('users.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'username' => 'required|min:3|unique:users,name'
        ]);
        
        $user = new User();
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->name = $request->input('username');
        $user->save();
        
        return redirect()->route('users.login');
    }
    
    public function login()
    {
        return view('users.login');
    }
    
    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        
        if (Auth::attempt([
            'name' => $request->input('username'), 
            'password' => $request->input('password')
        ])) {
            $request->session()->regenerate();
            
            // Redirection vers la page que l'on avait l'intention de consulter
            return redirect()->intended(route('home'));
        }
        
        return back()->withErrors([
            'username' => 'Les identifiants ne correspondent pas'    
        ]);
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect()->route('home');
    }
}
