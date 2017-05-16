<?php

namespace App\Http\Controllers\socios;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Socios\Pariente;
use App\Models\Persona;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;


class parientescontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
           
    public function index(){
        if(!auth()->user()->can('ver parientes'))
            return response ()->view ('errors.403');
        $parientes = Pariente::listaParientes('');
        $departamentos = \App\Models\Socios\Departamento::pluck('departamento','id');
        return view('socios/parientes',['parientes'=>$parientes,'departamentos'=>$departamentos]);
    }
    
    public function listaParientes($dato = ''){    
        $parientes = Pariente::listaParientes($dato);
        return response()->view('socios.parientesList',['parientes'=>$parientes]);
    }


    public function ModalPariente(){
        if(!auth()->user()->can(['crear parientes','editar parientes']))
                return response ()->view ('errors.403-modal');
        $departamentos = \App\Models\Socios\Departamento::pluck('departamento','id');
        return response()->view('socios.parientesModal',['departamentos'=>$departamentos]);
    }

    public function datosparientes($idsocio,$dnipariente){
        $pariente = Pariente::getpariente($idsocio,$dnipariente);
        return response()->json($pariente);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\socios\createparientesrequest $request)
    {            
        if($request->ajax())
        {
            if(!auth()->user()->can('crear parientes'))
                return response()->view('errors.403-content', [], 403);
            $persona = Persona::where('dni','=',$request->dni)->select()->first();
            if(count($persona) == 0){
                $persona = Persona::create([
                    'paterno'=>  strtoupper($request->paterno),
                    'materno'=>  strtoupper($request->materno),
                    'nombre'=>  strtoupper($request->nombre),
                    'fec_nac'=>Carbon::parse($request->fec_nac),
                    'sexo'=>$request->sexo,
                    'direccion'=>  strtoupper($request->direccion),
                    'telefono'=>$request->telefono,
                    'comites_locales_id'=>$request->comite_local,
                    'dni'=>$request->dni
                ]);
            }
            else{
                $persona = Persona::where('dni','=',$request->dni)->update([
                    'paterno'=>  strtoupper($request->paterno),
                    'materno'=>  strtoupper($request->materno),
                    'nombre'=>  strtoupper($request->nombre),
                    'fec_nac'=>Carbon::parse($request->fec_nac),
                    'sexo'=>$request->sexo,
                    'direccion'=>  strtoupper($request->direccion),
                    'telefono'=>$request->telefono,
                    'comites_locales_id'=>$request->comite_local,
                ]);
            }        
            $pariente = new Pariente($request->all());
                $pariente->socios_codigo=$request->socios_codigo;
                $pariente->personas_dni = $request->dni;
                $pariente->users_id = \Illuminate\Support\Facades\Auth::user()->id;
                $pariente->save();
            if($pariente)
            {                               
                return response()->json(['success'=>true,'message'=>'Se registro correctamente']);               
            }
            else{
                return response()->json(['success'=>false,'message'=>'No se Registro ningun Dato']);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\socios\createparientesrequest $request, $id)
    {
        //
        if($request->ajax())
        {
            if(!auth()->user()->can('editar parientes'))
                return response()->view('errors.403-content', [], 403);
            $result = Pariente::join('personas','parientes.personas_dni','=','personas.dni')
                    ->where('parientes.id','=',$id)
                    ->update([
                        'parientes.grado_inst'=>$request->grado_inst,                        
                        'parientes.beneficiario'=>$request->beneficiario,
                        'parientes.estado_civil'=>$request->estado_civil,
                        'parientes.tipo_pariente'=>$request->tipo_pariente,
                        'parientes.users_id'=>  \Illuminate\Support\Facades\Auth::user()->id,
                                               
                        'personas.paterno'=>  strtoupper($request->paterno),
                        'personas.materno'=>strtoupper($request->materno),
                        'personas.nombre'=>strtoupper($request->nombre),
                        'personas.fec_nac'=>Carbon::parse($request->fec_nac) ,
                        'personas.sexo'=>$request->sexo,
                        'personas.direccion'=>$request->direccion,
                        'personas.telefono'=>$request->telefono,
                        'personas.comites_locales_id'=>$request->comite_local,
                    ]);
            if($result)
            {
                return response()->json(['success'=>true,'message'=>'Se Actualizaron correctamente']);
            }
            else{
                return response()->json(['success'=>false,'message'=>'No se Actualizo']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$cod)
    {        
        if(auth()->user()->can('eliminar parientes')){
//            $cant = \App\Models\Tesoreria\Mov_cheque::where('personas_dni','=',$id)->count();            
            $cant = \App\Models\Socios\Transferencia::where('beneficiario_antiguo','=',$id)->count();
            if($cant == 0)            {
            $result = Pariente::where('personas_dni','=',$id)
                    ->where('socios_codigo','=',$cod)->delete();
        return response ()->json (['success'=>true]);}
            else{
                return response ()->json (['success'=>false]);
            }
            
        }
        return response()->view('errors.403-content', [], 403);            
    }
}
