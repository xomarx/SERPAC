<?php

namespace App\Http\Controllers\Tesoreria;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Tesoreria\Distribucion;
use App\Models\Acopio\Recepcion_fondo;
use Carbon\Carbon;

class tesoreriacontroller extends Controller
{
    
    public function recibodistribucio()
    {
        $socio = Socio::getSocio($idsocio);
        $parientes = \App\Models\Socios\Pariente::getparientesSocio($idsocio);
        $fundos = \App\Models\Socios\Fundo::getfundosSocio($idsocio);
        $cultivos = Flora::getcultivos($idsocio);
        $faunas = Fauna::getfaunas($idsocio);
        $dato = view('Reportes.socios.socio',['socio'=>$socio,'parientes'=>$parientes,
            'fundos'=>$fundos,'cultivos'=>$cultivos,'faunas'=>$faunas])->render();
//        return view('Reportes.socios.socio',['socio'=>$socio,'parientes'=>$parientes,
//            'fundos'=>$fundos,'cultivos'=>$cultivos,'faunas'=>$faunas]);
        $pdf = \Illuminate\Support\Facades\App::make('dompdf.wrapper');
        $pdf->loadHTML($dato);                        
//        $pdf->loadview('Acopio.formExcel');
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
        $distribucions = Distribucion::listaDistribucion();
        $tecnicos = Distribucion::tecnicos();
        $sucursales = \App\Models\RRHH\Sucursal::pluck('sucursal','sucursalId')->prepend('Seleccione una sucursal');
        return view('Tesoreria.distribucion',['distribucions'=>$distribucions,'sucursales'=>$sucursales,'tecnicos'=>$tecnicos]);
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
        if($request->ajax())
        {
            $date = Carbon::parse($request->fecha);
            $distribucion = Distribucion::create(['tecnicos_empleados_empleadoId'=>$request->tecnicos_empleados_empleadoId,
                'fecha'=>$date,'monto'=>$request->monto,'sucursales_sucursalId'=>$request->sucursales_sucursalId,'estado'=>$request->estado]);
            $recepcion = Recepcion_fondo::create([
                'monto'=>$request->monto,'fecha'=>$date,'distribucions_id'=>$distribucion->id
            ]);
            if($recepcion)
            {
                return response()->json(['success'=>'true']);
            }
            else
            {
                return response()->json(['success'=>'false']);
            }
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
        if($request->ajax())
        {
            $distribucion = Distribucion::FindOrFail($id);
            $distribucion->estado='ANULADO';
            $distribucion->motivo = $request->motivo;
            $distribucion->save();
            $recepcion = Recepcion_fondo::FindOrFail($distribucion->id)->delete();
            if($recepcion)
            {
                return response()->json(['success'=>'true']);
            }
            else
            {
                return response()->json(['success'=>'false']);
            }
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
        //
    }
}
