<?php

namespace App\Http\Controllers\Acopio;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Certificacion\Condicion;
use App\Models\Acopio\Compra;

class comprascontroller extends Controller
{
    
    public function autoCompleteNosocios(Request $request){
        if($request->ajax()){
            $nombre = \Illuminate\Support\Facades\Input::get('term');
            $nosocios = \App\Models\Acopio\Nosocio::where('dni','like','%'.$nombre.'%')->get();
            foreach ($nosocios as $nosocio) 
            {
                $result[] = ['id' => $nosocio->paterno, 'value' => $nosocio->dni,'materno'=>$nosocio->materno,'nombres'=>$nosocio->nombres];
            }
            return response()->json($result);
        }
    }


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
        $condicions = Condicion::pluck('condicion','id'); 
        $comite = \App\Models\Socios\Comites_Locale::pluck('comite_local','id');                
        return view('Acopio.compras',['compras'=>$compras,'condicions'=>$condicions,'comite'=>$comite]);
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
    public function store(Requests\Acopio\ComprasCreateRequest $request)
    {
        //
        $date = \Carbon\Carbon::parse($request->fecha);
        if($request->ajax())
        {
            $documento = \App\Models\Configuracion\Documento::create([
                'enumeracion'=>$request->numero,
                'importe'=>  round($request->precio * $request->kilos,2),
                'tipo_documentos_cod'=>$request->codrecibo
            ]);
            $nosocio = \App\Models\Acopio\Nosocio::where('dni', '=', $request->dni)->first();
            if (!$nosocio) {
                if ($request->estado == "NOSOCIO") {
                    $nosocio = \App\Models\Acopio\Nosocio::create([
                                'dni' => $request->dni,
                                'paterno' => strtoupper($request->paterno),
                                'materno' => strtoupper($request->materno),
                                'nombres' => strtoupper($request->nombres),
                                'comites_locales_id' => $request->comite
                    ]);
                }
            }
            $compra = \App\Models\Acopio\Compra::create([
                'fecha'=>\Carbon\Carbon::parse($request->fecha),
                'kilos'=>$request->kilos,'precio'=>$request->precio,
                'observacion'=>$request->observacion,'tipocacao'=>$request->tipo,
                'sucursales_sucursalId'=>$request->acopio,'condicions_id'=>$request->condicion,
                'socios_codigo'=>$request->codigo,'estado'=>'CANCELADO'
                ,'documentos_id'=>$documento->id, 
                'nosocios_dni'=>$request->dni,
                'users_id'=>  \Illuminate\Support\Facades\Auth::user()->id
            ]);                        
            if($compra)
            {
                return response()->json(['success'=>'true','message'=>'Se realiso la Compra correctamente']);
            }
            else
            {
                return response()->json(['success'=>'false','message'=>'No se realizo ninguna compra']);
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
