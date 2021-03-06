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
    
    public function ListAlmacen($dato=''){
        
        if(!auth()->user()->can('ver almacen'))
            return response ()->view ('errors.403');
        $sucursales = Sucursal::listaSucursales($dato);            
        return response()->view('RRHH.sucursalList',['sucursales'=>$sucursales]);
    }

        public function almacenmodal(){
        if(!auth()->user()->can(['crear almacen','editar almacen']))
                return response ()->view ('error.403-content',[],403);
        $areas = Areas::pluck('area','id');
        $acopiadores = \App\Models\Persona::ListAcopiador()->pluck('acopiador','dni');
        $departamentos = \App\Models\Socios\Departamento::pluck('departamento','id'); 
        return response()->view('RRHH.sucursalModal',['areas'=>$areas,'departamentos'=>$departamentos,'empleados'=>$acopiadores]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        if(!auth()->user()->can('ver almacen'))
            return response ()->view ('errors.403');
        $sucursales = Sucursal::listaSucursales('');    
        
        return view('RRHH/sucursal', array('sucursales'=>$sucursales));
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
            if(!auth()->user()->can('crear almacen'))
                return response ()->view ('errors.403-content',[],403);
            $sucursal = Sucursal::create([
                'sucursalId'=>$request->codigoId,
                'sucursal'=>  strtoupper($request->sucursal),
                'telefono'=>$request->telefono,
                'fax'=>$request->telefono,
                'direccion'=>$request->direccion,
                'areas_id'=>$request->area,
                'comites_locales_id'=>$request->comite_local,
                'users_id'=>  \Illuminate\Support\Facades\Auth::user()->id,
                'personas_dni'=>$request->acopiador                    
            ]);
            if($sucursal)            
                return response()->json(['success'=>true,'message'=>'Se Registro Correctamente']);            
            else            
                return response()->json(['success'=>false,'message'=>'No se registro ningun dato']);            
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
        $sucursal = Sucursal::getSucursal($id);
                return response()->json($sucursal);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\RRHH\almacenCreateRequest $request, $id)
    {        
        if($request->ajax())
        {              
            if(!auth()->user()->can('editar almacen'))
                return response ()->view ('errors.403-content',[],403);
            $sucursal =  Sucursal::where('sucursalId','=',$id)
                      ->update([
                          'sucursal'=>  strtoupper($request->sucursal),
                          'telefono' => $request->telefono,
                          'fax' => $request->fax,
                          'comites_locales_id' => $request->comite_local,
                          'areas_id' => $request->area,
                          'direccion' => strtoupper($request->direccion),
                          'personas_dni'=>$request->acopiador,
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
        if(!auth()->user()->can('eliminar almacen'))
                return response ()->view ('errors.403-content',[],403);
            $sucursal = Sucursal::where('sucursalId','=',$id)
                ->delete();
       if($sucursal)            
                return response()->json(['success'=>true]);            
            else            
                return response()->json(['success'=>false]);                    
    }
}
