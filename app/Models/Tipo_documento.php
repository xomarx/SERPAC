<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipo_documento extends Model
{
    //
    protected $table = 'tipo_documentos';
    protected $primarykey = 'cod';
    public  $timestamps=false;
    protected  $fillable = [
        'cod','tipo_documento'
    ]; 
    
    public  function documentos()
    {
        return $this->hasMany(Documento::class);
    }
}
