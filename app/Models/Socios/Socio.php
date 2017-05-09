<?php

namespace App\Models\Socios;

use Illuminate\Database\Eloquent\Model;
use App\Models\Persona;
use Illuminate\Support\Facades\DB;

class Socio extends Model
{
    //    
    protected  $fillable = [
        'codigo','fec_asociado','fec_empadron','','estado_civil',
        'ocupacion','grado_inst','produccion','estado','observacion'
        ,'persona_dni','users_id'];    
    
    /**
     * Obtener el registro de persona asociado con el socio
     */
    public function persona()
    {
        return $this->hasOne(Persona::class);
    }
    
    public function compras()
    {
        return $this->hasMany(\App\Models\Acopio\Compra::class);
    }
    public function users()
    {
        return $this->belongsTo(\App\User::class);
    }
    public function parientes()
    {
        return $this ->hasMany(Pariente::class);
    }
    
    public function fundos()
    {
        return $this->hasMany(Fundo::class);
    }
    
    public function transferencias()
    {
        return $this->hasMany(Transferencia::class);
    }
    
    public function condicions(){
        return $this->belongsToMany(\App\Models\Certificacion\Condicion::class);
    }

    // socios
    public static function scopelistasocios($query,$dato='')
    {
       return  $socio = $query
                ->join('personas','socios.dni','=','personas.dni')
                ->join('comites_locales','personas.comites_locales_id','=','comites_locales.id')
                ->join('comites_centrales','comites_locales.comites_centrales_id','=','comites_centrales.id')
               ->join('users','socios.users_id','=','users.id')
               ->where(function($query)use($dato){
                   $query->where('socios.codigo','like','%'.$dato.'%')
                         ->orwhere(DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"), 'like', '%' . $dato . '%')
                         ->orwhere('socios.dni', 'like', '%' . $dato . '%')
                           ->orwhere('comite_local', 'like', '%' . $dato . '%')
                           ->orwhere('comite_central', 'like', '%' . $dato . '%')
                           ->orwhere('fec_asociado', 'like', '%' . $dato . '%')
                           ->orwhere('socios.estado', 'like', '%' . $dato . '%')
                           ->orwhere('name', 'like', '%' . $dato . '%');
               })
                ->select('socios.codigo','personas.paterno','personas.dni','personas.materno','personas.nombre'
                        ,'socios.fec_asociado','comites_locales.comite_local','comites_centrales.comite_central','users.name','socios.estado')
                       ->orderby('codigo','asc')
                ->paginate(10);
    }
    
    
    //´para editar
    public static function DNISocioautocomplete($dni)
    {
      return DB::table('socios')
                ->join('personas','socios.dni','=','personas.dni')
                ->join('comites_locales','personas.comites_locales_id','=','comites_locales.id')
              ->where ('socios.dni','like','%'.$dni.'%')
              ->select('socios.codigo',DB::raw("CONCAT(personas.paterno,' ',personas.materno,' ',personas.nombre)  AS fullname")
                      ,'comites_locales.comite_local','socios.dni')
              ->take(7)->get();
    }
    
    public static function CodigoSocioautocomplete($codigo)
    {
      return  DB::table('socios')
                ->join('personas','socios.dni','=','personas.dni')
                ->join('comites_locales','personas.comites_locales_id','=','comites_locales.id')
              ->where ('socios.codigo','like','%'.$codigo.'%')
              ->select('socios.codigo',DB::raw("CONCAT(personas.paterno,' ',personas.materno,' ',personas.nombre)  AS fullname")
                      ,'comites_locales.comite_local','socios.dni')
              ->take(7)->get();
    }
    
    public static function Socioautocomplete($nombres)
    {
      return DB::table('socios')
                ->join('personas','socios.dni','=','personas.dni')
                ->join('comites_locales','personas.comites_locales_id','=','comites_locales.id')
              ->where (DB::raw("CONCAT(personas.paterno,' ',personas.materno,' ',personas.nombre)"),'like','%'.$nombres.'%')
              ->select('socios.codigo',DB::raw("CONCAT(personas.paterno,' ',personas.materno,' ',personas.nombre)  AS fullname")
                      ,'comites_locales.comite_local','socios.dni')
              ->take(7)->get();
    }
    
    
    
    
    
    public static function  getSocio($codigo)
    {
        $socio = DB::table('socios')
                ->join('personas','socios.dni','=','personas.dni')
                ->join('comites_locales','personas.comites_locales_id','=','comites_locales.id')
                ->join('comites_centrales','comites_locales.comites_centrales_id','=','comites_centrales.id')
                ->join('distritos','comites_centrales.distritos_id','=','distritos.id')
                ->join('provincias','distritos.provincias_id','=','provincias.id')
                ->join('departamentos','provincias.departamentos_id','=','departamentos.id')
                ->where('socios.codigo','=',$codigo)
                ->select('socios.codigo','socios.fec_asociado','socios.fec_empadron','socios.estado_civil','socios.ocupacion',
                        'socios.grado_inst','socios.produccion','socios.estado','socios.observacion','socios.dni',
                        'personas.paterno','personas.materno','personas.nombre','personas.fec_nac','personas.sexo','personas.direccion',
                        'personas.telefono','personas.comites_locales_id',
                        'comites_locales.comite_local','comites_locales.comites_centrales_id',
                        'comites_centrales.comite_central','comites_centrales.distritos_id'
                        ,'distritos.distrito','distritos.provincias_id'
                        ,'provincias.provincia','provincias.departamentos_id'
                        ,'departamentos.departamento')                        
                ->first(); 
        return $socio;
    }
    
    
       
    public static function getsocioTransferencia($codigo)
    {
        return DB::table('socios')
                ->join('personas','socios.dni','=','personas.dni')
                ->join('comites_locales','personas.comites_locales_id','=','comites_locales.id')                                                
                ->join('comites_centrales','comites_locales.comites_centrales_id','=','comites_centrales.id')                
                ->where ('socios.codigo','=',$codigo)
                ->select('socios.dni','personas.paterno','personas.materno','personas.nombre','personas.fec_nac',
                        'comites_locales.comite_local','comites_centrales.comite_central'
                       )                        
                 ->first(); 
    }
    
    public static function PersonasSociosAuto($nombre){
        return DB::table('personas')
                ->leftjoin('empleados','personas.dni','=','empleados.empleadoId')
                ->where('empleados.empleadoId')
                ->where(DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre)"),'like','%'.$nombre.'%')
                ->select('personas.dni',  DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre) as socio"))
                ->take(5)->get();
    }
    
    public static function PersonasSociosDniAuto($dni){
        return DB::table('personas')
                ->leftjoin('empleados','personas.dni','=','empleados.empleadoId')
                ->where('empleados.empleadoId')
                ->where('personas.dni','like','%'.$dni.'%')
                ->select('personas.dni',  DB::raw("concat(personas.paterno,' ',personas.materno,' ',personas.nombre) as socio"))
                ->take(5)->get();
    }
    
    public static function getcontActivos($anio,$mes,$estado,$day){
        if($mes==0){
            return  \App\Models\Socios\Socio::select(\Illuminate\Support\Facades\DB::raw('IFNULL(count(fec_asociado),0) as cont'))
                    ->orderby('fec_asociado','asc')
                    ->where('estado','=',$estado)
                    ->whereyear('fec_asociado','=',$anio)
                    ->first();
        }
        else if($day == 0){
            return  \App\Models\Socios\Socio::select(\Illuminate\Support\Facades\DB::raw('IFNULL(count(fec_asociado),0) as cont'))
                    ->orderby('fec_asociado','asc')
                    ->where('estado','=',$estado)
                    ->whereyear('fec_asociado','=',$anio)
                    ->wheremonth('fec_asociado','=',$mes)
                    ->first();
        }
        else{
            return  \App\Models\Socios\Socio::select(\Illuminate\Support\Facades\DB::raw('IFNULL(count(fec_asociado),0) as cont'))
                    ->orderby('fec_asociado','asc')
                    ->where('estado','=',$estado)
                    ->whereyear('fec_asociado','=',$anio)
                    ->wheremonth('fec_asociado','=',$mes)
                    ->whereday('fec_asociado','=',$day)
                    ->first();
        }
            
    }
    
}
