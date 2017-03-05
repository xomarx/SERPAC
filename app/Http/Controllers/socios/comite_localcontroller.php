<?php

namespace App\Http\Controllers\socios;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Socios\Departamento;
use App\Models\Socios\Comites_Locale;

class comite_localcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function getcomites_locales(Request $request  ,$id)
    {
        
        if($request->ajax())
        {            
            $comites_locales = Comites_Locale::comites_locales($id);
            return response()->json($comites_locales);
        }
    }
    
    public function index()
    {
        //
        $comites_locales = Comites_Locale::getlistaComite_Local();
        $departamentos = Departamento::pluck('departamento','id');        
        return view('socios.comitelocal',array('comites_locales'=>$comites_locales,'departamentos'=>$departamentos));
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
    public function store(Requests\socios\Comite_localCreateRequet $request)
    {
        //
        if($request->ajax())
        {
            $local = Comites_Locale::create([
                'comite_local'=>  strtoupper($request->comite_local),
                'comites_centrales_id'=>$request->comite_central
            ]);
            if($local)
            {
                return response()->json(['success'=>'true','message'=>'Se registro Correctamente']);
            }
            else
            {
                return response()->json(['success'=>'false','message'=>'no se Registro ningun Dato']);
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
        $comite_local = Comites_Locale::comite_local($id);
        return response()->json($comite_local);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\socios\Comite_localCreateRequet $request, $id)
    {
        //
        if($request->ajax())
        {
            $comite_local = Comites_Locale::FindOrFail($id);
            $comite_local->comites_centrales_id = $request->comite_central;
            $comite_local->comite_local = strtoupper($request->comite_local);
            $comite_local->save();
            if($comite_local)
            {
                return response()->json(['success'=>'true','message'=>'Se actualizaron los datos']);
            }
            else
            {
                return response()->json(['success'=>'false','message'=>'no se actualizo ningun registro']);
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
        $comite_local = Comites_Locale::FindOrFail($id);
        $result = $comite_local->delete();
        if($result)
        {
            return response()->json(['success'=>'true']);
        }
        else
        {
            return response()->json(['success'=>'false']);
        }
    }
}
