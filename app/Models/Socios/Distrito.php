<?php

namespace App\Models\Socios;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Distrito extends Model
{
    //
    protected $table = 'distritos';
    protected $increments = 'id';    
    public  $timestamps=false;
    protected  $fillable  = [
        'distrito','provincias_id'
        ]; 
//    fillable 
//    guarded 
        public function provincia()
        {
            return $this ->belongsTo(Provincia::class);
        }
        
        public function comites_centrales()
        {
            return $this->hasMany(Comites_Centrales::class);
        }
        
        public static function  distritos($id)
        {
            return Distrito::where('provincias_id','=',$id)
                    ->get();
        }
        
        public static function  getdistrito($id)
        {
            return DB::table('distritos')
                    ->join('provincias','distritos.provincias_id','=','provincias.id')
                    ->where('distritos.id','=',$id)                    
                    ->select('distritos.id','distritos.distrito','distritos.provincias_id','provincias.departamentos_id'
                            ,'provincias.provincia')
                    ->first();
        }
}
