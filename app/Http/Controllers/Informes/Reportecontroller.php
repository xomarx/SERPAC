<?php

namespace App\Http\Controllers\Informes;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Reportecontroller extends Controller
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
        }
//        dd($listas[0]['parientes'][0]->dni);
//        dd($cont[0]['socio']->codigo);
        $dato = view('Reportes.socios.ReporPadronSocios', ['listas'=>$listas])->render();        
        $pdf = \Illuminate\Support\Facades\App::make('dompdf.wrapper');        
            $pdf->loadHTML(utf8_decode($dato))->setPaper('a4', 'portrait')->setWarnings(false); //landscape  
        
        return $pdf->stream();
    }
    //*****************************************************   ACOPIO *********************************
    public function excelrecepcion($anio,$me,$dato=''){        
        $meses = \App\Models\Acopio\Recepcion_fondo::ListMonth($anio,$me,$dato);
//        dd($meses);
        if(count($meses) > 0){
        setlocale(LC_TIME, 'spanish');
//        dd($me);
         \Maatwebsite\Excel\Facades\Excel::create('KARDEX DE DINERO '.$anio, function($excel) use($anio,$meses,$dato){
             
        foreach ($meses as $mes){
                $excel->sheet('KARDEX', function($sheet) use($anio,$mes,$dato){
               
                $acopiadores = \App\Models\Acopio\Recepcion_fondo::ListAcopiadores($anio,$mes->mes,$dato);
//                dd($acopiadores[0]);
                foreach ($acopiadores as $acopiador){
                    $dias = \App\Models\Acopio\Recepcion_fondo::ListDays($anio,$mes->mes,$acopiador->empleadoId);
//                    dd($dias);
                    $listadias = [];
                    foreach ($dias as $dia){
                        $monto = \App\Models\Acopio\Recepcion_fondo::ExportingExcelPdf($anio,$mes->mes,$dia->dia,$acopiador->empleadoId);
//                        dd($monto->monto);
                        $listadias[] = ['dias'=>$dia->dia,'monto'=>$monto->monto];                        
                    }
                    $lista2[]=['dias'=>$listadias,'acopiador'=>$acopiador];
                    unset($listadias);
                }
                $m=strtoupper(strftime("%B", mktime(0, 0, 0, $mes->mes, 1, 2000)));
                $dias=date("t",mktime(0,0,0,$mes->mes,1,$anio));
                $datos [] = ['meses'=>$m,'acopiadores'=>$lista2,'dias'=>$dias];
                unset($lista2);
                $sheet->loadView('Reportes.Acopio.ExcelRecepFondos', ['listas'=>$datos]);
            });
        }
         })->export('xls');
        }
        else
            $dato = view('Reportes.NoFoundPdfExcel')->with('titulo', 'KARDEX DE DINERO DE ACOPIO');                        
    }

    public function pdfrecepcion($anio,$me,$dato=''){

        $meses = \App\Models\Acopio\Recepcion_fondo::ListMonth($anio,$me,$dato);
        if(count($meses) > 0){
        setlocale(LC_TIME, 'spanish');        
        foreach ($meses as $mes){
            $acopiadores = \App\Models\Acopio\Recepcion_fondo::ListAcopiadores($anio,$mes->mes,$dato);
            foreach ($acopiadores as $acopiador){
                $dias = \App\Models\Acopio\Recepcion_fondo::ListDays($anio,$mes->mes,$acopiador->empleadoId);
                $listadias = [];
                foreach ($dias as $dia){
                    $monto = \App\Models\Acopio\Recepcion_fondo::ExportingExcelPdf($anio,$mes->mes,$dia->dia,$acopiador->empleadoId);                    
                    $listadias[] = ['dias'=>$dia->dia,'monto'=>$monto->monto];
                }
                $lista2[]=['dias'=>$listadias,'acopiador'=>$acopiador];
                unset($listadias);
            }
            $m=strtoupper(strftime("%B", mktime(0, 0, 0, $mes->mes, 1, 2000)));
            $dias=date("t",mktime(0,0,0,$mes->mes,1,$anio));
            $datos [] = ['meses'=>$m,'acopiadores'=>$lista2,'dias'=>$dias];
            unset($lista2);                
        }
        $dato = view('Reportes.Acopio.ExcelPdfRecepFondos',['listas'=>$datos])->render(); 
        }
        else
            $dato = view('Reportes.NoFoundPdfExcel')->with('titulo', 'KARDEX DE DINERO DE ACOPIO');
        
        $pdf = \Illuminate\Support\Facades\App::make('dompdf.wrapper');        
            $pdf->loadHTML(utf8_decode($dato))->setPaper('a3', 'landscape')->setWarnings(false); //portrait          
        return $pdf->stream();
    }
    
    //******************************************************  TESORERIA ***************************************
//    
    
    public function pdfDistribucionFondo($anio, $mes, $dato = '') {

        $anios = \App\Models\Tesoreria\Distribucion::ListaAnioDistriReport($anio, $mes, $dato);
//        dd($anios[0]->fecha);
        if (count($anios)) {            
            foreach ($anios as $ani) {
                $meses = \App\Models\Tesoreria\Distribucion::ListaMesesDistriReport($ani->fecha, $mes, $dato);    
//                dd($meses[0]->mes);
                foreach ($meses as $me) {                    
                    $movcheques = \App\Models\Tesoreria\Distribucion::ListaDistribucReportMovCheques($ani->fecha, $me->mes, $dato);
//                    dd($movcheques);                    
                    foreach ($movcheques as $movcheque) {
                        $distribucions = \App\Models\Tesoreria\Distribucion::ListaReportDistribucions($ani->fecha, $me->mes, $dato, $movcheque->id);
//                        dd($distribucions);
                        $lista[] = ['cheque' => $movcheque, 'listas' => $distribucions];
                    }
                    
                    $lista1[] = ['meses' => $me->mes, 'lista1' => $lista];
                    unset($lista);
//                   dd($lista1);
                }                                
                $lista2[] = ['anios' => $ani->fecha, 'lista2' => $lista1];  
//                dd($lista2);
                unset($lista1);                
            }
//            dd($lista2);
            $dato = view('Reportes.Tesoreria.ExcelPdfDistribucionFondos', ['listas' => $lista2])->render();
        } else {
            $dato = view('Reportes.NoFoundPdfExcel')->with('titulo', 'REPORTE DE DISTRIBUCION DE ACOPIO');
        }
        $pdf = \Illuminate\Support\Facades\App::make('dompdf.wrapper');
        $pdf->loadHTML(utf8_decode($dato))->setPaper('a4', 'portrait')->setWarnings(false); //portrait          
        return $pdf->stream();
    }
    
    public function excelDistribucionFondo($anio, $mes, $dato = ''){
        
        $anios = \App\Models\Tesoreria\Distribucion::ListaAnioDistriReport($anio, $mes, $dato);        
        if (count($anios) > 0) {                        
            foreach ($anios as $ani) {
                //crea archivo                
                \Maatwebsite\Excel\Facades\Excel::create('REPORTE DE DISTRIBUCION DE FONDOS DEL '.$ani->fecha, function($excel) use($ani,$mes,$dato){
                    $meses = \App\Models\Tesoreria\Distribucion::ListaMesesDistriReport($ani->fecha, $mes, $dato); 
                    
                    foreach ($meses as $me) {
                        //crea hoja                             
                        $excel->sheet('FONDOS', function($sheet) use($ani,$me,$dato){                              
                            $movcheques = \App\Models\Tesoreria\Distribucion::ListaDistribucReportMovCheques($ani->fecha, $me->mes, $dato);                            
                            foreach ($movcheques as $movcheque) {
                                $distribucions = \App\Models\Tesoreria\Distribucion::ListaReportDistribucions($ani->fecha, $me->mes, $dato, $movcheque->id);
                                $lista[] = ['cheque' => $movcheque, 'listas' => $distribucions];
                            }                              
                            $lista1[] = ['meses' => $me->mes, 'lista1' => $lista];
                            unset($lista);                            
                        //termina de crear hoja
                        $sheet->setAutoSize(true);
                        $sheet->loadView('Reportes.Tesoreria.ExcelDistFondos',['listas'=>$lista1]);
                        });
                    }
                })->export('xls');//xlsx
            }
        }
        else{
            
             \Maatwebsite\Excel\Facades\Excel::create('REPORTE DE DISTRIBUCION DE FONDOS ', function($excel){   
                 $excel->sheet('FONDOS', function($sheet){ 
                    $sheet->loadView('Reportes.NoFoundPdfExcel',['titulo'=>"REPORTE"]);  
                    });
        })->export('xls');//xlsx
        }
    }

    public function pdfGiroCheques($anio,$mes,$dato=''){
        
        $cheques = \App\Models\Tesoreria\Mov_cheque::listachequesXanio($anio,$mes,$dato);
        if(count($cheques) > 0){
        foreach ($cheques as $cheque){            
                $anios = \App\Models\Tesoreria\Mov_cheque::ListaReportAnios($anio,$dato,$cheque->id);  
               
                foreach ($anios as $ani){
                    $meses = \App\Models\Tesoreria\Mov_cheque::listameses($ani->fecha,$mes,$dato,$cheque->id);                    
                    foreach($meses as $me){
                        $movcheques = \App\Models\Tesoreria\Mov_cheque::ListaRepoMovCheques($ani->fecha,$me->mes,$dato,$cheque->id);
                        $lista1[]=['movcheques'=>$movcheques,'meses'=>$me->mes];
                    }                    
                    $lista2[]=['anio'=>$ani->fecha,'lista1'=>$lista1];
                    unset($lista1); 
                }                
                $listas[]=['lista2'=>$lista2,'cheques'=>$cheque];                
                unset($lista2);              
        }               
        $dato = view('Reportes.Tesoreria.ExcelPdfGiroCheques',['listas'=>$listas])->render();     }
        else $dato = view('Reportes.NoFoundPdfExcel')->with('titulo','REPORTE DE CHEQUES GIRADOS');
        $pdf = \Illuminate\Support\Facades\App::make('dompdf.wrapper');        
            $pdf->loadHTML(utf8_decode($dato))->setPaper('a4', 'portrait')->setWarnings(false); //portrait          
        return $pdf->stream();
    }
    
    public function ExcelGiroCheques($anio,$mes,$dato=''){
        
        $cheques = \App\Models\Tesoreria\Mov_cheque::listachequesXanio($anio,$mes,$dato);
        if (count($cheques) > 0) {
            $anios = \App\Models\Tesoreria\Mov_cheque::ListaExcelAnios($anio, $dato);               
            foreach ($anios as $ani) {
                //crea archivo                
                \Maatwebsite\Excel\Facades\Excel::create('REPORTE DE CHEQUES GIRADOS '.$ani->fecha, function($excel)use($ani,$mes,$dato){
                    $listcheques = \App\Models\Tesoreria\Mov_cheque::listacheques($ani->fecha,$dato);   
                    
                    foreach ($listcheques as $cheque) {
                        //crea hoja                        
                        $excel->sheet('CHEQUES', function($sheet) use($ani,$mes,$dato,$cheque){                            
                            $meses = \App\Models\Tesoreria\Mov_cheque::listameses($ani->fecha, $mes, $dato, $cheque->id); 
                            
                            foreach ($meses as $me) {
                                $lista1 = \App\Models\Tesoreria\Mov_cheque::ListaRepoMovCheques($ani->fecha, $me->mes, $dato, $cheque->id);                                
                                $lista2[] = ['meses' => $me->mes,'movcheques'=>$lista1];
                            }                              
                            $lista[] = ['listas'=>$lista2,'cheques'=>$cheque];                            
                            unset($lista2);                            
                        //termina de crear hoja
                        $sheet->setAutoSize(true);
                        $sheet->loadView('Reportes.Tesoreria.ExcelGiroCheques',['listas'=>$lista]);
                        });
                    }
                })->export('xls');//xlsx
            }
        }
        else{
             \Maatwebsite\Excel\Facades\Excel::create('REPORTE DE CHEQUES GIRADOS ', function($excel){   
                 $excel->sheet('CHEQUES', function($sheet){ 
                    $sheet->loadView('Reportes.NoFoundPdfExcel',['titulo'=>"REPORTE DE CHEQUES GIRADOS"]);  
                    });
        })->export('xls');//xlsx
        }
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
