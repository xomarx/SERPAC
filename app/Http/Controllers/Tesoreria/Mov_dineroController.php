<?php

namespace App\Http\Controllers\Tesoreria;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use SoapClient;

class Mov_dineroController extends Controller
{
    
    public function StoreSinDocumentos(Requests\Tesoreria\DineroSinDocRquest $reques){
        if($reques->ajax()){            
            $idempleado = \App\Models\RRHH\Empleado::where('personas_dni','=',$reques->dni)->select('empleadoId')->first();
            $dinero = \App\Models\Tesoreria\Dinero_sin_documento::create([
                'fecha'=>$reques->fecha,
                'detalle'=> strtoupper($reques->detalle),
                'monto'=>$reques->monto,
                'tipoGasto'=>$reques->gasto,
                'estado'=>$reques->tipo,
                'users_id'=>  auth()->user()->id,
                'empleados_empleadoId'=>$idempleado->empleadoId,
            ]);
            if($dinero) return response ()->json (['success'=>true,'message'=>'Se registro Corectamente']);
            else return response ()->json (['success'=>false,'message'=>'No se registro ningun dato']);
        }
    }


    public function MDSinDocumento(){        
//        $servicio = new SoapClient("https://www.sunat.gob.pe:443/ol-ad-itseida-ws/ReceptorService.htm?wsdl");
        
//        dd($wsdl);
        $SDdinero = \App\Models\Tesoreria\Dinero_sin_documento::listaSD();
        return response()->view('Tesoreria.movDineroSDList',['dineros'=>$SDdinero]);
    }
    
    public function MDConDocumento(){        
//        $servicio = new SoapClient("https://www.sunat.gob.pe:443/ol-ad-itseida-ws/ReceptorService.htm?wsdl");
        
//        dd($wsdl);        
        return response()->view('Tesoreria.movDineroList');
    }

    public function modalDinero(){
        return response()->view('Tesoreria.movDineroModal');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->view('Tesoreria.movDinero');
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
