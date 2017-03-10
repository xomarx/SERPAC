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
        'monto','fecha','tecnicos_empleados_empleadoId','sucursales_sucursalId','estado','motivo','users_id'
    ];

    public function recepcion_fondo()
    {
        return $this->hasOne(\App\Models\Acopio\Recepcion_fondo::class);
    }

        public static function listaDistribucion()
    {
        return DB::table('distribucions')
                ->join('sucursales','distribucions.sucursales_sucursalId','=','sucursales.sucursalId')                
                ->join('empleados','distribucions.tecnicos_empleados_empleadoId','=','empleados.empleadoId')
                ->join('personas','empleados.personas_dni','=','personas.dni')
                ->join('users','distribucions.users_id','=','users.id')
                ->where('distribucions.estado','=','Entregado')
                ->select('empleados.personas_dni','personas.paterno','personas.materno','personas.nombre',
                        'sucursales.sucursal','distribucions.monto','distribucions.fecha','distribucions.id','users.name')
                ->get();
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
    
    public static function getReciboAcopiador($iddistribcion){
        return \Illuminate\Support\Facades\DB::table('distribucions')
                ->join('sucursales','distribucions.sucursales_sucursalId','=','sucursales.sucursalId')                
                ->join('comites_locales','sucursales.comites_locales_id','=','comites_locales.id')
                ->join('empleados','sucursales.empleados_empleadoId','=','empleados.empleadoId')
                ->join('personas','empleados.personas_dni','=','personas.dni')
                ->where('distribucions.id','=',$iddistribcion)
                ->select('comites_locales.comite_local','sucursales.sucursal','personas.paterno','personas.materno','personas.nombre'
                        ,'personas.dni','distribucions.fecha','distribucions.monto')
                ->first();
    }
            
            
}
