<?php

namespace App\Models\Acopio;

use Illuminate\Database\Eloquent\Model;

class Compras_has_planilla extends Model
{
    //
    protected $table = 'compras_has_planillas';
    protected $primarykey = 'compras_id';
    public  $timestamps=false;
    protected  $fillable = [
        'compras_id','planillas_id'        
        ];    
    
        
}
