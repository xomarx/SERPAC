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
    public function store(Request $request)
    {
        //
        if($request->ajax())
        {
            $juridica = \App\Models\Tesoreria\Persona_juridicas::create($request->all());
            if($juridica)
            {
                return response()->json(['success'=>'true']);
            }
            else {
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
    public function update(Request $request, $id)
    {        
        if($request->ajax())
        {
            $persona_juridica = Persona_juridicas::FindOrFail($id);
            $persona_juridica->ruc=$request->ruc;
            $persona_juridica->telefono = $request->telefono;
            $persona_juridica->direccion = $request->direccion;
            $persona_juridica->razon_social = $request->razon_social;
            $persona_juridica->save();
            if($persona_juridica)
            {
              return response()->json(['success'=>'true']);
            }
            else {
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
