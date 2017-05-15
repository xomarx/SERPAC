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
  <li><a href="javascript:void(0)" onclick="cargarLista(8)" class="bg-blue-gradient">INFORMES</a></li>
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
            <th ><h4><b>INFORME DE SOCIOS</b></h4></th>
            <th><b>CREAR</b></th>
            <th><b>EDITAR</b></th>
            <th><b>VER</b></th>
            <th><b>ELIMINAR</b></th>                
        </tr>
        <tr>
            <td>Reportes Padron de Socios </td>
            <td>                
                    {!!Form::checkbox('crear_empleados','crear_empleados',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
            </td>
            <td>
               {!!Form::checkbox('crear_empleados','crear_empleados',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
            <td>
                @if(in_array('ver_padron_socios',$permisos) )
                    {!!Form::checkbox('ver_padron_socios','ver_padron_socios',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_padron_socios")','checked'])!!}
                @else
                    {!!Form::checkbox('ver_padron_socios','ver_padron_socios',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_padron_socios")'])!!}
                @endif
                </td>
            <td>
               {!!Form::checkbox('crear_empleados','crear_empleados',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
                </td>
        </tr>
        <tr>
            <th ><h4><b>INFORME DE ACOPIO</b></h4></th>
            <th><b>CREAR</b></th>
            <th><b>EDITAR</b></th>
            <th><b>VER</b></th>
            <th><b>ELIMINAR</b></th>                
        </tr>
        <tr>
            <td>Grafico - Kardex Dinero </td>
            <td>                
                {!!Form::checkbox('crear_empleados','crear_empleados',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
            </td>
            <td>
               {!!Form::checkbox('crear_empleados','crear_empleados',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
            <td>
                @if(in_array('ver_kardex_dinero',$permisos) )
                    {!!Form::checkbox('ver_kardex_dinero','ver_kardex_dinero',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_kardex_dinero")','checked'])!!}
                @else
                    {!!Form::checkbox('ver_kardex_dinero','ver_kardex_dinero',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_kardex_dinero")'])!!}
                @endif
                </td>
            <td>
               {!!Form::checkbox('crear_empleados','crear_empleados',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
                </td>
        </tr>
        <tr>
            <th ><h4><b>INFORME DE TESORERIA</b></h4></th>
            <th><b>CREAR</b></th>
            <th><b>EDITAR</b></th>
            <th><b>VER</b></th>
            <th><b>ELIMINAR</b></th>                
        </tr>
        <tr>
            <td>Grafico - Giro de Cheques </td>
            <td>                
                {!!Form::checkbox('movimiento_cheques','crear_empleados',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
            </td>
            <td>
               {!!Form::checkbox('movimiento_cheques','crear_empleados',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
            <td>
                @if(in_array('ver_movimiento_cheques',$permisos) )
                    {!!Form::checkbox('ver_movimiento_cheques','ver_movimiento_cheques',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_movimiento_cheques")','checked'])!!}
                @else
                    {!!Form::checkbox('ver_movimiento_cheques','ver_movimiento_cheques',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_movimiento_cheques")'])!!}
                @endif
                </td>
            <td>
               {!!Form::checkbox('movimiento_cheques','movimiento_cheques',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
                </td>
        </tr>
        <tr>
            <td>Grafico - Distribucion de Fondos para Acopio </td>
            <td>                
                {!!Form::checkbox('movimiento_cheques','crear_empleados',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
            </td>
            <td>
               {!!Form::checkbox('movimiento_cheques','crear_empleados',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
            <td>
                @if(in_array('ver_distribucion_fondos',$permisos) )
                    {!!Form::checkbox('ver_distribucion_fondos','ver_distribucion_fondos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_distribucion_fondos")','checked'])!!}
                @else
                    {!!Form::checkbox('ver_distribucion_fondos','ver_distribucion_fondos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_distribucion_fondos")'])!!}
                @endif
                </td>
            <td>
               {!!Form::checkbox('movimiento_cheques','movimiento_cheques',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
                </td>
        </tr>
    </tbody>
</table>
{!! Form::close() !!}
