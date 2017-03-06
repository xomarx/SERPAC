<?php

namespace App\Http\Controllers\RRHH;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\RRHH\Tecnico;

class tecnicoscontroller extends Controller
{
    
    public static function listaSectorAsignados(){
        $lista = Tecnico::all();
        return response()->json(['lista'=>$lista]);
    }
    
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {        
        $tecnicos = Tecnico::listaTecnicos();
        $tecnics = Tecnico::tecnicos();
        $locales = \App\Models\Socios\Comites_Locale::listaSectorTecnicos();
        return view('RRHH/tecnicos',['tecnicos'=>$tecnicos,'tecnics'=>$tecnics,'locales'=>$locales]);
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
            $tecnicos = Tecnico::create([
                'comites_locales_id'=>$request->comites_locales_id,
                'empleados_empleadoId'=>$request->empleados_empleadoId]);                   
            if($tecnicos)
            {
                return response()->json(['success'=>'true','message'=>'Se Asignaron Correctamente los Sectores']);
            }
            else
            {
                return response()->json(['success'=>'false','message'=>'No se Registro ningun Dato']);
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
        $sectores = Tecnico::getComitesTecnicos($id);
        return response()->json(['success'=>'true','sectores'=>$sectores]);
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
        $tecnico = Tecnico::where('empleados_empleadoId','=',$id)->delete();
        if($tecnico)
        {
            return response()->json(['success'=>'true']);
        }
        else
        {
            return response()->json(['success'=>'false']);
        }
    }
}
