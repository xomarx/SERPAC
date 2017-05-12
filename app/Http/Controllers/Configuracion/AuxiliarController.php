<?php

namespace App\Http\Controllers\Configuracion;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class AuxiliarController extends Controller
{
    
    public function PersonDNI($dni){        
            $personas = \App\Models\Persona::DNIPersonas($dni);            
            return response()->json($personas);        
    }

    public function autoDatoSocios (Request $request) {
        if($request->ajax()){
            $nombre = Input::get('term');
            $socios = \App\Models\Socios\Socio::Socioautocomplete($nombre);
            foreach ($socios as $socio) 
            {
                $result[] = [
                    'id' => $socio->codigo, 'value' => $socio->fullname,'local'=>$socio->comite_local,'dni'=>$socio->dni,'condicions'=>  \App\Models\Certificacion\Condicion::getcondicions($socio->codigo)
                        ];
            }
            return response()->json($result);
        }
    }
    
    public function autoCodigoSocios(Request $request){
        if($request->ajax()){
            $nombre = Input::get('term');
            $socios = \App\Models\Socios\Socio::CodigoSocioautocomplete($nombre);
            foreach ($socios as $socio) 
            {
                $result[] = ['id' => $socio->dni, 'value' => $socio->codigo,'local'=>$socio->comite_local,'socio'=>$socio->fullname,'condicions'=>  \App\Models\Certificacion\Condicion::getcondicions($socio->codigo)];
            }
            return response()->json($result);
        }
    }

    
    public function autoDNISocios(Request $request) {
        if($request->ajax()){
            $nombre = Input::get('term');
            $socios = \App\Models\Socios\Socio::DNISocioautocomplete($nombre);
            foreach ($socios as $socio) 
            {
                $result[] = ['id' => $socio->codigo, 'value' => $socio->dni,'local'=>$socio->comite_local,'socio'=>$socio->fullname
                        ,'condicions'=>  \App\Models\Certificacion\Condicion::getcondicions($socio->codigo)];
            }
            return response()->json($result);
        }
    }
    
    public function autoDNIParientesSocios(Request $request)
    {
        if($request->ajax()){
            $nombre = Input::get('term');
            $personas = \App\Models\Persona::dniParientesSocios($nombre);
            foreach ($personas as $persona) 
            {
                $result[] = ['id' => $persona->paterno, 'value' => $persona->dni,'local'=>$persona->comite_local,'materno'=>$persona->materno,
                        'nombre'=>$persona->nombre,'fecha'=>$persona->fec_nac];
            }
            return response()->json($result);
        }
    }
    
    public function autoDNIPersonas(Request $request)
    {
        if($request->ajax())
        {
            $nombre = Input::get('term');
            $parientes = \App\Models\Persona::AutodniPersonas($nombre);
            foreach ($parientes as $pariente) 
            {
                $result[] = ['id' => $pariente->paterno, 'value' => $pariente->dni,'local'=>$pariente->comite_local,'materno'=>$pariente->materno,
                        'nombre'=>$pariente->nombre,'fecha'=>$pariente->fec_nac];
            }
            return response()->json($result);
        }
    }
    
    public function autoDatosPersonas(Request $request){
        if($request->ajax())
        {
            $nombre = Input::get('term');            
            $personas = \App\Models\Persona::autoDatosPersonas($nombre);            
            foreach ($personas as $persona) 
            {
                $result[] = ['id' => $persona->dni, 'value' => $persona->paterno. ' '.$persona->materno.' '.$persona->nombre,'fecha'=>$persona->fec_nac];
            }
            return response()->json($result);
        }
    }

     public function autoSucursal(Request $request){
        if($request->ajax())
        {
            $nombre = Input::get('term');
            $sucursals = \App\Models\RRHH\Sucursal::autoSucursal($nombre);
            foreach ($sucursals as $sucursal) 
            {
                $result[] = ['id' => $sucursal->sucursalId, 'value' => $sucursal->sucursal
//                        ,'sucursal'=>$sucursal->sucursal,'sector'=>$sucursal->comite_local
//                        ,'acopiador'=>$sucursal->acopiador,'tecnico'=>$sucursal->tecnico
                        ];
            }
            return response()->json($result);
        }
    }

    public function autoCodigoSucursal(Request $request){
        if($request->ajax())
        {
            $nombre = Input::get('term');
            $sucursals = \App\Models\RRHH\Sucursal::autoCodigoSucursal($nombre);
            foreach ($sucursals as $sucursal) 
            {
                $result[] = ['id' => $sucursal->sucursal, 'value' => $sucursal->sucursalId
//                        ,'sucursal'=>$sucursal->sucursal,'acopiador'=>$sucursal->acopiador,'tecnico'=>$sucursal->tecnico
                        ];
            }
            return response()->json($result);
        }
    }

    public function autoNoSocios(Request $request){
        if($request->ajax()){
            $nombre = \Illuminate\Support\Facades\Input::get('term');
            $nosocios = \App\Models\Acopio\Nosocio::where('dni','like','%'.$nombre.'%')->get();
            foreach ($nosocios as $nosocio) 
            {
                $result[] = ['id' => $nosocio->paterno, 'value' => $nosocio->dni,'materno'=>$nosocio->materno,'nombres'=>$nosocio->nombres,'condicions'=>  \App\Models\Certificacion\Condicion::pluck('condicion','id')];
            }
            return response()->json($result);
        }
    }

    
    
    
    
    

    public function autoSociosPersonas(Request $request){
        if($request->ajax()){
            $nombre = Input::get('term');
            $socios = Socio::PersonasSociosAuto($nombre);
            foreach ($socios as $socio) 
            {
                $result[] = ['id' => $socio->dni, 'value' => $socio->socio];
            }
            return response()->json($result);
        }
    }
    
    public function autoSociosPersonasDni(Request $request){
        if($request->ajax()){
            $nombre = Input::get('term');
            $socios = Socio::PersonasSociosAuto($nombre);
            foreach ($socios as $socio) 
            {
                $result[] = ['id' => $socio->dni, 'value' => $socio->socio];
            }
            return response()->json($result);
        }
    }

        public function autoSociosDni(Request $request)    {
        if($request->ajax()){
            $nombre = Input::get('term');
            $socios = Socio::PersonasSociosDniAuto($nombre);
            foreach ($socios as $socio) 
            {
                $result[] = ['id' => $socio->socio, 'value' => $socio->dni];
            }
            return response()->json($result);
        }
    }
    
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
