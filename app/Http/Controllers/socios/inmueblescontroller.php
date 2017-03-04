<?php

namespace App\Http\Controllers\socios;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Socios\Inmueble;

class inmueblescontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $inmuebles = Inmueble::all();
        return view('socios.basicos.inmuebles')->  with('inmuebles',$inmuebles);
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
    public function store(Requests\socios\createinmueblerequest $request)
    {
        //
        if($request->ajax())
        {
            $inmueble = Inmueble::create([
                'inmueble'=>  strtoupper($request->inmueble)
            ]);
            if($inmueble)
                return response()->json(['success'=>'true','message'=>'Se registro correctamente']);
            else 
                return response()->json(['success'=>'false','message'=>'No se registro']);
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
        $inmueble = Inmueble::FindOrFail($id);
        return response()->json($inmueble);
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
            $inmueble = Inmueble::FindOrFail($id);
            $inmueble->inmueble = strtoupper($request->inmueble);
            $inmueble->save();
            if($inmueble)
                return response()->json(['success'=>'true','message'=>'Se Actualizo correctamente']);
            else
                return response()->json(['success'=>'false','message'=>'No se Actualizo']);
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
        $inmueble = Inmueble::FindOrFail($id);
        $resul = $inmueble->delete();
        if($resul)
        {
            return response()->json(['success'=>'true']);
        }
        else
        {
            return response()->json(['success'=>'false']);
        }
    }
}
