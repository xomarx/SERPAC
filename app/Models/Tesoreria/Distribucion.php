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
    public function sucursal(){
        return $this->hasOne(\App\Models\RRHH\Sucursal::class);
    }

    public static function scopelistaDistribucion($query,$anio,$mes,$dato=''){
            if($anio == 0)
            return $query
                    ->join('sucursales', 'distribucions.sucursales_sucursalId', '=', 'sucursales.sucursalId')
                    ->join('empleados', 'distribucions.tecnicos_empleados_empleadoId', '=', 'empleados.empleadoId')
                    ->join('personas', 'empleados.personas_dni', '=', 'personas.dni')
                    ->join('users', 'distribucions.users_id', '=', 'users.id')
                    ->where(function($query)use($dato){
                        $query->where('personas_dni','like','%'.$dato.'%')
                            ->orwhere('sucursal', 'like', '%' . $dato . '%')
                            ->orwhere('monto', 'like', '%' . $dato . '%')
                            ->orwhere('fecha', 'like', '%' . $dato . '%')
                            ->orwhere('name', 'like', '%' . $dato . '%')
                            ->orwhere(DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%');
                    })
                    ->select('monto','sucursal','paterno','materno','nombre','personas_dni','fecha','name','distribucions.id')
                    ->orderby('fecha', 'desc')
                    ->paginate(8);
        else if ($mes == 0)
            return $query->whereyear('fecha','=',$anio)
                    ->join('sucursales', 'distribucions.sucursales_sucursalId', '=', 'sucursales.sucursalId')
                    ->join('empleados', 'distribucions.tecnicos_empleados_empleadoId', '=', 'empleados.empleadoId')
                    ->join('personas', 'empleados.personas_dni', '=', 'personas.dni')
                    ->join('users', 'distribucions.users_id', '=', 'users.id')
                    ->where(function($query)use($dato){
                        $query->where('personas_dni','like','%'.$dato.'%')
                            ->orwhere('sucursal', 'like', '%' . $dato . '%')
                            ->orwhere('monto', 'like', '%' . $dato . '%')
                            ->orwhere('fecha', 'like', '%' . $dato . '%')
                            ->orwhere('name', 'like', '%' . $dato . '%')
                            ->orwhere(DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%');
                    })
                    ->select('monto','sucursal','paterno','materno','nombre','personas_dni','fecha','name','distribucions.id')
                    ->orderby('fecha', 'desc')
                    ->paginate(8);
        else
            return $query->whereyear('fecha','=',$anio)->wheremonth('fecha', '=', $mes)
                    ->join('sucursales', 'distribucions.sucursales_sucursalId', '=', 'sucursales.sucursalId')
                    ->join('empleados', 'distribucions.tecnicos_empleados_empleadoId', '=', 'empleados.empleadoId')
                    ->join('personas', 'empleados.personas_dni', '=', 'personas.dni')
                    ->join('users', 'distribucions.users_id', '=', 'users.id')
                    ->where(function($query)use($dato){
                        $query->where('personas_dni','like','%'.$dato.'%')
                            ->orwhere('sucursal', 'like', '%' . $dato . '%')
                            ->orwhere('monto', 'like', '%' . $dato . '%')
                            ->orwhere('fecha', 'like', '%' . $dato . '%')
                            ->orwhere('name', 'like', '%' . $dato . '%')
                            ->orwhere(DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%');
                    })
                    ->select('monto','sucursal','paterno','materno','nombre','personas_dni','fecha','name','distribucions.id')
                    ->orderby('fecha', 'desc')
                    ->paginate(8);
            
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
    
    public static function getDistribucion(){
        return DB::table('distribucions')
                ->select(DB::raw('max(id) as id'))->first();
    }
            
}
