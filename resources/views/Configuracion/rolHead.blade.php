<div class="box-tools form-inline">
    @permission('crear rol')
<a onclick="activarmodal(1);" class="btn btn-dropbox" data-toggle="tooltip" data-placement="top" title="Nuevo Rol">Nuevo Rol&nbsp;<span class="glyphicon glyphicon-education">  </span></a>
@endpermission
@permission('ver rol')
            {!! Form::text('buscar',null,['id'=>'buscaRol','class'=>'form-control','placeholder'=>'Buscar..'])!!} 
@endpermission
</div>
<div class="box box-body" id="lista-body">
    @include('Configuracion.rolList')
</div>
