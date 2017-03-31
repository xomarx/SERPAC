<?php

namespace App\Http\Controllers\socios;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class fundoscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $fundos = \App\Models\Socios\Fundo::listaFundo();
        $departamentos = \App\Models\Socios\Departamento::pluck('departamento','id')->prepend('Selleciona');
        $floras = \App\Models\Socios\Flora::pluck('flora','id');  
        $faunas = \App\Models\Socios\Fauna::pluck('fauna','id');  
        $inmuebles = \App\Models\Socios\Inmueble::pluck('inmueble','id'); 
        return view('socios.fundos',  ['fundos'=>$fundos,'departamentos'=>$departamentos,'floras'=>$floras,'faunas'=>$faunas,'inmuebles'=>$inmuebles]);
                
    }
    
    public function ModalFundo(){
        $departamentos = \App\Models\Socios\Departamento::pluck('departamento','id');
        $floras = \App\Models\Socios\Flora::pluck('flora','id');  
        $faunas = \App\Models\Socios\Fauna::pluck('fauna','id');  
        $inmuebles = \App\Models\Socios\Inmueble::pluck('inmueble','id');
        return response()->view('socios.formFundo',['departamentos'=>$departamentos,'floras'=>$floras,'faunas'=>$faunas,'inmuebles'=>$inmuebles]);
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
    public function store(Requests\socios\createfundorequest $request)
    {
        //
        if($request->ajax())
        {
            if(!auth()->user()->can('crear fundos'))
                return response ()->view ('errors.403-content',[],403);            
            $date = \Carbon\Carbon::parse($request->fecha);
            $fundo = new \App\Models\Socios\Fundo($request->all());
            $fundo->comite_local_id=$request->comite_local;
            $fundo->fundo=  strtoupper($request->fundo);
            $fundo->direccion=strtoupper($request->direccion);
            $fundo->fecha = $date;
            $fundo->estado=1;
            $fundo->users_id=  \Illuminate\Support\Facades\Auth::user()->id;
            $fundo->save();
            if($fundo)
                return response()->json(['success'=>'Registrar','message'=>'Se registro Correctamente']);
        }
    }
    
    public function propiedadinmueble(Request $request)
    {
        if($request->ajax())
        {
            $inmuebleid = \App\Models\Socios\Inmueble::where('inmueble','=', $request->inmueble)->first();
            $fundoid = \App\Models\Socios\Fundo::where('fundo','=',$request->fundo)->first();
            $inmueble = \App\Models\socios\Fundos_has_inmueble::create([
                'inmuebles_id'=>$inmuebleid->id,
                'fundos_id'=>$fundoid->id
            ]);
            if($inmueble) return response()->json(['success'=>true]);
        }
    }
    
    public function propiedadfauna(Request $request)
    {
        if($request->ajax())
        {
            $fundo = \App\Models\Socios\Fundo::where('fundo','=',$request->fundo)->first();
            $fauna = \App\Models\Socios\Fauna::where('fauna','=',$request->fauna)->first();
            $faunas = \App\Models\socios\Fundos_has_fauna::create([
                'fundos_id'=>$fundo->id,
                'faunas_id'=>$fauna->id,
                'cantidad'=>$request->cantidad,
                'rendimiento'=>$request->rendimiento
            ]);
            if($faunas)  return response()->json(['success'=>true]);
        }
    }
    public function propiedadflora(Request $request){
        if($request->ajax())
        {
            $fundo = \App\Models\Socios\Fundo::where('fundo','=',$request->fundo)->first();
            $flora = \App\Models\Socios\Flora::where('flora','=',$request->flora)->first();
            $floras = \App\Models\socios\Fundos_has_flora::create([
                'fundos_id'=>$fundo->id,
                'floras_id'=>$flora->id,
                'hectarea'=>$request->hectarea,
                'rendimiento'=>$request->rendimiento
            ]);
            if($floras)  return response()->json(['success'=>true]);
        }
    }

    public  function EliminarPropiedadesFundo($idfundo){
        $inmuebles = \App\Models\socios\Fundos_has_inmueble::where('fundos_id','=',$idfundo)->delete();
        $floras = \App\Models\socios\Fundos_has_flora::where('fundos_id','=',$idfundo)->delete();
        $faunas = \App\Models\socios\Fundos_has_fauna::where('fundos_id','=',$idfundo)->delete();
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
        $fundo = \App\Models\Socios\Fundo::getfundoDatos($id);
        $floras = \App\Models\Socios\Flora::getcultivos($fundo->codigo);
        $faunas = \App\Models\Socios\Fauna::getfaunas($fundo->codigo);
        $inmuebles = \App\Models\Socios\Inmueble::getInmuebles($fundo->codigo);
        return response()->json(['fundo'=>$fundo,'floras'=>$floras,'faunas'=>$faunas,'inmuebles'=>$inmuebles]);       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
        if($request->ajax())
        {
            if(!auth()->user()->can('editar fundos'))
                return response ()->view ('errors.403-content',[],403);
            
            $fundo = \App\Models\Socios\Fundo::FindOrFail($id);
            $fundo->fecha = \Carbon\Carbon::parse($request->fecha);
            $fundo->estadofundo = $request->estadofundo;
            $fundo->fundo = strtoupper($request->fundo);
            $fundo->direccion = $request->direccion;
            $fundo->observaciones = $request->observaciones;
            $fundo->comite_local_id = $request->comite_local;
            $fundo->users_id=  \Illuminate\Support\Facades\Auth::user()->id;
            $fundo->save();
            if($fundo) return response()->json(['success'=>true,'message'=>'Se Actualizaron Correctamente']);
            else return response()->json(['success'=>false,'message'=>'No se Actualizo ningun dato']);
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
        if(!auth()->user()->can('eliminar fundos'))
                return response ()->view ('errors.403-content',[],403);
        $fundo = \App\Models\Socios\Fundo::where('id','=',$id)
                ->update([
                    'estado'=>0
                ]);
        if($fundo)
            return response()->json(['success'=>'true']);
    }
}
