<?php

namespace App\Models\Socios;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comites_Centrales extends Model
{
    //
    protected $table = 'comites_centrales';
    protected $increments = 'id';    
    public  $timestamps=false;
    protected  $fillable  = [
        'comite_central','distritos_id'
        ]; 
//    fillable 
//    guarded 
        public function distrito()
        {
            return $this ->belongsTo(Distrito::class);
        }
        
        public function comites_locales()
        {
            return $this->hasMany(Comites_Locales::class);
        }
        
        public static function  comites_centrales($id)
        {
            return Comites_Centrales::where('distritos_id','=',$id)
                    ->get();
        }
        
        
        public static function  comite_central($id)
        {
            return DB::table('comites_centrales')
                    ->join('distritos','comites_centrales.distritos_id','=','distritos.id')
                    ->join('provincias','distritos.provincias_id','=','provincias.id')
                    ->join('departamentos','provincias.departamentos_id','=','departamentos.id')
                    ->where('comites_centrales.id','=',$id)
                    ->select('comites_centrales.id','comites_centrales.comite_central','distritos.distrito','comites_centrales.distritos_id'
                            ,'provincias.provincia','distritos.provincias_id','departamentos.departamento','provincias.departamentos_id')
                    ->get();
        }
}
