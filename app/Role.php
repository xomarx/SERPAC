<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    //
     protected $fillable = [
        'name',
        'display_name',
        'description'
    ];
    
   //establecemos las relacion de muchos a muchos con el modelo User, ya que un rol 
   //lo pueden tener varios usuarios y un usuario puede tener varios roles
   public function users(){
        return $this->belongsToMany(User::class);
    }
    
    public static function listaPermisos($rolid){
        return \Illuminate\Support\Facades\DB::table('permission_role')
                ->join('permissions','permission_role.permission_id','=','permissions.id')
                ->where('permission_role.role_id','=',$rolid)
                ->select('permissions.display_name')->get();
    }
    
    public static function deleteRolUSer($iduser){
        return \Illuminate\Support\Facades\DB::table('role_user')
                ->where('role_user.user_id','=',$iduser)                
                ->delete();
    }
    
    public static function RolUser($idrol){
        return \Illuminate\Support\Facades\DB::table('role_user')
                ->where('role_id','=',$idrol)->count();
    }
    
    public static function scopeListRols($query,$dato=''){
        return $query
                ->where(function($query)use($dato){
                    $query->where('name','like','%'.$dato.'%')
                            ->orwhere('display_name','like','%'.$dato.'%')
                            ->orwhere('description','like','%'.$dato.'%');
                })
                ->select('name','display_name','description','id')->get();
        
    }
}
