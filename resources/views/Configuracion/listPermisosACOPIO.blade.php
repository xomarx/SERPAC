<ul class="pager "> 
  <li><a href="javascript:void(0)" onclick="cargarLista(1)" >SOCIOS</a></li>
  <li><a href="javascript:void(0)" onclick="cargarLista(2)">RRHH</a></li>
  <li><a href="javascript:void(0)" onclick="cargarLista(3)" class="bg-blue-gradient">ACOPIO</a></li>
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
            <th ><h4><b>Modulo de Acopio</b></h4></th>
            <th><b>CREAR</b></th>
            <th><b>EDITAR</b></th>
            <th><b>VER</b></th>
            <th><b>ELIMINAR</b></th>                
        </tr>
        <tr>
            <td>Sub modulo de Fondos de Acopio </td>
            <td>
                @if(in_array('crear_fondos',$permisos) )
                    {!!Form::checkbox('crear_fondos','crear_fondos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_fondos")','checked'])!!}
                @else
                    {!!Form::checkbox('crear_fondos','crear_fondos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_fondos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_fondos',$permisos) )
                {!!Form::checkbox('editar_fondos','editar_fondos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_fondos")','checked'])!!}
                @else
                {!!Form::checkbox('editar_fondos','editar_fondos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_fondos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_fondos',$permisos) )
                    {!!Form::checkbox('ver_fondos','ver_fondos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_fondos")','checked'])!!}
                @else
                    {!!Form::checkbox('ver_fondos','ver_fondos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_fondos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_fondos',$permisos) )
                    {!!Form::checkbox('eliminar_fondos','eliminar_fondos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_fondos")','checked'])!!}
                @else
                    {!!Form::checkbox('eliminar_fondos','eliminar_fondos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_fondos")'])!!}
                @endif
                </td>
        </tr>
        <tr>
            <td>Sub modulo de Compras de Granos</td>
            <td>
                @if(in_array('crear_compras',$permisos) )
                {!!Form::checkbox('crear_compras','crear_compras',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_compras")','checked'])!!}
                @else
                {!!Form::checkbox('crear_compras','crear_compras',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_compras")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_compras',$permisos) )
                {!!Form::checkbox('editar_compras','editar_compras',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_compras")','checked'])!!}
                @else
                {!!Form::checkbox('editar_compras','editar_compras',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_compras")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_compras',$permisos) )
                {!!Form::checkbox('ver_compras','ver_compras',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_compras")','checked'])!!}
                @else
                {!!Form::checkbox('ver_compras','ver_compras',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_compras")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_compras',$permisos) )
                {!!Form::checkbox('eliminar_compras','eliminar_compras',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_compras")','checked'])!!}
                @else
                {!!Form::checkbox('eliminar_compras','eliminar_compras',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_compras")'])!!}
                @endif
                </td>
        </tr>
        
        <tr>
            <td>Sub modulo de Pagos</td>
            <td>
                @if(in_array('crear_pagos',$permisos) )
                {!!Form::checkbox('crear_pagos','crear_pagos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_pagos")','checked'])!!}
                @else
                {!!Form::checkbox('crear_pagos','crear_pagos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_pagos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_pagos',$permisos) )
                {!!Form::checkbox('editar_pagos','editar_pagos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_pagos")','checked'])!!}
                @else
                {!!Form::checkbox('editar_pagos','editar_pagos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_pagos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_pagos',$permisos) )
                {!!Form::checkbox('ver_pagos','ver_pagos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_pagos")','checked'])!!}
                @else
                {!!Form::checkbox('ver_pagos','ver_pagos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_pagos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_pagos',$permisos) )
                {!!Form::checkbox('eliminar_pagos','eliminar_pagos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_pagos")','checked'])!!}
                @else
                {!!Form::checkbox('eliminar_pagos','eliminar_pagos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_pagos")'])!!}
                @endif
                </td>
        </tr>
        
        <tr>
            <td>Sub modulo de Planilla Semanal</td>
            <td>
                @if(in_array('crear_semana',$permisos) )
                {!!Form::checkbox('crear_semana','crear_semana',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_semana")','checked'])!!}
                @else
                {!!Form::checkbox('crear_semana','crear_semana',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_semana")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_semana',$permisos) )
                {!!Form::checkbox('editar_semana','editar_semana',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_semana")','checked'])!!}
                @else
                {!!Form::checkbox('editar_semana','editar_semana',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_semana")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_semana',$permisos) )
                {!!Form::checkbox('ver_semana','ver_semana',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_semana")','checked'])!!}
                @else
                {!!Form::checkbox('ver_semana','ver_semana',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_semana")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_semana',$permisos) )
                {!!Form::checkbox('eliminar_semana','eliminar_semana',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_semana")','checked'])!!}
                @else
                {!!Form::checkbox('eliminar_semana','eliminar_semana',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_semana")'])!!}
                @endif
                </td>
        </tr>
        <tr>
            <td>Sub modulo de Planilla Mensual</td>
            <td>
                @if(in_array('crear_mensual',$permisos) )
                {!!Form::checkbox('crear_mensual','crear_mensual',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_mensual")','checked'])!!}
                @else
                {!!Form::checkbox('crear_mensual','crear_mensual',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_mensual")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_mensual',$permisos) )
                {!!Form::checkbox('editar_mensual','editar_mensual',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_mensual")','checked'])!!}
                @else
                {!!Form::checkbox('editar_mensual','editar_mensual',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_mensual")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_mensual',$permisos) )
                {!!Form::checkbox('ver_mensual','ver_mensual',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_mensual")','checked'])!!}
                @else
                {!!Form::checkbox('ver_mensual','ver_mensual',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_mensual")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_mensual',$permisos) )
                {!!Form::checkbox('eliminar_mensual','eliminar_mensual',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_mensual")','checked'])!!}
                @else
                {!!Form::checkbox('eliminar_mensual','eliminar_mensual',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_mensual")'])!!}
                @endif
                </td>
        </tr>
        <tr>
            <td>Sub modulo de Ventas Internas</td>
            <td>
                @if(in_array('crear_internas',$permisos) )
                {!!Form::checkbox('crear_internas','crear_internas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_internas")','checked'])!!}
                @else
                {!!Form::checkbox('crear_internas','crear_internas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_internas")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_internas',$permisos) )
                {!!Form::checkbox('editar_internas','editar_internas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_internas")','checked'])!!}
                @else
                {!!Form::checkbox('editar_internas','editar_internas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_internas")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_internas',$permisos) )
                {!!Form::checkbox('ver_internas','ver_internas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_internas")','checked'])!!}
                @else
                {!!Form::checkbox('ver_internas','ver_internas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_internas")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_internas',$permisos) )
                {!!Form::checkbox('eliminar_internas','eliminar_internas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_internas")','checked'])!!}
                @else
                {!!Form::checkbox('eliminar_internas','eliminar_internas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_internas")'])!!}
                @endif
                </td>
        </tr>
        <tr>
            <td>Sub modulo de Ventas Externas</td>
            <td>
                @if(in_array('crear_externas',$permisos) )
                {!!Form::checkbox('crear_externas','crear_externas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_externas")','checked'])!!}
                @else
                {!!Form::checkbox('crear_externas','crear_externas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_externas")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_externas',$permisos) )
                {!!Form::checkbox('editar_externas','editar_externas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_externas")','checked'])!!}
                @else
                {!!Form::checkbox('editar_externas','editar_externas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_externas")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_externas',$permisos) )
                {!!Form::checkbox('ver_externas','ver_faunas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_externas")','checked'])!!}
                @else
                {!!Form::checkbox('ver_externas','ver_faunas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_externas")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_externas',$permisos) )
                {!!Form::checkbox('eliminar_externas','eliminar_externas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_externas")','checked'])!!}
                @else
                {!!Form::checkbox('eliminar_externas','eliminar_externas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_externas")'])!!}
                @endif
                </td>
        </tr>
        <tr>
            <td>Sub modulo de Taras</td>
            <td>
                @if(in_array('crear_taras',$permisos) )
                {!!Form::checkbox('crear_taras','crear_taras',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_taras")','checked'])!!}
                @else
                {!!Form::checkbox('crear_taras','crear_taras',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_taras")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_taras',$permisos) )
                {!!Form::checkbox('editar_taras','editar_taras',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_taras")','checked'])!!}
                @else
                {!!Form::checkbox('editar_taras','editar_taras',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_taras")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_taras',$permisos) )
                {!!Form::checkbox('ver_taras','ver_taras',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_taras")','checked'])!!}
                @else
                {!!Form::checkbox('ver_taras','ver_taras',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_taras")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_taras',$permisos) )
                {!!Form::checkbox('eliminar_taras','eliminar_taras',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_taras")','checked'])!!}
                @else
                {!!Form::checkbox('eliminar_taras','eliminar_taras',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_taras")'])!!}
                @endif
                </td>
        </tr>
        <tr>
            <td>Sub modulo de Transportes</td>
            <td>
                @if(in_array('crear_transportes',$permisos) )
                {!!Form::checkbox('crear_transportes','crear_transportes',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_transportes")','checked'])!!}
                @else
                {!!Form::checkbox('crear_transportes','crear_transportes',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_transportes")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_transportes',$permisos) )
                {!!Form::checkbox('editar_transportes','editar_transportes',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_transportes")','checked'])!!}
                @else
                {!!Form::checkbox('editar_transportes','editar_transportes',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_transportes")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_transportes',$permisos) )
                {!!Form::checkbox('ver_transportes','ver_transportes',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_transportes")','checked'])!!}
                @else
                {!!Form::checkbox('ver_transportes','ver_transportes',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_transportes")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_transportes',$permisos) )
                {!!Form::checkbox('eliminar_transportes','eliminar_transportes',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_transportes")','checked'])!!}
                @else
                {!!Form::checkbox('eliminar_transportes','eliminar_transportes',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_transportes")'])!!}
                @endif
                </td>
        </tr>
        <tr>
            <td>Sub modulo de tipos de pagos</td>
            <td>
                @if(in_array('crear_tipopagos',$permisos) )
                {!!Form::checkbox('crear_tipopagos','crear_tipopagos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_tipopagos")','checked'])!!}
                @else
                {!!Form::checkbox('crear_tipopagos','crear_tipopagos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_tipopagos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_tipopagos',$permisos) )
                {!!Form::checkbox('editar_tipopagos','editar_tipopagos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_tipopagos")','checked'])!!}
                @else
                {!!Form::checkbox('editar_tipopagos','editar_tipopagos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_tipopagos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_tipopagos',$permisos) )
                {!!Form::checkbox('ver_tipopagos','ver_tipopagos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_tipopagos")','checked'])!!}
                @else
                {!!Form::checkbox('ver_tipopagos','ver_tipopagos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_tipopagos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_tipopagos',$permisos) )
                {!!Form::checkbox('eliminar_tipopagos','eliminar_tipopagos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_tipopagos")','checked'])!!}
                @else
                {!!Form::checkbox('eliminar_tipopagos','eliminar_tipopagos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_tipopagos")'])!!}
                @endif
                </td>
        </tr>
        <tr>
            <td>Sub modulo de Personas Juridicas</td>
            <td>
                @if(in_array('crear_personas',$permisos) )
                {!!Form::checkbox('crear_personas','crear_personas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_personas")','checked'])!!}
                @else
                {!!Form::checkbox('crear_personas','crear_personas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_personas")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_personas',$permisos) )
                {!!Form::checkbox('editar_personas','editar_personas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_personas")','checked'])!!}
                @else
                {!!Form::checkbox('editar_personas','editar_personas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_personas")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_personas',$permisos) )
                {!!Form::checkbox('ver_personas','ver_personas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_personas")','checked'])!!}
                @else
                {!!Form::checkbox('ver_personas','ver_personas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_personas")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_personas',$permisos) )
                {!!Form::checkbox('eliminar_personas','eliminar_personas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_personas")','checked'])!!}
                @else
                {!!Form::checkbox('eliminar_personas','eliminar_personas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_personas")'])!!}
                @endif
                </td>
        </tr>
        
    </tbody>
</table>
{!! Form::close() !!}

