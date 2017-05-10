<?php

namespace App\Http\Controllers\socios;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class cargodirectivosociocontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        if(!auth()->user()->can('ver asigDirectivos'))
                return response ()->view ('errors.403',[],403);
        $asigdirectivos = \App\Models\Socios\Cargos_directivo::listaAsignacionDirectivos('');
        $directivos = \App\Models\Socios\Cargos_directivo::pluck('cargo_directivo','id');
        return view('socios.asigdirectivos',['directivos'=>$directivos,'asigdirectivos'=>$asigdirectivos]);
    }
    
    public function listaAsigDirectivos($dato=''){
        if(!auth()->user()->can('ver asig delegados'))
                return response ()->view ('errors.403-content');
        $asigdirectivos = \App\Models\Socios\Cargos_directivo::listaAsignacionDirectivos($dato);
        return response()->view('socios.asigDirectivosList',['asigdirectivos'=>$asigdirectivos]);
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
    public function store(Requests\socios\AsigDirectivosRequest $request)
    {
        //
        if($request->ajax()){
            if(!auth()->user()->can('crear asigDirectivos'))
                return response ()->view ('errors.403-content',[],403);
            $socio = \App\Models\Socios\Socio::where('dni','=',$request->dni)->select('dni')->first();
            $pariente = \App\Models\Socios\Pariente::where('personas_dni','=',$request->dni)->select('personas_dni')->first();
            if(count($socio) == 0 && count($pariente) == 0)
                return response ()->json (['success'=>false,'message'=>'El N° de DNI no pertenece a ningun Socio o Beneficiario']);
            $cargo = \App\Models\Socios\Cargos_directivos_has_socios::create([
                'cargos_directivos_id'=>$request->directivo,
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
        //
        $asigdirectivo = \App\Models\Socios\Cargos_directivo::getAsigDirectivo($id);
        $datetime1=new \DateTime($asigdirectivo->fecha_inicial);
        $datetime2=new \DateTime($asigdirectivo->fecha_final);    
        # obtenemos la diferencia entre las dos fechas
        $interval=$datetime2->diff($datetime1); 
        # obtenemos la diferencia en meses
        $intervalMeses=$interval->format("%m");       
        $asigdirectivo->fecha_final= $intervalMeses;
        return response()->json($asigdirectivo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\socios\AsigDirectivosRequest $request, $id)
    {        
        if($request->ajax()){
            if(!auth()->user()->can('editar asigDirectivos'))
                return response ()->view ('errors.403-content',[],403);
            $cargo = \App\Models\Socios\Cargos_directivos_has_socios::where('cargos_directivos_has_socios.id','=',$id)
                    ->update([
                'cargos_directivos_id'=>$request->directivo,
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
       if(!auth()->user()->can('eliminar asigDirectivos'))
                return response ()->view ('errors.403-content',[],403);
            $dele = \App\Models\Socios\Cargos_directivos_has_socios::FindOrFail($id)->delete();
            if($dele) return response ()->json (['success'=>true]);
            else return response ()->json (['success'=>false]);
    
    }
}
