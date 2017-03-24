<?php

namespace App\Models\Tesoreria;

use Illuminate\Database\Eloquent\Model;

class Cheque extends Model
{
    //
    protected $table = 'cheques';
    protected $primarykey = 'id';
    public  $timestamps=false;
    protected  $fillable = [
        'cheque','num_cuenta','descripcion'
    ];
    
    
}
