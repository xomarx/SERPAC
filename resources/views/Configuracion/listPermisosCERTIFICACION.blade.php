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
  <li><a href="javascript:void(0)" onclick="cargarLista(4)">CREDITOS</a></li>
  @endpermission
  @permission('crear permiso certificacion')
  <li><a href="javascript:void(0)" onclick="cargarLista(5)" class="bg-blue-gradient">CERTIFICACION</a></li>
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
  <li><a href="javascript:void(0)" onclick="cargarLista(9)" >CONFIGURACION</a></li>  
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
            <th ><h4><b>Modulo de Certificación</b></h4></th>
            <th><b>CREAR</b></th>
            <th><b>EDITAR</b></th>
            <th><b>VER</b></th>
            <th><b>ELIMINAR</b></th>                
        </tr>
        <tr>
            <td>Sub modulo de Condicion </td>
            <td>
                @if(in_array('crear_condicion',$permisos) )
                    {!!Form::checkbox('crear_condicion','crear_condicion',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_condicion")','checked'])!!}
                @else
                    {!!Form::checkbox('crear_condicion','crear_condicion',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_condicion")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_condicion',$permisos) )
                {!!Form::checkbox('editar_condicion','editar_condicion',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_condicion")','checked'])!!}
                @else
                {!!Form::checkbox('editar_condicion','editar_condicion',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_condicion")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_condicion',$permisos) )
                    {!!Form::checkbox('ver_condicion','ver_condicion',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_condicion")','checked'])!!}
                @else
                    {!!Form::checkbox('ver_condicion','ver_condicion',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_condicion")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_condicion',$permisos) )
                    {!!Form::checkbox('eliminar_condicion','eliminar_condicion',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_condicion")','checked'])!!}
                @else
                    {!!Form::checkbox('eliminar_condicion','eliminar_condicion',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_condicion")'])!!}
                @endif
                </td>
        </tr>
    </tbody>
</table>
{!! Form::close() !!}
