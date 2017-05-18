<?php

namespace App\Http\Controllers\Tesoreria;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ChequeController extends Controller
{
    public function cheque(){
        if(!auth()->user()->can(['crear cheques','editar cheques']))
                return response ()->view ('errors.403-modal');
        return  view('Tesoreria.chequeModal');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        if(!auth()->user()->can('ver cheques'))
                return response ()->view ('errors.403');
        $cheques = \App\Models\Tesoreria\Cheque::ListaCheques('');
        return view('Tesoreria.Cheques')->with('cheques',$cheques);
    }

    public function listaCheque($dato=''){
        if(!auth()->user()->can('ver cheques'))
                return response ()->view ('errors.403-content');
        $cheques = \App\Models\Tesoreria\Cheque::ListaCheques($dato);
        return response()->view('Tesoreria.chequesList',['cheques'=>$cheques]);
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
    public function store(Requests\Tesoreria\ChequeRequest $request)
    {
        //
        if($request->ajax()){
            if(!auth()->user()->can('crear cheques'))
                return response ()->view ('errors.403-content',[],403);
            $cheque = \App\Models\Tesoreria\Cheque::create([
                'cheque'=>  strtoupper($request->cheque),
                'num_cuenta'=>$request->numero,
                'descripcion'=>$request->descripcion
            ]);
            if($cheque) return response ()->json (['success'=>true,'message'=>'Se Registro Correctamente']);
            else return response ()->json (['success'=>false,'message'=>'Error al registrar']);
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
        $cheque = \App\Models\Tesoreria\Cheque::FindOrFail($id);
        return response()->json($cheque);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\Tesoreria\ChequeRequest $request, $id)
    {
        if($request->ajax()) {
            if(!auth()->user()->can('editar cheques'))
                return response ()->view ('errors.403-content',[],403);
            $cheque = \App\Models\Tesoreria\Cheque::FindOrFail($id);
            $cheque->cheque = strtoupper($request->cheque);
            $cheque->num_cuenta = $request->numero;
            $cheque->descripcion = $request->descripcion;
            $cheque->save();
            if ($cheque)
                return response()->json(['success' => true, 'message' => 'Se actualizaron correctamente']);
            else
                return response()->json(['success' => false, 'message' => 'No se actualizaron datos']);
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
        if(!auth()->user()->can('eliminar cheques'))
                return response ()->view ('errors.403-content',[],403);
        $cheque = \App\Models\Tesoreria\Cheque::FindOrFail($id)->delete();
        if($cheque) return response ()->json (true);
        else return response ()->json (false);
    }
}
