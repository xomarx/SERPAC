<?php

namespace App\Http\Controllers\socios;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Socios\Flora;

class floracontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(!auth()->user()->can('ver floras'))
            return response ()->view ('errors.403');
        $floras = Flora::all();
        return view('socios.basicos.flora',  compact('floras',$floras));
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
    public function store(Requests\socios\createFlorarequest $request)
    {
        //
        if ($request->ajax()) {
            if(!auth()->user()->can('crear floras'))
                return response ()->view ('errors.403-content',[],403);
            $flora = Flora::create(['flora'=>strtoupper($request->flora)]);
            if ($flora) {
                return response()->json(['success'=>true,'message'=>'Se registro correctamente']);
            } else {
                return response()->json(['success'=>false,'message'=>'No se registro']);
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
        $flora = Flora::FindOrFail($id);
        return response()->json($flora);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\socios\createFlorarequest $request, $id)
    {        
        if($request->ajax()){
            if(!auth()->user()->can('editar floras'))
                return response ()->view ('errors.403-content',[],403);
        $flora = Flora::FindOrFail($id);
        $flora->flora = strtoupper($request->flora);        
        $flora->save();
        if($flora)        
            return response()->json(['success'=>true,'message'=>'Se Actualizo correctamente']);        
        else        
            return response()->json(['success'=>false,'message'=>'No se Actualizo']);        
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
        if(auth()->user()->can('eliminar floras')){
                
        $flora = Flora::FindOrFail($id);
        $resul = $flora->delete();
        if($resul)
        
            return response()->json(['success'=>true]);
        
        else
        
            return response()->json(['success'=>false]);
        
        }
    }
}
