<?php

namespace App\Models\Socios;

use Illuminate\Database\Eloquent\Model;

class Fauna extends Model
{
    //
    protected  $table = 'faunas';
    protected  $increment = 'id';
    public  $timestamps=false;
    protected  $fillable  = [
        'fauna'
        ];
    
        public function fundos()
        {
            return $this->belongsToMany(Fundo::class);
        }
        
        public static function getfaunas($idsocio)
        {
            return \Illuminate\Support\Facades\DB::table('faunas')
                    ->join('fundos_has_faunas','faunas.id','=','fundos_has_faunas.faunas_id')
                    ->join('fundos','fundos_has_faunas.fundos_id','=','fundos.id')
                    ->where('fundos.codigo_socios','=',$idsocio)
                    ->select('fundos_has_faunas.cantidad','fundos_has_faunas.rendimiento','faunas.fauna','faunas.id')
                    ->get(); 
        }
}
