<?php

namespace App\Models\Tesoreria;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tipo_egreso extends Model
{
    //
    protected $table = 'tipo_egresos';
    protected $primarykey = 'id';
    public  $timestamps=false;
    protected  $fillable = [
        'tipo_egreso','descripcion'
    ];
    
    public function egresos()
    {
        return $this->hasMany(Egreso::class);
    }        
}
