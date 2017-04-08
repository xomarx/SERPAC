<?php

namespace App\Http\Controllers\Informes;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Khill\Lavacharts\Lavacharts;

class ListaInformescontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->view('Reportes.masterInform');
    }
    
    public function padronsocios() {
        $anios = \App\Models\Socios\Socio::orderby('fec_asociado', 'asc')->first();
        $resul[] = 'Todo los Años';
        for ($i = \Carbon\Carbon::parse($anios->fec_asociado)->format('Y'); $i <= \Carbon\Carbon::now()->format('Y'); $i++) {
            $resul[$i] = $i;                                                   
        }
        setlocale(LC_TIME, 'spanish');
        $meses[] = 'Todo los Meses';
        for ($i = 1; $i <= 12; $i++) {
            $meses[] = strftime("%B", mktime(0, 0, 0, $i, 1, 2000));
        }

        $departamentos = \App\Models\Socios\Departamento::pluck('departamento', 'id');
                        
        return response()->view('Reportes.socios.PadronSocios', ['departamentos' => $departamentos, 
            'anios' => $resul, 'meses' => $meses]);
    }
    
    public function grafico_socios($anio,$mes){
        if ($anio == 0) {
            $anios = \App\Models\Socios\Socio::orderby('fec_asociado', 'asc')->first();
            for ($i = \Carbon\Carbon::parse($anios->fec_asociado)->format('Y'); $i <= \Carbon\Carbon::now()->format('Y'); $i++) {
                $resul[] = $i;
                $activos[] = \App\Models\Socios\Socio::getcontActivos($i, 0, 'ACTIVO',0)->cont;
                $reinscrito[] = \App\Models\Socios\Socio::getcontActivos($i, 0, 'REINSCRITO',0)->cont;
                $renunciante[] = \App\Models\Socios\Socio::getcontActivos($i, 0, 'RENUNCIANTE',0)->cont;
                $retirado[] = \App\Models\Socios\Socio::getcontActivos($i, 0, 'RETIRADO',0)->cont;
            }            
        }
        else if($mes==0){
            setlocale(LC_TIME, 'spanish');
            for ($i = 1; $i <= 12; $i++) {
                $resul[] = strftime("%B", mktime(0, 0, 0, $i, 1, 2000));
                $activos[] = \App\Models\Socios\Socio::getcontActivos($anio, $i, 'ACTIVO',0)->cont;
                $reinscrito[] = \App\Models\Socios\Socio::getcontActivos($anio, $i, 'REINSCRITO',0)->cont;
                $renunciante[] = \App\Models\Socios\Socio::getcontActivos($anio, $i, 'RENUNCIANTE',0)->cont;
                $retirado[] = \App\Models\Socios\Socio::getcontActivos($anio, $i, 'RETIRADO',0)->cont;
            }
        }
        else{
            
            for ($i = 1; $i <= date("t",mktime(0,0,0,$mes,1,$anio)); $i++) {
                $resul[] = $i;
                $activos[] = \App\Models\Socios\Socio::getcontActivos($anio, $mes, 'ACTIVO',$i)->cont;
                $reinscrito[] = \App\Models\Socios\Socio::getcontActivos($anio, $mes, 'REINSCRITO',$i)->cont;
                $renunciante[] = \App\Models\Socios\Socio::getcontActivos($anio, $mes, 'RENUNCIANTE',$i)->cont;
                $retirado[] = \App\Models\Socios\Socio::getcontActivos($anio, $mes, 'RETIRADO',$i)->cont;
            }
        }

        $data = ['anios' => $resul, 'activos' => $activos,'reinscrito' => $reinscrito,
            'renunciante' => $renunciante, 'retirado' => $retirado];      
        return json_encode($data);
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
