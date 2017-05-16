<?php

namespace App\Http\Controllers\Certificacion;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class condicioncontroller extends Controller
{
    public function Certificacion(){
                
        return response()->view('Certificacion.masterCertificacion');
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!auth()->user()->can('ver condicion'))
            return response ()->view ('errors.403',[],403);
        $condicion = \App\Models\Certificacion\Condicion::all();
        return response()->view('Certificacion.condicion',['condicions'=>$condicion]);
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
        if(!auth()->user()->can('crear condicion'))
            return response ()->view ('errors.403-content',[],403);
        $this->validate($request, ['condicion'=>'required|unique:condicions,condicion','descripcion'=>'required']);
        if($request->ajax()){
            $condicion = \App\Models\Certificacion\Condicion::create([
                'condicion'=>  strtoupper($request->condicion),
                'descripcion'=>  strtoupper($request->descripcion)
            ]);
            if($condicion) return response()->json (['success'=>true, 'message'=>'Se registro correctamente los Datos']);
            else return response ()->json (['success'=>false,'message'=>'Error no se registro ningun Dato']);
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
        $condicion = \App\Models\Certificacion\Condicion::FindOrFail($id);
        return response()->json($condicion);
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
        if(!auth()->user()->can('editar condicion'))
            return response ()->view ('errors.403-content',[],403);
        $this->validate($request, ['condicion'=>'required|unique:condicions,condicion','descripcion'=>'required']);
        if($request->ajax()){
            $condicion = \App\Models\Certificacion\Condicion::FindOrFail($id);
            $condicion->condicion=$request->condicion;
            $condicion->descripcion = $request->descripcion;
            $condicion->save();   
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
        if(!auth()->user()->can('eliminar condicion'))
            return response ()->view ('errors.403-content',[],403);
        $cont = \App\Models\Acopio\Compra::where('condicions_id','=',$id)->count();
        $cant = \App\Models\Socios\Condicions_has_socio::where('condicions_id','=',$id)->count();
        if($cont == 0 && $cant == 0){
            \App\Models\Certificacion\Condicion::where('id','=',$id)->delete();
            return response()->json(['success'=>true]);
        }
        return response()->json(['success'=>false]);
        
    }
}
