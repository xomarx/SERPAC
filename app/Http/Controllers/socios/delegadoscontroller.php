<?php

namespace App\Http\Controllers\socios;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Socios\Cargos_delegado;

class delegadoscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        if(!auth()->user()->can('ver delegados'))
            return response ()->view ('errors.403');
        $delegados = Cargos_delegado::all();        
        return view('socios.basicos.delegados')->with('delegados',$delegados);
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
    public function store(Requests\socios\createCargo_delegadorequest $request)
    {
        if ($request->ajax()) {
            if(!auth()->user()->can('crear delegados'))
                return response ()->view ('errors.403-content',[],403);
            $cargo_delegada = Cargos_delegado::create([
                'cargo_delegado'=> strtoupper( $request->cargo_delegado)
            ]);
            if ($cargo_delegada) {
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
        $cargo_delegado = Cargos_delegado::FindOrFail($id);
        return response()->json($cargo_delegado);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\socios\createCargo_delegadorequest $request, $id)
    {        
        if($request->ajax()) {
            if(!auth()->user()->can('editar delegados'))
                return response ()->view ('errors.403-content',[],403);
            $cargo_delegado = Cargos_delegado::FindOrFail($id);
            $cargo_delegado->cargo_delegado = strtoupper($request->cargo_delegado);
            $cargo_delegado->save();
            if ($cargo_delegado)
                return response()->json(['success' => true, 'message' => 'Se Actualizo correctamente']);
            else
                return response()->json(['success' => false, 'message' => 'No se Actualizo']);
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
        if  (auth()->user()->can('crear delegados')) {
            $cargo_delegado = Cargos_delegado::FindOrFail($id);
            $resul = $cargo_delegado->delete();
            if ($resul)
                return response()->json(['success' => true]);
            else
                return response()->json(['success' => false]);
        }
    }
}
