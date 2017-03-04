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
}
