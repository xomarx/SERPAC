<?php

namespace App\Models\Socios;

use Illuminate\Database\Eloquent\Model;

class Fundos_has_inmueble extends Model
{
    //
    protected $table = 'fundos_has_inmuebles';
    public  $timestamps=false;
    protected  $fillable  = [
        'fundos_id','inmuebles_id'        
        ]; 
}
