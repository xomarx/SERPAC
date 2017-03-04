<?php

namespace App\Http\Controllers\socios;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Socios\Cargos_directivo;

class directivoscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $directivos = Cargos_directivo::all();
        return view('socios.basicos.directivos')->with('directivos',$directivos);
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
    public function store(Requests\socios\createCargo_directivorequest $request)
    {
        //
        if ($request->ajax()) {
            $cargo_directivo = Cargos_directivo::create([
                'cargo_directivo'=>  strtoupper($request->cargo_directivo)
            ]);
            if ($cargo_directivo) {
                return response()->json(['success' => 'true','message'=>'Se Registro Correctamente']);
            } else {
                return response()->json(['success' => 'false','message'=>'No se registro ningun datos']);
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
        $cargo_directivo = Cargos_directivo::FindOrFail($id);
        return response()->json($cargo_directivo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\socios\createCargo_directivorequest $request, $id)
    {
        //
        $cargo_directivo = Cargos_directivo::FindOrFail($id);
        $cargo_directivo->fill($request->all());
        $resul = $cargo_directivo->save();
        if($resul){
            return response()->json(['success'=>'true','message'=>'Se actualizaron correctamente los datos']);
        }
        else{
            return response()->json(['success'=>'false','message'=>'No se Actualizaron los datos']);
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
        $cargo_directivo = Cargos_directivo::FindOrFail($id);
        $resul = $cargo_directivo->delete();
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
