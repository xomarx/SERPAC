<?php

namespace App\Models\Socios;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Persona;

class Comites_Locale extends Model
{
    //
    protected $table = 'comites_locales';
    protected $increments = 'id';    
    public  $timestamps=false;
    protected  $fillable  = [
        'comite_local','comites_centrales_id'
        ]; 
//    fillable 
//    guarded 
        public function comite_central()
        {
            return $this ->belongsTo(Comites_Centrale::class);
        }
        
        public function fundos()
        {
            return $this->hasMany(Fundo::class);
        }


        public static function  comites_locales($id)
        {
            return Comites_Locale::where('comites_centrales_id','=',$id)
                    ->get();
        }
        
        public function personas()
        {
            return $this ->hasMany(Persona::class);
        }

        public function sucursales()
        {
            return $this ->hasMany(\App\Models\RRHH\Sucursal::class);
        }

        public static function comite_local($id)
        {
            return DB::table('comites_locales')
                ->join('comites_centrales','comites_locales.comites_centrales_id','=','comites_centrales.id')
                ->join('distritos','comites_centrales.distritos_id','=','distritos.id')
                ->join('provincias','distritos.provincias_id','=','provincias.id')
                ->join('departamentos','provincias.departamentos_id','=','departamentos.id')
                ->where('comites_locales.id','=',$id)
                ->select( 'comites_locales.id','comites_locales.comite_local','comites_locales.comites_centrales_id'
                        ,'comites_centrales.comite_central','comites_centrales.distritos_id','distritos.distrito'
                        ,'distritos.provincias_id','provincias.provincia','provincias.departamentos_id','departamentos.departamento')
                ->first();
        }
        
        public static function getlistaComite_Local(){
            return DB::table('comites_locales')
                ->join('comites_centrales','comites_locales.comites_centrales_id','=','comites_centrales.id')
                ->join('distritos','comites_centrales.distritos_id','=','distritos.id')
                ->join('provincias','distritos.provincias_id','=','provincias.id')
                ->join('departamentos','provincias.departamentos_id','=','departamentos.id')
                ->select( 'comites_locales.id','comites_locales.comite_local','comites_locales.comites_centrales_id'
                        ,'comites_centrales.comite_central','comites_centrales.distritos_id','distritos.distrito'
                        ,'distritos.provincias_id','provincias.provincia','provincias.departamentos_id','departamentos.departamento')
                ->get();
        }
        
        public static function listaSectorTecnicos(){
            return DB::table('comites_locales')
                    ->leftjoin('tecnicos','comites_locales.id','=','tecnicos.comites_locales_id')
                ->join('comites_centrales','comites_locales.comites_centrales_id','=','comites_centrales.id')
                    ->where('tecnicos.comites_locales_id')
                    ->pluck(DB::raw("concat(comites_centrales.comite_central,' / ' ,comites_locales.comite_local) as comite_local"),'comites_locales.id');
            
        }
        
        
                
                
}
