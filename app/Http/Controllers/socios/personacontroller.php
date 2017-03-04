<?php

namespace App\Http\Controllers\Socios;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class personacontroller extends Controller
{
    
    public function autoCompleteDniPersona(Request $request)
    {
        if($request->ajax()){
            $nombre = Input::get('term');
            $personas = \App\Models\Persona::dnipersonaAutocomplete($nombre);
            foreach ($personas as $persona) 
            {
                $result[] = ['id' => $persona->paterno, 'value' => $persona->dni,'local'=>$persona->comite_local,'materno'=>$persona->materno,
                        'nombre'=>$persona->nombre,'fecha'=>$persona->fec_nac];
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
        return View('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return "aqui se registra a las nuevas personas";
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
        $socio = new Socios;
        
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
