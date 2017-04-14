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
    
    public function grafica_fondos(){   
        if(!auth()->user()->can('ver kardex dinero'))
            return response()->view('errors.403');
        for ($i = 2016; $i <= \Carbon\Carbon::now()->format('Y'); $i++) {
            $resul[$i] = $i;
        }        
//        $data = ['anios'=>$resul,'montos'=>$montos];
        return response()->view('Reportes.Acopio.graficaRecepFondos',['anios'=>$resul]);        
    }
    
    public function grafica_acopio_dinero($anio, $mes) {
        if ($mes == 0) {
            setlocale(LC_TIME, 'spanish');
            for ($i = 1; $i <= 12; $i++) {
                $resul[] = strftime("%B", mktime(0, 0, 0, $i, 1, 2016));
                $montos[] = floatval(\App\Models\Acopio\Recepcion_fondo::montofechas($anio, $i,0)->monto);
            }
        } else {
           for ($i = 1; $i <= date("t",mktime(0,0,0,$mes,1,$anio)); $i++){
                $resul[] = $i;
                $montos[] = floatval(\App\Models\Acopio\Recepcion_fondo::montofechas($anio,$mes ,$i)->monto);
            }
        }

        $data = ['fechas' => $resul, 'montos' => $montos];
        return json_encode($data);
    }
    
    //***********************************  TESORERIA **********************************************
    public function Giro_cheques(){
        
        if(!auth()->user()->can('ver movimiento cheques'))
            return response ()->view ('errors.403');
        for ($i = 2016; $i <= \Carbon\Carbon::now()->format('Y'); $i++) {
            $resul[$i] = $i;
        }
        return response()->view('Reportes.Tesoreria.GraficoGiroCheques',['anios'=>$resul]);
    }
    
    public function  grafica_Giro_cheques($anio,$mes){
        
        $cheques = \App\Models\Tesoreria\Mov_cheque::listachequesXanio($anio,$mes,'');        
//        dd($meses[0]->mes);//4
        if ($mes == 0) {//lista de meses
            $meses = \App\Models\Tesoreria\Mov_cheque::ListaMesesXanio($anio);
            foreach ($cheques as $cheque){
                setlocale(LC_TIME, 'spanish');
                foreach ($meses as $mes){                    
                    $lista[] = floatval(\App\Models\Tesoreria\Mov_cheque::Grafica_Giros($anio,$mes->mes,0,$cheque->id)->monto);
                }                
                $listcheque[] = $cheque->cheque; $lista2[] = $lista;
                unset($lista);
            }
            foreach ($meses as $me){
                $fecha[] = strtoupper(strftime("%B", mktime(0, 0, 0, $me->mes, 1, 2016)));
            }
        } else {
            $days = \App\Models\Tesoreria\Mov_cheque::ListaDiasXmes($anio,$mes);            
            foreach ($cheques as $cheque){
                setlocale(LC_TIME, 'spanish');
                foreach ($days as $dia){                    
                    $lista[] = floatval(\App\Models\Tesoreria\Mov_cheque::Grafica_Giros($anio,$mes,$dia->day,$cheque->id)->monto);
                }                
                $listcheque[] = $cheque->cheque; $lista2[] = $lista;
                unset($lista);
            }
            foreach ($days as $dia){
                $fecha [] = $dia->day;
            }
           
        }
        $data = ['fechas' => $fecha, 'cheques' => $listcheque,'montos'=>$lista2];
        return json_encode($data);
    }
//    GraficoGiroCheques.blade

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
