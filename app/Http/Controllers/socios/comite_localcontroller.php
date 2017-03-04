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
        $comites_locales = DB::table('comites_locales')
                ->join('comites_centrales','comites_locales.comites_centrales_id','=','comites_centrales.id')
                ->join('distritos','comites_centrales.distritos_id','=','distritos.id')
                ->join('provincias','distritos.provincias_id','=','provincias.id')
                ->join('departamentos','provincias.departamentos_id','=','departamentos.id')
                ->select( 'comites_locales.id','comites_locales.comite_local','comites_locales.comites_centrales_id'
                        ,'comites_centrales.comite_central','comites_centrales.distritos_id','distritos.distrito'
                        ,'distritos.provincias_id','provincias.provincia','provincias.departamentos_id','departamentos.departamento')
                ->get();
        $departamentos = Departamento::pluck('departamento','id')->prepend('Selleciona');        
//        return view('socios.distrito')->with('distritos',$distritos);
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
    public function store(Request $request)
    {
        //
        if($request->ajax())
        {
            $local = Comites_Locale::create($request->all());
            if($local)
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
    public function update(Request $request, $id)
    {
        //
        if($request->ajax())
        {
            $comite_local = Comites_Locale::FindOrFail($id);
            $comite_local->fill($request->all());
            $comite_local->save();
            if($comite_local)
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
