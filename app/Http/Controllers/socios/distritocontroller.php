<?php

namespace App\Http\Controllers\socios;


use App\Models\Socios\Distrito;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Socios\Departamento;
use App\Models\Socios\Provincia;

class distritocontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function getdistritos(Request $request,$id)
    {        
        if($request ->ajax())
        {
            $distritos = Distrito::distritos($id);
            return response()->json($distritos);
        }
    }   
        
    public function index()
    {
        //
        $distritos = DB::table('distritos')
                ->join('provincias','distritos.provincias_id','=','provincias.id')
                ->join('departamentos','provincias.departamentos_id','=','departamentos.id')
                ->select( 'distritos.id','distritos.distrito','distritos.provincias_id'
                        ,'provincias.provincia','provincias.departamentos_id'
                        ,'departamentos.departamento')
                ->get();
        $departamentos = Departamento::pluck('departamento','id');        
//        return view('socios.distrito')->with('distritos',$distritos);
        return view('socios.distrito',array('distritos'=>$distritos,'departamentos'=>$departamentos));
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
    public function store(Requests\socios\createdistritorequest $request)
    {
        //
        if($request->ajax())
        {
            $distrito = Distrito::create([
                'distrito'=>$request->distrito,
                'provincias_id'=>$request->provincia
            ]);
            $distrito->save();
            if($distrito)
            {
                return response()->json(['success' => 'true','message'=>'Se Registro Correctamente']);
            } else {
                    return response()->json(['success' => 'false','message'=>'No se registro ningun datos']);
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
        $distrito = Distrito::getdistrito($id);
        return response()->json($distrito);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\socios\updatedistritorequest $request, $id)
    {
        //
        if($request ->ajax())
        {            
            $distrito = Distrito::FindOrFail($id);            
            $distrito->distrito = strtoupper($request->distrito);
            $distrito->provincias_id = $request->provincia;
            $distrito->save();        
            if ($distrito){
                return response()->json(['success'=>'true','message'=>'Se actualizaron correctamente los datos']);
            }
            else{
                return response()->json(['success'=>'false','message'=>'No se Actualizaron los datos']);
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
        $distritos=Distrito::FindOrFail($id)->delete();
        if($distritos)
        {
            return response()->json(['success'=>'true']);
        }
        else
        {
            return response()->json(['success'=>'false']);
        }
    }
}
