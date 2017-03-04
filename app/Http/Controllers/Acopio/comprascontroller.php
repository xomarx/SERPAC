<?php

namespace App\Http\Controllers\Acopio;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Certificacion\Condicion;
use App\Models\Acopio\Compra;

class comprascontroller extends Controller
{
    
    public function  planillasemanal()
    {                
        return view('Acopio.planillasemanal');        
    }
    
    public function ListaplanillaSemanal($sucursal,$fecha,$condicion)
    {                        
        $fecha = str_replace('-','/', $fecha);
        $fecha = \Carbon\Carbon::parse($fecha);
        $planillas = Compra::planillasemanal($sucursal, $fecha, $condicion);
        return response()->json($planillas);
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $compras = \App\Models\Acopio\Compra::listaCompras();
        $condicions = Condicion::pluck('condicion','id')->prepend('Selleciona una Condicion'); 
        $fecha = \Carbon\Carbon::now();
        $fecha = $fecha->format('m/d/Y');
        return view('Acopio.compras',['compras'=>$compras,'condicions'=>$condicions,'fecha'=>$fecha]);
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
        $date = \Carbon\Carbon::parse($request->fecha);
        if($request->ajax())
        {
            $documento = \App\Models\Documento::create([
                'enumeracion'=>$request->enumeracion,
                'importe'=>  round($request->precio * $request->kilos,2),
                'tipo_documentos_id'=>'RE'
            ]);
            $compra = \App\Models\Acopio\Compra::create([
                'fecha'=>$date,'kilos'=>$request->kilos,'precio'=>$request->precio,
                'observacion'=>$request->observacion,'tipocacao'=>$request->tipocacao,
                'sucursales_sucursalId'=>$request->sucursal,'condicions_id'=>$request->condicion,
                'socios_codigo'=>$request->codigo,'estado'=>'CANCELADO'
                ,'documentos_id'=>$documento->id
            ]);
            if($compra)
            {
                return response()->json(['success'=>'true']);
            }
            else
            {
                return response()->json(['success'=>'false']);
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
        if($request->ajax())
        {
            $compra = \App\Models\Acopio\Compra::FindOrFail($id);
            $compra->estado = 'ANULADO';
            $compra->motivo = $request->motivo;
            $compra->save();                                   
            if($compra)
            {
                return response()->json(['success'=>'true']);
            }
            else
            {
                return response()->json(['success'=>'false']);
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
    }
}
