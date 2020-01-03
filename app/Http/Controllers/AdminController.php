<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class AdminController extends Controller {
    
    public function index()
    {               
        if (session()->has('id'))
            return view('backend.dashboard');
        else {
           return redirect('login'); 
        }    
    }      
    
    public function admin_login(Request $request)
    {
        $email = $request->email;
        $password = md5($request->password);
        
        $result = DB::table('users')->where('email', $email)->where('password', $password)->first();

        // dd($result);        

        if($result) {            
            $request->session()->put('id', $result->id);
            $request->session()->put('name', $result->name);
            
            return redirect('dashboard');
        } else {
            $request->session()->put('message', 'Mật khẩu hoặc tên đăng nhập không đúng');
            return redirect('login');
        }
    }

    public function login()
    {        
        if (session()->has('id'))
            return redirect('dashboard');
        else
            return view('login');
        
    }

    public function logout()
    {
        session()->flush();
        return redirect('login');
    }
}