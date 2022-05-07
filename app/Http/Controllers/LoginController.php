<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\usuarios;
use Session;

class LoginController extends Controller{
    public function cerrarsesion()
    {
        Session::forget('sessionusuario');
        Session::forget('sessiontipo');
        Session::forget('sessionidu');
        Session::flush();
        Session::flash('mensaje',"Sesion cerrada correctamente");
        return redirect()->route('login');
    } 
    public function principal()
    {
        $sessionidu = session('sessionidu');
        if($sessionidu<>"")
        {
        return view('vistabootstrap'); 
    }else {
        Session::flash('mensaje',"Loguearse antes de continuar");
        return redirect()->route('login');
    }
    }
    public function login()
    {
        return view('login');
    }
    public function validar(Request $request)
    {
        $this->validate($request,[
            'usuario' => 'required',
            'pasw' => 'required'
        ]);
        // $paswordEncriptado = Hash::make($request->pasw);
        // echo $paswordEncriptado;
    $consulta = usuarios::where('user',$request->usuario)
    ->where('activo','Si')
    ->get();
    $cuantos = count($consulta);
    
     if($cuantos==1 and Hash::check($request->pasw,$consulta[0]->pasw))
     {
        echo "acceso concedido";
        Session::put('sessionusuario',$consulta[0]->nombre . ' ' .$consulta[0]->apellido);
        Session::put('sessiontipo',$consulta[0]->tipo);
        Session::put('sessionidu',$consulta[0]->idu);
        
        return redirect()->route('principal');
     }
     else {
         Session::flash('mensaje',"El usuario o password no son válidos");
         return redirect()->route('login');
     }
  }
}