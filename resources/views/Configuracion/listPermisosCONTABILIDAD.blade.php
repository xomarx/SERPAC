<ul class="pager "> 
  <li><a href="javascript:void(0)" onclick="cargarLista(1)" >SOCIOS</a></li>
  <li><a href="javascript:void(0)" onclick="cargarLista(2)">RRHH</a></li>
  <li><a href="javascript:void(0)" onclick="cargarLista(3)" >ACOPIO</a></li>
  <li><a href="javascript:void(0)" onclick="cargarLista(4)" >CREDITOS</a></li>
  <li><a href="javascript:void(0)" onclick="cargarLista(5)">CERTIFICACION</a></li>
  <li><a href="javascript:void(0)" onclick="cargarLista(6)">TESORERIA</a></li>
  <li><a href="javascript:void(0)" onclick="cargarLista(7)" class="bg-blue-gradient">CONTABILIDAD</a></li>
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
            <th ><h4><b>Modulo de Contabilidad</b></h4></th>
            <th><b>CREAR</b></th>
            <th><b>EDITAR</b></th>
            <th><b>VER</b></th>
            <th><b>ELIMINAR</b></th>                
        </tr>
    </tbody>
</table>
{!! Form::close() !!}

