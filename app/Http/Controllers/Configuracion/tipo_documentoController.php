<?php

namespace App\Http\Controllers\Configuracion;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class tipo_documentoController extends Controller
{
    
    public function getnumerodocumento($idrecibo){
        $numero = \App\Models\Configuracion\Documento::enumeracionDoc($idrecibo); 
        if(is_null($numero) )
            $dato = 1;         
        else
            $dato = $numero->enumeracion + 1;
         return response()->json($dato);
    }


    public function autoCompleteCodRecibo(Request $request){
        if($request->ajax()){
            $nombre = \Illuminate\Support\Facades\Input::get('term');
            $recibos = \App\Models\Configuracion\Tipo_documento::autoCompleteTipo_Doc($nombre);// pluck('codigo')->take(7)->get();            
            foreach ($recibos as $recibo) 
            {
                $result[] = ['id' => $recibo->codigo, 'value' => $recibo->codigo];
            }
            return response()->json($result);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
        //
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
    }
}
