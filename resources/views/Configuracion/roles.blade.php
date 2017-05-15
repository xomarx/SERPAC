<div class="modal fade" id="modal-form" role="dialog">
    <div class="modal-dialog modal-primary modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close btn-sm" data-dismiss="modal">&times;</button>
                <h3>ROL</h3>
            </div>
            <div class="modal-body form-horizontal">     
                {!!Form::open(['id'=>'formrol'])!!}
                <input type="hidden" id="id" name="id" />
                    @include('mensajes.mensaje')
                    {!! Form::label('rol','Rol: ',['class'=>'control-label'])!!}
                    {!! Form::text('rol',null,['id'=>'rol','class'=>'form-control','placeholder'=>'Nombre del Rol'])!!}
                    <div class="text-red" id="error_rol"></div>
                    {!! Form::label('tag','Tag del Rol: ',['class'=>'control-label'])!!}
                    {!! Form::text('tag',null,['id'=>'tag','class'=>'form-control','placeholder'=>'nombre similar al rol'])!!}
                    <div class="text-red" id="error_tag"></div>
                    {!! Form::label('descripcion','Descripcion: ',['class'=>'control-label'])!!}
                    {!! Form::textarea('descripcion',null,['id'=>'descripcion','class'=>'form-control','placeholder'=>'Descripcion del rol','rows'=>'3'])!!}
                    <div class="text-red" id="error_descripcion"></div>
                {!!Form::close()!!}                   
            </div>
            <div class="modal-footer">                              
                <a class="btn btn-dropbox" id="RegRol">Registrar </span></a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
            </div>                    
        </div>
    </div>
</div>
