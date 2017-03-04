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
//    $planilla = \App\Models\Acopio\Compra::planillasemanal('ABC-05', \Carbon\Carbon::now(), 2);   
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
        //
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
