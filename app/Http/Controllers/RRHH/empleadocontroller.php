<?php

namespace App\Http\Controllers\RRHH;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Socios\Departamento;
use App\Models\RRHH\Empleado;
use App\Models\Persona;
USE Carbon\Carbon;
use Illuminate\Support\Facades\Input;


class empleadocontroller extends Controller
{
    
    
    public function autocompleteEmpleado(Request $request)    {
        if($request->ajax()){
            $nombre = Input::get('term');
            $empleados = Empleado::autocompleteDatos($nombre);
            foreach ($empleados as $empleado) 
            {
                $result[] = ['id' => $empleado->dni, 'value' => $empleado->empleado];
            }
            return response()->json($result);
        }
    }
    
    public function autocompleteEmpleadoDni(Request $request)    {
        if($request->ajax()){
            $nombre = Input::get('term');
            $empleados = Empleado::autocompleteDatosDni($nombre);
            foreach ($empleados as $empleado) 
            {
                $result[] = ['id' => $empleado->empleado, 'value' => $empleado->dni];
            }
            return response()->json($result);
        }
    }
    
    public function amonestacion(){
        return response()->view('RRHH.amonestaciones');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        if(!auth()->user()->can('ver empleados'))
            return response ()->view ('errors.403');
        $empleados  = \App\Models\RRHH\Empleado::listaEmpleado();          
        return view('RRHH/Empleados',  array('empleados'=>$empleados));
    }
    
    public function modalEmpleado(){
        if(!auth()->user()->can(['crear empleados','editar empleados']))
                return response ()->view ('errors.403-modal');
        $departamentos = Departamento::pluck('departamento','id');
        $areas = \App\Models\RRHH\Areas::pluck('area','id');
        $cargos = \App\Models\RRHH\Cargos::pluck('cargo','id');
        $empresas = \App\Models\RRHH\Empresa::pluck('empresa','ruc');
        return view('RRHH/empleadosModal',  array('departamentos'=>$departamentos,'areas'=>$areas,'cargos'=>$cargos,'empresas'=>$empresas));
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
    public function store(Requests\RRHH\EmpleadosCreateRequest $request) {        
        if($request->ajax()){
            if(!auth()->user()->can('crear empleados'))
                return response ()->view ('errors.403-content',[],403);
                       
            $persona = Persona::where('dni','=',$request->dni)->first();
//            dd($persona);
            if( count($persona)== 0 ){
                $persona = new Persona($request->all());
                $persona->sexo= $request->sexo;
                $persona->telefono=$request->celular;
                $persona->comites_locales_id = $request->comite_local;     
                $persona->fec_nac = Carbon::parse($request->fec_nac);
                $persona->paterno = strtoupper($request->paterno);
                $persona->materno = strtoupper($request->materno);
                $persona->nombre = strtoupper($request->nombre);
                $persona->direccion = strtoupper($request->direccion);  
                $persona->save();
            }
            else{
                $persona = Persona::where('dni','=',$request->dni)
                        ->update([
                    'paterno'=>strtoupper($request->paterno),
                            'materno'=>strtoupper($request->materno),
                            'nombre'=>strtoupper($request->nombre),
                            'fec_nac'=>Carbon::parse($request->fec_nac),
                            'sexo'=>$request->sexo,
                            'direccion'=>strtoupper($request->direccion),
                            'telefono'=>$request->celular,
                            'comites_locales_id'=>$request->comite_local,
                ]);
            }
                           
            $empleado = new Empleado($request->all());     
            $empleado->empleadoId = strtoupper($request->codigo);
            $empleado->estadocivil = $request->estado_civil;
            $empleado->personas_dni = $request->dni;
            $empleado->areas_id=$request->area;
            $empleado->cargos_id = $request->cargo;
            $empleado->empresas_ruc = $request->empresa;
            $empleado->save();            
            if($empleado)
            {                            
                return response()->json(['success'=>true,'message'=>'Se registro Correctamente el Empleado']);
            }
            else
            {                
                return response()->json(['success'=>false,'message'=>'No se Registro ningun dato']);
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
        $empleado = Empleado::empleado($id);
        $dato = view('Reportes.RRHH.RegistroEmpleado',['empleado'=>$empleado])->render();
        $pdf = \Illuminate\Support\Facades\App::make('dompdf.wrapper');
        $pdf->loadHTML($dato);                        
//        $pdf->loadview('Acopio.formExcel');
        return $pdf->stream();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){        
        $empleado = Empleado::getempleado($id);
        return response()->json($empleado);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\RRHH\EmpleadosCreateRequest $request, $id){
        //
        IF($request->ajax())
        {            
            if(!auth()->user()->can('editar empleados'))
                return response ()->view ('errors.403-content',[],403);
            $date = Carbon::parse($request->fec_nac);
            $empleado = Empleado::where('empleadoId', '=', $id)
                    ->join('personas', 'empleados.personas_dni', '=', 'personas.dni')
                    ->update([
                'empleados.estado' => $request->estado,
                'empleados.estadocivil' => $request->estado_civil,
                'empleados.email' => $request->email,
                'empleados.profesion' =>  strtoupper($request->profesion),
                'empleados.ruc' => $request->ruc,
                'empleados.areas_id' => $request->area,
                'empleados.cargos_id' => $request->cargo,
                'personas.paterno' => strtoupper($request->paterno),
                'personas.materno' => strtoupper($request->materno),
                'personas.nombre' => strtoupper($request->nombre),
                'personas.fec_nac' => $date,
                'personas.sexo' => $request->sexo,
                'personas.direccion' => strtoupper($request->direccion),                
                'personas.telefono' => $request->telefono,
                'personas.comites_locales_id' => $request->comite_local
            ]);

            if($empleado) return response()->json(['success'=>true,'message'=>'Se actualizaron correctamente los Datos']);            
            else return response()->json(['success'=>false,'message'=>'No se actualizaron ningun Datos']);            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        
        if(!auth()->user()->can('eliminar empleados'))
            return response ()->view ('errors.403-modal',[],403);            
        if(\App\Models\RRHH\Sucursal::where('empleados_empleadoId','=',$id)->count() > 0 || \App\Models\RRHH\Tecnico::where('empleados_empleadoId','=',$id)->count() > 0)
                return response ()->json (['success'=>false]);
        $empleado = Empleado::where('empleadoId','=',$id)->delete();
        if($empleado)
            return response ()->json (['success'=>true]);
        else
            return response ()->json (['success'=>false]);
    }
}
