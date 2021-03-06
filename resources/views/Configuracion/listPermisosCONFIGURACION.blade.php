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
  <li><a href="javascript:void(0)" onclick="cargarLista(9)" class="bg-blue-gradient">CONFIGURACION</a></li>  
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
            <th ><h4><b>Modulo de Configuración</b></h4></th>
            <th><b>CREAR</b></th>
            <th><b>EDITAR</b></th>
            <th><b>VER</b></th>
            <th><b>ELIMINAR</b></th>                
        </tr>
        <tr>
            <td>Sub modulo de Documentos </td>
            <td>
                @if(in_array('crear_documentos',$permisos) )
                    {!!Form::checkbox('crear_documentos','crear_documentos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_documentos")','checked'])!!}
                @else
                    {!!Form::checkbox('crear_documentos','crear_documentos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_documentos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_documentos',$permisos) )
                {!!Form::checkbox('editar_documentos','editar_documentos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_documentos")','checked'])!!}
                @else
                {!!Form::checkbox('editar_documentos','editar_documentos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_documentos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_documentos',$permisos) )
                    {!!Form::checkbox('ver_documentos','ver_documentos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_documentos")','checked'])!!}
                @else
                    {!!Form::checkbox('ver_documentos','ver_documentos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_documentos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_documentos',$permisos) )
                    {!!Form::checkbox('eliminar_documentos','eliminar_documentos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_documentos")','checked'])!!}
                @else
                    {!!Form::checkbox('eliminar_documentos','eliminar_documentos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_documentos")'])!!}
                @endif
                </td>
        </tr>
        <tr>
            <td>Sub modulo de Usuarios</td>
            <td>
                @if(in_array('crear_usuarios',$permisos) )
                {!!Form::checkbox('crear_usuarios','crear_usuarios',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_usuarios")','checked'])!!}
                @else
                {!!Form::checkbox('crear_usuarios','crear_usuarios',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_usuarios")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_usuarios',$permisos) )
                {!!Form::checkbox('editar_usuarios','editar_usuarios',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_usuarios")','checked'])!!}
                @else
                {!!Form::checkbox('editar_usuarios','editar_usuarios',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_usuarios")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_usuarios',$permisos) )
                {!!Form::checkbox('ver_usuarios','ver_usuarios',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_usuarios")','checked'])!!}
                @else
                {!!Form::checkbox('ver_usuarios','ver_usuarios',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_usuarios")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_usuarios',$permisos) )
                {!!Form::checkbox('eliminar_usuarios','eliminar_usuarios',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_usuarios")','checked'])!!}
                @else
                {!!Form::checkbox('eliminar_usuarios','eliminar_usuarios',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_usuarios")'])!!}
                @endif
            </td>
        </tr>        
        <tr>
            <td>Sub modulo de Rol</td>
            <td>
                @if(in_array('crear_rol',$permisos) )
                {!!Form::checkbox('crear_rol','crear_rol',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_rol")','checked'])!!}
                @else
                {!!Form::checkbox('crear_rol','crear_rol',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_rol")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_rol',$permisos) )
                {!!Form::checkbox('editar_rol','editar_rol',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_rol")','checked'])!!}
                @else
                {!!Form::checkbox('editar_rol','editar_rol',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_rol")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_rol',$permisos) )
                {!!Form::checkbox('ver_rol','ver_rol',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_rol")','checked'])!!}
                @else
                {!!Form::checkbox('ver_rol','ver_rol',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_rol")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_rol',$permisos) )
                {!!Form::checkbox('eliminar_rol','eliminar_rol',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_rol")','checked'])!!}
                @else
                {!!Form::checkbox('eliminar_rol','eliminar_rol',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_rol")'])!!}
                @endif
                </td>
        </tr>
                
        <tr>
            <td><b>MODULO SOCIOS - PERMISOS</b></td>
            <td>
                @if(in_array('crear_permiso_socio',$permisos) )
                {!!Form::checkbox('crear_permiso_socio','crear_permiso_socio',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_permiso_socio")','checked'])!!}
                @else
                {!!Form::checkbox('crear_permiso_socio','crear_permiso_socio',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_permiso_socio")'])!!}
                @endif
            </td>
            <td>                
                {!!Form::checkbox('permiso','permiso',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}                
            </td>
            <td>
                {!!Form::checkbox('permiso','permiso',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}                
                </td>
            <td>
                {!!Form::checkbox('permiso','permiso',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
            </td>
        </tr>
        <tr>
            <td><b>MODULO RRHH - PERMISOS</b></td>
            <td>
                @if(in_array('crear_permiso_RRHH',$permisos) )
                {!!Form::checkbox('crear_permiso_RRHH','crear_permiso_RRHH',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_permiso_RRHH")','checked'])!!}
                @else
                {!!Form::checkbox('crear_permiso_RRHH','crear_permiso_RRHH',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_permiso_RRHH")'])!!}
                @endif
                </td>
                <td>
                {!!Form::checkbox('permiso','permiso',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}                
                </td>
            <td>
                {!!Form::checkbox('permiso','permiso',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}                
                </td>
            <td>
                {!!Form::checkbox('permiso','permiso',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
                </td>
        </tr>
        
        <tr>
            <td><b>MODULO ACOPIO - PERMISOS</b></td>
            <td>
                @if(in_array('crear_permiso_acopio',$permisos) )
                {!!Form::checkbox('crear_permiso_acopio','crear_permiso_acopio',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_permiso_acopio")','checked'])!!}
                @else
                {!!Form::checkbox('crear_permiso_acopio','crear_permiso_acopio',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_permiso_acopio")'])!!}
                @endif
                </td>
                <td>
               {!!Form::checkbox('permiso','permiso',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
                </td>
            <td>
                {!!Form::checkbox('permiso','permiso',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
                </td>
            <td>
                {!!Form::checkbox('permiso','permiso',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
                </td>
        </tr>
        <tr>
            <td><b>MODULO CREDITOS - PERMISOS</b></td>
            <td>
                @if(in_array('crear_permiso_creditos',$permisos) )
                {!!Form::checkbox('crear_permiso_creditos','crear_permiso_creditos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_permiso_creditos")','checked'])!!}
                @else
                {!!Form::checkbox('crear_permiso_creditos','crear_permiso_creditos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_permiso_creditos")'])!!}
                @endif
                </td>
                <td>
                {!!Form::checkbox('permiso','permiso',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
                </td>
            <td>
                {!!Form::checkbox('permiso','permiso',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
                </td>
            <td>
                {!!Form::checkbox('permiso','permiso',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
                </td>
        </tr>
        <tr>
            <td><b>MODULO CERTIFICACION - PERMISOS</b></td>
            <td>
                @if(in_array('crear_permiso_certificacion',$permisos) )
                {!!Form::checkbox('crear_permiso_certificacion','crear_permiso_certificacion',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_permiso_certificacion")','checked'])!!}
                @else
                {!!Form::checkbox('crear_permiso_certificacion','crear_permiso_certificacion',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_permiso_certificacion")'])!!}
                @endif
                </td>
                <td>
                {!!Form::checkbox('permiso','permiso',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
                </td>
            <td>
                {!!Form::checkbox('permiso','permiso',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
                </td>
            <td>
                {!!Form::checkbox('permiso','permiso',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
                </td>
        </tr>
        <tr>
            <td><b>MODULO TESORERIA - PERMISOS</b></td>
            <td>
                @if(in_array('crear_permiso_tesoreria',$permisos) )
                {!!Form::checkbox('crear_permiso_tesoreria','crear_permiso_tesoreria',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_permiso_tesoreria")','checked'])!!}
                @else
                {!!Form::checkbox('crear_permiso_tesoreria','crear_permiso_tesoreria',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_permiso_tesoreria")'])!!}
                @endif
                </td>
                <td>
                {!!Form::checkbox('permiso','permiso',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
                </td>
            <td>
                {!!Form::checkbox('permiso','permiso',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
                </td>
            <td>
                {!!Form::checkbox('permiso','permiso',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
                </td>
        </tr>
        <tr>
            <td><b>MODULO CONTABILIDAD - PERMISOS</b></td>
            <td>
                @if(in_array('crear_permiso_contabilidad',$permisos) )
                {!!Form::checkbox('crear_permiso_contabilidad','crear_permiso_contabilidad',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_permiso_contabilidad")','checked'])!!}
                @else
                {!!Form::checkbox('crear_permiso_contabilidad','crear_permiso_contabilidad',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_permiso_contabilidad")'])!!}
                @endif
                </td>
                <td>
                {!!Form::checkbox('permiso','permiso',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
                </td>
            <td>
                {!!Form::checkbox('permiso','permiso',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
                </td>
            <td>
                {!!Form::checkbox('permiso','permiso',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
                </td>
        </tr>
        <tr>
            <td><b>MODULO INFORMES - PERMISOS</b></td>
            <td>
                @if(in_array('crear_permiso_informes',$permisos) )
                {!!Form::checkbox('crear_permiso_informes','crear_permiso_informes',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_permiso_informes")','checked'])!!}
                @else
                {!!Form::checkbox('crear_permiso_informes','crear_permiso_informes',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_permiso_informes")'])!!}
                @endif
                </td>
                <td>
                {!!Form::checkbox('permiso','permiso',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
                </td>
            <td>
                {!!Form::checkbox('permiso','permiso',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
                </td>
            <td>
                {!!Form::checkbox('permiso','permiso',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
                </td>
        </tr>
        <tr>
            <td><b>MODULO CONFIGURACION - PERMISOS</b></td>
            <td>
                @if(in_array('crear_permiso_configuracion',$permisos) )
                {!!Form::checkbox('crear_permiso_configuracion','crear_permiso_configuracion',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_permiso_configuracion")','checked'])!!}
                @else
                {!!Form::checkbox('crear_permiso_configuracion','crear_permiso_configuracion',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_permiso_configuracion")'])!!}
                @endif
                </td>
                <td>
                {!!Form::checkbox('permiso','permiso',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
                </td>
            <td>
                {!!Form::checkbox('permiso','permiso',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
                </td>
            <td>
                {!!Form::checkbox('permiso','permiso',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
                </td>
        </tr>
    </tbody>
</table>
{!! Form::close() !!}
