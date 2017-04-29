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
    
    public function mov_cheque(){
        return $this->hasOne(Mov_cheque::class);
    }
            
    public static function scopeListaCheques($query, $dato=''){
        return  $query
                ->where(function($query)use($dato){
                    $query->where('cheque','like','%'.$dato.'%')
                            ->orwhere('num_cuenta','like','%'.$dato.'%')
                            ->orwhere('descripcion','like','%'.$dato.'%');
                })
                ->select()->paginate(10);
                
    }

    
}
