<div class="modal fade" id="modalrol" role="dialog">
    <div class="modal-dialog modal-primary modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close btn-sm" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">GIROS DE CHEQUES</h3>
            </div>
            <div class="modal-body form-horizontal">     
                <!--{!! Form::open(['id'=>'formmovcheque','enctype'=>'multipart/form-data']) !!}-->
                <form action="{{url('/uploadcheque')}}" id="formmovcheque" method="POST" enctype="multipart/form-data">
                    <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}" >
                <input type="hidden" name="id" id="id"/>
                    @include('mensajes.mensaje')
                    <div class="col-md-2 col-md-offset-1">
                        <label class="radio-inline form-group" onclick="clicktipo(1);">
                        {!!  Form::radio('tipo','socio', null, ['class' => 'forma-control checkbox','id'=>'condicion']) !!} 
                        Socio</label> <br>
                        <label class="radio-inline form-group" onclick="clicktipo(2);">
                        {!!  Form::radio('tipo','empleado', null, ['class' => 'forma-control','id'=>'condicion']) !!} 
                        Empleado</label>
                    </div>                    
                    <div class="col-sm-6 ">
                        {!! Form::label('cheque','Cheque: ',['class'=>'control-label'])!!}                    
                        {!! Form::select('cheque',$cheques,null,['id'=>'cheque','class'=>'form-control','placeholder'=>'selecciona el Cheque']) !!}
                    <div class="text-red" id="error_rol"></div>
                    </div>
                    <div class="col-md-3">
                        {!! Form::label('numero','N° cheque: ',['class'=>'control-label'])!!}
                        {!! Form::text('numero',null,['id'=>'numero','class'=>'form-control text-center','placeholder'=>'N° de cheque','maxlength'=>4])!!}
                    <div class="text-red" id="error_tag"></div>
                    </div>    
                    <table width='100%'>
                        <tr>
                            <td>
                                {!! Form::label('dato','Empleado: ',['class'=>'control-label'])!!}
                                {!! Form::text('dato',null,['id'=>'dato','class'=>'form-control','placeholder'=>'Apellidos y nombres'])!!}                        
                                <div class="text-red" id="error_tag"></div>
                            </td>
                            <td class="col-md-2">
                                {!! Form::label('dni','D.N.I.: ',['class'=>'control-label'])!!}
                                {!! Form::text('dni',null,['id'=>'dni','class'=>'form-control','placeholder'=>'N° DNI','maxlength'=>8])!!}                        
                                <div class="text-red" id="error_tag"></div>

                            </td>
                            <td rowspan="2" class="col-md-5 ">
                                                                
                                {!! Form::label('cheque','Imagen del Cheque: ',['class'=>'control-label'])!!}                                
                                {!! Form::file('filecheque', ['class' => 'form-control','accept'=>'image/*','style'=>'display:none','id'=>'filecheque','onchange'=>'filechange(this)']) !!}
                                
                                <img src="{{url('img/acopagro.png')}}" onclick="cambiarimg()" id="imgcheque" class=" img-bordered img-responsive" data-toggle="tooltip" data-placement="top" title="Imagen del cheque"/>
                                
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                {!! Form::label('concepto','Concepto: ',['class'=>'control-label'])!!}
                                {!! Form::text('concepto',null,['id'=>'concepto','class'=>'form-control','placeholder'=>'Concepto del Giro de cheque'])!!}
                                <div class="text-red" id="error_tag"></div>
                            </td>
                        </tr>

                    </table>
                    
                  {!!Form::close()!!}
            </div>
            <div class="modal-footer">    
                <div class="col-md-12">
                    <a onclick="regmovCheque()" id="Regmodal" class="btn btn-dropbox" data-toggle="tooltip" data-placement="top" title="Rol de Usuarios">Registrar</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                
            </div>                    
        </div>
    </div>
</div>
