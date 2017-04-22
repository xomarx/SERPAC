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
 
    public function excel() {
        $date = Carbon::now()->format('m-d-Y');
        Excel::create('Planilla-Semanal-' . $date, function($excel) {
            $excel->sheet('Compras', function($sheet) {
                
                $sheet->mergeCells('A1:H1');
                $sheet->row(1,['COMPRA DE GRANO DE CACAO DEL CENTRO DE ACOPIO DE ']);
                $sheet->row(2,['FECHA','CODIGO SOCIO','APELLIDOS Y NOMBRES','GRADO I','GRADO II','KG','P. UNITARIO S/.','TOTAL A PAGAR']);                
                $planillas = Compra::planillasemanal('ABC-05', Carbon::now(), 2);
                foreach ($planillas as $planilla)
                {
                    $row = [];
                    $row[0] = $planilla->fecha;
                    $row[1] = $planilla->socios_codigo;
                    $row[2] = $planilla->paterno.' '.$planilla->materno.' '.$planilla->nombre ;
                    if($planilla->tipocacao == 'GRADO I')
                    {    $row[3] = $planilla->tipocacao;
                        $row[4] = '';
                    }
                    else if($planilla->tipocacao == 'GRADO II')
                    {
                        $row[3] = '';
                        $row[4] = $planilla->tipocacao;
                    }
                    $row[5] = $planilla->kilos;
                    $row[6] = $planilla->precio;
                    $row[7] = $planilla->kilos * $planilla->precio;
                    $sheet->appendRow($row);
                }
//            $sheet->loadView('Acopio.formexcel');                
                
            });
        })->export('pdf');
    }

    public function pdf() {
        
        $dato = view('Acopio.formExcel')->render();
        $pdf = \Illuminate\Support\Facades\App::make('dompdf.wrapper');
        //$pdf->loadHTML($dato);                                                             
        $pdf->isHtml5ParserEnabled = true;
        $pdf->loadview('Acopio.formExcel');
        return $pdf->stream();
    }
        
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
            $planilla = \App\Models\Acopio\Planilla::create([
                'numero'=>$request->planilla,
                'fecha'=>  Carbon::parse($request->fecha),
                'users_id'=>  \Illuminate\Support\Facades\Auth::user()->id]);
            $compras = Compra::listaPlanillaSemanal($request->almacen,$request->fecha,$request->condicion);
            foreach ($compras as $compra) {
                $comprasplanilla = \App\Models\Acopio\Compras_has_planilla::create([
                            'compras_id' => $compra->id,
                            'planillas_id' => $planilla->id
                ]);
            }
            if($planilla) return response()->json(['success'=>true,'message'=>'Se registro correctamente la planilla semanal']);
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
