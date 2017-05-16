<?php

namespace App\Http\Controllers\RRHH;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\RRHH\Cargos;

class cargoscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!auth()->user()->can('ver cargos'))
            return response ()->view ('errors.403');
        $cargos = Cargos::all();
        return view('RRHH.cargos',  compact('cargos',$cargos));                
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
        $this->validate($request, ['cargo'=>'required|unique:cargos,cargo']);
        if($request->ajax())
        {
            if(!auth()->user()->can('crear cargos'))
                return response ()->view ('errors.403-content',[],403);
            $cargo = Cargos::create(['cargo'=>  strtoupper($request->cargo)]);
            if($cargo)  return response()->json(['success'=>true,'message'=>'Se registro correctamente']);            
            else  return response()->json(['success'=>false,'message'=>'No se Registro Ningun dato']);
            
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
        $cargo = Cargos::FindOrFail($id);
        return response()->json($cargo);
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
         $this->validate($request, ['cargo'=>'required|unique:cargos,cargo']);
        if($request->ajax())
        {
            if(!auth()->user()->can('editar cargos'))
                return response ()->view ('errors.403-content',[],403);
            $cargo = Cargos::FindOrFail($id);
            $cargo->cargo = strtoupper($request->cargo);
            $cargo->save();
            if($cargo)                
                return response()->json(['success'=>true,'message'=>'Se actualizaron los DAtos']);            
            else {
            return response()->json(['success'=>false,'message'=>'No se actualizo ningun dato']);
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
        if(!auth()->user()->can('eliminar cargos'))
                return response ()->view ('errors.403-content',[],403);
        $cargo = Cargos::FindOrFail($id)->delete();
        if($cargo) return response ()->json (['success'=>true]);
        
    }
}
