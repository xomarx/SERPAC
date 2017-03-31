<?php

namespace App\Http\Controllers\socios;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Socios\Departamento;
//use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Session;
use Laracasts\Flash\Flash;

class departamentocontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        if(!auth()->user()->can('ver departamentos'))
            return response ()->view ('errors.403');
        $departamentos = DB::table('departamentos')
                ->select('departamentos.id','departamentos.departamento')->get();
        return view('socios.departamentos')->with('departamentos',$departamentos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        return view('socios.creardepartamento');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\socios\createDepartamentorequest $request)
    {
        if ($request->ajax())
        {
            if(!auth()->user()->can('crear departamentos'))
                return response ()->view ('errors.403-content',[],403);
                $departamento = Departamento::create(['departamento'=>  strtoupper($request->departamento)]);
                if($departamento)
                {
                    return response()->json(['success' => true,'message'=>'Se Registro Correctamente']);
                } else {
                    return response()->json(['success' => false,'message'=>'No se registro ningun datos']);
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
        $departamento = Departamento::FindOrFail($id);        
        return response()->json($departamento);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\socios\createDepartamentorequest $request, $id)
    {
        //
        if ($request->ajax())
        {
            if(!auth()->user()->can('editar departamentos'))
                return response ()->view ('errors.403-content',[],403);
            $departamento = Departamento::FindOrFail($id);
            $departamento->departamento = strtoupper($request->departamento);            
            $departamento->save();
            if ($departamento){
                return response()->json(['success'=>true,'message'=>'Se Actualizo correctamente los Datos']);
            }
            else{
                return response()->json(['success'=>false,'message'=>'No se Actualizaron los datos']);
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
        if(auth()->user()->can('eliminar departamentos')){
        $departamento = Departamento::FindOrFail($id);
        $result = $departamento->delete();
        if ($result)
        {            
            return response()->json(['success'=>true]); 
        }
        else
        {
            return response()->json(['success'=> false]);
        }}
    }
}
