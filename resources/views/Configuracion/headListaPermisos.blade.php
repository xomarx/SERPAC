<a onclick="activarmodal(2);" class="btn btn-dropbox" data-toggle="tooltip" data-placement="top" title="Nuevo Permiso">Nuevo Permiso &nbsp;<span class="glyphicon glyphicon-certificate">  </span></a>    
<div class="box box-body">
    
    <div class="box-header form-inline">
       {!! Form::label('rol','Rol: ',['class'=>'col-md-1'])!!}
       {!! Form::select('rol',$roles,null,['id'=>'rol','class'=>'col-md-8 form-control','onchange'=>'cargarLista(0)','placeholder'=>'Seleccione un Rol']) !!} &nbsp;&nbsp;&nbsp;       
    </div>
    <div class="box box-body" id="SelecListPermiso" >
        
    </div>
</div>

