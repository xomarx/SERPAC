<div class="modal fade" id="modalrol" role="dialog">
    <div class="modal-dialog modal-primary">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close btn-sm" data-dismiss="modal">&times;</button>
                <h3>ROLES</h3>
            </div>
            <div class="modal-body form-horizontal">     
                <form  id="formrol" name="formrol" method="post"  action="NewRolUsuario"  class="form_rol">
                    <div class="alert alert-success" style="display: none;" id="msj_rol">
                        <strong id="txt_rol"></strong>
                    </div>                      
                    <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}" >
                    {!! Form::label('rol','Rol: ',['class'=>'control-label'])!!}
                    {!! Form::text('rol',null,['id'=>'rol','class'=>'form-control','placeholder'=>'Nombre del Rol'])!!}
                    <div class="text-red" id="error_rol"></div>
                    {!! Form::label('tag','Tag del Rol: ',['class'=>'control-label'])!!}
                    {!! Form::text('tag',null,['id'=>'tag','class'=>'form-control','placeholder'=>'tag del Rol - el mismo nombre que el rol pero en minuscula'])!!}
                    <div class="text-red" id="error_tag"></div>
                    {!! Form::label('descripcion','Descripcion: ',['class'=>'control-label'])!!}
                    {!! Form::textarea('descripcion',null,['id'=>'descripcion','class'=>'form-control','placeholder'=>'Descripcion del rol','rows'=>'3'])!!}
                    <div class="text-red" id="error_descripcion"></div>

                </form>                     
            </div>
            <div class="modal-footer">                              
                <a onclick="regrol(1)"  class="btn btn-dropbox" data-toggle="tooltip" data-placement="top" title="Rol de Usuarios">Registrar &nbsp;<span class="glyphicon glyphicon-floppy-save">  </span></a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>                    
        </div>
    </div>
</div>
