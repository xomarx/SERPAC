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
    
    public static function scopeListDays($query,$anio,$mes,$acopiador){
//        return $acopiador;
        return $query
                ->whereyear('recepcion_fondos.fecha','=',$anio)
                ->wheremonth('recepcion_fondos.fecha','=',$mes)
                ->join('distribucions','distribucions_id','=','distribucions.id')
                ->join('sucursales','sucursales_sucursalId','=','sucursalId')
                ->where('empleados_empleadoId','=',$acopiador)
                ->select(DB::raw('day(recepcion_fondos.fecha) as dia'))
                ->groupby(DB::raw(DB::raw('day(recepcion_fondos.fecha)')))
                ->get();
    }

    public static function scopeListAcopiadores($query,$anio,$mes,$dato){
        return DB::table('recepcion_fondos')
                ->whereyear('recepcion_fondos.fecha','=',$anio)
                ->wheremonth('recepcion_fondos.fecha','=',$mes)
                ->join('distribucions','recepcion_fondos.distribucions_id','=','distribucions.id')
                ->join('empleados','distribucions.tecnicos_empleados_empleadoId','=','empleados.empleadoId')
                ->join('personas','empleados.personas_dni','=','personas.dni')
                ->join('sucursales','distribucions.sucursales_sucursalId','=','sucursales.sucursalId')
                ->join('comites_locales','sucursales.comites_locales_id','=','comites_locales.id')
                ->join('empleados as emp','sucursales.empleados_empleadoId','=','emp.empleadoId')                
                ->join('personas as per','emp.personas_dni','=','per.dni')
                ->where(function($query)use($dato){
                        $query->where('empleados.personas_dni','like','%'.$dato.'%')
                            ->orwhere('sucursal', 'like', '%' . $dato . '%')
                            ->orwhere('recepcion_fondos.monto', 'like', '%' . $dato . '%')
                            ->orwhere('recepcion_fondos.fecha', 'like', '%' . $dato . '%')                            
                            ->orwhere('recepcion_fondos.estado', 'like', '%' . $dato . '%')                            
                            ->orwhere(DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%');
                    })
                ->select('emp.empleadoId','per.paterno','per.materno','per.nombre','comite_local')
                ->groupby('emp.empleadoId')
                ->orderby('emp.empleadoId')
                ->get();
    }

    public static function scopeListRecepMoney($query,$anio,$mes,$dato=''){
        if($anio == 0)
        return $query
                ->join('distribucions','distribucions_id','=','distribucions.id')
                ->join('sucursales','distribucions.sucursales_sucursalId','=','sucursales.sucursalId')
                ->join('comites_locales','sucursales.comites_locales_id','=','comites_locales.id')
                ->join('empleados','distribucions.tecnicos_empleados_empleadoId','=','empleados.empleadoId')
                ->join('personas','empleados.personas_dni','=','personas.dni')
                ->where(function($query)use($dato){
                        $query->where('personas_dni','like','%'.$dato.'%')
                            ->orwhere('sucursal', 'like', '%' . $dato . '%')
                            ->orwhere('recepcion_fondos.monto', 'like', '%' . $dato . '%')
                            ->orwhere('recepcion_fondos.fecha', 'like', '%' . $dato . '%')                            
                            ->orwhere('recepcion_fondos.estado', 'like', '%' . $dato . '%')                            
                            ->orwhere(DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%');
                    })
                ->select('empleados.personas_dni','personas.paterno','personas.materno','personas.nombre',
                        'sucursales.sucursal','recepcion_fondos.monto','recepcion_fondos.fecha','recepcion_fondos.id'
                        ,'recepcion_fondos.estado','comite_local')
                ->orderby('recepcion_fondos.fecha','desc')
                ->paginate(10);
        else if($mes==0)
            return $query
                ->join('distribucions','recepcion_fondos.distribucions_id','=','distribucions.id')
                ->join('sucursales','distribucions.sucursales_sucursalId','=','sucursales.sucursalId')
                ->join('comites_locales','sucursales.comites_locales_id','=','comites_locales.id')
                ->join('empleados','distribucions.tecnicos_empleados_empleadoId','=','empleados.empleadoId')
                ->join('personas','empleados.personas_dni','=','personas.dni')
                ->whereyear('recepcion_fondos.fecha','=',$anio)
                ->where(function($query)use($dato){
                        $query->where('personas_dni','like','%'.$dato.'%')
                            ->orwhere('sucursal', 'like', '%' . $dato . '%')
                            ->orwhere('recepcion_fondos.monto', 'like', '%' . $dato . '%')
                            ->orwhere('recepcion_fondos.fecha', 'like', '%' . $dato . '%')                            
                            ->orwhere('recepcion_fondos.estado', 'like', '%' . $dato . '%')                            
                            ->orwhere(DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%');
                    })
                ->select('empleados.personas_dni','personas.paterno','personas.materno','personas.nombre',
                        'sucursales.sucursal','recepcion_fondos.monto','recepcion_fondos.fecha','recepcion_fondos.id'
                        ,'recepcion_fondos.estado','comite_local')                
                ->orderby('recepcion_fondos.fecha','desc')
                ->paginate(10);
        else
            return $query
                ->join('distribucions','recepcion_fondos.distribucions_id','=','distribucions.id')
                ->join('sucursales','distribucions.sucursales_sucursalId','=','sucursales.sucursalId')
                ->join('comites_locales','sucursales.comites_locales_id','=','comites_locales.id')
                ->join('empleados','distribucions.tecnicos_empleados_empleadoId','=','empleados.empleadoId')
                ->join('personas','empleados.personas_dni','=','personas.dni')
                ->whereyear('recepcion_fondos.fecha','=',$anio)
                ->wheremonth('recepcion_fondos.fecha','=',$mes)
                ->where(function($query)use($dato){
                        $query->where('personas_dni','like','%'.$dato.'%')
                            ->orwhere('sucursal', 'like', '%' . $dato . '%')
                            ->orwhere('recepcion_fondos.monto', 'like', '%' . $dato . '%')
                            ->orwhere('recepcion_fondos.fecha', 'like', '%' . $dato . '%')                            
                            ->orwhere('recepcion_fondos.estado', 'like', '%' . $dato . '%')                            
                            ->orwhere(DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%');
                    })
                ->select('empleados.personas_dni','personas.paterno','personas.materno','personas.nombre',
                        'sucursales.sucursal','recepcion_fondos.monto','recepcion_fondos.fecha','recepcion_fondos.id'
                        ,'recepcion_fondos.estado','comite_local')                
                ->orderby('recepcion_fondos.fecha','desc')
                ->paginate(10);
    }
        
    public static function ListMonth($anio,$mes,$dato=''){
//        return $mes;
        if($mes==0)
        return DB::table('recepcion_fondos')
                ->whereyear('recepcion_fondos.fecha','=',$anio)                
                ->join('distribucions','recepcion_fondos.distribucions_id','=','distribucions.id')
                ->join('sucursales','distribucions.sucursales_sucursalId','=','sucursales.sucursalId')
                ->join('comites_locales','sucursales.comites_locales_id','=','comites_locales.id')
                ->join('empleados','distribucions.tecnicos_empleados_empleadoId','=','empleados.empleadoId')
                ->join('personas','empleados.personas_dni','=','personas.dni')                
                ->where(function($query)use($dato){
                        $query->where('personas_dni','like','%'.$dato.'%')
                            ->orwhere('sucursal', 'like', '%' . $dato . '%')
                            ->orwhere('recepcion_fondos.monto', 'like', '%' . $dato . '%')
                            ->orwhere('recepcion_fondos.fecha', 'like', '%' . $dato . '%')                            
                            ->orwhere('recepcion_fondos.estado', 'like', '%' . $dato . '%')                            
                            ->orwhere(DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%');
                    })
                ->select(DB::raw('month(recepcion_fondos.fecha) as mes'))
                ->orderby(DB::raw('month(recepcion_fondos.fecha)'),'asc')
                ->groupby(DB::raw('month(recepcion_fondos.fecha)'))
                ->get();
        else 
            return DB::table('recepcion_fondos')
                ->whereyear('recepcion_fondos.fecha','=',$anio)
                ->wheremonth('recepcion_fondos.fecha','=',$mes)
                ->join('distribucions','recepcion_fondos.distribucions_id','=','distribucions.id')
                ->join('sucursales','distribucions.sucursales_sucursalId','=','sucursales.sucursalId')
                ->join('comites_locales','sucursales.comites_locales_id','=','comites_locales.id')
                ->join('empleados','distribucions.tecnicos_empleados_empleadoId','=','empleados.empleadoId')
                ->join('personas','empleados.personas_dni','=','personas.dni')                
                ->where(function($query)use($dato){
                        $query->where('personas_dni','like','%'.$dato.'%')
                            ->orwhere('sucursal', 'like', '%' . $dato . '%')
                            ->orwhere('recepcion_fondos.monto', 'like', '%' . $dato . '%')
                            ->orwhere('recepcion_fondos.fecha', 'like', '%' . $dato . '%')                            
                            ->orwhere('recepcion_fondos.estado', 'like', '%' . $dato . '%')                            
                            ->orwhere(DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%');
                    })
                ->select(DB::raw('month(recepcion_fondos.fecha) as mes'))
                ->orderby(DB::raw('month(recepcion_fondos.fecha)'),'asc')
                ->groupby(DB::raw('month(recepcion_fondos.fecha)'))
                ->get();
                
    }
    
    public static function scopeExportingExcelPdf($query,$anio,$mes,$dia,$acopiador){
        
        return $query 
                ->whereyear('recepcion_fondos.fecha','=',$anio)
                ->wheremonth('recepcion_fondos.fecha','=',$mes)
                ->whereday('recepcion_fondos.fecha','=',$dia)
                ->join('distribucions','distribucions_id','=','distribucions.id')
                ->join('sucursales','sucursales_sucursalId','=','sucursalId')
                ->where('empleados_empleadoId','=',$acopiador)
                ->select(DB::raw('sum(distribucions.monto) as monto'))
                ->first();                              
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
