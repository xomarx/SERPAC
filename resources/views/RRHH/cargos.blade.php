@extends('RRHH.masterempleados')
@section('contentheader_title')
    CARGOS
@stop
@section('main-content')

<div class="container spark-screen">
    <div class="row">
        <div class="col-md-11 col-md-offset-0">
            <div class="panel panel-primary">
                
                <div class="panel-heading">
                    <input type="reset" value="Nuevo" class="btn btn-default btn-sm m-t-10">
                    LISTA DE CARGOS                    
                </div>                
                <div class="panel-body"> 
                    {!! Form::open(['id'=>'form']) !!}
                    <div class="col-md-4">  
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                        <input type="hidden" id="id">  
                        {!! Form::label('cargo','Cargo:',['class' => 'control-label col-xs-1'])!!}                    
                        {!! Form::text('cargo',null,['id'=>'cargo','class'=>'form-control','placeholder'=>'Nombre del Cargo'])!!}                                                    
                        {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegCargo', 'class'=>'btn btn-primary btn-sm m-t-10'])!!}                                                                                                          
                    </div>
                    {!! Form::close() !!}
                    <div class="col-md-8">
                        <table class="table table-responsive" id="myTable" >
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
                                        <a href="#"  OnClick='EdiCargo({{$cargo->id}});' data-toggle='modal' data-target='#myModal'><span class="glyphicon glyphicon-pencil"data-toggle="tooltip" data-placement="top" title="Editars"></span></a>
                                        <a href="#" onclick="EliCArgo('{{$cargo->id}}','{{$name}}')" ><span data-toggle="tooltip" data-placement="top" title="Eliminar" class="glyphicon glyphicon-remove"></span></a>                                                            
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
</div>


<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content ">
            <div class="modal-header ">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">ACTUALIZAR DATO</h4>
            </div>
            {!! Form::open(['id'=>'form']) !!}
            <div class="modal-body">
                {!! Form::label('cargo','Cargo:',['class' => 'control-label col-xs-1'])!!}                    
                {!! Form::text('cargo',null,['id'=>'cargo_1','class'=>'form-control','placeholder'=>'Nombre del Cargo'])!!}                                                                            
            </div>
            {!! Form::close() !!} 
            <div class="modal-footer">
                {!!link_to('#', $title='Actualizar', $attributes = ['id'=>'ActCargo', 'class'=>'btn btn-primary btn-sm m-t-10'])!!} 
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    
 //*******************************   
    $(document).ready(function () {        
        $('#myTable').DataTable();
    });
//************************  REGISTRAR 
  

  //******************************
    
 
 

  
</script>
@stop