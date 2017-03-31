<?php

namespace App\Http\Controllers\socios;


use App\Models\Socios\Distrito;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Socios\Departamento;
use App\Models\Socios\Provincia;

class distritocontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function getdistritos(Request $request,$id)
    {        
        if($request ->ajax())
        {
            $distritos = Distrito::distritos($id);
            return response()->json($distritos);
        }
    }   
        
    public function index()
    {
        //
        if(!auth()->user()->can('ver distritos'))
            return response ()->view ('errors.403');
        $distritos = Distrito::listadistritos();
        $departamentos = Departamento::pluck('departamento','id');        
//        return view('socios.distrito')->with('distritos',$distritos);
        return response ()->view('socios.distrito',array('distritos'=>$distritos,'departamentos'=>$departamentos));
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
    public function store(Requests\socios\createdistritorequest $request)
    {
        //
        if($request->ajax())
        {
             if(!auth()->user()->can('crear distritos'))
                return response ()->view ('errors.403-content',[],403);
            $distrito = Distrito::create([
                'distrito'=>$request->distrito,
                'provincias_id'=>$request->provincia
            ]);
            $distrito->save();
            if($distrito)
            {
                return response()->json(['success' => 'true','message'=>'Se Registro Correctamente']);
            } else {
                    return response()->json(['success' => 'false','message'=>'No se registro ningun datos']);
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
        $distrito = Distrito::getdistrito($id);
        return response()->json($distrito);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\socios\createdistritorequest $request, $id)
    {
        //
        if($request ->ajax())
        {            
            if(!auth()->user()->can('editar distritos'))
                return response ()->view ('errors.403-content',[],403);
            $distrito = Distrito::FindOrFail($id);            
            $distrito->distrito = strtoupper($request->distrito);
            $distrito->provincias_id = $request->provincia;
            $distrito->save();        
            if ($distrito){
                return response()->json(['success'=>'true','message'=>'Se actualizaron correctamente los datos']);
            }
            else{
                return response()->json(['success'=>'false','message'=>'No se Actualizaron los datos']);
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
        if(auth()->user()->can('eliminar distritos')){
        $distritos=Distrito::FindOrFail($id)->delete();
        if($distritos)        
            return response()->json(['success'=>true]);        
        else        
            return response()->json(['success'=>false]);        
        }
        return response ()->view ('errors.403-content',[],403);
    }
}
