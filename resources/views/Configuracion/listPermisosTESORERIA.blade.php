<ul class="pager "> 
  <li><a href="javascript:void(0)" onclick="cargarLista(1)" >SOCIOS</a></li>
  <li><a href="javascript:void(0)" onclick="cargarLista(2)">RRHH</a></li>
  <li><a href="javascript:void(0)" onclick="cargarLista(3)" >ACOPIO</a></li>
  <li><a href="javascript:void(0)" onclick="cargarLista(4)">CREDITOS</a></li>
  <li><a href="javascript:void(0)" onclick="cargarLista(5)">CERTIFICACION</a></li>
  <li><a href="javascript:void(0)" onclick="cargarLista(6)" class="bg-blue-gradient">TESORERIA</a></li>
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
            <th ><h4><b>Modulo de Tesoreria</b></h4></th>
            <th><b>CREAR</b></th>
            <th><b>EDITAR</b></th>
            <th><b>VER</b></th>
            <th><b>ELIMINAR</b></th>                
        </tr>
        <tr>
            <td>Sub modulo de Apertura - Cierre de Caja </td>
            <td>
                @if(in_array('crear_caja',$permisos) )
                    {!!Form::checkbox('crear_caja','crear_caja',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_caja")','checked'])!!}
                @else
                    {!!Form::checkbox('crear_caja','crear_caja',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_caja")'])!!}
                @endif
                </td>
            <td>                
                {!!Form::checkbox('editar','editar_distribucion',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}                
            </td>
            <td>
                 @if(in_array('ver_caja',$permisos) )
                    {!!Form::checkbox('ver_caja','ver_caja',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_caja")','checked'])!!}
                @else
                    {!!Form::checkbox('ver_caja','ver_caja',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_caja")'])!!}
                @endif
                </td>
            <td>
                 {!!Form::checkbox('eliminar','editar_distribucion',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}
                </td>
        </tr>
        <tr>
            <td>Sub modulo de Distribucion de Acopio </td>
            <td>
                @if(in_array('crear_distribucion',$permisos) )
                    {!!Form::checkbox('crear_distribucion','crear_distribucion',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_distribucion")','checked'])!!}
                @else
                    {!!Form::checkbox('crear_distribucion','crear_distribucion',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_distribucion")'])!!}
                @endif
                </td>
            <td>
                
                {!!Form::checkbox('editar_distribucion','editar_distribucion',null,['class'=>'checkbox-inline','disabled'=>'disabled'])!!}                
                </td>
            <td>
                @if(in_array('ver_distribucion',$permisos) )
                    {!!Form::checkbox('ver_distribucion','ver_distribucion',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_distribucion")','checked'])!!}
                @else
                    {!!Form::checkbox('ver_distribucion','ver_distribucion',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_distribucion")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_distribucion',$permisos) )
                    {!!Form::checkbox('eliminar_distribucion','eliminar_distribucion',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_distribucion")','checked'])!!}
                @else
                    {!!Form::checkbox('eliminar_distribucion','eliminar_distribucion',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_distribucion")'])!!}
                @endif
                </td>
        </tr>
        <tr>
            <td>Sub modulo de Movimientos de cheques</td>
            <td>
                @if(in_array('crear_movimientos',$permisos) )
                {!!Form::checkbox('crear_movimientos','crear_movimientos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_movimientos")','checked'])!!}
                @else
                {!!Form::checkbox('crear_movimientos','crear_movimientos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_movimientos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_movimientos',$permisos) )
                {!!Form::checkbox('editar_movimientos','editar_movimientos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_movimientos")','checked'])!!}
                @else
                {!!Form::checkbox('editar_movimientos','editar_movimientos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_movimientos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_movimientos',$permisos) )
                {!!Form::checkbox('ver_movimientos','ver_movimientos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_movimientos")','checked'])!!}
                @else
                {!!Form::checkbox('ver_movimientos','ver_movimientos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_movimientos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_movimientos',$permisos) )
                {!!Form::checkbox('eliminar_movimientos','eliminar_movimientos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_movimientos")','checked'])!!}
                @else
                {!!Form::checkbox('eliminar_movimientos','eliminar_movimientos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_movimientos")'])!!}
                @endif
                </td>
        </tr>
        
        <tr>
            <td>Sub modulo de Movimiento de Dinero</td>
            <td>
                @if(in_array('crear_mov_dinero',$permisos) )
                {!!Form::checkbox('crear_mov_dinero','crear_mov_dinero',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_mov_dinero")','checked'])!!}
                @else
                {!!Form::checkbox('crear_mov_dinero','crear_mov_dinero',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_mov_dinero")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_adelantos',$permisos) )
                {!!Form::checkbox('editar_adelantos','editar_adelantos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_adelantos")','checked'])!!}
                @else
                {!!Form::checkbox('editar_adelantos','editar_adelantos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_adelantos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_adelantos',$permisos) )
                {!!Form::checkbox('ver_adelantos','ver_adelantos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_adelantos")','checked'])!!}
                @else
                {!!Form::checkbox('ver_adelantos','ver_adelantos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_adelantos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_adelantos',$permisos) )
                {!!Form::checkbox('eliminar_adelantos','eliminar_adelantos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_adelantos")','checked'])!!}
                @else
                {!!Form::checkbox('eliminar_adelantos','eliminar_adelantos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_adelantos")'])!!}
                @endif
                </td>
        </tr>
        
        <tr>
            <td>Sub modulo de Cheques</td>
            <td>
                @if(in_array('crear_cheques',$permisos) )
                {!!Form::checkbox('crear_cheques','crear_cheques',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_cheques")','checked'])!!}
                @else
                {!!Form::checkbox('crear_cheques','crear_cheques',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_cheques")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_cheques',$permisos) )
                {!!Form::checkbox('editar_cheques','editar_cheques',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_cheques")','checked'])!!}
                @else
                {!!Form::checkbox('editar_cheques','editar_cheques',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_cheques")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_cheques',$permisos) )
                {!!Form::checkbox('ver_cheques','ver_cheques',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_cheques")','checked'])!!}
                @else
                {!!Form::checkbox('ver_cheques','ver_cheques',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_cheques")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_cheques',$permisos) )
                {!!Form::checkbox('eliminar_cheques','eliminar_cheques',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_cheques")','checked'])!!}
                @else
                {!!Form::checkbox('eliminar_cheques','eliminar_cheques',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_cheques")'])!!}
                @endif
                </td>
        </tr>
    </tbody>
</table>
{!! Form::close() !!}