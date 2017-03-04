<?php

namespace App\Models\Socios;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    //
    protected $table = 'departamentos';
    protected $primarykey = 'id';    
    public  $timestamps=false;
    protected  $fillable = [
        'id',
        'departamento'
        ];  
    
        public function provincias()
        {
            return $this->hasMany(Provincia::class);
        }
}
