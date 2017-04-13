<?php

namespace App\Models\Tesoreria;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Distribucion extends Model
{
    //
    protected $table = 'distribucions';
    protected $primarykey = 'id';
    public  $timestamps=false;
    protected  $fillable = [
        'monto','fecha','tecnicos_empleados_empleadoId','sucursales_sucursalId','estado','motivo','users_id','mov_cheques_id','documentos_id'
    ];

    public function recepcion_fondo()
    {
        return $this->hasOne(\App\Models\Acopio\Recepcion_fondo::class);
    }
    public function sucursal(){
        return $this->hasOne(\App\Models\RRHH\Sucursal::class);
    }

    public static function scopeListaAnioDistriReport($query,$anio,$mes,$dato=''){
        if($anio == 0)
            return $query->where('distribucions.estado','=','Entregado')
                    ->join('sucursales', 'distribucions.sucursales_sucursalId', '=', 'sucursales.sucursalId')
                    ->join('empleados', 'distribucions.tecnicos_empleados_empleadoId', '=', 'empleados.empleadoId')
                    ->join('personas', 'empleados.personas_dni', '=', 'personas.dni')
                    ->join('users', 'distribucions.users_id', '=', 'users.id')
                    ->join('mov_cheques','distribucions.mov_cheques_id','=','mov_cheques.id')
                    ->join('cheques','mov_cheques.cheques_id','=','cheques.id')
                    ->join('documentos','distribucions.documentos_id','=','documentos.id')                    
                    ->where(function($query)use($dato){
                        $query->where('empleados.personas_dni','like','%'.$dato.'%')
                            ->orwhere('sucursal', 'like', '%' . $dato . '%')
                            ->orwhere('monto', 'like', '%' . $dato . '%')
                            ->orwhere('fecha', 'like', '%' . $dato . '%')
                            ->orwhere('name', 'like', '%' . $dato . '%')
                            ->orwhere('cheque', 'like', '%' . $dato . '%')
                            ->orwhere('num_cheque', 'like', '%' . $dato . '%')
                            ->orwhere('enumeracion', 'like', '%' . $dato . '%')
                            ->orwhere(DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%');
                    })
                    ->select(DB::raw('year(fecha) as fecha'))
                    ->groupby(DB::raw('year(fecha)'))
                    ->orderby('fecha', 'asc')->get();
                    
        else if ($mes == 0)
            return $query->whereyear('fecha','=',$anio)->where('distribucions.estado','=','Entregado')
                    ->join('sucursales', 'distribucions.sucursales_sucursalId', '=', 'sucursales.sucursalId')
                    ->join('empleados', 'distribucions.tecnicos_empleados_empleadoId', '=', 'empleados.empleadoId')
                    ->join('personas', 'empleados.personas_dni', '=', 'personas.dni')
                    ->join('users', 'distribucions.users_id', '=', 'users.id')
                    ->join('mov_cheques','distribucions.mov_cheques_id','=','mov_cheques.id')
                    ->join('cheques','mov_cheques.cheques_id','=','cheques.id')
                    ->join('documentos','distribucions.documentos_id','=','documentos.id')
                    ->where(function($query)use($dato){
                        $query->where('empleados.personas_dni','like','%'.$dato.'%')
                            ->orwhere('sucursal', 'like', '%' . $dato . '%')
                            ->orwhere('monto', 'like', '%' . $dato . '%')
                            ->orwhere('fecha', 'like', '%' . $dato . '%')
                            ->orwhere('name', 'like', '%' . $dato . '%')
                            ->orwhere('cheque', 'like', '%' . $dato . '%')
                            ->orwhere('num_cheque', 'like', '%' . $dato . '%')
                            ->orwhere('enumeracion', 'like', '%' . $dato . '%')
                            ->orwhere(DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%');
                    })
                    ->select(DB::raw('year(fecha) as fecha'))
                    ->groupby(DB::raw('year(fecha)'))
                    ->orderby('fecha', 'asc')->get();
        else
            return $query->whereyear('fecha','=',$anio)->wheremonth('fecha', '=', $mes)->where('distribucions.estado','=','Entregado')
                    ->join('sucursales', 'distribucions.sucursales_sucursalId', '=', 'sucursales.sucursalId')
                    ->join('empleados', 'distribucions.tecnicos_empleados_empleadoId', '=', 'empleados.empleadoId')
                    ->join('personas', 'empleados.personas_dni', '=', 'personas.dni')
                    ->join('users', 'distribucions.users_id', '=', 'users.id')
                    ->join('mov_cheques','distribucions.mov_cheques_id','=','mov_cheques.id')
                    ->join('cheques','mov_cheques.cheques_id','=','cheques.id')
                    ->join('documentos','distribucions.documentos_id','=','documentos.id')
                    ->where(function($query)use($dato){
                        $query->where('empleados.personas_dni','like','%'.$dato.'%')
                            ->orwhere('sucursal', 'like', '%' . $dato . '%')
                            ->orwhere('monto', 'like', '%' . $dato . '%')
                            ->orwhere('fecha', 'like', '%' . $dato . '%')
                            ->orwhere('name', 'like', '%' . $dato . '%')
                            ->orwhere('cheque', 'like', '%' . $dato . '%')
                            ->orwhere('num_cheque', 'like', '%' . $dato . '%')
                            ->orwhere('enumeracion', 'like', '%' . $dato . '%')
                            ->orwhere(DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%');
                    })
                    ->select(DB::raw('year(fecha) as fecha'))
                    ->groupby(DB::raw('year(fecha)'))
                    ->orderby('fecha', 'asc')->get();
        
    }

    public static function scopeListaMesesDistriReport($query,$anio,$mes,$dato=''){          
        if ($mes == 0)
            return $query->whereyear('fecha','=',$anio)->where('distribucions.estado','=','Entregado')
                    ->join('sucursales', 'distribucions.sucursales_sucursalId', '=', 'sucursales.sucursalId')
                    ->join('empleados', 'distribucions.tecnicos_empleados_empleadoId', '=', 'empleados.empleadoId')
                    ->join('personas', 'empleados.personas_dni', '=', 'personas.dni')
                    ->join('users', 'distribucions.users_id', '=', 'users.id')
                    ->join('mov_cheques','distribucions.mov_cheques_id','=','mov_cheques.id')
                    ->join('cheques','mov_cheques.cheques_id','=','cheques.id')
                    ->join('documentos','distribucions.documentos_id','=','documentos.id')
                    ->where(function($query)use($dato){
                        $query->where('empleados.personas_dni','like','%'.$dato.'%')
                            ->orwhere('sucursal', 'like', '%' . $dato . '%')
                            ->orwhere('monto', 'like', '%' . $dato . '%')
                            ->orwhere('fecha', 'like', '%' . $dato . '%')
                            ->orwhere('name', 'like', '%' . $dato . '%')
                            ->orwhere('cheque', 'like', '%' . $dato . '%')
                            ->orwhere('num_cheque', 'like', '%' . $dato . '%')
                            ->orwhere('enumeracion', 'like', '%' . $dato . '%')
                            ->orwhere(DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%');
                    })
                    ->select(DB::raw('month(fecha) as mes'))
                    ->groupby(DB::raw('month(fecha)'))
                    ->orderby('fecha', 'asc')->get();
        else
            return $query->whereyear('fecha','=',$anio)->wheremonth('fecha', '=', $mes)->where('distribucions.estado','=','Entregado')
                    ->join('sucursales', 'distribucions.sucursales_sucursalId', '=', 'sucursales.sucursalId')
                    ->join('empleados', 'distribucions.tecnicos_empleados_empleadoId', '=', 'empleados.empleadoId')
                    ->join('personas', 'empleados.personas_dni', '=', 'personas.dni')
                    ->join('users', 'distribucions.users_id', '=', 'users.id')
                    ->join('mov_cheques','distribucions.mov_cheques_id','=','mov_cheques.id')
                    ->join('cheques','mov_cheques.cheques_id','=','cheques.id')
                    ->join('documentos','distribucions.documentos_id','=','documentos.id')
                    ->where(function($query)use($dato){
                        $query->where('empleados.personas_dni','like','%'.$dato.'%')
                            ->orwhere('sucursal', 'like', '%' . $dato . '%')
                            ->orwhere('monto', 'like', '%' . $dato . '%')
                            ->orwhere('fecha', 'like', '%' . $dato . '%')
                            ->orwhere('name', 'like', '%' . $dato . '%')
                            ->orwhere('cheque', 'like', '%' . $dato . '%')
                            ->orwhere('num_cheque', 'like', '%' . $dato . '%')
                            ->orwhere('enumeracion', 'like', '%' . $dato . '%')
                            ->orwhere(DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%');
                    })
                    ->select(DB::raw('month(fecha) as mes'))
                    ->groupby(DB::raw('month(fecha)'))
                    ->orderby('fecha', 'asc')->get();
    }

    public static function scopeListaReportDistribucions($query,$anio,$mes,$dato='',$idmovcheque){        
            return $query->whereyear('fecha','=',$anio)->wheremonth('fecha', '=', $mes)->where('distribucions.estado','=','Entregado')
                    ->join('sucursales', 'distribucions.sucursales_sucursalId', '=', 'sucursales.sucursalId')
                    ->join('empleados', 'distribucions.tecnicos_empleados_empleadoId', '=', 'empleados.empleadoId')
                    ->join('personas', 'empleados.personas_dni', '=', 'personas.dni')
                    ->join('users', 'distribucions.users_id', '=', 'users.id')
                    ->join('mov_cheques','distribucions.mov_cheques_id','=','mov_cheques.id')
                    ->join('cheques','mov_cheques.cheques_id','=','cheques.id')
                    ->join('documentos','distribucions.documentos_id','=','documentos.id')
                    ->where('mov_cheques.id','=',$idmovcheque)
                    ->where(function($query)use($dato){
                        $query->where('empleados.personas_dni','like','%'.$dato.'%')
                            ->orwhere('sucursal', 'like', '%' . $dato . '%')
                            ->orwhere('monto', 'like', '%' . $dato . '%')
                            ->orwhere('fecha', 'like', '%' . $dato . '%')
                            ->orwhere('name', 'like', '%' . $dato . '%')
                            ->orwhere('cheque', 'like', '%' . $dato . '%')
                            ->orwhere('num_cheque', 'like', '%' . $dato . '%')
                            ->orwhere('enumeracion', 'like', '%' . $dato . '%')
                            ->orwhere(DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%');
                    })
                    ->select('monto','sucursal','fecha','enumeracion')                    
                    ->orderby('fecha', 'asc')->get();
        
    }

    public static function scopeListaDistribucReportMovCheques($query,$anio,$mes,$dato=''){
        if($anio == 0)
            return $query->where('distribucions.estado','=','Entregado')
                    ->join('sucursales', 'distribucions.sucursales_sucursalId', '=', 'sucursales.sucursalId')
                    ->join('empleados', 'distribucions.tecnicos_empleados_empleadoId', '=', 'empleados.empleadoId')
                    ->join('personas', 'empleados.personas_dni', '=', 'personas.dni')
                    ->join('users', 'distribucions.users_id', '=', 'users.id')
                    ->join('mov_cheques','distribucions.mov_cheques_id','=','mov_cheques.id')
                    ->join('cheques','mov_cheques.cheques_id','=','cheques.id')
                    ->join('documentos','distribucions.documentos_id','=','documentos.id')
                    ->where(function($query)use($dato){
                        $query->where('empleados.personas_dni','like','%'.$dato.'%')
                            ->orwhere('sucursal', 'like', '%' . $dato . '%')
                            ->orwhere('monto', 'like', '%' . $dato . '%')
                            ->orwhere('fecha', 'like', '%' . $dato . '%')
                            ->orwhere('name', 'like', '%' . $dato . '%')
                            ->orwhere('cheque', 'like', '%' . $dato . '%')
                            ->orwhere('num_cheque', 'like', '%' . $dato . '%')
                            ->orwhere('enumeracion', 'like', '%' . $dato . '%')
                            ->orwhere(DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%');
                    })
                    ->select('cheque','mov_cheques.created_at','mov_cheques.importe',
                            'num_cheque','mov_cheques.id')
                    ->groupby('num_cheque')
                    ->orderby('mov_cheques.created_at', 'asc')
                    ->get();
        else if ($mes == 0)
            return $query->whereyear('fecha','=',$anio)->where('distribucions.estado','=','Entregado')
                    ->join('sucursales', 'distribucions.sucursales_sucursalId', '=', 'sucursales.sucursalId')
                    ->join('empleados', 'distribucions.tecnicos_empleados_empleadoId', '=', 'empleados.empleadoId')
                    ->join('personas', 'empleados.personas_dni', '=', 'personas.dni')
                    ->join('users', 'distribucions.users_id', '=', 'users.id')
                    ->join('mov_cheques','distribucions.mov_cheques_id','=','mov_cheques.id')
                    ->join('cheques','mov_cheques.cheques_id','=','cheques.id')
                    ->join('documentos','distribucions.documentos_id','=','documentos.id')
                    ->where(function($query)use($dato){
                        $query->where('empleados.personas_dni','like','%'.$dato.'%')
                            ->orwhere('sucursal', 'like', '%' . $dato . '%')
                            ->orwhere('monto', 'like', '%' . $dato . '%')
                            ->orwhere('fecha', 'like', '%' . $dato . '%')
                            ->orwhere('name', 'like', '%' . $dato . '%')
                            ->orwhere('cheque', 'like', '%' . $dato . '%')
                            ->orwhere('num_cheque', 'like', '%' . $dato . '%')
                            ->orwhere('enumeracion', 'like', '%' . $dato . '%')
                            ->orwhere(DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%');
                    })
                    ->select('cheque','mov_cheques.created_at','mov_cheques.importe',
                            'num_cheque','mov_cheques.id')
                            ->groupby('num_cheque')
                    ->orderby('mov_cheques.created_at', 'asc')
                    ->get();
        else
            return $query->whereyear('fecha','=',$anio)->wheremonth('fecha', '=', $mes)->where('distribucions.estado','=','Entregado')
                    ->join('sucursales', 'distribucions.sucursales_sucursalId', '=', 'sucursales.sucursalId')
                    ->join('empleados', 'distribucions.tecnicos_empleados_empleadoId', '=', 'empleados.empleadoId')
                    ->join('personas', 'empleados.personas_dni', '=', 'personas.dni')
                    ->join('users', 'distribucions.users_id', '=', 'users.id')
                    ->join('mov_cheques','distribucions.mov_cheques_id','=','mov_cheques.id')
                    ->join('cheques','mov_cheques.cheques_id','=','cheques.id')
                    ->join('documentos','distribucions.documentos_id','=','documentos.id')
                    ->where(function($query)use($dato){
                        $query->where('empleados.personas_dni','like','%'.$dato.'%')
                            ->orwhere('sucursal', 'like', '%' . $dato . '%')
                            ->orwhere('monto', 'like', '%' . $dato . '%')
                            ->orwhere('fecha', 'like', '%' . $dato . '%')
                            ->orwhere('name', 'like', '%' . $dato . '%')
                            ->orwhere('cheque', 'like', '%' . $dato . '%')
                            ->orwhere('num_cheque', 'like', '%' . $dato . '%')
                            ->orwhere('enumeracion', 'like', '%' . $dato . '%')
                            ->orwhere(DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%');
                    })
                    ->select('cheque','mov_cheques.created_at','mov_cheques.importe',
                            'num_cheque','mov_cheques.id')
                            ->groupby('num_cheque')
                    ->orderby('mov_cheques.created_at', 'asc')
                    ->get();
    }
    
    public static function scopelistaDistribucion($query,$anio,$mes,$dato=''){
            if($anio == 0)
            return $query->where('distribucions.estado','=','Entregado')
                    ->join('sucursales', 'distribucions.sucursales_sucursalId', '=', 'sucursales.sucursalId')
                    ->join('empleados', 'distribucions.tecnicos_empleados_empleadoId', '=', 'empleados.empleadoId')
                    ->join('personas', 'empleados.personas_dni', '=', 'personas.dni')
                    ->join('users', 'distribucions.users_id', '=', 'users.id')
                    ->join('mov_cheques','distribucions.mov_cheques_id','=','mov_cheques.id')
                    ->join('cheques','mov_cheques.cheques_id','=','cheques.id')
                    ->join('documentos','distribucions.documentos_id','=','documentos.id')
                    ->where(function($query)use($dato){
                        $query->where('empleados.personas_dni','like','%'.$dato.'%')
                            ->orwhere('sucursal', 'like', '%' . $dato . '%')
                            ->orwhere('monto', 'like', '%' . $dato . '%')
                            ->orwhere('fecha', 'like', '%' . $dato . '%')
                            ->orwhere('name', 'like', '%' . $dato . '%')
                            ->orwhere('cheque', 'like', '%' . $dato . '%')
                            ->orwhere('num_cheque', 'like', '%' . $dato . '%')
                            ->orwhere('enumeracion', 'like', '%' . $dato . '%')
                            ->orwhere(DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%');
                    })
                    ->select('monto','sucursal','paterno','materno','nombre','empleados.personas_dni','fecha','name',
                            'cheque','num_cheque','distribucions.id','enumeracion')
                    ->orderby('fecha', 'desc')
                    ->paginate(10);
        else if ($mes == 0)
            return $query->whereyear('fecha','=',$anio)->where('distribucions.estado','=','Entregado')
                    ->join('sucursales', 'distribucions.sucursales_sucursalId', '=', 'sucursales.sucursalId')
                    ->join('empleados', 'distribucions.tecnicos_empleados_empleadoId', '=', 'empleados.empleadoId')
                    ->join('personas', 'empleados.personas_dni', '=', 'personas.dni')
                    ->join('users', 'distribucions.users_id', '=', 'users.id')
                    ->join('mov_cheques','distribucions.mov_cheques_id','=','mov_cheques.id')
                    ->join('cheques','mov_cheques.cheques_id','=','cheques.id')
                    ->join('documentos','distribucions.documentos_id','=','documentos.id')
                    ->where(function($query)use($dato){
                        $query->where('empleados.personas_dni','like','%'.$dato.'%')
                            ->orwhere('sucursal', 'like', '%' . $dato . '%')
                            ->orwhere('monto', 'like', '%' . $dato . '%')
                            ->orwhere('fecha', 'like', '%' . $dato . '%')
                            ->orwhere('name', 'like', '%' . $dato . '%')
                            ->orwhere('cheque', 'like', '%' . $dato . '%')
                            ->orwhere('num_cheque', 'like', '%' . $dato . '%')
                            ->orwhere('enumeracion', 'like', '%' . $dato . '%')
                            ->orwhere(DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%');
                    })
                    ->select('monto','sucursal','paterno','materno','nombre','empleados.personas_dni','fecha','name',
                            'cheque','num_cheque','distribucions.id','enumeracion')
                    ->orderby('fecha', 'desc')
                    ->paginate(10);
        else
            return $query->whereyear('fecha','=',$anio)->wheremonth('fecha', '=', $mes)->where('distribucions.estado','=','Entregado')
                    ->join('sucursales', 'distribucions.sucursales_sucursalId', '=', 'sucursales.sucursalId')
                    ->join('empleados', 'distribucions.tecnicos_empleados_empleadoId', '=', 'empleados.empleadoId')
                    ->join('personas', 'empleados.personas_dni', '=', 'personas.dni')
                    ->join('users', 'distribucions.users_id', '=', 'users.id')
                    ->join('mov_cheques','distribucions.mov_cheques_id','=','mov_cheques.id')
                    ->join('cheques','mov_cheques.cheques_id','=','cheques.id')
                    ->join('documentos','distribucions.documentos_id','=','documentos.id')
                    ->where(function($query)use($dato){
                        $query->where('empleados.personas_dni','like','%'.$dato.'%')
                            ->orwhere('sucursal', 'like', '%' . $dato . '%')
                            ->orwhere('monto', 'like', '%' . $dato . '%')
                            ->orwhere('fecha', 'like', '%' . $dato . '%')
                            ->orwhere('name', 'like', '%' . $dato . '%')
                            ->orwhere('cheque', 'like', '%' . $dato . '%')
                            ->orwhere('num_cheque', 'like', '%' . $dato . '%')
                            ->orwhere('enumeracion', 'like', '%' . $dato . '%')
                            ->orwhere(DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%');
                    })
                    ->select('monto','sucursal','paterno','materno','nombre','empleados.personas_dni','fecha',
                            'cheque','num_cheque','name','distribucions.id','enumeracion')
                    ->orderby('fecha', 'desc')
                    ->paginate(10);
            
    }
    

    public static function tecnicos()
    {
        return DB::table('tecnicos')
                ->join('empleados','tecnicos.empleados_empleadoId','=','empleados.empleadoId')
                ->join('personas','empleados.personas_dni','=','personas.dni')
                ->where('empleados.estado','=','ACTIVO')
                ->pluck( DB::raw("CONCAT(personas.paterno,' ',personas.materno,' ',personas.nombre)  AS fullname")   ,'empleados.empleadoId');
    }
    
    public static function listaSucursalTecnicos($idtecnico){
        return DB::table('tecnicos')
                ->join('comites_locales','tecnicos.comites_locales_id','=','comites_locales.id')
                ->join('sucursales','comites_locales.id','=','sucursales.comites_locales_id')
                ->where('tecnicos.empleados_empleadoId','=',$idtecnico)
                ->pluck('sucursales.sucursal','sucursales.sucursalId');
        
    }
    
    public static function scopegetReciboAcopiador($query,$iddistribcion){
        return $query
                ->join('sucursales','distribucions.sucursales_sucursalId','=','sucursales.sucursalId')                
                ->join('comites_locales','sucursales.comites_locales_id','=','comites_locales.id')
                ->join('empleados','sucursales.empleados_empleadoId','=','empleados.empleadoId')
                ->join('personas','empleados.personas_dni','=','personas.dni')
                ->join('documentos','distribucions.documentos_id','=','documentos.id')
                ->join('tipo_documentos','documentos.tipo_documentos_cod','=','tipo_documentos.codigo')
                ->where('distribucions.id','=',$iddistribcion)
                ->select('comite_local','sucursal','paterno','materno','nombre'
                        ,'dni','distribucions.fecha','distribucions.monto','tipo_documento','enumeracion')
                ->first();
    }
    
    public static function getDistribucion(){
        return DB::table('distribucions')
                ->select(DB::raw('max(id) as id'))->first();
    }
            
}
