<?php

namespace App\Http\Controllers\Informes;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Repostecontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    
    public function ReporpadronSocios(){
        $socios = \App\Models\Socios\Socio::all();
        
        foreach ($socios as $socio) {
            
            $parientes = \App\Models\Socios\Pariente::getparientesSocio($socio->codigo);
            $fundos = \App\Models\Socios\Fundo::getfundosSocio($socio->codigo);
            $cultivos = \App\Models\Socios\Flora::getcultivos($socio->codigo);
            $faunas = \App\Models\Socios\Fauna::getfaunas($socio->codigo);
            $datosocio = \App\Models\Socios\Socio::getSocio($socio->codigo);
            $listas[] = ['socio' => $datosocio, 'parientes' => $parientes,
                'fundos' => $fundos, 'cultivos' => $cultivos, 'faunas' => $faunas];
            $cont[]=['socio' => $socio];
        }
//        dd($listas[0]['parientes'][0]->dni);
//        dd($cont[0]['socio']->codigo);
        $dato = view('Reportes.socios.ReporPadronSocios', ['listas'=>$listas])->render();        
        $pdf = \Illuminate\Support\Facades\App::make('dompdf.wrapper');        
            $pdf->loadHTML(utf8_decode($dato))->setPaper('a4', 'portrait')->setWarnings(false); //landscape  
        
        return $pdf->stream();
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
