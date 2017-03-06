<?php

namespace App\Models\RRHH;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\RRHH\Areas;

class Sucursal extends Model
{
    //
    protected  $table = 'sucursales';
    protected  $primarykey = 'sucursalId';
    public  $timestamps=false;
    protected  $fillable = ['sucursalId','sucursal','telefono','fax','direccion',
        'areas_id','comites_locales_id','users_id','empleados_empleadoId'];
    
    public function comites_local()
    {
        return $this->belongsTo(\App\Models\Socios\Comites_Locale::class);
    }
    
    public function area()
    {
        return $this->belongsTo(Areas::class);
    }
    
    public function egresos()
    {
        return $this->hasMany(Egreso::class);
    }
    
    public static  function listaSucursales()
    {
        return DB::table('sucursales')
                ->join('areas','sucursales.areas_id','=','areas.id')
                ->join('comites_locales','sucursales.comites_locales_id','=','comites_locales.id')
                ->join('comites_centrales','comites_locales.comites_centrales_id','=','comites_centrales.id')
                ->join('distritos','comites_centrales.distritos_id','=','distritos.id')
                ->join('provincias','distritos.provincias_id','=','provincias.id')
                ->join('empleados','sucursales.empleados_empleadoId','=','empleados.empleadoId')
                ->join('personas','empleados.personas_dni','=','personas.dni')
                ->select('sucursales.sucursal','sucursales.telefono','areas.area',
                        'comites_locales.comite_local','comites_centrales.comite_central',
                        'distritos.distrito','provincias.provincia','sucursales.sucursalId'
                        ,DB::raw("concat(personas.nombre,' ',personas.paterno,' ',personas.materno) as acopiador"))
                ->get();
    }
    
    public static function sucursal($sucursalId)
    {
        return DB::table('sucursales')
                ->join('areas','sucursales.areas_id','=','areas.id')
                ->join('comites_locales','sucursales.comites_locales_id','=','comites_locales.id')
                ->join('comites_centrales','comites_locales.comites_centrales_id','=','comites_centrales.id')
                ->join('distritos','comites_centrales.distritos_id','=','distritos.id')
                ->join('provincias','distritos.provincias_id','=','provincias.id')   
                ->join('departamentos','provincias.departamentos_id','=','departamentos.id')
                ->join('empleados','sucursales.empleados_empleadoId','=','empleados.empleadoId')
                ->join('personas','empleados.personas_dni','=','personas.dni')
                ->where('sucursales.sucursalId','=',$sucursalId)
                ->select('sucursales.sucursal','sucursales.telefono','areas.area','sucursales.fax','sucursales.areas_id',
                        'comites_locales.comite_local','comites_centrales.comite_central','sucursales.direccion',
                        'distritos.distrito','provincias.provincia','sucursales.sucursalId','provincias.departamentos_id','sucursales.comites_locales_id'
                        ,'comites_locales.comites_centrales_id','comites_centrales.distritos_id','distritos.provincias_id','sucursales.empleados_empleadoId'
                        ,DB::raw("concat(personas.nombre,' ',personas.paterno,' ',personas.materno) as acopiador"))
                ->first();
    }
        
    
}
