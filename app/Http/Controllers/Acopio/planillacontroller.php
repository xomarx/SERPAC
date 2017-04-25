<?php

namespace App\Http\Controllers\Acopio;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Models\Acopio\Compra;
use Barryvdh\DomPDF\PDF;
use Dompdf\Adapter\PDFLib;

class planillacontroller extends Controller
{
 
    

    
        
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        if(!auth()->user()->can('ver semanal'))
            return response ()->view ('errors.403');
        $planillas = \App\Models\Acopio\Planilla::listaPlanilla();        
        return view('Acopio.planillasemanal',['planillas'=>$planillas]);
    }
    
    public function ListaSemanal(){
        if(!auth()->user()->can('ver semanal'))
            return response ()->view ('errors.403-content');
        $planillas = \App\Models\Acopio\Planilla::listaPlanilla();        
        return response()->view('Acopio.listaPlanillasemanal',['planillas'=>$planillas]);
    }

        public function newPlanillaSemanal(){
        if(!auth()->user()->can('crear semanal'))
            return response ()->view ('errors.403-content');
        $condiciones = \App\Models\Certificacion\Condicion::all();
        return response()->view('Acopio.newPlanillaSemanal',['condiciones'=>$condiciones]);
    }

    public function cierremensual(){
        $condiciones = \App\Models\Certificacion\Condicion::all();
        return view('Acopio.cierremensual',['condiciones'=>$condiciones]);
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
    public function store(Requests\Acopio\PlanillaSemanalCreateRequest $request)
    {        
        if($request->ajax()){
            if(!auth()->user()->can('crear semanal'))
                return response ()->view ('errors.403-content');
            $cadena = (string)($request->planilla);
            $cadena = str_pad($cadena, 6, '0', STR_PAD_LEFT);
            $planilla = \App\Models\Acopio\Planilla::create([
                'numero'=>$cadena,
                'fecha'=>  Carbon::parse($request->fecha),
                'users_id'=>  \Illuminate\Support\Facades\Auth::user()->id]);
            $compras = Compra::listaPlanillaSemanal($request->almacen,$request->fecha,$request->condicion);
            foreach ($compras as $compra) {
                $comprasplanilla = \App\Models\Acopio\Compras_has_planilla::create([
                            'compras_id' => $compra->id,
                            'planillas_id' => $planilla->id
                ]);
            }
            if($planilla) return response()->json(['success'=>true,'message'=>'Se registro correctamente la planilla semanal','id'=>$planilla->id]);
            else return response()->json(['success'=>false,'message'=>'no se puedo registrar la planilla semanal']);
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
        if($request->ajax()){
            $planillas = Compra::listaPlanillaSemanal($id,$request->fecha,$request->condicion);
            return response()->json($planillas);
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
        if(!auth()->user()->can('eliminar semanal'))
            return response ()->view ('errors.403-content',[],403);
        $planilla = \App\Models\Acopio\Planilla::FindOrFail($id)->delete();
        $planilla = \App\Models\Acopio\Compras_has_planilla::where('planillas_id','=',$id)->delete();
        if($planilla) return response ()->json (['success'=>true]);
        else return response ()->json (['success'=>false]);
    }
}
