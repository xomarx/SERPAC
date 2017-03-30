<?php

namespace App\Http\Controllers\Configuracion;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use App\Http\Controllers\Controller;

class usuarioController extends Controller
{
   
    public function roluser(){        
        return view('Configuracion.roles');
    }
    
    public function listaRoles()
    {
        $roles = \App\Role::all();
        return view('Configuracion.listarRoles')->with('roles',$roles);
    }
                
    public function PermisoUser(){        
        return view('Configuracion.permisos');
    }
    
    public function HeadPermisoUser(){
        $roles = \App\Role::all()->pluck('name','id');
        return view('Configuracion.headListaPermisos',['roles'=>$roles]);
    }
    
    public function asigRolUser(){        
        $roles = \App\Role::all()->pluck('name','id');
        return view('Configuracion.asignaRolUser',['roles'=>$roles]);
    }
    
    public function ListUsers(){
        $usuarios = \App\User::usuarios();
        return view('Configuracion.listUsers',['usuarios'=>$usuarios]);  
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        
    }
            
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\Configuracion\RolCreateRequest $request)
    {
       
    }

    public function storerol(Requests\Configuracion\RolCreateRequest $request) {
//        return redirect('Usuarios');
        if ($request->ajax()) {
            $rol = \App\Role::create([
                'name'=>$request->rol,
                'display_name'=>$request->tag,
                'description'=>$request->descripcion
            ]);
            if($rol)  return response()->json(['success'=>true,'message'=>'Se registro nuevo Rol']);
            else return response ()->json (['success'=>false,'message'=>'Error en el Registro del Rol']);
        }
    }
    public function PermisoStore(Requests\Configuracion\PermisosCreateRequest $request){
        if ($request->ajax()) {
            $rol = \App\Permission::create([
                'name'=>$request->permiso,
                'display_name'=>$request->tag,
                'description'=>$request->descripcion
            ]);
            if($rol)  return response()->json(['success'=>true,'message'=>'Se registro nuevo Permiso']);
            else return response ()->json (['success'=>false,'message'=>'Error en el Registro del Permiso']);
        }
    }
    
    public function AsigPermisoStore(Request $request){
        if($request->ajax()){
            $rol = \App\Role::Find($request->rol);
            $permiss = \App\Permission::where('display_name','=',$request->permiso)->first();
            if($request->estado)if($request->estado == 'true'){                
                $rol->attachPermission($permiss);
                return response()->json(true);
            }
            else{                                
                $resul = \App\Permission::DeletePermisos($permiss->id,$rol->id);                                
//                $rol->perms()->sync([$permiss->id]);
                return response()->json($resul);
            }                        
        }               
    }
    
    public function AsigRolUserStore(Request $request){
        
        if($request->ajax()){
            $this->validate($request, ['rol'=>'required'], ['rol.required'=>'Seleccione un Rol']);
            
            $rol = \App\Role::FindOrFail($request->rol);            
            $user = \App\User::where('name','=',$request->usuario)->first();
            $roluser = \App\Role::deleteRolUSer($user->id);
            $user->attachRole($rol);
            if($user) return response ()->json (['success'=>true,'message'=>'Se asigno correctamente su ROL']);
            else return response ()->json (['success'=>false,'message'=>'No se Asigno ningun ROL']);
        }
        
    }
    
    public function ActDesact(Request $request){
        if($request->ajax()){
            $user = \App\User::where('name','=',$request->usuario)->first();
            \App\User::where('name','=',$request->usuario)
                    ->update(['estado'=>!$user->estado]);
//            if($user->estado) $user->estado = 0;
//            else $user->estado = 1;            
            $roluser = \App\Role::deleteRolUSer($user->id);
            return response()->json(['success'=>true]);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permisos = \App\Role::listaPermisos($id);
        $results[]=[0=>'nada'];
        foreach ($permisos as $permiso){
            $results[] = $permiso->display_name;
        }
        return    view('Configuracion.listPermisos')->with('permisos',$results); //response()->json($results);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
    
    
}
