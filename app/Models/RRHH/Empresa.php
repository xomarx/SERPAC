<?php

namespace App\Models\RRHH;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    //
    public  $timestamps=false;
    protected  $fillable = ['empresa','ruc','direccion'];
    
    public static function scopelistaEmpresas($query){
        return $query
                ->select()
                ->paginate(5);
    }
}
