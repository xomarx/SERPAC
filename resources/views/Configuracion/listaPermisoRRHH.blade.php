<ul class="pager "> 
  <li><a href="javascript:void(0)" onclick="cargarLista(1)" >SOCIOS</a></li>
  <li><a href="javascript:void(0)" onclick="cargarLista(2)" class="bg-blue-gradient">RRHH</a></li>
  <li><a href="javascript:void(0)" onclick="cargarLista(3)">ACOPIO</a></li>
  <li><a href="javascript:void(0)" onclick="cargarLista(4)">CREDITOS</a></li>
  <li><a href="javascript:void(0)" onclick="cargarLista(5)">CERTIFICACION</a></li>
  <li><a href="javascript:void(0)" onclick="cargarLista(6)">TESORERIA</a></li>
  <li><a href="javascript:void(0)" onclick="cargarLista(7)">CONTABILIDAD</a></li>
  <li><a href="javascript:void(0)" onclick="cargarLista(8)">INFORMES</a></li>
  <li><a href="javascript:void(0)" onclick="cargarLista(9)">CONFIGURACION</a></li>  
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
            <th ><h4><b>Modulo de RRHH</b></h4></th>
            <th><b>CREAR</b></th>
            <th><b>EDITAR</b></th>
            <th><b>VER</b></th>
            <th><b>ELIMINAR</b></th>                
        </tr>
        <tr>
            <td>Sub modulo de Empleados </td>
            <td>
                @if(in_array('crear_empleados',$permisos) )
                    {!!Form::checkbox('crear_empleados','crear_empleados',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_empleados")','checked'])!!}
                @else
                    {!!Form::checkbox('crear_empleados','crear_empleados',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_empleados")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_empleados',$permisos) )
                {!!Form::checkbox('editar_empleados','editar_empleados',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_empleados")','checked'])!!}
                @else
                {!!Form::checkbox('editar_empleados','editar_empleados',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_empleados")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_empleados',$permisos) )
                    {!!Form::checkbox('ver_empleados','ver_empleados',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_empleados")','checked'])!!}
                @else
                    {!!Form::checkbox('ver_empleados','ver_empleados',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_empleados")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_empleados',$permisos) )
                    {!!Form::checkbox('eliminar_empleados','eliminar_empleados',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_empleados")','checked'])!!}
                @else
                    {!!Form::checkbox('eliminar_empleados','eliminar_empleados',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_empleados")'])!!}
                @endif
                </td>
        </tr>
        <tr>
            <td>Sub modulo de Tecnicos</td>
            <td>
                @if(in_array('crear_tecnicos',$permisos) )
                {!!Form::checkbox('crear_tecnicos','crear_tecnicos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_tecnicos")','checked'])!!}
                @else
                {!!Form::checkbox('crear_tecnicos','crear_tecnicos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_tecnicos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_tecnicos',$permisos) )
                {!!Form::checkbox('editar_tecnicos','editar_tecnicos',null,['class'=>'checkbox-inline','disabled'=>'disabled','onclick'=>'asigpermiso("editar_tecnicos")','checked'])!!}
                @else
                {!!Form::checkbox('editar_tecnicos','editar_tecnicos',null,['class'=>'checkbox-inline','disabled'=>'disabled','onclick'=>'asigpermiso("editar_tecnicos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_tecnicos',$permisos) )
                {!!Form::checkbox('ver_tecnicos','ver_tecnicos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_tecnicos")','checked'])!!}
                @else
                {!!Form::checkbox('ver_tecnicos','ver_tecnicos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_tecnicos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_tecnicos',$permisos) )
                {!!Form::checkbox('eliminar_tecnicos','eliminar_tecnicos',null,['class'=>'checkbox-inline','disabled'=>'disabled','onclick'=>'asigpermiso("eliminar_tecnicos")','checked'])!!}
                @else
                {!!Form::checkbox('eliminar_tecnicos','eliminar_tecnicos',null,['class'=>'checkbox-inline','disabled'=>'disabled','onclick'=>'asigpermiso("eliminar_tecnicos")'])!!}
                @endif
                </td>
        </tr>        
        <tr>
            <td>Sub modulo de Areas de la Cooperativa</td>
            <td>
                @if(in_array('crear_areas',$permisos) )
                {!!Form::checkbox('crear_areas','crear_areas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_areas")','checked'])!!}
                @else
                {!!Form::checkbox('crear_areas','crear_areas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_areas")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_areas',$permisos) )
                {!!Form::checkbox('editar_areas','editar_areas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_areas")','checked'])!!}
                @else
                {!!Form::checkbox('editar_areas','editar_areas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_areas")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_areas',$permisos) )
                {!!Form::checkbox('ver_areas','ver_areas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_areas")','checked'])!!}
                @else
                {!!Form::checkbox('ver_areas','ver_areas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_areas")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_areas',$permisos) )
                {!!Form::checkbox('eliminar_areas','eliminar_areas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_areas")','checked'])!!}
                @else
                {!!Form::checkbox('eliminar_areas','eliminar_areas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_areas")'])!!}
                @endif
                </td>
        </tr>        
        <tr>
            <td>Sub modulo de Cargos de Empleados</td>
            <td>
                @if(in_array('crear_cargos',$permisos) )
                {!!Form::checkbox('crear_cargos','crear_cargos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_cargos")','checked'])!!}
                @else
                {!!Form::checkbox('crear_cargos','crear_cargos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_cargos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_cargos',$permisos) )
                {!!Form::checkbox('editar_cargos','editar_cargos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_cargos")','checked'])!!}
                @else
                {!!Form::checkbox('editar_cargos','editar_cargos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_cargos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_cargos',$permisos) )
                {!!Form::checkbox('ver_cargos','ver_cargos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_cargos")','checked'])!!}
                @else
                {!!Form::checkbox('ver_cargos','ver_cargos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_cargos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_cargos',$permisos) )
                {!!Form::checkbox('eliminar_cargos','eliminar_cargos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_cargos")','checked'])!!}
                @else
                {!!Form::checkbox('eliminar_cargos','eliminar_cargos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_cargos")'])!!}
                @endif
                </td>
        </tr>
        <tr>
            <td>Sub modulo de Almacen</td>
            <td>
                @if(in_array('crear_almacen',$permisos) )
                {!!Form::checkbox('crear_almacen','crear_almacen',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_almacen")','checked'])!!}
                @else
                {!!Form::checkbox('crear_almacen','crear_almacen',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_almacen")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_almacen',$permisos) )
                {!!Form::checkbox('editar_almacen','editar_almacen',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_almacen")','checked'])!!}
                @else
                {!!Form::checkbox('editar_almacen','editar_almacen',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_almacen")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_almacen',$permisos) )
                {!!Form::checkbox('ver_almacen','ver_almacen',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_almacen")','checked'])!!}
                @else
                {!!Form::checkbox('ver_almacen','ver_almacen',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_almacen")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_almacen',$permisos) )
                {!!Form::checkbox('eliminar_almacen','eliminar_almacen',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_almacen")','checked'])!!}
                @else
                {!!Form::checkbox('eliminar_almacen','eliminar_almacen',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_almacen")'])!!}
                @endif
                </td>
        </tr> 
        
        <tr>
            <td>Sub modulo de Empresa</td>
            <td>
                @if(in_array('crear_empresas',$permisos) )
                {!!Form::checkbox('crear_empresas','crear_empresas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_empresas")','checked'])!!}
                @else
                {!!Form::checkbox('crear_empresas','crear_empresas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_empresas")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_empresas',$permisos) )
                {!!Form::checkbox('editar_empresas','editar_empresas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_empresas")','checked'])!!}
                @else
                {!!Form::checkbox('editar_empresas','editar_empresas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_empresas")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_empresas',$permisos) )
                {!!Form::checkbox('ver_empresas','ver_empresas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_empresas")','checked'])!!}
                @else
                {!!Form::checkbox('ver_empresas','ver_empresas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_empresas")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_empresas',$permisos) )
                {!!Form::checkbox('eliminar_empresas','eliminar_empresas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_empresas")','checked'])!!}
                @else
                {!!Form::checkbox('eliminar_empresas','eliminar_empresas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_empresas")'])!!}
                @endif
                </td>
        </tr> 
    </tbody>
</table>
{!! Form::close() !!}
