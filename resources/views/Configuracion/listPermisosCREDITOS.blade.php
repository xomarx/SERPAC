<ul class="pager "> 
  @permission('crear permiso socio')
  <li><a href="javascript:void(0)" onclick="cargarLista(1)" >SOCIOS</a></li>
  @endpermission
  @permission('crear permiso RRHH')
  <li><a href="javascript:void(0)" onclick="cargarLista(2)">RRHH</a></li>
  @endpermission
  @permission('crear permiso acopio')
  <li><a href="javascript:void(0)" onclick="cargarLista(3)" >ACOPIO</a></li>
  @endpermission
  @permission('crear permiso creditos')
  <li><a href="javascript:void(0)" onclick="cargarLista(4)" class="bg-blue-gradient">CREDITOS</a></li>
  @endpermission
  @permission('crear permiso certificacion')
  <li><a href="javascript:void(0)" onclick="cargarLista(5)">CERTIFICACION</a></li>
  @endpermission
  @permission('crear permiso tesoreria')
  <li><a href="javascript:void(0)" onclick="cargarLista(6)">TESORERIA</a></li>
  @endpermission
  @permission('crear permiso contabilidad')
  <li><a href="javascript:void(0)" onclick="cargarLista(7)">CONTABILIDAD</a></li>
  @endpermission
  @permission('crear permiso informes')
  <li><a href="javascript:void(0)" onclick="cargarLista(8)">INFORMES</a></li>
  @endpermission
  @permission('crear permiso configuracion')
  <li><a href="javascript:void(0)" onclick="cargarLista(9)">CONFIGURACION</a></li>  
  @endpermission   
</ul>
{!! Form::open(['id'=>'formAsigPermisos']) !!}             
<table class="table table-hover table-responsive">
    <thead>
        <tr>
            <th  style="text-align: center"><h4><b>MODULOS / SUB MODULOS</b></h4></th>
            <th colspan="4" style="text-align: center"><h4><b>PERMISOS</b></h4></th>
        </tr>            
    </thead>
    <tbody>
        <tr>
            <th ><h4><b>Modulo de Creditos</b></h4></th>
            <th><b>CREAR</b></th>
            <th><b>EDITAR</b></th>
            <th><b>VER</b></th>
            <th><b>ELIMINAR</b></th>                
        </tr>
    </tbody>
</table>
{!! Form::close() !!}