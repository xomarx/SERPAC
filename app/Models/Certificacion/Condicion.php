<?php

namespace App\Models\Certificacion;

use Illuminate\Database\Eloquent\Model;
use App\Models\Acopio\Compra;

class Condicion extends Model
{
    //
    protected $table = 'condicions';
    protected $primarykey = 'id';
    public  $timestamps=false;
    protected  $fillable = [
        'condicion','descripcion']; 
    
    public function compras()
    {
        return $this->hasMany(Compra::class);
    }
    
    public function socios(){
        return $this->belongsToMany(\App\Models\Socios\Socio::class);
    }
    
    public static function scopegetcondicions($query,$codigo){
        return $query
                ->join('condicions_has_socios','id','=','condicions_id')
                ->where('socios_codigo','=',$codigo)
                ->pluck('condicion','id');
    }
}
