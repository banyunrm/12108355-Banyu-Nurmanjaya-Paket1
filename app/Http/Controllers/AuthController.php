<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //menampilkan auth.login
    public function index()
    {
        return view('auth.login');
    }
     
    //menampilkan auth.register
    public function register()
    {
        return view('auth.register');
    }

    public function user()
    {
        $users = User::all();
        return view('admin.user', compact('users'));
    }

    public function registerAcc(Request $request)
    {
        //validasi
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'address' => 'required',
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'address' => $request->address,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        return redirect('/')->with('success', 'sukses registrasi!, silahkan login');
    }

   
    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required',
        ],[
            'email.exists' => 'email tidak tersedia',
            'password.required' => 'password tidak tersedia'
        ]);
        $users = $request->Only('email', 'password');
        if(Auth::attempt($users)){
            return redirect('/dashboard')->with('success', 'sukses login!');
        }else{
            return redirect()->back()->with('error', 'gagal login coba lagi!');
        }
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'address' => 'required',
            'role' => 'required',
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'address' => $request->address,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password)
        ]);
        return redirect()->back()->with('success', 'sukses menambah user!, silahkan login');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'address' => 'required',
            'role' => 'required',
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);
        User::where('id', $id)->update([
            'name' => $request->name,
            'username' => $request->username,
            'address' => $request->address,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password)
        ]);
        return redirect()->back()->with('success', 'sukses edit user!, silahkan login');
    }

    //untuk logout
    public function logout(){
        Auth::logout();
        return redirect()->back()->with('success', 'berhasil logout');
    }

    //menghapus user
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->back()->with('success', 'sukses menghapus user');
    }
}
