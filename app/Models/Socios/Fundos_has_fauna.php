<?php

namespace App\Models\socios;

use Illuminate\Database\Eloquent\Model;

class Fundos_has_fauna extends Model
{
    //
    protected $table = 'fundos_has_faunas';
//    protected $key = 'fundos_id';    
    public  $timestamps=false;
    protected  $fillable  = [
        'fundos_id','faunas_id',
        'cantidad','rendimiento'
        ]; 
        
}
