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
        'monto','fecha','tecnicos_empleados_empleadoId','sucursales_sucursalId','estado','motivo'
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
                ->where('distribucions.estado','=','ENTREGADO')
                ->select('empleados.personas_dni','personas.paterno','personas.materno','personas.nombre',
                        'sucursales.sucursal','distribucions.monto','distribucions.fecha','distribucions.id')
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
}