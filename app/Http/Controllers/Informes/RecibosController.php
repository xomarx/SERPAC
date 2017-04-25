<?php

namespace App\Http\Controllers\Informes;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RecibosController extends Controller
{
    // planilla semanal PDF
    public  function PlanillaSemanalPDF($idplanilla){
        $planillas = \App\Models\Acopio\Planilla::PlanillaSemanal($idplanilla);
        $compras = \App\Models\Acopio\Planilla::Planillacompra($idplanilla);
        $dato = view('Reportes.Acopio.planillaSemanalPDF',['planillas'=>$planillas,'compras'=>$compras])->render();        
        $pdf = \Illuminate\Support\Facades\App::make('dompdf.wrapper');        
            $pdf->loadHTML(utf8_decode($dato))->setPaper('a4', 'landscape')->setWarnings(false); //landscape  
        
        return $pdf->stream();
    }

    
    /*
     * Recibo de  Compras 
     * @paramet idcompras
     * @return pdf compras
     */
    public function ReciboCompras($idcompra){
        
        $compra = \App\Models\Acopio\Compra::GetReciCompra($idcompra);
        
        
        $dato = view('Reportes.Acopio.ReciboCompras',['compras'=>$compra])->render();        
        $pdf = \Illuminate\Support\Facades\App::make('dompdf.wrapper');        
            $pdf->loadHTML(utf8_decode($dato))->setPaper('a4', 'portrait')->setWarnings(false); //landscape  
        
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
    
    public function ReciboComprasAcopio(){
        
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
