@extends('tesoreria.mastertesoreria')
@section('contentheader_title')
    DISTRIBUCION DE FONDOS PARA ACOPIO
@stop
@section('main-content')

<div class="box box-solid box-primary">
    <div class="box-header" style="text-align: center;">        
        <a id="nuevadistribucion" style="float: left;" data-toggle='modal' data-target='#modaldistribucion' class="btn btn-dropbox btn-sm m-t-10" >NUEVO  <span class="glyphicon glyphicon-plus"data-toggle="tooltip" data-placement="top" title="Nueva Distribucion"></span></a>
        <h3 class="box-title" >LISTA DE DISTRIBUCION DE FONDOS</h3>
    </div>
    <div class="box-body">
        <table class="table table-responsive" id="myTable" >
                        <thead>
                        <th>DNI</th>
                        <th>TECNICO</th> 
                        <th>CENTRO DE ACOPIO</th>                            
                        <th>MONTO</th>
                        <th>FECHA</th>
                        <th>USUARIO</th>                                                           
                        <th>ACCIONES</th>            
                        </thead>
                        <tbody>
                            @foreach($distribucions as $distribucion)
                            {{--*/ @$name = str_replace(' ','&nbsp;', $distribucion->sucursal) /*--}}
                            <tr>                                                                                
                                <td>{{$distribucion->personas_dni}}</td>
                                <td>{{$distribucion->paterno}} {{$distribucion->materno}} {{$distribucion->nombre}}</td>
                                <td>{{$distribucion->sucursal}}</td>
                                <td>{{$distribucion->monto}}</td>
                                <td>{{$distribucion->fecha}}</td>                                    
                                <td>{{$distribucion->name}}</td>
                                <td>
                                    <a href="{{url('Tesoreria/Distribucion/ReciboTecnico') }}/{{$distribucion->id}}" class="btn-sm btn-success"><span class="glyphicon glyphicon-eye-open" data-toggle="tooltip" data-placement="top" title="Imprimir" ></span></a>
                                    <a href="{{url('Tesoreria/Distribucion/ReciboAcopio') }}/{{$distribucion->id}}" class="btn-sm btn-success"  ><span data-toggle="tooltip" data-placement="top" title="Imprimir" class="glyphicon glyphicon-print"></span></a>                                    
                                    <a href="javascript:void(0);" onclick="AnulDistribucion('{{$distribucion->id}}','{{$name}}')" class="btn-sm btn-danger" ><span data-toggle="tooltip" data-placement="top" title="Anular" class="glyphicon glyphicon-remove"></span></a>
                                </td>                    
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
    </div>
</div>

<div class="modal fade" id="modaldistribucion" role="dialog">
    <div class="modal-dialog modal-primary">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">NUEVA DISTRIBUCION</h4>
            </div>
            <div class="modal-body col-md-12 form-group-sm">
                <div class="alert alert-success" id="msjdistribucion" style="display: none;">
                    <strong id="msjtextodistribucion"></strong>
                </div>
                {!! Form::open(['id'=>'formfondosdistri']) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <div class="col-md-12">
                    <div class="col-sm-9">
                        {!! Form::label('texnicos','Extensionistas: ',['class'=>'control-label ']) !!}                    
                    </div>
                    <div class="col-md-3">
                        {!! Form::label('fecha','Fecha:',['class' => 'control-label'])!!}                    
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-sm-9">
                        {!! Form::select ('tecnico',$tecnicos,null,['id'=>'tecnico','required','placeholder'=>'selecciona un Extensionista']) !!} 
                        <div class="text-danger" id="error_tecnico"></div>
                    </div>
                    <div class="col-md-3">
                        {!! Form::text('fecha',null,['id'=>'fecha','class'=>'form-control','placeholder'=>'mes/dia/año'])!!}
                        <div class="text-danger" id="error_fecha"></div>
                    </div>
                </div>  
                
                <div class="col-md-12">
                    <div class="col-sm-9">
                        {!! Form::label('sucursal','Centro de Acopio:',['class' => 'control-label'])!!}                    
                    </div>
                    <div class="col-md-3">
                        {!! Form::label('monto','Monto:',['class' => 'control-label'])!!}                    
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-sm-9">
                        {!! Form::select('sucursal',[],null,['id'=>'sucursal','placeholder'=>'selecciona un Centro de Acopio']) !!}
                        <div class="text-danger" id="error_sucursal"></div>
                    </div>
                    <div class="col-md-3">
                        {!! Form::text('monto',null,['id'=>'monto','class'=>'form-control','placeholder'=>'S/. 0.00'])!!}
                        <div class="text-danger" id="error_monto"></div>
                    </div>
                </div>                                                                                                                                                 
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dropbox btn-sm m-t-10" data-dismiss="modal">Imprimir</button>
                {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegDistribucion', 'class'=>'btn btn-dropbox btn-sm m-t-10'])!!}
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
@stop

@section('script')
<script>
  
$("#fecha").datepicker({
        autoclose: true,
        language: "es"
    });   
$("#sucursal").select2({
    alloClear:true
});
$("#tecnico").select2({
    alloClear:true,    
});

$("#tecnico").change(function(event){
    var route = "{{url('Tesoreria/Distribucion-Fondos')}}/" + event.target.value;
    console.log(route);
    $.getJSON(route,function(data){
//        var cad="placeholder='seleccione un centro de acopio'";$("#sucursal").html(cad);
        $("#sucursal").empty();
        $("#sucursal").append("<option value=''>selecciona un Centro de Acopio</option>"); 
        $.each(data,function( index, value ){           
           $("#sucursal").append("<option value='"+index+"'>"+value+"</option>");           
        });        
    });
});

</script>
@stop