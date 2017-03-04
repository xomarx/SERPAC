<?php

namespace App\Models\Socios;

use Illuminate\Database\Eloquent\Model;

class Cargos_directivo extends Model
{
    //
    protected  $table = 'cargos_directivos';
    protected  $increment = 'id';
    public  $timestamps=false;
    protected  $fillable  = [
        'cargo_directivo'
        ];
}
