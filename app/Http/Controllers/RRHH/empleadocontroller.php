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


class empleadocontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $empleados  = \App\Models\RRHH\Empleado::listaEmpleado();
        $departamentos = Departamento::pluck('departamento','id');
        $areas = \App\Models\RRHH\Areas::pluck('area','id');
        $cargos = \App\Models\RRHH\Cargos::pluck('cargo','id');
        return view('RRHH/empleados',  array('empleados'=>$empleados,'departamentos'=>$departamentos,'areas'=>$areas,'cargos'=>$cargos));
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
        if($request->ajax())
        {                                  
            $persona = new Persona($request->all());                        
            $persona->comites_locales_id = $request->comite_local;     
            $persona->fec_nac = Carbon::parse($request->fec_nac);
            $persona->paterno = strtoupper($request->paterno);
            $persona->materno = strtoupper($request->materno);
            $persona->nombre = strtoupper($request->nombre);
            $persona->direccion = strtoupper($request->direccion);  
            $persona->save();               
            $empleado = new Empleado($request->all());     
            $empleado->empleadoId = strtoupper($request->codigo);
            $empleado->estadocivil = $request->estado_civil;
            $empleado->personas_dni = $persona->dni;
            $empleado->areas_id=$request->area;
            $empleado->cargos_id = $request->cargo;
            $empleado->save();            
            if($empleado)
            {                            
                return response()->json(['success'=>'true','message'=>'Se registro Correctamente el Empleado']);
            }
            else
            {                
                return response()->json(['success'=>'false','message'=>'No se Registro ningun dato']);
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
        $empleado = Empleado::empleado($id);
        return response()->json($empleado);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\RRHH\EmpleadosUpdateRequest $request, $id){
        //
        IF($request->ajax())
        {            
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

            if($empleado)
            {                            
                return response()->json(['success'=>'true','message'=>'Se actualizaron correctamente los Datos']);
            }
            else
            {                
                return response()->json(['success'=>'false','message'=>'No se actualizaron ningun Datos']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
        $empleado = Empleado::where('empleadoId','=',$id)->delete();
        if($empleado)
            return response ()->json (['success'=>'true']);
        else
            return response ()->json (['success'=>'false']);
    }
}
