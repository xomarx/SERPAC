<?php

namespace App\Http\Controllers\socios;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Socios\Pariente;
use App\Models\Persona;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;


class parientescontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function autocompleteDNIpariente(Request $request)
    {
        if($request->ajax())
        {
            $nombre = Input::get('term');
            $parientes = \App\Models\Persona::dnibeneficiarioAutocomplete($nombre);
            foreach ($parientes as $pariente) 
            {
                $result[] = ['id' => $pariente->paterno, 'value' => $pariente->dni,'local'=>$pariente->comite_local,'materno'=>$pariente->materno,
                        'nombre'=>$pariente->nombre,'fecha'=>$pariente->fec_nac];
            }
            return response()->json($result);
        }
    }
       
    public function index()
    {
        //
        $parientes = Pariente::listaParientes();
        $departamentos = \App\Models\Socios\Departamento::pluck('departamento','id')->prepend('Selleciona');
        return view('socios/parientes',['parientes'=>$parientes,'departamentos'=>$departamentos]);
    }
    
    public function datosparientes($idsocio,$dnipariente)
    {
        $pariente = Pariente::getpariente($idsocio,$dnipariente);
        return response()->json($pariente);
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
    public function store(Requests\socios\createparientesrequest $request)
    {    
        
        if($request->ajax())
        {
            
            $persona = new Persona($request->all());
            $date = Carbon::parse($request->fec_nac);
            $persona->fec_nac=$date;                       
            $persona->save();
            $dni = $persona->dni;                   
            $pariente = new Pariente($request->all());
            $pariente->personas_dni = $dni;            
            $pariente->users_id = \Illuminate\Support\Facades\Auth::user()->id;
            $pariente->save();
            if($persona)
            {
                return response()->json(['success'=>'true','message'=>'Se registro correctamente']);
            }
            else{
                return response()->json(['success'=>'false','message'=>$request->comites_locales_id]);
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
        if($request->ajax())
        {
            $date = Carbon::parse($request->fec_nac);
            $result = Pariente::join('personas','parientes.personas_dni','=','personas.dni')
                    ->where('parientes.id','=',$id)
                    ->update([
                        'parientes.grado_inst'=>$request->grado_inst,                        
                        'parientes.beneficiario'=>$request->beneficiario,
                        'parientes.estado_civil'=>$request->estado_civil,
                        'parientes.tipo_pariente'=>$request->tipo_pariente,
                        'parientes.users_id'=>  \Illuminate\Support\Facades\Auth::user()->id,
                        
                        'personas.paterno'=>$request->paterno,
                        'personas.materno'=>$request->materno,
                        'personas.nombre'=>$request->nombre,
                        'personas.fec_nac'=>$date ,
                        'personas.sexo'=>$request->sexo,
                        'personas.direccion'=>$request->direccion,
                        'personas.telefono'=>$request->telefono,
                        'personas.comites_locales_id'=>$request->comites_locales_id,
                    ]);
            if($result)
            {
                return response()->json(['success'=>'true','message'=>'Se Actualizaron correctamente']);
            }
            else{
                return response()->json(['success'=>'false','message'=>'No se Actualizo']);
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
    }
}
