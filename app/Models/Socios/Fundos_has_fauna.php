<?php

namespace App\Models\Socios;

use Illuminate\Database\Eloquent\Model;

class Fundos_has_fauna extends Model
{
    //
    protected $table = 'fundos_has_faunas';      
    public  $timestamps=false;
    protected  $fillable  = [
        'fundos_id','faunas_id',
        'cantidad','rendimiento'
        ]; 
        
}
