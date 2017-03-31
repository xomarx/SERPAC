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
            <th ><h4><b>Modulo de Socios</b></h4></th>
            <th><b>CREAR</b></th>
            <th><b>EDITAR</b></th>
            <th><b>VER</b></th>
            <th><b>ELIMINAR</b></th>                
        </tr>
        <tr>
            <td>Sub modulo de Socios </td>
            <td>
                @if(in_array('crear_socios',$permisos) )
                    {!!Form::checkbox('crear_socios','crear_socios',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_socios")','checked'])!!}
                @else
                    {!!Form::checkbox('crear_socios','crear_socios',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_socios")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_socios',$permisos) )
                {!!Form::checkbox('editar_socios','editar_socios',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_socios")','checked'])!!}
                @else
                {!!Form::checkbox('editar_socios','editar_socios',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_socios")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_socios',$permisos) )
                    {!!Form::checkbox('ver_socios','ver_socios',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_socios")','checked'])!!}
                @else
                    {!!Form::checkbox('ver_socios','ver_socios',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_socios")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_socios',$permisos) )
                    {!!Form::checkbox('eliminar_socios','eliminar_socios',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_socios")','checked'])!!}
                @else
                    {!!Form::checkbox('eliminar_socios','eliminar_socios',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_socios")'])!!}
                @endif
                </td>
        </tr>
        <tr>
            <td>Sub modulo de Parientes/Beneficiarios</td>
            <td>
                @if(in_array('crear_parientes',$permisos) )
                {!!Form::checkbox('crear_parientes','crear_parientes',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_parientes")','checked'])!!}
                @else
                {!!Form::checkbox('crear_parientes','crear_parientes',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_parientes")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_parientes',$permisos) )
                {!!Form::checkbox('editar_parientes','editar_parientes',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_parientes")','checked'])!!}
                @else
                {!!Form::checkbox('editar_parientes','editar_parientes',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_parientes")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_parientes',$permisos) )
                {!!Form::checkbox('ver_parientes','ver_parientes',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_parientes")','checked'])!!}
                @else
                {!!Form::checkbox('ver_parientes','ver_parientes',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_parientes")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_parientes',$permisos) )
                {!!Form::checkbox('eliminar_parientes','eliminar_parientes',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_parientes")','checked'])!!}
                @else
                {!!Form::checkbox('eliminar_parientes','eliminar_parientes',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_parientes")'])!!}
                @endif
                </td>
        </tr>
        <tr>
            <td>Sub modulo de Transferencias de Socios</td>
            <td>
                @if(in_array('crear_transferencias',$permisos) )
                {!!Form::checkbox('crear_transferencias','crear_transferencias',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_transferencias")','checked'])!!}
                @else
                {!!Form::checkbox('crear_transferencias','crear_transferencias',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_transferencias")'])!!}
                @endif
                </td>
            <td></td>
            <td>
                @if(in_array('ver_transferencias',$permisos) )
                {!!Form::checkbox('ver_transferencias','ver_transferencias',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_transferencias")','checked'])!!}
                @else
                {!!Form::checkbox('ver_transferencias','ver_transferencias',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_transferencias")'])!!}
                @endif
                </td>
            <td></td>
        </tr>
        <tr>
            <td>Sub modulo de Fundos</td>
            <td>
                @if(in_array('crear_fundos',$permisos) )
                {!!Form::checkbox('crear_fundos','crear_fundos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_fundos")','checked'])!!}
                @else
                {!!Form::checkbox('crear_fundos','crear_fundos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_fundos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_fundos',$permisos) )
                {!!Form::checkbox('editar_fundos','editar_fundos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_fundos")','checked'])!!}
                @else
                {!!Form::checkbox('editar_fundos','editar_fundos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_fundos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_fundos',$permisos) )
                {!!Form::checkbox('ver_fundos','ver_fundos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_fundos")','checked'])!!}
                @else
                {!!Form::checkbox('ver_fundos','ver_fundos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_fundos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_fundos',$permisos) )
                {!!Form::checkbox('eliminar_fundos','eliminar_fundos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_fundos")','checked'])!!}
                @else
                {!!Form::checkbox('eliminar_fundos','eliminar_fundos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_fundos")'])!!}
                @endif
                </td>
        </tr>
        <tr>
            <td>Sub modulo de Asignacion de Delegados</td>
            <td>
                @if(in_array('crear_asigDelegados',$permisos) )
                {!!Form::checkbox('crear_asigDelegados','crear_asigDelegados',null,['class'=>'checkbox-inline','disabled'=>'disabled','onclick'=>'asigpermiso("crear_asigDelegados")','checked'])!!}
                @else
                {!!Form::checkbox('crear_asigDelegados','crear_asigDelegados',null,['class'=>'checkbox-inline','disabled'=>'disabled','onclick'=>'asigpermiso("crear_asigDelegados")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_asigDelegados',$permisos) )
                {!!Form::checkbox('editar_asigDelegados','editar_asigDelegados',null,['class'=>'checkbox-inline','disabled'=>'disabled','onclick'=>'asigpermiso("editar_asigDelegados")','checked'])!!}
                @else
                {!!Form::checkbox('editar_asigDelegados','editar_asigDelegados',null,['class'=>'checkbox-inline','disabled'=>'disabled','onclick'=>'asigpermiso("editar_asigDelegados")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_asigDelegados',$permisos) )
                {!!Form::checkbox('ver_asigDelegados','ver_asigDelegados',null,['class'=>'checkbox-inline','disabled'=>'disabled','onclick'=>'asigpermiso("ver_asigDelegados")','checked'])!!}
                @else
                {!!Form::checkbox('ver_asigDelegados','ver_asigDelegados',null,['class'=>'checkbox-inline','disabled'=>'disabled','onclick'=>'asigpermiso("ver_asigDelegados")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_asigDelegados',$permisos) )
                {!!Form::checkbox('eliminar_asigDelegados','eliminar_asigDelegados',null,['class'=>'checkbox-inline','disabled'=>'disabled','onclick'=>'asigpermiso("eliminar_asigDelegados")','checked'])!!}
                @else
                {!!Form::checkbox('eliminar_asigDelegados','eliminar_asigDelegados',null,['class'=>'checkbox-inline','disabled'=>'disabled','onclick'=>'asigpermiso("eliminar_asigDelegados")'])!!}
                @endif
                </td>
        </tr>
        <tr>
            <td>Sub modulo de Asignacion Directivos</td>
            <td>
                @if(in_array('crear_asigDirectivos',$permisos) )
                {!!Form::checkbox('crear_asigDirectivos','crear_asigDirectivos',null,['class'=>'checkbox-inline','disabled'=>'disabled','onclick'=>'asigpermiso("crear_asigDirectivos")','checked'])!!}
                @else
                {!!Form::checkbox('crear_asigDirectivos','crear_asigDirectivos',null,['class'=>'checkbox-inline','disabled'=>'disabled','onclick'=>'asigpermiso("crear_asigDirectivos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_asigDirectivos',$permisos) )
                {!!Form::checkbox('editar_asigDirectivos','editar_asigDirectivos',null,['class'=>'checkbox-inline','disabled'=>'disabled','onclick'=>'asigpermiso("editar_asigDirectivos")','checked'])!!}
                @else
                {!!Form::checkbox('editar_asigDirectivos','editar_asigDirectivos',null,['class'=>'checkbox-inline','disabled'=>'disabled','onclick'=>'asigpermiso("editar_asigDirectivos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_asigDirectivos',$permisos) )
                {!!Form::checkbox('ver_asigDirectivos','ver_asigDirectivos',null,['class'=>'checkbox-inline','disabled'=>'disabled','onclick'=>'asigpermiso("ver_asigDirectivos")','checked'])!!}
                @else
                {!!Form::checkbox('ver_asigDirectivos','ver_asigDirectivos',null,['class'=>'checkbox-inline','disabled'=>'disabled','onclick'=>'asigpermiso("ver_asigDirectivos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_asigDirectivos',$permisos) )
                {!!Form::checkbox('eliminar_asigDirectivos','eliminar_asigDirectivos',null,['class'=>'checkbox-inline','disabled'=>'disabled','onclick'=>'asigpermiso("eliminar_asigDirectivos")','checked'])!!}
                @else
                {!!Form::checkbox('eliminar_asigDirectivos','eliminar_asigDirectivos',null,['class'=>'checkbox-inline','disabled'=>'disabled','onclick'=>'asigpermiso("eliminar_asigDirectivos")'])!!}
                @endif
                </td>
        </tr>
        <tr>
            <td>Sub modulo de Cargos Delegados</td>
            <td>
                @if(in_array('crear_delegados',$permisos) )
                {!!Form::checkbox('crear_delegados','crear_delegados',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_delegados")','checked'])!!}
                @else
                {!!Form::checkbox('crear_delegados','crear_delegados',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_delegados")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_delegados',$permisos) )
                {!!Form::checkbox('editar_delegados','editar_delegados',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_delegados")','checked'])!!}
                @else
                {!!Form::checkbox('editar_delegados','editar_delegados',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_delegados")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_delegados',$permisos) )
                {!!Form::checkbox('ver_delegados','ver_delegados',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_delegados")','checked'])!!}
                @else
                {!!Form::checkbox('ver_delegados','ver_delegados',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_delegados")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_delegados',$permisos) )
                {!!Form::checkbox('eliminar_delegados','eliminar_delegados',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_delegados")','checked'])!!}
                @else
                {!!Form::checkbox('eliminar_delegados','eliminar_delegados',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_delegados")'])!!}
                @endif
                </td>
        </tr>
        <tr>
            <td>Sub modulo de Cargos Directivos</td>
            <td>
                @if(in_array('crear_directivos',$permisos) )
                {!!Form::checkbox('crear_directivos','crear_directivos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_directivos")','checked'])!!}
                @else
                {!!Form::checkbox('crear_directivos','crear_directivos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_directivos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_directivos',$permisos) )
                {!!Form::checkbox('editar_directivos','editar_directivos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_directivos")','checked'])!!}
                @else
                {!!Form::checkbox('editar_directivos','editar_directivos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_directivos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_directivos',$permisos) )
                {!!Form::checkbox('ver_directivos','ver_directivos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_directivos")','checked'])!!}
                @else
                {!!Form::checkbox('ver_directivos','ver_directivos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_directivos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_directivos',$permisos) )
                {!!Form::checkbox('eliminar_directivos','eliminar_directivos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_directivos")','checked'])!!}
                @else
                {!!Form::checkbox('eliminar_directivos','eliminar_directivos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_directivos")'])!!}
                @endif
                </td>
        </tr>
        <tr>
            <td>Sub modulo de floras</td>
            <td>
                @if(in_array('crear_floras',$permisos) )
                {!!Form::checkbox('crear_floras','crear_floras',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_floras")','checked'])!!}
                @else
                {!!Form::checkbox('crear_floras','crear_floras',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_floras")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_floras',$permisos) )
                {!!Form::checkbox('editar_floras','editar_floras',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_floras")','checked'])!!}
                @else
                {!!Form::checkbox('editar_floras','editar_floras',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_floras")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_floras',$permisos) )
                {!!Form::checkbox('ver_floras','ver_floras',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_floras")','checked'])!!}
                @else
                {!!Form::checkbox('ver_floras','ver_floras',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_floras")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_floras',$permisos) )
                {!!Form::checkbox('eliminar_floras','eliminar_floras',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_floras")','checked'])!!}
                @else
                {!!Form::checkbox('eliminar_floras','eliminar_floras',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_floras")'])!!}
                @endif
                </td>
        </tr>
        <tr>
            <td>Sub modulo de Faunas</td>
            <td>
                @if(in_array('crear_faunas',$permisos) )
                {!!Form::checkbox('crear_faunas','crear_faunas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_faunas")','checked'])!!}
                @else
                {!!Form::checkbox('crear_faunas','crear_faunas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_faunas")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_faunas',$permisos) )
                {!!Form::checkbox('editar_faunas','editar_faunas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_faunas")','checked'])!!}
                @else
                {!!Form::checkbox('editar_faunas','editar_faunas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_faunas")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_faunas',$permisos) )
                {!!Form::checkbox('ver_faunas','ver_faunas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_faunas")','checked'])!!}
                @else
                {!!Form::checkbox('ver_faunas','ver_faunas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_faunas")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_faunas',$permisos) )
                {!!Form::checkbox('eliminar_faunas','eliminar_faunas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_faunas")','checked'])!!}
                @else
                {!!Form::checkbox('eliminar_faunas','eliminar_faunas',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_faunas")'])!!}
                @endif
                </td>
        </tr>
        <tr>
            <td>Sub modulo de Inmuebles</td>
            <td>
                @if(in_array('crear_inmuebles',$permisos) )
                {!!Form::checkbox('crear_inmuebles','crear_inmuebles',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_inmuebles")','checked'])!!}
                @else
                {!!Form::checkbox('crear_inmuebles','crear_inmuebles',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_inmuebles")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_inmuebles',$permisos) )
                {!!Form::checkbox('editar_inmuebles','editar_inmuebles',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_inmuebles")','checked'])!!}
                @else
                {!!Form::checkbox('editar_inmuebles','editar_inmuebles',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_inmuebles")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_inmuebles',$permisos) )
                {!!Form::checkbox('ver_inmuebles','ver_inmuebles',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_inmuebles")','checked'])!!}
                @else
                {!!Form::checkbox('ver_inmuebles','ver_inmuebles',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_inmuebles")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_inmuebles',$permisos) )
                {!!Form::checkbox('eliminar_inmuebles','eliminar_inmuebles',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_inmuebles")','checked'])!!}
                @else
                {!!Form::checkbox('eliminar_inmuebles','eliminar_inmuebles',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_inmuebles")'])!!}
                @endif
                </td>
        </tr>
        <tr>
            <td>Sub modulo de Departamento</td>
            <td>
                @if(in_array('crear_departamentos',$permisos) )
                {!!Form::checkbox('crear_departamentos','crear_departamentos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_departamentos")','checked'])!!}
                @else
                {!!Form::checkbox('crear_departamentos','crear_departamentos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_departamentos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_departamentos',$permisos) )
                {!!Form::checkbox('editar_departamentos','editar_departamentos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_departamentos")','checked'])!!}
                @else
                {!!Form::checkbox('editar_departamentos','editar_departamentos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_departamentos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_departamentos',$permisos) )
                {!!Form::checkbox('ver_departamentos','ver_departamentos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_departamentos")','checked'])!!}
                @else
                {!!Form::checkbox('ver_departamentos','ver_departamentos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_departamentos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_departamentos',$permisos) )
                {!!Form::checkbox('eliminar_departamentos','eliminar_departamentos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_departamentos")','checked'])!!}
                @else
                {!!Form::checkbox('eliminar_departamentos','eliminar_departamentos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_departamentos")'])!!}
                @endif
                </td>
        </tr>
        <tr>
            <td>Sub modulo de Provincia</td>
            <td>
                @if(in_array('crear_provincias',$permisos) )
                {!!Form::checkbox('crear_provincias','crear_provincias',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_provincias")','checked'])!!}
                @else
                {!!Form::checkbox('crear_provincias','crear_provincias',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_provincias")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_provincias',$permisos) )
                {!!Form::checkbox('editar_provincias','editar_provincias',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_provincias")','checked'])!!}
                @else
                {!!Form::checkbox('editar_provincias','editar_provincias',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_provincias")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_provincias',$permisos) )
                {!!Form::checkbox('ver_provincias','ver_provincias',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_provincias")','checked'])!!}
                @else
                {!!Form::checkbox('ver_provincias','ver_provincias',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_provincias")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_provincias',$permisos) )
                {!!Form::checkbox('eliminar_provincias','eliminar_provincias',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_provincias")','checked'])!!}
                @else
                {!!Form::checkbox('eliminar_provincias','eliminar_provincias',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_provincias")'])!!}
                @endif
                </td>
        </tr>
        <tr>
            <td>Sub modulo de Distrito</td>
            <td>
                @if(in_array('crear_distritos',$permisos) )
                {!!Form::checkbox('crear_distritos','crear_distritos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_distritos")','checked'])!!}
                @else
                {!!Form::checkbox('crear_distritos','crear_distritos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_distritos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_distritos',$permisos) )
                {!!Form::checkbox('editar_distritos','editar_distritos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_distritos")','checked'])!!}
                @else
                {!!Form::checkbox('editar_distritos','editar_distritos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_distritos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_distritos',$permisos) )
                {!!Form::checkbox('ver_distritos','ver_distritos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_distritos")','checked'])!!}
                @else
                {!!Form::checkbox('ver_distritos','ver_distritos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_distritos")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_distritos',$permisos) )
                {!!Form::checkbox('eliminar_distritos','eliminar_distritos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_distritos")','checked'])!!}
                @else
                {!!Form::checkbox('eliminar_distritos','eliminar_distritos',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_distritos")'])!!}
                @endif
                </td>
        </tr>
        <tr>
            <td>Sub modulo de Comite Central</td>
            <td>
                @if(in_array('crear_central',$permisos) )
                {!!Form::checkbox('crear_central','crear_central',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_central")','checked'])!!}
                @else
                {!!Form::checkbox('crear_central','crear_central',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_central")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_central',$permisos) )
                {!!Form::checkbox('editar_central','editar_central',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_central")','checked'])!!}
                @else
                {!!Form::checkbox('editar_central','editar_central',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_central")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_central',$permisos) )
                {!!Form::checkbox('ver_central','ver_central',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_central")','checked'])!!}
                @else
                {!!Form::checkbox('ver_central','ver_central',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_central")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_central',$permisos) )
                {!!Form::checkbox('eliminar_central','eliminar_central',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_central")','checked'])!!}                
                @else
                {!!Form::checkbox('eliminar_central','eliminar_central',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_central")'])!!}
                @endif
                </td>
        </tr>
        <tr>
            <td>Sub modulo de Comite Local</td>
            <td>
                @if(in_array('crear_local',$permisos) )
                {!!Form::checkbox('crear_local','crear_local',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_local")','checked'])!!}
                @else
                {!!Form::checkbox('crear_local','crear_local',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("crear_local")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('editar_local',$permisos) )
                {!!Form::checkbox('editar_local','editar_local',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_local")','checked'])!!}
                @else
                {!!Form::checkbox('editar_local','editar_local',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("editar_local")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('ver_local',$permisos) )
                {!!Form::checkbox('ver_local','ver_local',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_local")','checked'])!!}
                @else
                {!!Form::checkbox('ver_local','ver_local',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("ver_local")'])!!}
                @endif
                </td>
            <td>
                @if(in_array('eliminar_local',$permisos) )
                {!!Form::checkbox('eliminar_local','eliminar_local',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_local")','checked'])!!}
                @else
                {!!Form::checkbox('eliminar_local','eliminar_local',null,['class'=>'checkbox-inline','onclick'=>'asigpermiso("eliminar_local")'])!!}
                @endif
                </td>
        </tr>
    </tbody>
</table>
{!! Form::close() !!}

    
