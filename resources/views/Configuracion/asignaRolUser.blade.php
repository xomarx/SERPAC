<div class="modal fade" id="modalrol" role="dialog">
    <div class="modal-dialog modal-primary modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close btn-sm" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">ASIGNAR ROL</h3>
            </div>
            <div class="modal-body form-horizontal">     
                {!!Form::open(['id'=>'formasigrol'])!!}
                    @include('mensajes.mensaje')                                                            
                    <label><h3>Usuario: <b id="title-user"></b></h3></label>
                    <br>                  
                    {!! Form::label('rol','Asignar Rol: ',['class'=>'control-label'])!!}
                    {!! Form::select('rol',$roles,null,['id'=>'rol','class'=>'form-control','placeholder'=>'Seleccione un Rol']) !!}
                    <div class="text-red" id="error_rol"></div>                    
                {!!Form::close()!!}
            </div>
            <div class="modal-footer">                              
                <a class="btn btn-dropbox" onclick="rolUser()">Registrar &nbsp;<span class="glyphicon glyphicon-floppy-save">  </span></a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>                    
        </div>
    </div>
</div>
