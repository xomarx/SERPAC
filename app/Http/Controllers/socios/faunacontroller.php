<?php

namespace App\Http\Controllers\socios;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Models\Socios\Fauna;

class faunacontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(!auth()->user()->can('ver faunas'))
            return response ()->view ('errors.403');
        $faunas = Fauna::all();
        return view('socios.basicos.fauna',  compact('faunas',$faunas));
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
    public function store(Requests\socios\createfaunaRequest $request)
    {
        //
        if($request->ajax())
        {                         
            if(!auth()->user()->can('crear faunas'))
                return response ()->view ('errors.403-content',[],403);
            $fauna = Fauna::create([
                'fauna'=>strtoupper($request->fauna)
            ]);
            if($fauna)
            {
                return response()->json(['success'=>'true','message'=>'Se Registro Correctamente']);
            }
            else
            {
                return response()->json(['success'=>'false','message'=>'No se Registro Ningun dato']);
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
        $fauna = Fauna::FindOrFail($id);
        return response()->json($fauna);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\socios\createfaunaRequest $request, $id)
    {        
        if($request->ajax())
        {
            if(!auth()->user()->can('editar faunas'))
                return response ()->view ('errors.403-content',[],403);
            $fauna = Fauna::FindOrFail($id);
            $fauna->fauna=  strtoupper($request->fauna);
            $fauna->save();
            if($fauna)
            {
                return response()->json(['success'=>'true','message'=>'Se Actualizo Correctamente']);
            }
            else
            {
                return response()->json(['success'=>'false','message'=>'No se Actualizaron ningun dato']);
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
        if(auth()->user()->can('eliminar faunas')){
                
        $fauna = Fauna::FindOrFail($id);
        $result = $fauna->delete();        
        if($result) return response()->json(['success'=>true]);
        
        else return response()->json(['success'=>false]);
        
        }
    }
}
