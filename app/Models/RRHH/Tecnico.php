<?php

namespace App\Models\RRHH;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tecnico extends Model
{
    //
     protected  $table = 'tecnicos';
    protected  $primarykey = 'comites_locales_id';    
    public  $timestamps=false;
    protected  $fillable = ['comites_locales_id','empleados_empleadoId'];    
    
    public static function listaTecnicos() {
        return DB::table('tecnicos')
                ->join('empleados','tecnicos.empleados_empleadoId','=','empleados.empleadoId')
                ->join('personas','empleados.personas_dni','=','personas.dni')
                ->join('cargos','empleados.cargos_id','=','cargos.id')
                ->join('areas','empleados.areas_id','=','areas.id')
                ->select('tecnicos.empleados_empleadoId','empleados.personas_dni','personas.paterno','personas.materno','personas.nombre'
                        ,'cargos.cargo','areas.area')
                ->groupBy('tecnicos.empleados_empleadoId')
                ->get();
    }
    
    public static function tecnicos()
    {
//        DB::Persona("concat('paterno',' ' ,'materno ') as tecnico")->where('dni','=','');
        return DB::table('empleados')
                ->join('personas','empleados.personas_dni','=','personas.dni')
                ->where('empleados.estado','=','ACTIVO')                
                ->pluck( DB::raw("CONCAT(personas.paterno,' ',personas.materno,' ',personas.nombre)  AS fullname")   ,'empleados.empleadoId');
    }
        
}




