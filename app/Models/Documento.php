<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    //
    protected $table = 'documentos';
    protected $primarykey = 'id';
    public  $timestamps=false;
    protected  $fillable = [
        'enumeracion','importe','tipo_documentos_id'
    ]; 
    
    public  function tipo_documento()
    {
        return $this->belongsTo(Tipo_documento::class);
    }
}
