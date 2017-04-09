<?php

namespace App\Http\Controllers\Acopio;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Acopio\Recepcion_fondo;

class recepcion_fondoscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(!auth()->user()->can('ver fondos'))
            return response ()->view ('errors.403');
        $recepcions = Recepcion_fondo::listaRecepcio();
        $anios = \App\Models\Socios\Socio::orderby('fec_asociado', 'asc')->first();
        $resul[] = 'Todo los Años';
        for ($i = 2016; $i <= \Carbon\Carbon::now()->format('Y'); $i++) {
            $resul[$i] = $i;                                                   
        }
        setlocale(LC_TIME, 'spanish');
        $meses[] = 'Todo los Meses';
        for ($i = 1; $i <= 12; $i++) {
            $meses[] = strftime("%B", mktime(0, 0, 0, $i, 1, 2000));
        }
        return view('Acopio.recepcion_fondos',  ['recepcions'=>$recepcions,'anios'=>$resul,'meses'=>$meses]);
    }
    
    public function recepcionfondos($anio,$mes){
        if(!auth()->user()->can('ver fondos'))
            return response ()->view ('errors.403');
        $recepcions = Recepcion_fondo::listaRecFondos($anio,$mes);
        return view('Acopio.listaRecepcionFondos')->with('recepcions',$recepcions);
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
        $recepcion = Recepcion_fondo::FindOrFail($id);
        return response()->json($recepcion);
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
            if(!auth()->user()->can('crear fondos'))
                return response ()->view ('errors.403-content',[],403);
            $recepcio = Recepcion_fondo::FindOrFail($id);
            $recepcio->monto = $request->monto;
            $recepcio->estado= $request->estado;
            $recepcio->motivo = $request->motivo;            
            $recepcio->save();
            if($recepcio)
            {
                return response()->json(['success'=>true]);
            }
            else
            {
                return response()->json(['success'=>false]);
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
