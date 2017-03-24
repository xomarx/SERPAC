<?php

namespace App\Models\RRHH;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Empleado extends Model
{
    //
     protected  $table = 'empleados';
    protected  $primarykey = 'empleadoId';
    public  $timestamps=false;
    protected  $fillable = ['empleadoId','estado','estadocivil','email','profesion','ruc',
        'personas_dni','cargos_id','areas_id'];
    
    public function persona()
    {
        return $this ->hasOne(\App\Models\Persona::class);
    }
    
    public static  function listaEmpleado() {
        return DB::table('empleados')
                ->join('personas','empleados.personas_dni','=','personas.dni')
                ->join('cargos','empleados.cargos_id','=','cargos.id')
                ->join('areas','empleados.areas_id','=','areas.id')
                ->select('empleados.empleadoId','empleados.estado','personas.paterno','personas.materno',
                        'personas.nombre','cargos.cargo','areas.area','empleados.personas_dni')
                ->get();
    }
    
    public static function empleado($id) {
        return DB::table('empleados')
                ->join('personas','empleados.personas_dni','=','personas.dni')
                ->join('cargos','empleados.cargos_id','=','cargos.id')
                ->join('areas','empleados.areas_id','=','areas.id')
                ->join('comites_locales','personas.comites_locales_id','=','comites_locales.id')
                ->join('comites_centrales','comites_locales.comites_centrales_id','=','comites_centrales.id')
                ->join('distritos','comites_centrales.distritos_id','=','distritos.id')
                ->join('provincias','distritos.provincias_id','=','provincias.id')
                ->join('departamentos','provincias.departamentos_id','=','departamentos.id')
                ->where('empleados.empleadoId','=',$id)
                ->select('empleados.empleadoId','empleados.estado','empleados.personas_dni','empleados.estadocivil',
                        'empleados.email','empleados.profesion','empleados.ruc','empleados.cargos_id','empleados.areas_id',
                        'personas.paterno','personas.materno','personas.nombre','personas.fec_nac','personas.sexo','personas.direccion',
                        'personas.telefono','personas.comites_locales_id',
                        'comites_locales.comite_local','comites_centrales.comite_central','distritos.distrito','provincias.provincia',
                        'comites_centrales.comite_central','comites_locales.comite_local','distritos.distrito','provincias.provincia',
                        'comites_locales.comites_centrales_id','comites_centrales.distritos_id','distritos.provincias_id','provincias.departamentos_id',
                        'cargos.cargo','areas.area','departamentos.departamento')
                ->first();
    }
    
    public static function listaEmplUser(){
        return DB::table('empleados')
                ->leftJoin('users','empleados.empleadoId','=','users.empleados_empleadoId')
                ->join('personas','empleados.personas_dni','=','personas.dni')
                ->where('users.id')
//                ->where(DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"),'like','%'.$nombre.'%')
                ->select(DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre) as empleados"),'empleados.empleadoId')
                ->get();
    }
    
    public static function autocompleteDatos($nombre){
        return DB::table('empleados')
                ->join('personas','empleados.personas_dni','=','personas.dni')
                ->where(DB::raw("CONCAT(personas.paterno,' ',personas.materno,' ',personas.nombre)"),'like','%'.$nombre.'%')
                ->select('personas.dni',DB::raw("CONCAT(personas.paterno,' ',personas.materno,' ',personas.nombre) as empleado"),'personas.dni')
                ->take(5)->get();
    }
}
