<?php

namespace App\Models\Socios;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    //
    protected $table = 'provincias';
    protected $increments = 'id';    
    public  $timestamps=false;
    protected  $fillable  = [
        'provincia','departamentos_id'
        ]; 
//    fillable 
//    guarded 
        public function departamento()
        {
            return $this ->belongsTo(Departamento::class);
        }
        
        public function distritos()
        {
            return $this->hasMany(Distrito::class);
        }
        
        public static function  provincias($id)
        {
            return Provincia::where('departamentos_id','=',$id)
                    ->get();
        }
}
