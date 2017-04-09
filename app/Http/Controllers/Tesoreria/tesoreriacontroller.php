<?php

namespace App\Http\Controllers\Tesoreria;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Tesoreria\Distribucion;
use App\Models\Acopio\Recepcion_fondo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
class tesoreriacontroller extends Controller
{
    
    public function recibofondoAcopiador($idacopiorecibo)
    {        
        $monto =  new \App\Library\ConvertNumberToText();
        $miMoneda = "PEN";
        
        $distribucion = Distribucion::getReciboAcopiador($idacopiorecibo);
        $monto=$monto->to_word($distribucion->monto, $miMoneda);     
        $dato = view('Reportes.Tesoreria.ReciboFondoAcopiador',['monto'=>$monto,'distribucion'=>$distribucion])->render();        
        $pdf = \Illuminate\Support\Facades\App::make('dompdf.wrapper');
        $pdf->loadHTML($dato);                        
        return $pdf->stream();
    }
    
    public function recibofondoTecnicoo()
    {        
        $dato = view('Reportes.socios.socio')->render();
        $pdf = \Illuminate\Support\Facades\App::make('dompdf.wrapper');
        $pdf->loadHTML($dato);                        
        return $pdf->stream();
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        if(!auth()->user()->can('ver distribucion'))
            return response ()->view ('errors.403');
        $distribucions = Distribucion::listaDistribucion();
        $tecnicos = Distribucion::tecnicos();        
        return view('Tesoreria.distribucion',['distribucions'=>$distribucions,'tecnicos'=>$tecnicos]);
    }

    public function listaDistribucion(){
        $distribucions = Distribucion::listaDistribucion();           
        return view('Tesoreria.listaDistribucion',['distribucions'=>$distribucions]);
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
    public function store(Requests\Tesoreria\distribucionCreateRequest $request)
    {
        //
        if($request->ajax())
        {
            if(!auth()->user()->can('crear distribucion'))
                return response ()->view ('errors.403-content',[],403);
            $distribucion = Distribucion::create([
                'tecnicos_empleados_empleadoId'=>$request->tecnico,
                'fecha'=>Carbon::parse($request->fecha),
                'monto'=>$request->monto,
                'sucursales_sucursalId'=>$request->sucursal,
                'estado'=>'Entregado',
                'users_id'=>  \Illuminate\Support\Facades\Auth::user()->id
                ]);
            $recepcion = Recepcion_fondo::create([
                'monto'=>$request->monto,'fecha'=>Carbon::parse($request->fecha),'distribucions_id'=>$distribucion->id,
                'users_id'=>\Illuminate\Support\Facades\Auth::user()->id
            ]);
            if($recepcion)
            {
                return response()->json(['success'=>'true','message'=>'Se registro Correctamente']);
            }
            else
            {
                return response()->json(['success'=>'false','message'=>'No se registro ningun dato']);
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
        $sucursales = Distribucion::listaSucursalTecnicos($id);
        return response()->json($sucursales);
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
