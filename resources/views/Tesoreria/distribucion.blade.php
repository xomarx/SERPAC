@extends('tesoreria.mastertesoreria')
@section('contentheader_title')
    DISTRIBUCION DE FONDOS PARA ACOPIO
@stop
@section('main-content')

<div class="container spark-screen ">
    <div class="row">
        <div class="col-md-11 col-md-offset-0">
            <div class="panel panel-default panel-primary">                
                <div class="panel-heading">                                                            
                    <a id="nuevasucursal" data-toggle='modal' data-target='#modaldistribucion' class="btn btn-primary btn-sm m-t-10" >NUEVO  <span class="glyphicon glyphicon-file"data-toggle="tooltip" data-placement="top" title="Nueva Sucursal"></span></a>
                </div>
                <div class="panel-body">                                                             
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
                                <td></td>
                                <td>
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Imprimir" ><span class="glyphicon glyphicon-print"></span></a>                                    
                                    <a href="#" onclick="AnulDistribucion('{{$distribucion->id}}','{{$name}}')" ><span data-toggle="tooltip" data-placement="top" title="Anular" class="glyphicon glyphicon-remove"></span></a>
                                </td>                    
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modaldistribucion" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">NUEVA DISTRIBUCION</h4>
            </div>
            <div class="modal-body col-md-12 form-group-sm">
                {!! Form::open(['id'=>'form']) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

                <div class="col-xs-9 form-group-sm">
                    {!! Form::label('texnicos','Extensionistas: ',['class'=>'control-label ']) !!}
                    {!! Form::select ('tecnico',$tecnicos,null,['id'=>'tecnico','required','placeholder'=>'selecciona un Extensionista']) !!}
                </div>
                <div class="col-md-3 form-group-sm">
                    {!! Form::label('fecha','Fecha:',['class' => 'control-label col-xs-1'])!!} 
                    {!! Form::text('fecha',null,['id'=>'fecha','class'=>'form-control','placeholder'=>'mes/dia/año'])!!}
                </div> 
                <div class="col-md-9" >
                    {!! Form::label('sucursal','Centro de Acopio:',['class' => 'control-label'])!!}      
                    {!! Form::select('sucursal',$sucursales,null,['id'=>'sucursal']) !!}  
                </div>
                <div class="col-md-3 form-group-sm">
                    {!! Form::label('monto','Monto:',['class' => 'control-label col-xs-1'])!!} 
                    {!! Form::text('monto',null,['id'=>'monto','class'=>'form-control','placeholder'=>'S/. 0.00'])!!}
                </div>                                                                                                                  
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Imprimir</button>
                {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegDistribucion', 'class'=>'btn btn-primary btn-sm m-t-10'])!!}
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
    alloClear:true
});


</script>
@stop