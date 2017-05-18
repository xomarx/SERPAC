<?php

namespace App\Models\Socios;

use Illuminate\Database\Eloquent\Model;

class Fundos_has_flora extends Model
{
    //
    protected $table = 'fundos_has_floras';
    public  $timestamps=false;
    protected  $fillable  = [
        'fundos_id','floras_id',
        'hectarea','rendimiento'
        ]; 
    
        public function fundos(){
            return $this->belongsTo(\App\Models\Socios\Fundo::class);
        }
        
        public  function floras(){
            return $this->belongsTo(\App\Models\Socios\Flora::class);
        }
}
