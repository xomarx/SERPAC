<?php

namespace App\Models\socios;

use Illuminate\Database\Eloquent\Model;

class Fundos_has_inmueble extends Model
{
    //
    protected $table = 'fundos_has_inmuebles';
//    protected $key = 'fundos_id';    
    public  $timestamps=false;
    protected  $fillable  = [
        'fundos_id','inmuebles_id'        
        ]; 
}
