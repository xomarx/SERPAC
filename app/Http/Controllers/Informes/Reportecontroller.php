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
    public function excelrecepcion($anio,$me){
        \Maatwebsite\Excel\Facades\Excel::create('Recepcion Fondos', function($excel) use($anio,$me){
            $excel->setTitle('recepcion de fondos');
            $excel->sheet('Fondos', function($sheet) use($anio,$me){
          $fondos = \App\Models\Acopio\Recepcion_fondo::ExportingExcelPdf($anio,$me);
                setlocale(LC_TIME, 'spanish');
                $mes = date('m', strtotime($fondos[0]->fecha));
                $dias = date("t", mktime(0, 0, 0, $mes, 1, $anio));
                $mes = strftime("%B", mktime(0, 0, 0, $mes, 1, 2000));
                $mes = strtoupper($mes);

                foreach ($fondos as $fondo) {
                    $pagos = \App\Models\Acopio\Recepcion_fondo::listapagosRec($fondo->empleados_empleadoId, $anio, $me);
                    $lista[] = ['fondos' => $fondo, 'pagos' => $pagos];
                }
                $sheet->loadView('Reportes.Acopio.ExcelPdfRecepFondos', ['listas'=>$lista,'mes'=>$mes,'dias'=>$dias  ]);
            });
        })->export('xls');
    }

    public function pdfrecepcion($anio,$me){
        $fondos = \App\Models\Acopio\Recepcion_fondo::ExportingExcelPdf($anio,$me);
        setlocale(LC_TIME, 'spanish');
        $mes = date('m', strtotime($fondos[0]->fecha));
        $dias=date("t",mktime(0,0,0,$mes,1,$anio));
        $mes = strftime("%B", mktime(0, 0, 0, $mes, 1, 2000));
        $mes=strtoupper($mes);
        
        foreach ($fondos as $fondo){
            $pagos = \App\Models\Acopio\Recepcion_fondo::listapagosRec($fondo->empleados_empleadoId,$anio,$me);
            $lista[]=['fondos'=>$fondo,'pagos'=>$pagos];
        }
//        dd($lista[0]['pagos']->count);
        $dato = view('Reportes.Acopio.ExcelPdfRecepFondos',['listas'=>$lista,'mes'=>$mes,'dias'=>$dias  ])->render(); 
        
        $pdf = \Illuminate\Support\Facades\App::make('dompdf.wrapper');        
            $pdf->loadHTML(utf8_decode($dato))->setPaper('a3', 'landscape')->setWarnings(false); //portrait          
        return $pdf->stream();
    }

    
    //******************************************************  TESORERIA ***************************************
    
    public function pdfDistribucionFondo(){
        $dato = view('Reportes.Tesoreria.ExcelPdfDistribucionFondos')->render();         
        $pdf = \Illuminate\Support\Facades\App::make('dompdf.wrapper');        
            $pdf->loadHTML(utf8_decode($dato))->setPaper('a4', 'portrait')->setWarnings(false); //portrait          
        return $pdf->stream();
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
