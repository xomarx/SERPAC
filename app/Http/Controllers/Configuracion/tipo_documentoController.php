<?php

namespace App\Http\Controllers\Configuracion;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class tipo_documentoController extends Controller
{
    
    public function getnumerodocumento($idrecibo){
        $numero = \App\Models\Configuracion\Documento::enumeracionDoc($idrecibo); 
        if(is_null($numero) )
            $dato = 1;         
        else
            $dato = $numero->enumeracion + 1;
         return response()->json($dato);
    }


    public function autoCompleteCodRecibo(Request $request){
        if($request->ajax()){
            $nombre = \Illuminate\Support\Facades\Input::get('term');
            $recibos = \App\Models\Configuracion\Tipo_documento::autoCompleteTipo_Doc($nombre);// pluck('codigo')->take(7)->get();            
            foreach ($recibos as $recibo) 
            {
                $result[] = ['id' => $recibo->codigo, 'value' => $recibo->codigo];
            }
            return response()->json($result);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!auth()->user()->can(['crear documentos','ver documentos']))
                return response ()->view ('errors.403');
        $recibos = \App\Models\Configuracion\Tipo_documento::all();
        return view('Configuracion.Recibos',['recibos'=>$recibos]);
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
    public function store(Requests\Configuracion\tipo_documentoCreateRequest $request)
    {
        if($request->ajax()){
            if(!auth()->user()->can('crear documentos'))
                return response ()->view ('errors.403-content',[],403);
            $tipo = \App\Models\Configuracion\Tipo_documento::create([
                'codigo'=>  strtoupper($request->codigo),
                'tipo_documento'=>  strtoupper($request->recibo),
                'enlace'=>  strtoupper($request->enlace)
            ]);
            if($tipo) return response ()->json (['success'=>true,'message'=>'Se registro correctamente']);
            else return response ()->json (['success'=>false,'message'=>'No se registro']);
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
        $tipo = \App\Models\Configuracion\Tipo_documento::where('codigo','=',$id)->first();
        return response()->json($tipo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\Configuracion\tipo_documentoCreateRequest $request, $id)
    {
        if($request->ajax()){
            if(!auth()->user()->can('editar documentos'))
                return response ()->view ('errors.403-content',[],403);
            $tipo = \App\Models\Configuracion\Tipo_documento::where('codigo','=',$id)
                    ->update(['tipo_documento'=>  strtoupper($request->recibo),
                        'enlace'=>  strtoupper($request->enlace)]);
            if($tipo)
                return response()->json(['success'=>true,'message'=>'Se actualizaron correctamente los datos']);
            else return response()->json(['success'=>false,'message'=>'No se actualizaron datos']);
        
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
        if(!auth()->user()->can('eliminar documentos'))
            return response ()->view ('errors.403-content',[],403);
        $tipo = \App\Models\Configuracion\Tipo_documento::where('codigo','=',$id)->delete();
        if($tipo) return response ()->json (['success'=>true,'message'=>'Se elimino Correctamente']);
        else return response ()->json (['success'=>false,'message'=>'No se puede Eliminar el Registro']);
    }
}
