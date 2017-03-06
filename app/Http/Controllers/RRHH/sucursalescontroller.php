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
    
    public function listaacopiadores()
    {
        $listaAcopaidores = Sucursal::pluck('empleados_empleadoId');
        return response()->json($listaAcopaidores);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $sucursales = Sucursal::listaSucursales();    
        $areas = Areas::pluck('area','id');
        $empleados = \App\Models\RRHH\Tecnico::tecnicos();       
        $departamentos = \App\Models\Socios\Departamento::pluck('departamento','id');     
        return view('RRHH/sucursal', array('sucursales'=>$sucursales,'areas'=>$areas,'departamentos'=>$departamentos,'empleados'=>$empleados));
    }
    
    public function autocomplete(Request $request){
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
    public function store(Requests\RRHH\almacenCreateRequest $request)
    {
        //
        if($request->ajax())
        {
            $sucursal = Sucursal::create([
                'sucursalId'=>$request->codigoId,
                'sucursal'=>  strtoupper($request->sucursal),
                'telefono'=>$request->telefono,
                'fax'=>$request->telefono,
                'direccion'=>$request->direccion,
                'areas_id'=>$request->area,
                'comites_locales_id'=>$request->comite_local,
                'users_id'=>  \Illuminate\Support\Facades\Auth::user()->id,
                'empleados_empleadoId'=>$request->acopiador
                    
            ]);
            if($sucursal)
            {
                return response()->json(['success'=>'true','message'=>'Se Registro Correctamente']);
            }
            else
            {
                return response()->json(['success'=>'false','message'=>'No se registro ningun dato']);
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
    public function update(Requests\RRHH\almacenUpdateRequest $request, $id)
    {        
        if($request->ajax())
        {                        
            $sucursal =  Sucursal::where('sucursalId','=',$id)
                      ->update([
                          'sucursal'=>  strtoupper($request->sucursal),
                          'telefono' => $request->telefono,
                          'fax' => $request->fax,
                          'comites_locales_id' => $request->comite_local,
                          'areas_id' => $request->area,
                          'direccion' => strtoupper($request->direccion),
                          'empleados_empleadoId'=>$request->acopiador,
                          'users_id'=>  \Illuminate\Support\Facades\Auth::user()->id
                          ]);                          
            if($sucursal)
            {
                return response()->json(['success'=>'true','message'=>'Se actualizaron correctamente los datos']);
            }
            else
            {
                return response()->json(['success'=>'false','message'=>'No se actualizaron los datos']);
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
