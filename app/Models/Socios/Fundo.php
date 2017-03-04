<?php

namespace App\Models\Socios;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Fundo extends Model
{
    //
    protected $table = 'fundos';
    protected $increments = 'id';    
    public  $timestamps=false;
    protected  $fillable  = [
        'fundo','codigo_socios','estadofundo','direccion','fecha','observaciones','users_id','comite_local_id'
        ,'estado'
        ]; 
    
        public function socio()
        {
          return  $this->belongsTo(Socio::class);
        }
        
        public function user()
        {
            return $this->belongsTo(\App\User::class);
        }
        public  function comite_local()
        {
            return $this->belongsTo(Comites_Locale::class);
        }
        
        public  function faunas()
        {
            return $this->belongsToMany(Fauna::class);
        }
    
        public static function getfundosSocio($idsocio)
        {
            return \Illuminate\Support\Facades\DB::table('fundos')
                    ->where('codigo_socios','=',$idsocio)
                    ->where('fundos.estado','=',1)
                    ->join('comites_locales','fundos.comite_local_id','=','comites_locales.id')
                    ->select('fundos.fundo','fundos.direccion','comites_locales.comite_local','fundos.estadofundo','fundos.fecha')
                    ->get();
        }
        
        public static function getDatosFundoTransferencia($codigosocio)
        {
            return \Illuminate\Support\Facades\DB::table('fundos')
                    ->join('fundos_has_floras','fundos.id','=','fundos_has_floras.fundos_id')
                    ->where('codigo_socios','=',$codigosocio)
                    ->where('fundos.estado','=',1)
                    ->groupBy('fundos.id')
                    ->select('fundos.fundo', \Illuminate\Support\Facades\DB::raw('SUM(fundos_has_floras.hectarea) as hectareas'))
                    ->get();
        }
        
        public static function getDatoFundo($codigo)
        {
            return \Illuminate\Support\Facades\DB::table('fundos_has_floras')
                    ->join('fundos','fundos_has_floras.fundos_id','=','fundos.id')
                    ->join('floras','fundos_has_floras.floras_id','=','floras.id')
                    ->where('fundos.codigo_socios','=',$codigo)
                    ->where('fundos.estado','=',1)
                    ->select('fundos.fundo','fundos_has_floras.hectarea','floras.flora')
                    ->get();
        }
        
        public static function listaFundo()
        {
            return DB::table('fundos')
                ->join('comites_locales','fundos.comite_local_id','=','comites_locales.id')
                -> join ('comites_centrales','comites_locales.comites_centrales_id','=','comites_centrales.id')
                ->join('fundos_has_floras','fundos.id','=','fundos_has_floras.fundos_id')
                ->where('estado','=',1)
                ->groupBy('fundos_has_floras.fundos_id')
                ->select('fundos.id','fundos.codigo_socios','fundos.estadofundo','fundos.fundo','comites_locales.comite_local','comites_centrales.comite_central','fundos.fecha',DB::raw('SUM(fundos_has_floras.hectarea) as hectareas'))
                ->get();
        }
        
        public static function getfundoDatos($id)
        {
            return DB::table('fundos')
                    ->join('socios','fundos.codigo_socios','=','socios.codigo')
                    ->join('personas','socios.dni','=','personas.dni')
                    ->join('comites_locales','fundos.comite_local_id','=','comites_locales.id')
                    ->join('comites_centrales','comites_locales.comites_centrales_id','=','comites_centrales.id')
                    ->join('distritos','comites_centrales.distritos_id','=','distritos.id')
                    ->join('provincias','distritos.provincias_id','=','provincias.id')
                    ->join('departamentos','provincias.departamentos_id','=','departamentos.id')
                    ->where('fundos.id','=',$id)
                    ->where('fundos.estado','=',1)
                    ->select('socios.codigo','personas.paterno','personas.materno','personas.nombre','fundos.fundo','fundos.fecha','fundos.comite_local_id'
                            ,'fundos.estadofundo','fundos.direccion','fundos.observaciones','fundos.id','comites_locales.id',
                            'comites_locales.comite_local','comites_locales.comites_centrales_id','comites_centrales.comite_central','comites_centrales.distritos_id','distritos.distrito'
                            ,'distritos.provincias_id','provincias.provincia','provincias.departamentos_id','departamentos.departamento')
                    ->first();
        }
}
