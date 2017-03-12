<?php

namespace App\Http\Controllers\Tesoreria;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Tesoreria\Persona_juridicas;

class persona_juridicacontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $persona_juridicas = Persona_juridicas::all();
        return view('Tesoreria.persona_juridica')->with('persona_juridicas',$persona_juridicas);
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
    public function store(Requests\Tesoreria\Persona_juridicaCreateRequest $request)
    {
        //
        if($request->ajax())
        {
            $juridica = \App\Models\Tesoreria\Persona_juridicas::create([
                'ruc'=>$request->ruc,
                'telefono'=>$request->telefono,
                'razon_social'=>  strtoupper($request->razon),
                'direccion'=>  strtoupper($request->direccion)
            ]);
            if($juridica)
            {
                return response()->json(['success'=>true,'message'=>'Se registro correctamente']);
            }
            else {
                return response()->json(['success'=>false,'message'=>'No se registro']);
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
       $persona_juridicas = Persona_juridicas::FindOrFail($id);       
       return response()->json($persona_juridicas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\Tesoreria\Persona_juridicaUpdateRequest $request, $id)
    {        
        if($request->ajax())
        {
            $persona_juridica = Persona_juridicas::FindOrFail($id);
            $persona_juridica->ruc=$request->ruc;
            $persona_juridica->telefono = $request->telefono;
            $persona_juridica->direccion = strtoupper($request->direccion);
            $persona_juridica->razon_social = strtoupper($request->razon);
            $persona_juridica->save();
            if($persona_juridica)
            {
              return response()->json(['success'=>true,'message'=>'Se actualizaron los datos']);
            }
            else {
                return response()->json(['success'=>false,'message'=>'No se actualizaron los datos']);
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
        $juridico = Persona_juridicas::FindOrFail($id)->delete();
        if($juridico) return response ()->json (['success'=>true]);
        else return response ()->json (['success'=>false]);
    }
}
