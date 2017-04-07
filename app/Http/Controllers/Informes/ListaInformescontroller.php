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
    
    public function padronsocios(){
        $anios = \App\Models\Socios\Socio::orderby('fec_asociado','asc')->first();
        for ($i = \Carbon\Carbon::parse($anios->fec_asociado)->format('Y');$i <= \Carbon\Carbon::now()->format('Y');$i++){
            $resul[$i]= $i;
        }
        setlocale(LC_TIME, 'spanish'); 
        $meses[] = 'Todo los Meses';
        for ($i=1;$i <= 12;$i++){
            $meses[]=strftime("%B",mktime(0, 0, 0, $i, 1, 2000));
        }        
                
        $departamentos = \App\Models\Socios\Departamento::pluck('departamento','id');
        
        $lava = new Lavacharts();
        $socios = $lava->DataTable();
        $socios->addDateColumn('Registrados')
        ->addNumberColumn('Sales')
         ->addNumberColumn('Expenses')
         ->addNumberColumn('Net Worth')
         ->addRow(['2009-1-1', 1100, 490, 1324])
         ->addRow(['2010-1-1', 1000, 400, 1524])
         ->addRow(['2011-1-1', 1400, 450, 1351])
         ->addRow(['2012-1-1', 1250, 600, 1243])
         ->addRow(['2013-1-1', 1100, 550, 1462]);
        $lava->ComboChart('socios', $socios, [
    'title' => 'Company Performance',
    'titleTextStyle' => [
        'color'    => 'rgb(123, 65, 89)',
        'fontSize' => 16
    ],
    'legend' => [
        'position' => 'in'
    ],
    'seriesType' => 'bars',
    'series' => [
        2 => ['type' => 'line']
    ]
]);
        return response()->view('Reportes.socios.PadronSocios',['departamentos'=>$departamentos,'anios'=>$resul,'meses'=>$meses,'lava'=>$lava]);
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
