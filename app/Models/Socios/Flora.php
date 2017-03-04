<?php

namespace App\Models\Socios;

use Illuminate\Database\Eloquent\Model;

class Flora extends Model
{
    //
    protected  $table = 'floras';
    protected  $increment = 'id';
    public  $timestamps=false;
    protected  $fillable  = [
        'flora'
        ];
        public static function getcultivos($idsocio)
        {
            return \Illuminate\Support\Facades\DB::table('floras')
                    ->join('fundos_has_floras','floras.id','=','fundos_has_floras.floras_id')
                    ->join('fundos','fundos_has_floras.fundos_id','=','fundos.id')
                    ->where('fundos.codigo_socios','=',$idsocio)
                    ->select('fundos_has_floras.hectarea','fundos_has_floras.rendimiento','floras.flora','floras.id')
                    ->get();
        }

}
