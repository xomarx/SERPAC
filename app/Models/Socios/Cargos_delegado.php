<?php

namespace App\Models\Socios;

use Illuminate\Database\Eloquent\Model;

class Cargos_delegado extends Model
{
    //
    protected  $table = 'cargos_delegados';
    protected  $increment = 'id';
    public  $timestamps=false;
    protected  $fillable  = [
        'cargo_delegado'
        ];
}
