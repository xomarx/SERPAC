<?php

namespace App\Http\Controllers\Tesoreria;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CajaController extends Controller
{
    
    public function Caja($fecha){   
        $caja = \App\Models\Tesoreria\Caja::wheredate('fecha','=',$fecha)->select()->count();
        if($caja)
            $titulo = "CERRAR - CAJA";
        else
            $titulo = "APERTURAR - CAJA";                
        if($caja > 1)            
            return response ()->view ('errors.403-modal');
        else
            return response()->view('Tesoreria.Cajamodal',['apertura'=>$titulo]);                
    }
    
    public function DatoCaja($id){ 
        $caja = \App\Models\Tesoreria\Caja::where('cajas.id','=',$id)->join('users','cajas.users_id','=','users.id')->select('monto','name','fecha','observacion')->first();
        return response()->json($caja);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //                     
        if(!auth()->user()->can('ver caja'))
                return response ()->view ('errors.403',[],403);
        return response()->view('Tesoreria.caja');        
    }
    
    public function listacaja(){
        $calendar = \App\Models\Tesoreria\Caja::listaACcaja();
        return response()->json($calendar);
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
        $this->validate($request,['monto'=>'numeric|required']);
        if($request->ajax()){
            if(!auth()->user()->can('crear caja'))
                return response ()->view ('errors.403-content',[],403);
            $date = \Carbon\Carbon::now()->format('Y-m-d');
            $caja = \App\Models\Tesoreria\Caja::wheredate('fecha','=',$date)->select()->count();
            if($caja)
                $color= "#FF0000";
            else
                $color="#01DF01";
            $caja = \App\Models\Tesoreria\Caja::create([
                'fecha'=>  \Carbon\Carbon::now(),
                'monto'=>$request->monto,
                'observacion'=>$request->observacion,
                'color'=>$color,
                'users_id'=>  auth()->user()->id,
            ]);
            if($caja) return response()->json(['success'=>true,'message'=>'Se registro correctamente los datos']);
            else return response ()->json (['success'=>false,'message'=>'No se Registro ningun Dato']);
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
