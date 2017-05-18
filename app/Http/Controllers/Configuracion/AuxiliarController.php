<?php

namespace App\Http\Controllers\Configuracion;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class AuxiliarController extends Controller
{
    public function autoDNInoEmpleado(Request $request) {
        if($request->ajax()){
            $nombre = Input::get('term');
            $socios = \App\Models\Persona::autocompleteDNInoEmpleado($nombre);
//            dd($nombre);
            $result=[];
            foreach ($socios as $socio) 
            {
                $result[] = [
                    'id' => $socio->datos, 'value' => $socio->dni
                        ];
            }
            return response()->json($result);
        }
    }
    
    public function autoDatosNoEmpleados(Request $request){
        if($request->ajax()){
            $nombre = Input::get('term');
            $socios = \App\Models\Persona::autoDatosNoEmpleados($nombre);
            $result=[];
            foreach ($socios as $socio) 
            {
                $result[] = [
                    'value' => $socio->datos, 'id' => $socio->dni
                        ];
            }
            return response()->json($result);
        }
    }
    
    public function AutoDNIEmpleados(Request $request){
        if($request->ajax()){
            $nombre = Input::get('term');
            $mpleados = \App\Models\RRHH\Empleado::autocompleteDni($nombre);
            $result=[];
            foreach ($mpleados as $mpleado) 
            {
                $result[] = [
                    'value' => $mpleado->dni, 'id' => $mpleado->datos
                        ];
            }
            return response()->json($result);
        }
    }
    
    public function AutoDatosEmpleados(Request $request){
        if($request->ajax()){
            $nombre = Input::get('term');
            $mpleados = \App\Models\RRHH\Empleado::autocompleteDatos($nombre);
            $result=[];
            foreach ($mpleados as $mpleado) 
            {
                $result[] = [
                    'value' => $mpleado->datos, 'id' => $mpleado->dni
                        ];
            }
            return response()->json($result);
        }
    }

    public function StorePersona(Request $request){
        $this->validate($request, [
            'dni'=>'required|numeric|unique:personas,dni',
            'sexo'=>'required',
            'paterno'=>'required',
            'materno'=>'required',
            'nombre'=>'required',
            'fec_nacimiento'=>'required|date',
            'direccion'=>'required'
        ]);
        if($request->ajax()){
           $persona = \App\Models\Persona::create([
                'dni'=>$request->dni,
                'sexo'=>$request->sexo,
                'paterno'=>  strtoupper($request->paterno),
                'materno'=>  strtoupper($request->materno),
                'nombre'=>  strtoupper($request->nombre),
                'fec_nacimiento'=>$request->fec_nacimiento,
                'direccion'=>  strtoupper($request->direccion)
            ]);
           if($persona) return response ()->json (['success'=>true,'message'=>'Se registro correctamente']);
           else return response ()->json (['success'=>false,'message'=>'No se registro ningun dato']);
        }
    }

    public function PersonaModal(){
        $departamentos = \App\Models\Socios\Departamento::pluck('departamento','id');
        return response()->view('RRHH.persona',['departamentos'=>$departamentos]);
    }


    public function RRHH(){
        return response()->view('RRHH.masterempleados');
    }    
    public function Socios(){
        return response()->view('socios.mastersocio');
    }    
    public function Acopio(){
        return response()->view('Acopio.masteracopio');
    }
    public function Creditos(){
        return response()->view('Creditos.masterCreditos');
    }
    public function Certificacion(){
        return response()->view('Certificacion.masterCertificacion');
    }
    public function Tesoreria(){
        return response()->view('Tesoreria.mastertesoreria');
    }
    public function Contabilidad(){
        return response()->view('Contabilidad.masterContabilidad');
    }
    public function Informes(){
        return response()->view('Reportes.masterInform');
    }
    public function Configuracion(){
        return response()->view('Configuracion.masterconfiguracion');
    }
    


    public function PersonDNI($dni){        
            $personas = \App\Models\Persona::DNIPersonas($dni);            
            return response()->json($personas);        
    }

    public function autoDatoSocios (Request $request) {
        if($request->ajax()){
            $nombre = Input::get('term');
            $socios = \App\Models\Socios\Socio::Socioautocomplete($nombre);
            $result=[];
            foreach ($socios as $socio) 
            {
                $result[] = [
                    'id' => $socio->codigo, 'value' => $socio->fullname,'local'=>$socio->comite_local,'dni'=>$socio->dni,'condicions'=>  \App\Models\Certificacion\Condicion::getcondicions($socio->codigo)
                        ];
            }
            return response()->json($result);
        }
    }
    
    public function autoCodigoSocios(Request $request){
        if($request->ajax()){
            $nombre = Input::get('term');
            $socios = \App\Models\Socios\Socio::CodigoSocioautocomplete($nombre);
            $result=[];
            foreach ($socios as $socio) 
            {
                $result[] = ['id' => $socio->dni, 'value' => $socio->codigo,'local'=>$socio->comite_local,'socio'=>$socio->fullname,'condicions'=>  \App\Models\Certificacion\Condicion::getcondicions($socio->codigo)];
            }
            return response()->json($result);
        }
    }

    
    public function autoDNISocios(Request $request) {
        if($request->ajax()){
            $nombre = Input::get('term');
            $socios = \App\Models\Socios\Socio::DNISocioautocomplete($nombre);
            $result=[];
            foreach ($socios as $socio) 
            {
                $result[] = ['id' => $socio->codigo, 'value' => $socio->dni,'local'=>$socio->comite_local,'socio'=>$socio->fullname
                        ,'condicions'=>  \App\Models\Certificacion\Condicion::getcondicions($socio->codigo)];
            }
            return response()->json($result);
        }
    }
    
    public function autoDNIParientesSocios(Request $request)
    {
        if($request->ajax()){
            $nombre = Input::get('term');
            $personas = \App\Models\Persona::dniParientesSocios($nombre);
            $result=[];
            foreach ($personas as $persona) 
            {
                $result[] = ['id' => $persona->paterno, 'value' => $persona->dni,'local'=>$persona->comite_local,'materno'=>$persona->materno,
                        'nombre'=>$persona->nombre,'fecha'=>$persona->fec_nac];
            }
            return response()->json($result);
        }
    }
    
    public function autoDNIPersonas(Request $request)
    {
        if($request->ajax())
        {
            $nombre = Input::get('term');
            $parientes = \App\Models\Persona::AutodniPersonas($nombre);
            $result=[];
            foreach ($parientes as $pariente) 
            {
                $result[] = ['id' => $pariente->paterno, 'value' => $pariente->dni,'local'=>$pariente->comite_local,'materno'=>$pariente->materno,
                        'nombre'=>$pariente->nombre,'fecha'=>$pariente->fec_nac];
            }
            return response()->json($result);
        }
    }
    
    public function autoDatosPersonas(Request $request){
        if($request->ajax())
        {
            $nombre = Input::get('term');            
            $personas = \App\Models\Persona::autoDatosPersonas($nombre);    
            $result=[];
            foreach ($personas as $persona) 
            {
                $result[] = ['id' => $persona->dni, 'value' => $persona->paterno. ' '.$persona->materno.' '.$persona->nombre,'fecha'=>$persona->fec_nac];
            }
            return response()->json($result);
        }
    }

     public function autoSucursal(Request $request){
        if($request->ajax())
        {
            $nombre = Input::get('term');
            $sucursals = \App\Models\RRHH\Sucursal::autoSucursal($nombre);
            $result=[];
            foreach ($sucursals as $sucursal) 
            {
                $result[] = ['id' => $sucursal->sucursalId, 'value' => $sucursal->sucursal
//                        ,'sucursal'=>$sucursal->sucursal,'sector'=>$sucursal->comite_local
//                        ,'acopiador'=>$sucursal->acopiador,'tecnico'=>$sucursal->tecnico
                        ];
            }
            return response()->json($result);
        }
    }

    public function autoCodigoSucursal(Request $request){
        if($request->ajax())
        {
            $nombre = Input::get('term');
            $sucursals = \App\Models\RRHH\Sucursal::autoCodigoSucursal($nombre);
            $result=[];
            foreach ($sucursals as $sucursal) 
            {
                $result[] = ['id' => $sucursal->sucursal, 'value' => $sucursal->sucursalId
//                        ,'sucursal'=>$sucursal->sucursal,'acopiador'=>$sucursal->acopiador,'tecnico'=>$sucursal->tecnico
                        ];
            }
            return response()->json($result);
        }
    }

    public function autoNoSocios(Request $request){
        if($request->ajax()){
            $nombre = \Illuminate\Support\Facades\Input::get('term');
            $nosocios = \App\Models\Acopio\Nosocio::where('dni','like','%'.$nombre.'%')->get();
            $result=[];
            foreach ($nosocios as $nosocio) 
            {
                $result[] = ['id' => $nosocio->paterno, 'value' => $nosocio->dni,'materno'=>$nosocio->materno,'nombres'=>$nosocio->nombres,'condicions'=>  \App\Models\Certificacion\Condicion::pluck('condicion','id')];
            }
            return response()->json($result);
        }
    }

    
    
    
    
    

    public function autoSociosPersonas(Request $request){
        if($request->ajax()){
            $nombre = Input::get('term');
            $socios = Socio::PersonasSociosAuto($nombre);
            foreach ($socios as $socio) 
            {
                $result[] = ['id' => $socio->dni, 'value' => $socio->socio];
            }
            return response()->json($result);
        }
    }
    
    public function autoSociosPersonasDni(Request $request){
        if($request->ajax()){
            $nombre = Input::get('term');
            $socios = Socio::PersonasSociosAuto($nombre);
            foreach ($socios as $socio) 
            {
                $result[] = ['id' => $socio->dni, 'value' => $socio->socio];
            }
            return response()->json($result);
        }
    }

        public function autoSociosDni(Request $request)    {
        if($request->ajax()){
            $nombre = Input::get('term');
            $socios = Socio::PersonasSociosDniAuto($nombre);
            foreach ($socios as $socio) 
            {
                $result[] = ['id' => $socio->socio, 'value' => $socio->dni];
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
        return response()->view('Configuracion.datos');
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
    public function store(Request $request)// carga los datos del archivo de excel para los socios
    {
        $this->validate($request, [
            'excel'=>'required|file'
        ],['excel.required'=>'No cargo ningun archivo de tipo Excel','excel.file'=>'Solo se permiten Archivos de tipo Excel']);
        if($request->ajax()){
        $archivo = $request->file('excel');
        $nombre = $archivo->getClientOriginalName();
        $extension = $archivo->getClientOriginalExtension();
        $path = Storage::disk('archivosDatos')->put($nombre, \File($archivo));
        $ruta = "/storage/app/archivosDatos/".$nombre;
        
        ini_set('max_execution_time', 180);
        if($path){
            $cont=0;
//            return response()->json($ruta);
            \Maatwebsite\Excel\Facades\Excel::selectSheetsByIndex(0)->load($ruta,function($hoja){                 
                $hoja->each(function($fila){
                    $permiso = \App\Permission::where('name','=',$fila->name)->count();
                    if($permiso==0){
                        \App\Permission::create([
                        'name'=>$fila->name,
                        'display_name'=>$fila->display_name,
                        'description'=>$fila->description
                    ]);
                    }
                    
                    
                });
            });
            return response()->json(['success'=>true,'message'=>'Se cargo correctamente los Datos']);
        }
        else{
            return response()->json(['success'=>false,'message'=>'Error al cargar los datos del Archivo']);
        }
        }
    }

    /*
    //**********************   cargar comites centrales
                        
                    $distrito = \App\Models\Socios\Distrito::where('distrito','=',$fila->distrito)->select('id')->first();                    
                    $comite = \App\Models\Socios\Comites_Centrales::where('comite_central','=',$fila->comite_central)
                            ->where('distritos_id','=',$distrito->id)->first();
//                    dd(count($comite));
                    if(count($comite) == 0){
                    \App\Models\Socios\Comites_Centrales::create([
                        'comite_central'=>$fila->comite_central,
                        'distritos_id'=>$distrito->id
                    ]);
                    }
    
    //***************************  COMITE LOCALES 
                        
                    $central = \App\Models\Socios\Comites_Centrales::where('comite_central','=',$fila->comite_central)->select('id')->first();                    
                    $local = \App\Models\Socios\Comites_Locale::where('comite_local','=',$fila->comite_local)
                            ->where('comites_centrales_id','=',$central->id)->first();
//                    dd(count($comite));
                    if(count($local) == 0){
                        \App\Models\Socios\Comites_Locale::create([
                        'comite_local'=>$fila->comite_local,
                        'comites_centrales_id'=>$central->id
                    ]);
                    }
     // **********************************   SOCIOS  ************************************************************
     
                    $comite = \App\Models\Socios\Comites_Locale::where('comite_local','=',$fila->comite_local)->first();
                    $socios = \App\Models\Socios\Socio::where('dni','=',$fila->dni)->first();
                    if(count($socios) ==0 ){
                        $persona = new \App\Models\Persona();
                        $persona->dni=$fila->dni;                       
                           $persona->paterno=$fila->paterno;
                           $persona->materno=$fila->materno;
                           $persona->nombre=$fila->nombre;
                           $persona->fec_nac=$fila->fec_nacimiento;
                           $persona->sexo=substr($fila->sexo,1);
                           $persona->direccion=$fila->direccion;
                           $persona->telefono=$fila->telefono;
                           $persona->comites_locales_id=$comite->id;
                           $persona->save();
//                        dd($persona->dni);
                        \App\Models\Socios\Socio::create([
                            'codigo'=>$fila->codigo,
                            'fec_asociado'=>$fila->fec_asociado,
                            'fec_empadron'=>$fila->fec_empadron,
                            'estado_civil'=>$fila->estado_civil,
                            'ocupacion'=>$fila->ocupacion,
                            'grado_inst'=>$fila->grado_inst,
                            'produccion'=>$fila->produccion,
                            'estado'=>$fila->estado,
                            'observacion'=>$fila->observacion,
                            'dni'=>$persona->dni,
                            'users_id'=>  auth()->user()->id
                        ]);
                    } 
     
    //////// *************************************  EMPLEADOS 
     
     
                    
                    $comite = \App\Models\Socios\Comites_Locale::where('comite_local','=',$fila->comite_local)->first();
                    $area = \App\Models\RRHH\Areas::where('area','=',$fila->area)->first();
                    if(count($area) == 0){
                        $area = new \App\Models\RRHH\Areas();
                        $area->area = $fila->area;
                        $area->save();
                    }                        
                    $cargo = \App\Models\RRHH\Cargos::where('cargo','=',$fila->cargo)->first();
                    if(count($cargo) == 0){
                        $cargo = new \App\Models\RRHH\Cargos();
                        $cargo->cargo = $fila->cargo;
                        $cargo->save();
                    }                        
                    $persona = \App\Models\Persona::where('dni','=',$fila->dni)->first();
                    if(count($persona) == 0){
                        $persona = new \App\Models\Persona();
                        $persona->dni=$fila->dni;                       
                           $persona->paterno=$fila->paterno;
                           $persona->materno=$fila->materno;
                           $persona->nombre=$fila->nombre;
                           $persona->fec_nac=$fila->fec_nacimiento;
                           $persona->sexo=substr($fila->sexo,1);
                           $persona->direccion=$fila->direccion;
                           $persona->telefono=$fila->telefono;
                           $persona->comites_locales_id=$comite->id;
                           $persona->save();
                    }
                    $empleado = \App\Models\RRHH\Empleado::where('personas_dni','=',$fila->dni)->first();
                    if(count($empleado) == 0){
                        \App\Models\RRHH\Empleado::create([
                            'empleadoId'=>$fila->codigo,
                            'estado'=>'ACTIVO',
                            'estadocivil'=>$fila->estadocivil,
                            'email'=>$fila->email,
                            'profesion'=>$fila->profesion,
                            'ruc'=>$fila->ruc,
                            'personas_dni'=>$persona->dni,
                            'cargos_id'=>$cargo->id,
                            'areas_id'=>$area->id,
                            'empresas_ruc'=>$fila->empresa_ruc,
                        ]);   
                    }
     
     * 
     * 
     * 
    */
    
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
        //
    }
}
