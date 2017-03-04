<?php

namespace App\Models\Socios;

use Illuminate\Database\Eloquent\Model;

class Inmueble extends Model
{
    //
    protected $table = 'inmuebles';
    protected $increments = 'id';    
    public  $timestamps=false;
    protected  $fillable  = [
        'inmueble'
        ]; 
    
        public static function getInmuebles($codigosocio)
        {
            return \Illuminate\Support\Facades\DB::table('inmuebles')
                    ->join('fundos_has_inmuebles','inmuebles.id','=','fundos_has_inmuebles.inmuebles_id')
                    ->join('fundos','fundos_has_inmuebles.fundos_id','=','fundos.id')
                    ->where('fundos.codigo_socios','=',$codigosocio)
                    ->select('inmuebles.id','inmuebles.inmueble')
                    ->get(); 
        }
}
