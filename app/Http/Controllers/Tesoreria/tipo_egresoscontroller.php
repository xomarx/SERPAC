<?php

namespace App\Http\Controllers\Tesoreria;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Tesoreria\Tipo_egreso;

class tipo_egresoscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tipoegresos = Tipo_egreso::all();
        return view('Tesoreria.tiposegresos')->with('tipoegresos',$tipoegresos);
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
    public function store(Requests\Tesoreria\Tipo_egresoCreateRequest $request)
    {
        //
        if($request->ajax())
        {
            $tipoegreso = \App\Models\Tesoreria\Tipo_egreso::create([
                'tipo_egreso'=>  strtoupper($request->tipo),
                'descripcion'=>strtoupper($request->descripcion)
            ]);
            if($tipoegreso) return response ()->json (['success'=>true,'message'=>'Se registro correctamente']);
            else return response ()->json (['success'=>false,'message'=>'no se registro ningun dato']);
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
        $tipoegreso = Tipo_egreso::FindOrFail($id);
        return response()->json($tipoegreso);
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
            $tipoegreso = Tipo_egreso::FindOrFail($id);
            $tipoegreso->tipo_egreso=  strtoupper($request->tipo);
            $tipoegreso->descripcion =strtoupper( $request->descripcion);
            $tipoegreso->save();
            if($tipoegreso)
            {
                return response()->json(['success'=>true,'message'=>'Se actualizaron correctamente']);
            }
            else
            {
                return response()->json(['success'=>false,'message'=>'no se actualizaron datos']);
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
        $egreso = Tipo_egreso::FindOrFail($id)->delete();
        if($egreso) return response ()->json (['success'=>true]);
        else return response ()->json (['success'=>false]);        
    }
}
