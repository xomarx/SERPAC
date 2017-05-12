<?php

namespace App\Http\Controllers\Acopio;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Certificacion\Condicion;
use App\Models\Acopio\Compra;

class comprascontroller extends Controller
{
    
    
        

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(!auth()->user()->can('ver compras'))
            return response()->view ('errors.403');
        $compras = \App\Models\Acopio\Compra::listaCompras('');                        
        return view('Acopio.compras',['compras'=>$compras]);
    }
    
    public function ListCompras($dato=''){
        if(!auth()->user()->can('ver compras'))
            return response()->view ('errors.403-content');
        $compras = \App\Models\Acopio\Compra::listaCompras($dato);                        
        return view('Acopio.ListCompras',['compras'=>$compras]);
    }


    public function modalCompras(){
        if(!auth()->user()->can('crear compras'))
            return response ()->view ('errors.403-modal');        
        $comite = \App\Models\Socios\Comites_Locale::pluck('comite_local','id');
        return response()->view('Acopio.comprasModal',['comite'=>$comite]);
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
        if(!auth()->user()->can('crear compras'))
            return response()->view ('errors.403-content',[],403);        
        if($request->ajax())
        {
            $tipodocumento = \App\Models\Configuracion\Tipo_documento::where('enlace','=','COMPRAS')->select('codigo')->first();
            if(count($tipodocumento)==0)
                return response()->json(['success'=>false,'message'=>'No esta enlazado a un Documento.<br> '
                    . 'Registre o enlace el documento con el nombre de "COMPRAS"']);
            $monto = round($request->precio * $request->kilos,2);
            $saldo = Compra::SaldoAlmacen($request->acopio);            
            iF($saldo == 0 || $monto > $saldo)
                return response ()->json (['success'=>false,'message'=>'No cuenta con saldo suficiente <h3>Su saldo es: S/. '.number_format($saldo,2).'</<h3>']);                                    
            $cadena = (string)($request->numero);
            $cadena = str_pad($cadena, 6, '0', STR_PAD_LEFT);            
            $documento = \App\Models\Configuracion\Documento::create([
                'enumeracion'=>$cadena,
                'importe'=>  $monto,                
                'tipo_documentos_cod'=>$tipodocumento->codigo
            ]);
            $nosocio = \App\Models\Acopio\Nosocio::where('dni', '=', $request->dni)->first();            
            if (count($nosocio) == 0) {
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
                'kilos'=>$request->kilos,
                'precio'=>$request->precio,
                'observacion'=>$request->observacion,
                'tipocacao'=>$request->tipo,
                'sucursales_sucursalId'=>$request->acopio,
                'condicions_id'=>$request->condicion,
                'socios_codigo'=>$request->codigo,'estado'=>'CANCELADO'
                ,'documentos_id'=>$documento->id, 
                'nosocios_dni'=>$request->dni,
                'total'=>$monto,
                'users_id'=>  \Illuminate\Support\Facades\Auth::user()->id,
            ]);                        
            if($compra)            
                return response()->json(['success'=>true,'message'=>'Se realiso la Compra correctamente','saldo'=>number_format($saldo,2)]);            
            else            
                return response()->json(['success'=>false,'message'=>'No se realizo ninguna compra']);            
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
            if(!auth()->user()->can('eliminar compras'))
                return response()->view ('errors.403-content',[],403);
            $compra = \App\Models\Acopio\Compra::FindOrFail($id);
            $compra->estado = 'ANULADO';
            $compra->motivo = $request->motivo;
            $compra->total = 0;
            $compra->precio=0;
            $compra->save();                                   
            if($compra)
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
