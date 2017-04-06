<?php

namespace App\Http\Controllers\Tesoreria;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class egresoscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!auth()->user()->can('ver pagos'))
            return response ()->view ('errors.403');
        $egresos = \App\Models\Tesoreria\Egreso::listaEgresos();
        $tipo_egresos = \App\Models\Tesoreria\Tipo_egreso::pluck('tipo_egreso','id');
        $almacenes = \App\Models\RRHH\Sucursal::pluck('sucursal','sucursalId');
        return view('Tesoreria.gastos',['egresos'=>$egresos,'tipo_egresos'=>$tipo_egresos,'almacenes'=>$almacenes]);
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
    public function store(Requests\Tesoreria\GastosAcopioCreateRequest $request)
    {
        if($request->ajax()){
            if(!auth()->user()->can('crear pagos'))
                return response ()->view ('errors.403-content',[],403);
            $gastos = \App\Models\Tesoreria\Egreso::create([
                'fecha'=>  \Carbon\Carbon::parse($request->fecha),
                'monto'=>$request->monto,
                'motivo'=>  strtoupper($request->motivo),
                'estado'=>'CANCELADO',
                'sucursales_sucursalId'=>$request->almacen,
                'tipo_egresos_id'=>$request->egresos,
                'users_id'=>  \Illuminate\Support\Facades\Auth::user()->id
            ]);
            if($gastos) return response ()->json (['success'=>true,'message'=>'Se registro correctamente']);
            else return response ()->json (['success'=>false,'message'=>'No se registro ningun dato']);
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
        if($request->ajax()) {
            if(!auth()->user()->can('eliminar pagos'))
                return response ()->view ('errors.403-content',[],403);
            $gastos = \App\Models\Tesoreria\Egreso::FindOrFail($id);
            $gastos->estado = 'ANULADO';
            $gastos->motivo = strtoupper($request->motivo);
            $gastos->users_id = \Illuminate\Support\Facades\Auth::user()->id;
            $gastos->save();
            if ($request)
                return response()->json(['success' => true]);
            else
                return response()->json(['success' => false]);
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
