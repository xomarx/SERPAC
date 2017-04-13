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
        $distribucion = Distribucion::getReciboAcopiador($idacopiorecibo); 
        $monto=$monto->to_word($distribucion->monto, "PEN");  

        $dato = view('Reportes.Tesoreria.ReciboFondoAcopiador',['monto'=>$monto,'distribucion'=>$distribucion])->render();        
        $pdf = \Illuminate\Support\Facades\App::make('dompdf.wrapper');
        $pdf->loadHTML($dato);                        
        return $pdf->stream();
    }
    
    public function recibofondoDistribucion(){        
        $iddistribucion = Distribucion::getDistribucion()->id;
        $monto =  new \App\Library\ConvertNumberToText();
        $miMoneda = "PEN";        
        $distribucion = Distribucion::getReciboAcopiador($iddistribucion);
        $monto=$monto->to_word($distribucion->monto, $miMoneda);     
        $dato = view('Reportes.Tesoreria.ReciboFondoAcopiador',['monto'=>$monto,'distribucion'=>$distribucion])->render();        
        $pdf = \Illuminate\Support\Facades\App::make('dompdf.wrapper');
        $pdf->loadHTML($dato);                        
        return $pdf->stream();
    }
    
    public function MontoFondoCheque($idgiro){
        $monto = Distribucion::where('mov_cheques_id','=',$idgiro)->select(\Illuminate\Support\Facades\DB::raw('IFNULL(sum(monto),0) as monto'))->first();
        $monto = floatval($monto->monto);
        return response()->json($monto);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){        
        if(!auth()->user()->can('ver distribucion'))
            return response ()->view ('errors.403');
        $distribucions = Distribucion::listaDistribucion(0,0,'');
        $tecnicos = Distribucion::tecnicos();
        $cheques = \App\Models\Tesoreria\Cheque::pluck('cheque', 'id');
        $result[]='AÑO';
        for ($i = 2016; $i <= Carbon::now()->format('Y');$i++){
            $result [$i]=$i;
        }
        return view('Tesoreria.distribucion',['distribucions'=>$distribucions,'tecnicos'=>$tecnicos,'anios'=>$result,'cheques'=>$cheques]);
    }

    public function listaDistribucion($anio,$mes,$dato=''){                        
            $distribucions = Distribucion::listaDistribucion($anio,$mes,$dato);                           
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
    public function store(Requests\Tesoreria\distribucionCreateRequest $request){
        //
        if($request->ajax())
        {
            if(!auth()->user()->can('crear distribucion'))
                return response ()->view ('errors.403-content',[],403);
            $idmovcheque = \App\Models\Tesoreria\Mov_cheque::where('num_cheque','=',$request->numero)->where('cheques_id','=',$request->cheque)->select('id')->first();
            $tipodocumento = \App\Models\Configuracion\Tipo_documento::where('enlace','=','DISTRIBUCION')->select('codigo')->first();
            if(count($tipodocumento)==0)
                return response()->json(['success'=>false,'message'=>'No esta enlazado a un Documento.<br> '
                    . 'Registre o enlace el documento con el nombre de "DISTRIBUCION"']);
            $numero = \App\Models\Configuracion\Documento::enumeracionDoc($tipodocumento->codigo);             
            $cadena = (string)($numero->enumeracion+1);
            $cadena = str_pad($cadena, 6, '0', STR_PAD_LEFT);                                    
            $documento = \App\Models\Configuracion\Documento::create([
                'enumeracion'=>$cadena,
                'importe'=>  round($request->monto,2),
                'tipo_documentos_cod'=>$tipodocumento->codigo
            ]);            
            $distribucion = Distribucion::create([
                'tecnicos_empleados_empleadoId'=>$request->tecnico,
                'fecha'=>Carbon::parse($request->fecha),
                'monto'=>round($request->monto,2),
                'sucursales_sucursalId'=>$request->sucursal,
                'estado'=>'Entregado',
                'mov_cheques_id'=>$idmovcheque->id,
                'users_id'=>  \Illuminate\Support\Facades\Auth::user()->id,
                'documentos_id'=>$documento->id
                ]);
            $recepcion = Recepcion_fondo::create([
                'monto'=>round($request->monto,2),'fecha'=>Carbon::parse($request->fecha),'distribucions_id'=>$distribucion->id,
                'users_id'=>\Illuminate\Support\Facades\Auth::user()->id
            ]);
            if($recepcion)
            {
                return response()->json(['success'=>true,'message'=>'Se registro Correctamente','id'=>$distribucion->id]);
            }
            else
            {
                return response()->json(['success'=>false,'message'=>'No se registro ningun dato']);
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
    public function update(Request $request, $id){
        //
        if($request->ajax())
        {
            if(!auth()->user()->can('eliminar distribucion'))
                return response ()->view ('errors.403-content',[],403);
            $distribucion = Distribucion::FindOrFail($id);
            $distribucion->estado='ANULADO';
            $distribucion->motivo = $request->motivo;
            $distribucion->monto = 0;
            $distribucion->save();
            $recepcion = Recepcion_fondo::where('distribucions_id','=',$id)->delete();
            if($recepcion)            
                return response()->json(['success'=>true]);            
            else            
                return response()->json(['success'=>false,'message'=>'No se puede Eliminar el Registro']);
            
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
