<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\empleados;
use App\Models\nominas;
use App\Models\departamentos;
use Session;
use Symfony\Component\Console\Output\ConsoleOutputInterface;

class EmpleadosController extends Controller
{
    public function modificaempleado($ide){
        $consulta = empleados::withTrashed()->join('departamentos','empleados.idd','=','departamentos.idd')
        ->select('empleados.ide','empleados.nombre','empleados.apellido','empleados.sexo','empleados.celular','empleados.img',
        'departamentos.nombre as depa','empleados.email','empleados.idd','empleados.descripcion')
        ->where('ide',$ide)
        ->get();
        $departamentos = departamentos::all();
        return view('modificaempleado')
        ->with('consulta',$consulta[0])
        ->with('departamentos',$departamentos);
    }
    public function guardacambios(Request $request){
        $this->validate($request,[
            'nombre' => 'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú]+$/',
            'apellido' => 'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú]+$/',
            'email' => 'required|email',
            'celular' => 'required|regex:/^[0-9]{10}$/',
            'img'=>'image|mimes:gif,jpeg,png'
        ]);
        
        $empleados = empleados::withTrashed()->find($request->ide);
        $empleados->ide = $request->ide;
        $empleados->nombre = $request->nombre;  
        $empleados->apellido = $request->apellido;
        $empleados->email = $request->email;
        $empleados->celular = $request->celular; 
        $empleados->sexo = $request->sexo;
        $empleados->descripcion = $request->descripcion;
        $empleados->idd = $request->idd;
        $empleados->img = $img2;
        $empleados->save();
        
        /*return view('mensajes')
        ->with('proceso',"MODIFICA  EMPLEADOS")
        ->with('mensaje',"El empleado $request->nombre $request->apellido ha sido modificado correctamente")
        ->with('error',1);*/

        Session::flash('mensaje',"El empleado $request->nombre $request->apellido ha sido 
        modificado correctamente");
        return redirect()->route('reporteempleados');
    }
    public function borraempleado($ide){
        $empleados = empleados::withTrashed()->find($ide)->forceDelete();
        /*return view('mensajes')
        ->with('proceso',"BORRAR EMPLEADOS")
        ->with('mensaje',"El empleado ha sido borrado del sistema correctamente");*/
        Session::flash('mensaje',"El empleado $request->nombre $request->apellido ha sido 
                                  borrado del sistema correctamente");
        return redirect()->route('reporteempleados');

    }
    public function activarempleado($ide){
        $empleados = empleados::withTrashed()->where('ide',$ide)->restore();
        /*return view('mensajes')
        ->with('proceso',"ACTIVAR EMPLEADOS")
        ->with('mensaje',"El empleado ha sido activado correctamente");*/
        Session::flash('mensaje',"El empleado ha sido activado correctamente");
        return redirect()->route('reporteempleados');
    }
    public function desactivaempleado($ide){
        $empleados = empleados::find($ide);
        $empleados->delete();
        /*return view('mensajes')
        ->with('proceso',"DESACTIVAR EMPLEADOS")
        ->with('mensaje',"El empleado ha sido desactivado correctamente");*/
        Session::flash('mensaje',"El empleado ha sido desactivado correctamente");
        return redirect()->route('reporteempleados');
    }
    public function reporteempleados(){
        $sessionidu = session('sessionidu');
        $sessiontipo = session('sessiontipo');
        if($sessionidu<>"" and $sessiontipo<>""){
        $consulta = empleados::withTrashed()->join('departamentos','empleados.idd','=','departamentos.idd')
        ->select('empleados.ide','empleados.nombre','empleados.apellido','departamentos.nombre as depa',
        'empleados.email','empleados.deleted_at','empleados.img')
        ->orderBy('empleados.nombre')
        ->get();
        return view('reporteempleados')->with('consulta',$consulta)
        ->with('sessiontipo',$sessiontipo);
        }else{ 
        Session::flash('mensaje',"Loguearse antes de continuar");
        return redirect()->route('login');
        }
    }
    public function altaempleado()
    { 
        $consulta = empleados::orderBy('ide','desc')
                                ->take(1)->get();

        $cuantos = count($consulta);
        if($cuantos==0)
        {
            $idesigue = 1;
        }
        else {
            $idesigue = $consulta[0]->ide + 1;
        }
        $departamentos = departamentos::orderBy('nombre')->get();
        //return $idesigue;  
        return view ('altaempleado')
               ->with('idsigue',$idesigue)
               ->with('departamentos',$departamentos);
    }
    public function guardarempleado(Request $request)
    {
        $this->validate($request,[
            'nombre' => 'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú]+$/',
            'apellido' => 'required|regex:/^[A-Z][A-Z,a-z, ,á,é,í,ó,ú]+$/',
            'email' => 'required|email',
            'celular' => 'required|regex:/^[0-9]{10}$/',
            'img' => 'image|mimes:gif,jpeg,png'
        ]);

        $file = $request->file('img');
        if($file<>"")
        {
        $img = $file->getClientOriginalName();
        $img2 = $request->ide . $img;
        \Storage::disk('local')->put($img2, \File::get($file));
        }
         
      
        $empleados = new empleados;
        $empleados->ide = $request->ide;
        $empleados->nombre = $request->nombre; 
        $empleados->apellido = $request->apellido;
        $empleados->email = $request->email;
        $empleados->celular = $request->celular;
        $empleados->sexo = $request->sexo;
        $empleados->descripcion = $request->descripcion;
        $empleados->idd = $request->idd;
        if($file<>"")
        {
        $empleados->img = $img2;
        }
        $empleados->save();
        
        /*return view('mensajes')
        ->with('proceso',"ALTA DE EMPLEADOS")
        ->with('mensaje',"El empleado $request->nombre $request->apellido ha sido dado de alta correctamente");
        */
        Session::flash('mensaje',"El empleado $request->nombre $request->apelido
                                 ha sido dado de alta correctamente");
        return redirect()->route('reporteempleados');
    }
    


    public function eloquent()
    {
        //$consulta = empleados::all(); 
        /*$empleados = new empleados;
        $empleados->ide = 5;
        $empleados->nombre = "Luis";
        $empleados->apellido = "Contreras";
        $empleados->email = "luis@hotmailcom";
        $empleados->celular = "0987654321";
        $empleados->sexo = "M";
        $empleados->descripcion = "Prueba de insercion";
        $empleados->idd = 1;
        $empleados->save();
        echo "Registro GUardado Correctamente";*/
        //insercion
        /*$empleados = empleados::create([
            'ide' => 6, 'nombre'=>"Braulio", 'apellido'=>"Vargas", 'email'=>"braulio@hotmail.com",
            'celular' =>"3203381419",'sexo' =>"M",'descripcion' =>"test test",'idd'=>2
        ]);*/

        //modificacion
        /*$empleados = empleados::find(1);
        $empleados->nombre = "Dulce";
        $empleados->apellido = "montiel";
        $empleados->save();*/
        
        //actualizar o modificar
        /*empleados::where('sexo','M')
        ->where('email','sergio@hotmail.com')
        ->update(['nombre' =>'Francisco','celular'=>'5555555']);*/

        //eliminacion
        //empleados::destroy(1);

        //borrar por id
        /*$empleados = empleados::find(3);
        $empleados->delete();
        return "eliminacion Realizada";*/

        //consulta
        //$consulta = empleados::all();

        //muestra todos los empleados incluyendo los desechados
        //$consulta = empleados::withTrashed()->get();
        //muestra los empleados desechados
        /*$consulta = empleados::onlyTrashed()
                    ->where('sexo','M')
                    ->get();*/
        
        //empleados::withTrashed()->where('ide',3)->restore(); 

        //$empleados = empleados::find(3)->forceDelete();
        //$consulta = empleados::all();
        //return $consulta;

        //return "Restauracion Realizada";       
        //return $consulta;
        //borrar por sexo y celular
        /*$empleados=empleados::where('sexo','F')
        ->where('celular','3203381419')
        ->delete();*/

        $consulta = empleados::all();

        $consulta = empleados::where('sexo','M')->get();

        $consulta = empleados::where('edad','>=',20)
                              ->where('edad','<=',30)
                              ->get();
        

        $consulta = empleados::whereBetween('edad',[20,25])
                              ->get();

        
        $consulta = empleados::whereIn('ide',[3,4,5])
                              ->orderBy('nombre','desc')
                              ->get(); 
          

        $consulta = empleados::where('edad','>=',20)
                               ->where('edad','<=',30)
                               ->take(2)
                               ->get();

        $consulta = empleados::Select(['nombre','apellido','edad'])
                               ->where('edad','>=',30)
                               ->get();

       $consulta = empleados::Select(['nombre','apellido','edad'])
                               ->where('apellido','LIKE','%gas%')
                               ->get();

        $consulta = empleados::where('sexo','F')->sum('salario'); 

        $consulta = empleados::groupBy('sexo')
                    ->selectRaw('sexo,sum(salario) as salariototal')
                    ->get();

        $consulta = empleados::groupBy('sexo')
                                ->selectRaw('sexo,count(*) as cuantos')
                                ->get();
        //SQL NATIVO
        /*Select e.ide, e.nombre, d.nombre as departamento, e.edad i
        FROM empleados AS e
        INNER JOIN departamentos AS d ON d.idd = e.idd
        WHERE e.edad>=30*/
                            
        $consulta = empleados::join('departamentos','empleados.idd','=','departamentos.idd')
        ->select('empleados.ide','empleados.nombre','departamentos.nombre as depa','empleados.edad')
        ->where('empleados.edad','>=',30)
        ->get();

        $consulta = empleados::where('edad','>=',40)
                                ->orwhere('sexo','F')
                                ->get();

        //$cuantos = count($consulta);
        return $consulta;
    }
    public function vb()
    {
        return view ('vistabootstrap');
    }
    
    public function saludo($nombre,$dias){

        $pago = 100;
        $nomina = $dias * $pago;
        //Tienen que coincidir las variables
        //return view('empleado',compact('nombre','dias'));
        //No necesariamente tiene que coincidir
        //return view('empleado',['nombre'=>$nombre,'dias'=>$dias]);
        //No tiene que coincidir
        return view('empleado')
        ->with('nombre',$nombre)
        ->with('dias',$dias)
        ->with('nomina',$nomina);
    }
    public function salir()
    {
        return "Salir";
    }
    public function mensaje()
    {
        return "Hola trabajador";
    }
    public function pago()
    {
        $dias = 7;
        $pago = 600;
        $nomina = $dias * $pago;
        return "el pago del empleado es: $nomina";
    }
    public function nomina ($diast,$pago){
        $nomina = $diast * $pago;
        dd($nomina,$diast,$pago);
        return "el pago es $nomina con dias $diast y pago diario de $pago";
    }
}
