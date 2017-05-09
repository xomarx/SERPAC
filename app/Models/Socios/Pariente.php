<?php

namespace App\Models\Socios;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pariente extends Model
{
    //
//    protected $table = 'parientes';
//    protected $primarykey = 'id'; 
    public  $timestamps=true;
    protected  $fillable = [
        'grado_inst','socios_codigo','personas_dni','users_id','beneficiario',
        'estado_civil','tipo_pariente'];    
    
    /**
     * Obtener el registro de persona asociado con el socio
     */
    public function persona()
    {
        return $this->hasOne(\App\Models\Persona::class);
    }
    
    public function socio()
    {
        return $this ->belongsTo(Socio::class);
    }
    
    public static function scopelistaParientes($query,$dato='')
    {
        return  $query
                ->join('personas','parientes.personas_dni','=','personas.dni')
                ->join('comites_locales','personas.comites_locales_id','=','comites_locales.id')
                ->join('comites_centrales','comites_locales.comites_centrales_id','=','comites_centrales.id')
                ->join('users','parientes.users_id','=','users.id')
                ->where(function($query)use($dato){
                    $query->where('socios_codigo','like','%'.$dato.'%')
                          ->orwhere('dni','like','%'.$dato.'%')
                            ->orwhere('estado_civil','like','%'.$dato.'%')
                            ->orwhere('direccion','like','%'.$dato.'%')
                            ->orwhere('comite_central','like','%'.$dato.'%')
                            ->orwhere('comite_local','like','%'.$dato.'%')
                            ->orwhere('name','like','%'.$dato.'%')
                            ->orwhere('tipo_pariente','like','%'.$dato.'%')
                            ->orwhere(DB::raw("concat(paterno, ' ',materno,' ',nombre)"),'like','%'.$dato.'%');
                })
                ->select('parientes.socios_codigo','personas.dni','personas.paterno','personas.materno','personas.nombre'
                        ,'parientes.estado_civil','personas.direccion'
                        ,'comites_centrales.comite_central','comites_locales.comite_local','users.name','tipo_pariente')
                ->paginate(10);
    }
    public static  function getparientesSocio($idsocio)
    {
        return  DB::table('parientes')
                ->join('personas','parientes.personas_dni','=','personas.dni')
                ->join('comites_locales','personas.comites_locales_id','=','comites_locales.id')
                ->join('comites_centrales','comites_locales.comites_centrales_id','=','comites_centrales.id')
                ->join('distritos','comites_centrales.distritos_id','=','distritos.id')
                ->join('provincias','distritos.provincias_id','=','provincias.id')
                ->join('departamentos','provincias.departamentos_id','=','departamentos.id')
                ->where('parientes.socios_codigo','=',$idsocio)
                ->select('parientes.socios_codigo','personas.dni','personas.paterno','personas.materno','personas.nombre'
                        ,'parientes.estado_civil','personas.direccion','personas.fec_nac','parientes.grado_inst','parientes.tipo_pariente'
                        ,'distritos.distrito','provincias.provincia','departamentos.departamento'
                        ,'comites_centrales.comite_central','comites_locales.comite_local')
                ->get();
    }
    
    public static function getpariente($idsocio,$dnipariente)
    {
        return DB::table('parientes')
                ->join('personas','parientes.personas_dni','=','personas.dni')
                ->join('comites_locales','personas.comites_locales_id','=','comites_locales.id')
                ->join('comites_centrales','comites_locales.comites_centrales_id','=','comites_centrales.id')
                ->join('distritos','comites_centrales.distritos_id','=','distritos.id')
                ->join('provincias','distritos.provincias_id','=','provincias.id')
                ->join('departamentos','provincias.departamentos_id','=','departamentos.id')
                ->where('parientes.socios_codigo','=',$idsocio)
                ->where('personas.dni','=',$dnipariente)
                ->select('parientes.socios_codigo','personas.dni','personas.paterno','personas.materno','personas.nombre'
                        ,'parientes.estado_civil','personas.direccion','personas.fec_nac','parientes.grado_inst','parientes.tipo_pariente'
                        ,'distritos.distrito','provincias.provincia','departamentos.departamento','parientes.beneficiario','parientes.id','provincias.departamentos_id'
                        ,'comites_centrales.comite_central','comites_locales.comite_local','personas.comites_locales_id','personas.sexo','personas.telefono')
                ->first();
    }
    
    public static function getbeneficiario($codigosocio)
    {
        return DB::table('parientes')
                ->join('personas','parientes.personas_dni','=','personas.dni')
                ->join('comites_locales','personas.comites_locales_id','=','comites_locales.id')
                ->join('comites_centrales','comites_locales.comites_centrales_id','=','comites_centrales.id')
                ->where('parientes.socios_codigo','=',$codigosocio)
                ->where('parientes.beneficiario','=',1)
                ->select('personas.dni','personas.paterno','personas.materno','personas.nombre'
                        ,'personas.fec_nac','parientes.tipo_pariente'                        
                        ,'comites_centrales.comite_central','comites_locales.comite_local')
                ->first();
    }
    
    public static function getDatosbeneficiario($dni)
    {
        return DB::table('parientes')
                ->join('personas','parientes.personas_dni','=','personas.dni')
                ->join('comites_locales','personas.comites_locales_id','=','comites_locales.id')
                ->join('comites_centrales','comites_locales.comites_centrales_id','=','comites_centrales.id')
                ->where('parientes.personas_dni','=',$dni)                
                ->select('personas.dni','personas.paterno','personas.materno','personas.nombre'
                        ,'personas.fec_nac','parientes.tipo_pariente'                        
                        ,'comites_centrales.comite_central','comites_locales.comite_local')
                ->first();
    }
}
