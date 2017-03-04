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
        'distribucions_id'];    
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
}
