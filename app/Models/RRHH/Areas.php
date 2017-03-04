<?php

namespace App\Models\RRHH;

use Illuminate\Database\Eloquent\Model;

class Areas extends Model
{
    //
    protected  $table = 'areas';
    protected  $primarykey = 'id';
    
    public  $timestamps=false;
    protected  $fillable = ['area'];
    
    public function sucursales()
        {
            return $this ->hasMany(Sucursal::class);
        }
    
}
