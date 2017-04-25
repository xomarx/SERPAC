<?php

namespace App\Models\Acopio;

use Illuminate\Database\Eloquent\Model;

class Planilla extends Model
{
    //
    protected $table = 'planillas';
    protected $primarykey = 'id';
    public  $timestamps=false;
    protected  $fillable = [
        'numero','fecha','users_id'
        ];
    
        public function compras(){
            return $this->belongsToMany( Compra::class, 'compras_id');
        }
        
        public static function listaPlanilla(){
            return \Illuminate\Support\Facades\DB::table('planillas')
                    ->join('compras_has_planillas','planillas.id','=','compras_has_planillas.planillas_id')
                    ->join('compras','compras_has_planillas.compras_id','=','compras.id')
                    ->join('sucursales','compras.sucursales_sucursalId','=','sucursales.sucursalId')
                    ->join('users','planillas.users_id','=','users.id')
                    ->where('compras.estado','=','CANCELADO')
                    ->groupby('compras_has_planillas.planillas_id')
                    ->select('planillas.fecha','planillas.numero','sucursales.sucursalId','sucursales.sucursal','users.name','planillas.id')
                    ->paginate(10);
        }
        
        public static function scopePlanillaSemanal($query,$idplanilla){
            setlocale(LC_TIME, 'spanish');
            return $query
                    ->where('planillas.id','=',$idplanilla)
                    ->join('compras_has_planillas','planillas.id','=','planillas_id')
                    ->join('compras','compras_id','=','compras.id')
                    ->join('condicions','compras.condicions_id','=','condicions.id')
                    ->join('sucursales','compras.sucursales_sucursalId','=','sucursales.sucursalId')
                    ->join('empleados','sucursales.empleados_empleadoId','=','empleados.empleadoId')
                    ->join('personas','empleados.personas_dni','=','personas.dni')
                    ->join('comites_locales','sucursales.comites_locales_id','=','comites_locales.id')
                    ->join('tecnicos','comites_locales.id','=','tecnicos.comites_locales_id')
                    ->join('empleados as em','tecnicos.empleados_empleadoId','=','em.empleadoId')
                    ->join('personas as per','em.personas_dni','=','per.dni')
                    ->select('planillas.fecha','numero','sucursales_sucursalId','condicions.condicion',
                    \Illuminate\Support\Facades\DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre) as tecnico"),
                    \Illuminate\Support\Facades\DB::raw("concat(per.paterno,' ',per.materno,' ',per.nombre) as acopiador"),'condicion',
                            'compras.kilos')->first();           
//            whereRaw("DATE_FORMAT(date,'%Y-%m-%d')
        }
        public static function Planillacompra($idplanilla){
            return \Illuminate\Support\Facades\DB::table('compras_has_planillas')
                    ->join('compras','compras_id','=','id')
                    ->leftjoin('socios','socios_codigo','=','codigo')
                    ->leftjoin('personas','socios.dni','=','personas.dni')
                    ->leftjoin('nosocios','nosocios_dni','=','nosocios.dni')
                    ->where('planillas_id','=',$idplanilla)
                    ->select('fecha','kilos','precio','total','tipocacao','socios_codigo',  \Illuminate\Support\Facades\DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre) as socio")
                            ,  \Illuminate\Support\Facades\DB::raw("concat(nosocios.paterno,' ',nosocios.materno,' ',nosocios.nombres) as nosocio"),'nosocios.dni')->get();
        }
}
