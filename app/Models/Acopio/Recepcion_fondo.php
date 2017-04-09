<?php

namespace App\Models\Acopio;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Recepcion_fondo extends Model
{
    //
    protected $table = 'recepcion_fondos';
    protected $primarykey = 'id';
    public  $timestamps=false;
    protected  $fillable = [
        'monto','fecha','estado','motivo',
        'distribucions_id','users_id'];    
    /**
     * Devuelve el socio propietario de esta persona
     */
    public function distribucion()
    {
        return $this->belongsTo(\App\Models\Tesoreria\Distribucion::class);
    }
    
    public static function listaRecepcio()
    {
        return DB::table('recepcion_fondos')
                ->join('distribucions','recepcion_fondos.distribucions_id','=','distribucions.id')
                ->join('sucursales','distribucions.sucursales_sucursalId','=','sucursales.sucursalId')                
                ->join('empleados','distribucions.tecnicos_empleados_empleadoId','=','empleados.empleadoId')
                ->join('personas','empleados.personas_dni','=','personas.dni')
                ->select('empleados.personas_dni','personas.paterno','personas.materno','personas.nombre',
                        'sucursales.sucursal','recepcion_fondos.monto','recepcion_fondos.fecha','recepcion_fondos.id'
                        ,'recepcion_fondos.estado')
                ->get();
    }
    
    public static function listaRecFondos($anio,$mes){
        if($anio==0)
            return DB::table('recepcion_fondos')
                ->join('distribucions','recepcion_fondos.distribucions_id','=','distribucions.id')
                ->join('sucursales','distribucions.sucursales_sucursalId','=','sucursales.sucursalId')                
                ->join('empleados','distribucions.tecnicos_empleados_empleadoId','=','empleados.empleadoId')
                ->join('personas','empleados.personas_dni','=','personas.dni')
                ->select('empleados.personas_dni','personas.paterno','personas.materno','personas.nombre',
                        'sucursales.sucursal','recepcion_fondos.monto','recepcion_fondos.fecha','recepcion_fondos.id'
                        ,'recepcion_fondos.estado')
                ->get();
        else if($mes==0)
            return DB::table('recepcion_fondos')
                ->join('distribucions','recepcion_fondos.distribucions_id','=','distribucions.id')
                ->join('sucursales','distribucions.sucursales_sucursalId','=','sucursales.sucursalId')                
                ->join('empleados','distribucions.tecnicos_empleados_empleadoId','=','empleados.empleadoId')
                ->join('personas','empleados.personas_dni','=','personas.dni')
                ->whereyear('recepcion_fondos.fecha','=',$anio)                
                ->select('empleados.personas_dni','personas.paterno','personas.materno','personas.nombre',
                        'sucursales.sucursal','recepcion_fondos.monto','recepcion_fondos.fecha','recepcion_fondos.id'
                        ,'recepcion_fondos.estado')                
                ->get();
        else 
        return DB::table('recepcion_fondos')
                ->join('distribucions','recepcion_fondos.distribucions_id','=','distribucions.id')
                ->join('sucursales','distribucions.sucursales_sucursalId','=','sucursales.sucursalId')                
                ->join('empleados','distribucions.tecnicos_empleados_empleadoId','=','empleados.empleadoId')
                ->join('personas','empleados.personas_dni','=','personas.dni')
                ->whereyear('recepcion_fondos.fecha','=',$anio)
                ->wheremonth('recepcion_fondos.fecha','=',$mes)
                ->select('empleados.personas_dni','personas.paterno','personas.materno','personas.nombre',
                        'sucursales.sucursal','recepcion_fondos.monto','recepcion_fondos.fecha','recepcion_fondos.id'
                        ,'recepcion_fondos.estado')                
                ->get();
    }
    
    public static function ExportingExcelPdf($anio,$mes){
        return DB::table('recepcion_fondos')
                ->join('distribucions','recepcion_fondos.distribucions_id','=','distribucions.id')
                ->join('sucursales','distribucions.sucursales_sucursalId','=','sucursales.sucursalId')
                ->join('comites_locales','sucursales.comites_locales_id','=','comites_locales.id')
                ->join('empleados','sucursales.empleados_empleadoId','=','empleados.empleadoId')
                ->join('personas','empleados.personas_dni','=','personas.dni')
                ->whereyear('recepcion_fondos.fecha','=',$anio)
                ->wheremonth('recepcion_fondos.fecha','=',$mes)
                ->select('personas.nombre','personas.paterno','personas.materno','comites_locales.comite_local','recepcion_fondos.fecha','sucursales.empleados_empleadoId')
                ->groupby('empleados.empleadoId')
                ->get();
    }
    
    public static function listapagosRec($idempleado,$anio,$mes){
        return DB::table('recepcion_fondos')
                ->join('distribucions','recepcion_fondos.distribucions_id','=','distribucions.id')
                ->join('sucursales','distribucions.sucursales_sucursalId','=','sucursales.sucursalId')
                ->where('sucursales.empleados_empleadoId','=',$idempleado)
                ->whereyear('recepcion_fondos.fecha','=',$anio)
                ->wheremonth('recepcion_fondos.fecha','=',$mes)
                ->select(DB::raw('date_format(distribucions.fecha,"%e") as fecha'),'recepcion_fondos.monto')
                ->get();
    }
    
    public static function montofechas($anio,$mes,$dia){
        if($dia==0){
            return DB::table('recepcion_fondos')
                ->whereyear('fecha','=',$anio)
                ->wheremonth('fecha','=',$mes)
                ->select(DB::raw('IFNULL(sum(monto),0) as monto')) ->first();
        } else{
            return DB::table('recepcion_fondos')
                ->whereyear('fecha','=',$anio)
                ->wheremonth('fecha','=',$mes)
                ->whereday('fecha','=',$dia)
                ->select(DB::raw('IFNULL(sum(monto),0) as monto')) ->first();
        }
        
    }
}
