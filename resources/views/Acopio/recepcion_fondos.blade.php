@extends('Acopio.masteracopio')
@section('contentheader_title')
    RECEPCION DE FONDOS DE ACOPIO
@stop
@section('main-content')
<div class="box box-solid box-primary">
    <div class="box-header">
        <a id="nuevasucursal" data-toggle='modal' data-target='#modalsucursal' class="btn btn-primary btn-sm m-t-10" >INPORTAR DATOS  <span class="glyphicon glyphicon-import"data-toggle="tooltip" data-placement="top" title="Nueva Sucursal"></span></a>
    </div>
    <div class="box-body">
        <table class="table table-responsive" id="myTable" >
            <thead>
            <th>DNI</th>
            <th>TECNICO</th> 
            <th>CENTRO DE ACOPIO</th>                            
            <th>MONTO</th>
            <th>RECEPCION</th>
            <th>ESTADO</th>                                                      
            <th>ACCIONES</th>            
            </thead>
            <tbody>
                @foreach($recepcions as $recepcion)
                <tr>
                    <td>{{$recepcion->personas_dni }}</td>
                    <td>{{$recepcion->paterno }} {{$recepcion->materno }} {{ $recepcion->nombre }}</td>
                    <td>{{ $recepcion->sucursal }}</td>
                    <td>{{ $recepcion->monto }}</td>
                    <td>{{$recepcion->fecha }}</td>
                    <td>
                        @if($recepcion->estado == null)
                        {!! Form::select('estado',['CONFORME'=>'Conforme','NO CONFORME'=>'No Conforme'],null,['id'=>'estado','placeholder'=>'Seleccione']) !!}
                        @else
                        {!! Form::select('estado',['CONFORME'=>'Conforme','NO CONFORME'=>'No Conforme'],null,['id'=>'estado','placeholder'=>$recepcion->estado,'disabled']) !!}
                        @endif
                    </td>
                    <td>
                        <a href="#"   data-toggle='modal' data-target='#myModal'><span class="glyphicon glyphicon-eye-open"data-toggle="tooltip" data-placement="top" title="Ver"></span></a>
                        @if($recepcion->estado == null)
                        <a OnClick='RecepConform({{$recepcion->id}});'><span data-toggle="tooltip" data-placement="top" title="Grabar" class="glyphicon glyphicon-saved"></span></a>
                        @else
                        <a><span data-toggle="tooltip" data-placement="top" title="Grabar" class="glyphicon glyphicon-saved"></span></a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">RECEPCION DE FONDOS</h4>
      </div>
      <div class="modal-body">
          {!! Form::open(['id'=>'form']) !!}
          <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}" >
          <input type="hidden" id="id">
          <div class="col-lg-3 form-group-sm">
              {!! Form::label('monto','Monto:',['class' => 'control-label'])!!}                    
              {!! Form::text('monto',null,['id'=>'monto','class'=>'form-control','placeholder'=>'Departamento'])!!}
          </div>
          <div class="col-md-9">
              {!! Form::label('motivo','Motivo de No Conformidd:',['class' => 'control-label'])!!}                    
              {!! Form::textarea('motivo',null,['id'=>'motivo','class'=>'form-control','placeholder'=>'Descripcion','rows'=>'3'])!!}
          </div>                                                                                
          {!! Form::close() !!}                     
      </div>
      <div class="modal-footer">          
          {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegRecepcion', 'class'=>'btn btn-primary btn-sm m-t-10'])!!}
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
@stop
