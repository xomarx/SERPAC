<?php

namespace App\Models\Acopio;

use Illuminate\Database\Eloquent\Model;

class Nosocio extends Model
{
    //
     protected $table = 'nosocios';
    protected $primarykey = 'dni';
    public  $timestamps=false;
    protected  $fillable = [
        'dni','paterno','materno','nombres','comites_locales_id'];
    
    public function comite_local(){
        return $this->belongsTo(\App\Models\Socios\Comites_Locale::class);
    }
    
    public function compras(){
        return $this->hasMany(Compra::class);
    }
}
