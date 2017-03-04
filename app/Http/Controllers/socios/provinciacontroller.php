<?php

namespace App\Http\Controllers\socios;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Socios\Departamento;
use App\Models\Socios\Provincia;

class provinciacontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function getprovincias(Request $request,$id)
    {        
        if($request ->ajax())
        {
            $provincias = Provincia::provincias($id);
            return response()->json($provincias);
        }
    }
    
    public function index()
    {
        //
        $provincias = DB::table('provincias')
                ->join('departamentos','provincias.departamentos_id','=','departamentos.id')
                ->select('provincias.id','provincias.provincia','departamentos.departamento','provincias.departamentos_id')
                ->get();
        $departamentos = Departamento::pluck('departamento','id');
        return view('socios.provincias',array('provincias'=>$provincias,'departamentos'=>$departamentos));
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
    public function store(Requests\socios\createprovinciarequest $request)
    {        
        if ($request->ajax())
        {
                $provincia = Provincia::create([
                    'provincia'=> strtoupper($request->provincia),
                    'departamentos_id'=>$request->departamento
                ]);
                $provincia ->save();
                if($provincia)
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
        $provincia = Provincia::FindOrFail($id);
        return response()->json($provincia);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function update(Requests\socios\updateprovinciarequest $request, $id)
    {       
        if ($request->ajax())
        {
            $provincia = Provincia::FindOrFail($id);
            $provincia->provincia= strtoupper($request->provincia);
            $provincia->departamentos_id=$request->departamento;
            $provincia->save();            
            if ($provincia){
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
        $provincias = Provincia::FindOrFail($id);
        $result = $provincias->delete();
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
