<?php

namespace App\Models\socios;

use Illuminate\Database\Eloquent\Model;

class Fundos_has_flora extends Model
{
    //
    protected $table = 'fundos_has_floras';
//    protected $key = 'floras_id';    
    public  $timestamps=false;
    protected  $fillable  = [
        'fundos_id','floras_id',
        'hectarea','rendimiento'
        ]; 
}
