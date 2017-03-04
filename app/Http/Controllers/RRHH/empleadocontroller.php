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
        $departamentos = Departamento::pluck('departamento','id')->prepend('Selleciona');
        $areas = \App\Models\RRHH\Areas::pluck('area','id')->prepend('Selleciona');
        $cargos = \App\Models\RRHH\Cargos::pluck('cargo','id')->prepend('Selleciona');
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
    public function store(Request $request)
    {        
        if($request->ajax())
        {
            $persona = new Persona($request->all());
            $date = Carbon::parse($request->fec_nac);
            $persona->fec_nac=$date;
            $persona->comites_locales_id = $request->comites_locales_id;
            $persona->sexo = $request->sexo;
            $persona->save();
            $dni = $persona->dni;           
            $empleado = new Empleado($request->all());                        
            $empleado->personas_dni = $dni;
            $empleado->areas_id=$request->areas_id;
            $empleado->cargos_id = $request->cargos_id;
            $empleado->save();            
            if($empleado)
            {                            
                return response()->json(['succes'=>'true']);
            }
            else
            {                
                return response()->json(['succes'=>'false']);
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
    public function update(Request $request, $id)
    {
        //
        IF($request->ajax())
        {
            
            $date = Carbon::parse($request->fec_nac);
            $empleado = Empleado::where('empleadoId', '=', $id)
                    ->join('personas', 'empleados.personas_dni', '=', 'personas.dni')
                    ->update([
                'empleados.estado' => $request->estado,
                'empleados.estadocivil' => $request->estadocivil,
                'empleados.email' => $request->email,
                'empleados.profesion' => $request->profesion,
                'empleados.ruc' => $request->ruc,
                'empleados.areas_id' => $request->areas_id,
                'empleados.cargos_id' => $request->cargos_id,
                'personas.paterno' => $request->paterno,
                'personas.materno' => $request->materno,
                'personas.nombre' => $request->nombre,
                'personas.fec_nac' => $date,
                'personas.sexo' => $request->sexo,
                'personas.direccion' => $request->direccion,
                'personas.referencia' => $request->referencia,
                'personas.telefono' => $request->telefono,
                'personas.comites_locales_id' => $request->comites_locales_id
            ]);

            if($empleado)
            {                            
                return response()->json(['succes'=>'true']);
            }
            else
            {                
                return response()->json(['succes'=>'false']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
