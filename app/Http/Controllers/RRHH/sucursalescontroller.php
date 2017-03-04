<?php

namespace App\Http\Controllers\RRHH;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\RRHH\Sucursal;
use App\Models\RRHH\Areas;
use App\Models\Socios\Provincia;
use Illuminate\Support\Facades\Input;

class sucursalescontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sucursales = Sucursal::listaSucursales();    
        $areas = Areas::pluck('area','id');        
        $departamentos = \App\Models\Socios\Departamento::pluck('departamento','id')->prepend('Selleciona');     
        return view('RRHH/sucursal', array('sucursales'=>$sucursales,'areas'=>$areas,'departamentos'=>$departamentos));
    }
    
    public function autocomplete(Request $request)
    {
        if($request->ajax())
        {
            $nombre = Input::get('term');
            $sucursals = Sucursal::where('sucursalId','like','%'.$nombre.'%')->take(5)->get();
            foreach ($sucursals as $sucursal) 
            {
                $result[] = ['id' => $sucursal->sucursalId, 'value' => $sucursal->sucursalId,'sucursal'=>$sucursal->sucursal];
            }
            return response()->json($result);
        }
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
            $sucursal = Sucursal::create($request->all());
            if($sucursal)
            {
                return response()->json(['success'=>'true']);
            }
            else
            {
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
        $sucursal = Sucursal::sucursal($id);
                return response()->json($sucursal);
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
            $sucursal =  Sucursal::where('sucursalId','=',$id)
                      ->update([
                          'sucursal'=>$request->sucursal,                                                    
                          'telefono' => $request->telefono,
                          'fax' => $request->fax,
                          'comites_locales_id' => $request->comites_locales_id,
                          'areas_id' => $request->areas_id,
                          'direccion' => $request->direccion,                          
                          ]);                          
            if($sucursal)
            {
                return response()->json(['success'=>'true']);
            }
            else
            {
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
        $sucursal = Sucursal::where('sucursalId','=',$id)
                ->delete();
       if($sucursal)
            {
                return response()->json(['success'=>'true']);
            }
            else
            {
                return response()->json(['success'=>'false']);
            } 
        
    }
}
