<?php

namespace App\Models\RRHH;

use Illuminate\Database\Eloquent\Model;

class Cargos extends Model
{
    //
    protected  $table = 'cargos';
    protected  $primarykey = 'id';
    
    public  $timestamps=false;
    protected  $fillable = ['cargo'];
}
