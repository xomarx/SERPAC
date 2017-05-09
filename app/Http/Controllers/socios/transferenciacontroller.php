<?php

namespace App\Http\Controllers\socios;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class transferenciacontroller extends Controller
{
    
    public  function datossocio(Request $request)
    {
        if($request->ajax())
        {            
                $socio = \App\Models\Socios\Socio::getsocioTransferencia($request->codigo);
                $beneficiario = \App\Models\Socios\Pariente::getbeneficiario($request->codigo);
                $fundos = \App\Models\Socios\Fundo::getDatosFundoTransferencia($request->codigo);
                return response()->json(['socio'=>$socio,'beneficiario'=>$beneficiario,'fundos'=>$fundos]);            
        }
    }
    
    public  function datosnuevo(Request $request)
    {
        if($request->ajax())
        {            
                $persona = \App\Models\Persona::getdatonuevosocio($request->dni);
                $codigo = \App\Models\Socios\Pariente::where('personas_dni','=',$request->dni)
                        ->select('socios_codigo','tipo_pariente')->first();
                return response()->json(['persona'=>$persona,'codigo'=>$codigo]);
        }
    }
    
    public  function datosnuevobeneficiario(Request $request)
    {
        if($request->ajax())
        {            
                $persona = \App\Models\Persona::getdatoBeneficiario($request->dni);
                $codigo = \App\Models\Socios\Pariente::where('personas_dni','=',$request->dni)
                        ->select('socios_codigo','tipo_pariente')->first();
                return response()->json(['persona'=>$persona,'codigo'=>$codigo]);
        }
    }

    public function fichaTransferencia($id){
        $transferencia = \App\Models\Socios\Transferencia::FindOrFail($id);
        $fundos = \App\Models\Socios\Fundo::getDatoFundo($transferencia->socios_codigo);
        $socioa = \App\Models\Persona::getdatopersona($transferencia->dniantiguo);
        $socio = \App\Models\Persona::getdatopersona($transferencia->dninuevo);
        $beneficiarioa = \App\Models\Persona::getdatopersona($transferencia->beneficiario_antiguo);
        $beneficiario = \App\Models\Socios\Pariente::getbeneficiario($transferencia->socios_codigo);
//        dd($transferencia->motivo);
        $dato = view('Reportes.socios.fichatransferencia',['fundos'=>$fundos,'socio'=>$socio,
            'socioa'=>$socioa,'beneficiarioa'=>$beneficiarioa,'beneficiario'=>$beneficiario,'transferencia'=>$transferencia])->render();      
        $pdf = \Illuminate\Support\Facades\App::make('dompdf.wrapper');
        $pdf->loadHTML($dato);                        
        return $pdf->stream();        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //
        $transferencias = \App\Models\Socios\Transferencia::listaTransferencia();        
        return view('socios.trasnferencias', ['transferencias'=>$transferencias]);
    }
    
    public function NewTransferencia(){
        if(!auth()->user()->can('crear transferencias'))
            return response ()->view ('errors.403-content');
//        $departamentos = \App\Models\Socios\Departamento::pluck('departamento','id');
        return response()->view('socios.formtransferencia');        
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
    public function store(Requests\Socios\TransferenciaRequest $request)
    {
        if($request->ajax())
        {
            if(!auth()->user()->can('crear transferencias'))
                return response ()->view ('errors.403-content',[],403);
            $beneficiario = \App\Models\Socios\Pariente::getbeneficiario($request->codigo);
            if(count($beneficiario) == 0)
                return response()->json(['success'=>false,'message'=>'No Tiene Ningun Beneficiario Principal']);
            $transferencia = \App\Models\Socios\Transferencia::create([
                'socios_codigo'=>$request->codigo,
                'motivo'=>$request->motivo,
                'fecha'=>  \Carbon\Carbon::now(),
                'dniantiguo'=>$request->dni_socio,
                'dninuevo'=>$request->dni_nuevo_socio,
                'users_id'=>  \Illuminate\Support\Facades\Auth::user()->id,
                'beneficiario_antiguo'=>$beneficiario->dni
            ]);
            $socio = \App\Models\Socios\Socio::where('dni','=',$request->dni_socio)
                    ->first();
            $pariente = \App\Models\Socios\Pariente::where('personas_dni','=',$request->dni_nuevo_socio)
                    ->first();
            \App\Models\Socios\Pariente::where('personas_dni','=',$request->dni_nuevo_socio)
                    ->update([
                        'personas_dni'=>$request->dni_socio,
                        'beneficiario'=>0,
                        'grado_inst'=>$socio->grado_inst,
                        'estado_civil'=>$socio->estado_civil
                    ]);
            \App\Models\Socios\Socio::where('dni','=',$request->dni_socio)
                    ->update([
                            'dni'=>$request->dni_nuevo_socio,
                            'grado_inst'=>$pariente->grado_inst,
                            'estado_civil'=>$pariente->estado_civil
                    ]);
            \App\Models\Socios\Pariente::where('personas_dni','=',$request->dni_beneficiario)
                    ->update([                        
                        'beneficiario'=>1,                        
                    ]);
            if($transferencia)
            {
                return response()->json(['success'=>true,'message'=>'Se Registro Correctamente la Transferencia']);
            }
            else
                return response()->json(['success'=>false,'message'=>'No se Realizo la Transferencia']);
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
