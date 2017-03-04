<?php

namespace App\Http\Controllers\RRHH;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\RRHH\Tecnico;

class tecnicoscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $tecnicos = Tecnico::listaTecnicos();
        $tecnics = Tecnico::tecnicos();
        $locales = \App\Models\Socios\Comites_Locale::pluck('comite_local','id');
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
            $tecnicos = Tecnico::create(['comites_locales_id'=>$request->comites_locales_id,'empleados_empleadoId'=>$request->empleados_empleadoId]);
//            $tecnico->empleados_empleadoId = $request->empleados_empleadoId;            
//            $tecnico->save();                        
            if($tecnicos)
            {
                return response()->json($request->empleados_empleadoId);
            }
            else
            {
                return response()->json(['succes'=>'false']);
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
