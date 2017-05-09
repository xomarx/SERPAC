<?php

namespace App\Http\Controllers\socios;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\Models\Persona;
use App\Models\Socios\Socio;

use App\Http\Requests\socios\SociocreateRequest;
use App\Http\Requests\socios\Updatesociorquest;
use App\Models\Socios\Departamento;
use App\Models\Socios\Provincia;
use App\Models\Socios\Flora;
use App\Models\Socios\Fauna;
use App\Models\Socios\Inmueble;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class sociocontroller extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        
                                    
    public function ModalSocio(){
        if(!auth()->user()->can(['crear socios','editar socios'])) 
            return response()->view('errors.403-modal');
        $condicions = \App\Models\Certificacion\Condicion::all('condicion','id');
        $departamentos = Departamento::pluck('departamento','id');
        return response()->view('socios.sociosModal',['departamentos'=>$departamentos,'condicions'=>$condicions]);
        
    }
    
    public function index()
    {         
        if(!auth()->user()->can('ver socios'))
            return response ()->view ('errors.403');    
        $socios = Socio::listasocios('');
        return response()->view('socios.socios',['socios'=>$socios]);
    }       
    
    public function Listasocios($dato = ''){
        $socios = Socio::listasocios($dato);
        return response()->view('socios.sociosList',['socios'=>$socios]);
    }

    public function verPadronsocio($idsocio) {
        $socio = Socio::getSocio($idsocio);
        $parientes = \App\Models\Socios\Pariente::getparientesSocio($idsocio);
        $fundos = \App\Models\Socios\Fundo::getfundosSocio($idsocio);
        $cultivos = Flora::getcultivos($idsocio);
        $faunas = Fauna::getfaunas($idsocio);
        $dato = view('Reportes.socios.socio',['socio'=>$socio,'parientes'=>$parientes,
            'fundos'=>$fundos,'cultivos'=>$cultivos,'faunas'=>$faunas])->render();
//        return view('Reportes.socios.socio',['socio'=>$socio,'parientes'=>$parientes,
//            'fundos'=>$fundos,'cultivos'=>$cultivos,'faunas'=>$faunas]);
        $pdf = \Illuminate\Support\Facades\App::make('dompdf.wrapper');
        $pdf->loadHTML($dato);                        
//        $pdf->loadview('Acopio.formExcel');
        return $pdf->stream();
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SociocreateRequest $request)
    {
        //     
        if($request->ajax())
        {
            if(!auth()->user()->can('crear socios'))
                return response()->view('errors.403-content', [], 403);
            
            $persona = new Persona($request->all());
            $date = Carbon::parse($request->fec_nac);
            $persona->fec_nac=$date;
            $persona->comites_locales_id = $request->comite_local;
            $persona->save();
            $dni = $persona->dni;           
            $socio = new socio($request->all());
            $date = Carbon::parse($request->fec_asociado);
            $socio->fec_asociado = $date;
            $date = Carbon::parse($request->fec_empadron);
            $socio->fec_empadron = $date;
            $socio->dni = $dni;
            $socio->users_id = \Illuminate\Support\Facades\Auth::user()->id;
            $socio->save();                        
            if($socio) return response()->json(['success'=>true,'message'=> 'Se Registro Correctamente']);            
            else return response()->json(['success'=>false,'message'=> 'No se Registro ningun dato']);            
        }
        
    }
    
    public function condicions(Request $request){

        $condicion = \App\Models\Socios\Condicions_has_socio::where('socios_codigo','=',$request->socios_codigo)
                ->where('condicions_id','=',$request->condicions_id)->first();
        if(!$condicion)
            $condicion=\App\Models\Socios\Condicions_has_socio::create($request->all());
        if($condicion) return response ()->json (['success'=>true]);
    }
    
    public  function limpiarCondicion($idsocio){
        $condicion = \App\Models\Socios\Condicions_has_socio::where('socios_codigo','=',$idsocio)->delete();
        if($condicion) return response ()->json (['success'=>true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($codigo)
    {                
        $socio = Socio::getSocio($codigo);
        $condicion = \App\Models\Socios\Condicions_has_socio::where('socios_codigo','=',$codigo)
                ->select('condicions_id')->get();
        return response()->json(['socio'=>$socio,'condicions'=>$condicion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SociocreateRequest $request, $codigo)
    {        
        if ($request->ajax()) {
            if(!auth()->user()->can('editar socios'))
                return response()->view('errors.403-content', [], 403);
            $date = Carbon::parse($request->fec_asociado);
            $date2 = Carbon::parse($request->fec_empadron);
            $date3 = Carbon::parse($request->fec_nac);
            $result = Socio::where('codigo', '=', $codigo)
                    ->join('personas', 'socios.dni', '=', 'personas.dni')
                    ->update([
                'socios.estado_civil' => $request->estado_civil,
                'socios.fec_asociado' => $date,
                'socios.fec_empadron' => $date2,
                'socios.ocupacion' => $request->ocupacion,
                'socios.grado_inst' => $request->grado_inst,
                'socios.produccion' => $request->produccion,
                'socios.estado' => $request->estado,
                'socios.observacion' => $request->observacion,
                'personas.paterno' => $request->paterno,
                'personas.materno' => $request->materno,
                'personas.nombre' => $request->nombre,
                'personas.fec_nac' => $date3,
                'personas.sexo' => $request->sexo,
                'personas.direccion' => $request->direccion,
                'personas.telefono' => $request->telefono,
                'personas.comites_locales_id' => $request->comite_local,
                'socios.users_id'=>  \Illuminate\Support\Facades\Auth::user()->id
            ]);
            if ($result){                
                return response()->json(['success'=>'true','message'=> 'Se Actualizaron Correctamente los Datos']);
            } 
            else
            {
              return response()->json(['success'=>'false','message'=> 'No se Actualizo ningun registro']);  
            }
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        if (auth()->user()->can('eliminar socios')) {
            $socio = \App\Models\Acopio\Compra::where('socios_codigo','=',$id)->count();
            if($socio>0){
                return response()->json(['success'=>false]);
            }
            else{
                $estado = \App\Models\Socios\Fundo::where('codigo_socios','=',$id)->delete();                
                $estado=\App\Models\Socios\Pariente::where('socios_codigo','=',$id)->delete();
                $estado=\App\Models\Socios\Condicions_has_socio::where('socios_codigo','=',$id)->delete();
                $estado = Socio::where('codigo','=',$id)->delete();
//                \App\Models\Socios\Transferencia::where('socios_codigo','=',$id)->delete();
//                \App\Models\Socios\Cargos_delegados_has_socios::where('socios_codigo','=',$id)->delete();
//                \App\Models\Socios\Cargos_directivos_has_socios::where('socios_codigo','=',$id)->delete();
                return response()->json(['success'=>true]);
            }                                                    
        }
        return response()->view('errors.403-content', [], 403);  
    }

}
