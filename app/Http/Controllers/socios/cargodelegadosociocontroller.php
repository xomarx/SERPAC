<?php

namespace App\Http\Controllers\socios;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class cargodelegadosociocontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(!auth()->user()->can('ver asig delegados'))
                return response ()->view ('errors.403',[],403);
        $asignaciones = \App\Models\Socios\Cargos_delegado::listaAsignacionDelegados('');
        $delegados = \App\Models\Socios\Cargos_delegado::pluck('cargo_delegado','id');
        return view('socios.asigdelegado',['delegados'=>$delegados,'asignaciones'=>$asignaciones]);
    }
    
    public function listaAsigDelegados($dato=''){
        if(!auth()->user()->can('ver asig delegados'))
                return response ()->view ('errors.403-content');
        $asignaciones = \App\Models\Socios\Cargos_delegado::listaAsignacionDelegados($dato);
        return response()->view('socios.asigDelegadoList',['asignaciones'=>$asignaciones]);
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
    public function store(Requests\socios\AsigDelegadosRequest $request)
    {
        //
        if($request->ajax()){
            if(!auth()->user()->can('crear asig delegados'))
                return response ()->view ('errors.403-content',[],403);
            $socio = \App\Models\Socios\Socio::where('dni','=',$request->dni)->select('dni')->first();
            $pariente = \App\Models\Socios\Pariente::where('personas_dni','=',$request->dni)->select('personas_dni')->first();
            if(count($socio) == 0 && count($pariente) == 0)
                return response ()->json (['success'=>false,'message'=>'El N° de DNI no pertenece a ningun Socio o Beneficiario']);
            $cargo = \App\Models\Socios\Cargos_delegados_has_socios::create([
                'cargos_delegados_id'=>$request->delegado,
                'personas_dni'=>$request->dni,
                'fecha_inicio'=> \Carbon\Carbon::parse($request->inicio),
                'fecha_final'=>  \Carbon\Carbon::parse($request->inicio)->addMonth($request->final),
                'estado'=>$request->estado
            ]);
            if($cargo)
                return response ()->json (['success'=>true,'message'=>'Se registro Correctamente']);
            else 
                return response ()->json (['success'=>false,'message'=>'No se registro']);
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
        $asigdelegado = \App\Models\Socios\Cargos_delegado::getAsigDelegado($id);
        $datetime1=new \DateTime($asigdelegado->fecha_inicial);
        $datetime2=new \DateTime($asigdelegado->fecha_final);    
        # obtenemos la diferencia entre las dos fechas
        $interval=$datetime2->diff($datetime1); 
        # obtenemos la diferencia en meses
        $intervalMeses=$interval->format("%m");       
        $asigdelegado->fecha_final= $intervalMeses;
        return response()->json($asigdelegado);
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
        if($request->ajax()){
            if(!auth()->user()->can('editar asig delegados'))
                return response ()->view ('errors.403-content',[],403);
            $cargo = \App\Models\Socios\Cargos_delegados_has_socios::where('cargos_delegados_has_socios.id','=',$id)
                    ->update([
                'cargos_delegados_id'=>$request->delegado,
                'personas_dni'=>$request->dni,
                'fecha_inicio'=> \Carbon\Carbon::parse($request->inicio),
                'fecha_final'=>  \Carbon\Carbon::parse($request->inicio)->addMonth($request->final),
                'estado'=>$request->estado
            ]);
            if($cargo) return response ()->json (['success'=>true,'message'=>'Se Actualizo correctamente']);
            else return response ()->json (['success'=>false,'message'=>'No se Actualizo Ningun Registro']);
                
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
        if(!auth()->user()->can('eliminar asig delegados'))
                return response ()->view ('errors.403-content',[],403);
            $dele = \App\Models\Socios\Cargos_delegados_has_socios::FindOrFail($id)->delete();
            if($dele) return response ()->json (['success'=>true]);
            else return response ()->json (['success'=>false]);
    }
}
