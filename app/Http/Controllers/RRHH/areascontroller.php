<?php

namespace App\Http\Controllers\RRHH;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\RRHH\Areas;

class areascontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!auth()->user()->can('ver areas'))
            return response ()->view ('errors.403');
        $areas = Areas::all();
        return view('RRHH/areas',  compact('areas',$areas));
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
        $this->validate($request, ['area'=>'required|unique:areas,area']);
        if($request->ajax())
        {
            if(!auth()->user()->can('crear areas'))
                return response ()->view ('errors.403-content',[],403);
            $area = Areas::create($request->all());
            if($area) return response()->json(['success'=>true,'message'=>'Se Registro correctamente']);
            else return response()->json(['success'=>false,'No se registro nigun Dato']);            
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
        $area = Areas::FindOrFail($id);
        return response()->json($area);
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
        $this->validate($request, ['area'=>'required|unique:areas,area']);
        if($request->ajax())
        {
            if(!auth()->user()->can('editar areas'))
                return response ()->view ('errors.403-content',[],403);
            $area = Areas::FindOrFail($id);
            $area->area = $request->area;
            $area->save();
            if($area)          
                return response()->json(['success'=>true,'message'=>'Se actualizo correctamente']);            
            else            
                return response()->json(['success'=>false,'message'=>'No se actualizo ningun Dato']);            
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
        if(!auth()->user()->can('eliminar areas'))
            return response ()->view ('errors.403-content',[],403);
        $area = Areas::FindOrFail($id)->delete();
        if($area) return response ()->json (['success'=>true]);
    }
}
