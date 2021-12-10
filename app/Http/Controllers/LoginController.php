<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Empleado;
use Illuminate\Http\Request;

class LoginController extends Controller{
    function showLogin(Request $request){
        
        if($request->session()->exists('token')){
            return redirect('/');
        } else {
            return view('admin.login');
        }
        
    }
    
    function login(Request $request){
        $data = [];
        $user = $request->input('user');
        $pass = $request->input('password');
        

        if($user == "admin" && sha1($pass) == "f0cd2d230eb3d9dcaf0c8c198f75ca0b53193c22"){
            $request->session()->put('token','ASDF');
            return redirect("/");
        }else{
            $data['type'] = "danger";
            $data['message'] = "Sus datos de inicio de sesión no son correctos. Intentelo de nuevo";
            return back()->with($data);
        }
    }
}
