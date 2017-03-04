<?php

namespace App\Http\Controllers\socios;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Socios\Departamento;
use App\Models\Socios\Comites_Centrales;
use Illuminate\Http\Request;

use App\Http\Requests;


class comite_centralcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function getcomites_centrales(Request $request,$id)
    {                
        if($request->ajax())
        {
            $comites_centrales = Comites_Centrales::comites_centrales($id);
            return response()->json($comites_centrales);
        }
    }
    
    public function index()
    {
        //
        $comite_centrales = Comites_Centrales::getlistaComites(); 
        $departamentos = Departamento::pluck('departamento','id');
        return view('socios.comitecentral',array('comites_centrales'=>$comite_centrales,'departamentos'=>$departamentos));
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
    public function store(Requests\socios\createcomite_centralrequest $request)
    {
        //
        if($request->ajax())
        {
            $comite_centrals = Comites_Centrales::create($request->all());
            if($comite_centrals)
            {
                return response()->json(['success'=>'true','message'=>'Se Registro correctamente']);
            }
            else
            {
                return response()->json(['success'=>'false','message'=>'No se Registro ningun dato']);
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
        $comite_cetrals = Comites_Centrales::comite_central($id);
        return response()->json($comite_cetrals);
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
            $central = Comites_Centrales::FindOrFail($id);
            $central->fill($request->all());
            $central->save();
            if($central)
            {
                return response()->json(['success'=>'true','message'=>'Se actualizaron correctamente los datos']);
            }
            else 
            {
                return response()->json(['success'=>'false','message'=>'no se actualizaron los datos']);
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
        $central = Comites_Centrales::FindOrFail($id);
        $result = $central->delete();
        if ($result)
        {            
            return response()->json(['success'=>'true']); 
        }
        else
        {
            return response()->json(['success'=> 'false']);
        }
    }
}
