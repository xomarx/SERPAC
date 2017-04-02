@extends('RRHH.masterempleados')
@section('contentheader_title')
CARGOS DE EMPLEADOS
@stop
@section('main-content')

<div class="box box-solid">
    @permission(['crear cargos','editar cargos'])
    <div class="col-md-4">
        <div class="box box-solid box-primary">
            <div class="box-header">
            </div>
            <div class="box-body">                               
                @include('mensajes.mensaje')
                {!! Form::open(['id'=>'formcargos']) !!}     
                <input type="hidden" name="idcargo" id="idarea" />
                {!! Form::label('cargo','Cargo:',['class' => 'control-label'])!!}                    
                {!! Form::text('cargo',null,['id'=>'cargo','class'=>'form-control','placeholder'=>'Nombre del Cargo'])!!}
                <div class="text-danger" id="error-cargo"></div>
                {!! Form::close() !!} 
            </div>
            <div class="box-footer">
                <button type="button" class="btn btn-dropbox" id="nuevaarea">Nuevo</button>
                {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegCargo', 'class'=>'btn btn-dropbox'])!!}                
            </div>
        </div>
    </div>
    @endpermission
    @permission('ver cargos')
    <div class="col-md-8">
        <div class="box box-solid box-primary">    
            <div class="box-header">

            </div>
            <div class="box-body">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <table class="table table-responsive table-hover" id="myTable" >
                    <thead>                                                            
                    <th>CODIGO</th> 
                    <th>CARGO</th>                                                    
                    <th>ACCIONES</th>            
                    </thead>
                    <tbody>
                        @foreach($cargos as $cargo)
                        {{--*/ @$name = str_replace(' ','&nbsp;', $cargo->cargo) /*--}}
                        <tr>                                            
                            <td>{{$cargo->id}}</td>
                            <td>{{$cargo->cargo}}</td>                                                        
                            <td>    
                                @permission('editar cargos')
                                <a href="#"  OnClick='EdiCargo({{$cargo->id}});' data-toggle='modal' data-target='#myModal' class="btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"data-toggle="tooltip" data-placement="top" title="Editars"></span></a>
                                @endpermission
                                @permission('eliminar cargos')
                                <a href="#" onclick="EliCArgo('{{$cargo->id}}','{{$name}}')" class="btn-xs btn-danger"><span data-toggle="tooltip" data-placement="top" title="Eliminar" class="glyphicon glyphicon-remove"></span></a>
                                @endpermission
                            </td>                    
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endpermission
<section id="conten-modal"></section>
</div>

@endsection

@section('script')
<script>
   $(document).ready(function (){
      $("#subcargos").addClass('active');
    $("#menuRRHH").addClass('active');
   });
</script>   

@stop


