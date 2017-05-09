<?php

namespace App\Http\Controllers\Configuracion;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AuxiliarController extends Controller
{
    
    public function PersonDNI($dni){
        
            $personas = \App\Models\Persona::DNIPersonas($dni);            
            return response()->json($personas);        
    }


    
    public function autocompleteDniSocio(Request $request) {
        if($request->ajax()){
            $nombre = Input::get('term');
            $socios = Socio::DNISocioautocomplete($nombre);
            foreach ($socios as $socio) 
            {
                $result[] = ['id' => $socio->codigo, 'value' => $socio->dni,'local'=>$socio->comite_local,'socio'=>$socio->fullname];
            }
            return response()->json($result);
        }
    }
    
    public function autocompleteCodigoSocio(Request $request){
        if($request->ajax()){
            $nombre = Input::get('term');
            $socios = Socio::CodigoSocioautocomplete($nombre);
            foreach ($socios as $socio) 
            {
                $result[] = ['id' => $socio->dni, 'value' => $socio->codigo,'local'=>$socio->comite_local,'socio'=>$socio->fullname];
            }
            return response()->json($result);
        }
    }
    
    public function autocomplete (Request $request) {
        if($request->ajax()){
            $nombre = Input::get('term');
            $socios = Socio::Socioautocomplete($nombre);
            foreach ($socios as $socio) 
            {
                $result[] = ['id' => $socio->codigo, 'value' => $socio->fullname,'local'=>$socio->comite_local,'dni'=>$socio->dni];
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
