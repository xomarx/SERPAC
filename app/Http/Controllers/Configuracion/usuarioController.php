<?php

namespace App\Http\Controllers\Configuracion;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use App\Http\Controllers\Controller;

class usuarioController extends Controller
{
    
    
    
    public function EditRol($id){
        $rol = \App\Role::where('id','=',$id)->select('name','display_name','description')->first();
        return response()->json($rol);
    }
    
    public function updateRol(Requests\Configuracion\RolCreateRequest $request,$id){
        $rol = \App\Role::FindOrFail($id);
        $rol->name = strtoupper($request->rol);
        $rol->display_name=$request->tag;
        $rol->description=$request->descripcion;
        $rol->save();
        if($rol) return  response()->json(['success'=>true,'message'=>'Se actualizo los datos del Rol']);
        else return  response()->json(['success'=>false,'message'=>'No se actualizo los datos del Rol']);
    }


    public function roluser(){        
        return view('Configuracion.roles');
    }
    
    public function HeadRoles()
    {
        $roles = \App\Role::ListRols('');
        return view('Configuracion.rolHead')->with('roles',$roles);
    }
    
    public function listaRoles($dato=''){
        $roles = \App\Role::ListRols($dato);
        return view('Configuracion.rolList')->with('roles',$roles);
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
    
    public function errorModal(){
        return response()->view('errors.403-modal');
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
                'name'=>  strtoupper($request->rol),
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
    public function show($id,$modulo) {
        $permisos = \App\Role::listaPermisos($id);
        $results[]=[0=>'nada'];
        foreach ($permisos as $permiso){
            $results[] = $permiso->display_name;
        }
        if($modulo==0){
            if(auth()->user()->can('crear permiso socio'))  return    view('Configuracion.listPermisos')->with('permisos',$results);
            else if(auth()->user()->can('crear permiso RRHH')) return    view('Configuracion.listaPermisoRRHH')->with('permisos',$results);
            else if(auth()->user()->can('crear permiso acopio')) return    view('Configuracion.listPermisosACOPIO')->with('permisos',$results);
            else if(auth()->user()->can('crear permiso creditos')) return    view('Configuracion.listPermisosCREDITOS')->with('permisos',$results);
            else if(auth()->user()->can('crear permiso certificacion')) return    view('Configuracion.listPermisosCERTIFICACION')->with('permisos',$results);
            else if(auth()->user()->can('crear permiso tesoreria')) return    view('Configuracion.listPermisosTESORERIA')->with('permisos',$results);
            else if(auth()->user()->can('crear permiso contabilidad')) return    view('Configuracion.listPermisosCONTABILIDAD')->with('permisos',$results);
            else if(auth()->user()->can('crear permiso informes')) return    view('Configuracion.listPermisosINFORMES')->with('permisos',$results);
            else if(auth()->user()->can('crear permiso configuracion')) return    view('Configuracion.listPermisosCONFIGURACION')->with('permisos',$results);
            else return response ()->view ('errors.403-content');
        }
        else if($modulo == 1){
            if(auth()->user()->can('crear permiso socio'))  return    view('Configuracion.listPermisos')->with('permisos',$results);
            else return response ()->view ('errors.403-content');
        }
        else if($modulo == 2){
            if(auth()->user()->can('crear permiso RRHH')) return    view('Configuracion.listaPermisoRRHH')->with('permisos',$results);
            else return response ()->view ('errors.403-content');
        }
        else if($modulo == 3){
            if(auth()->user()->can('crear permiso acopio')) return    view('Configuracion.listPermisosACOPIO')->with('permisos',$results);
            else return response ()->view ('errors.403-content');
        }
        else if($modulo == 4){
            if(auth()->user()->can('crear permiso creditos')) return    view('Configuracion.listPermisosCREDITOS')->with('permisos',$results);
            else return response ()->view ('errors.403-content');
        }
        else if($modulo == 5){
            if(auth()->user()->can('crear permiso certificacion')) return    view('Configuracion.listPermisosCERTIFICACION')->with('permisos',$results);
            else return response ()->view ('errors.403-content');
        }
        else if($modulo == 6){
            if(auth()->user()->can('crear permiso tesoreria')) return    view('Configuracion.listPermisosTESORERIA')->with('permisos',$results);
            else return response ()->view ('errors.403-content');
        }
        else if($modulo == 7){
            if(auth()->user()->can('crear permiso contabilidad')) return    view('Configuracion.listPermisosCONTABILIDAD')->with('permisos',$results);
            else return response ()->view ('errors.403-content');
        }
        else if($modulo == 8){
            if(auth()->user()->can('crear permiso informes')) return    view('Configuracion.listPermisosINFORMES')->with('permisos',$results);
            else return response ()->view ('errors.403-content');
        }
        else if($modulo == 9){
            if(auth()->user()->can('crear permiso configuracion')) 
                return    view('Configuracion.listPermisosCONFIGURACION')->with('permisos',$results);
            else return response ()->view ('errors.403-content');
        }
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
    
    public function deleteRol($id){
        if(!auth()->user()->can('eliminar rol'))
            return response ()->view ('errors.403-content',[],403);
        if(\App\Role::RolUser($id) == 0){
            \App\Role::FindOrFail($id)->delete();
            return response()->json(['success'=>true]);
        }
        return response()->json(['success'=>false]);                       
    }
}
