<?php

namespace App\Http\Controllers\RRHH;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(!auth()->user()->can('ver empresas'))
                return response ()->view ('errors.403',[],403);
        $empresas = \App\Models\RRHH\Empresa::listaEmpresas();
        return response()->view('RRHH/empresa',['empresas'=>$empresas]);
    }
    
    public function ListEmpresa(){
        if(!auth()->user()->can('ver empresas'))
                return response ()->view ('errors.403-content',[],403);
        $empresas = \App\Models\RRHH\Empresa::listaEmpresas();
        return response()->view('RRHH/empresaList',['empresas'=>$empresas]);
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
    public function store(Requests\RRHH\EmpresaRequest $request)
    {
        if($request->ajax()){
            if(!auth()->user()->can('crear empresas'))
                return response ()->view ('errors.403-content',[],403);
            try {
                $empresa = \App\Models\RRHH\Empresa::create([
                'empresa'=>  strtoupper($request->empresa),
                'ruc'=>$request->ruc,
                'direccion'=>  strtoupper($request->direccion)
            ]);
                if($empresa) return response ()->json (['success'=>true,'message'=>'Se registro correctamente']);
            else return response ()->json (['success'=>false,'message'=>'No se Registro']);
            } catch (Exception $exc) {                
                return response ()->json (['success'=>false,'message'=>$exc-getTraceAsString()]);
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
        $empresa = \App\Models\RRHH\Empresa::where('ruc','=',$id)->first();
        return response()->json($empresa);
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
        if($request->ajax()){
            if(!auth()->user()->can('editar empresas'))
                return response ()->view ('errors.403-content',[],403);
            $empresa = \App\Models\RRHH\Empresa::where('ruc','=',$id)
                    ->update([
                        'empresa'=>  strtoupper($request->empresa),
                        'direccion'=>  strtoupper($request->direccion)
                    ]);
            if($empresa) return response ()->json (['success'=>true,'message'=>'Se Actualizaron los Datos']);
            else return response ()->json (['success'=>false,'message'=>'No se actualizaron ningun registro']);
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
        if(!auth()->user()->can('eliminar empresas'))
                return response ()->view ('errors.403-content',[],403);
        $empresa = \App\Models\RRHH\Empleado::where('empresas_ruc','=',$id)->first();        
        if(count($empresa) > 0)
            return response ()->json (['success'=>false]);
        $empresa = \App\Models\RRHH\Empresa::where('ruc','=',$id)->delete();
        if($empresa) return response ()->json (['success'=>true]);
        else return response ()->json (['success'=>false]);
//            
    }
}
