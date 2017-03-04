@extends('RRHH.masterempleados')
@section('contentheader_title')
    AREAS
@stop
@section('main-content')

<div class="container spark-screen">
    <div class="row">
        <div class="col-md-11 col-md-offset-0">
            <div class="panel panel-primary">                
                <div class="panel-heading">
                    <input type="reset" value="Nuevo" class="btn btn-primary btn-sm m-t-10" onclick="mostrar('SI')">
                    LISTA DE AREAS</div>
                {!! Form::open(['id'=>'form']) !!}
                <div class="panel-body"> 
                    <div class="col-md-4">  
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                        <input type="hidden" id="id">  
                        {!! Form::label('area','Area:',['class' => 'control-label col-xs-1'])!!}                    
                        {!! Form::text('area',null,['id'=>'area','class'=>'form-control','placeholder'=>'Nombre del Area'])!!}                                                                            
                        {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegArea', 'class'=>'btn btn-primary btn-sm m-t-10'])!!}                        
                    </div>
                    {!! Form::close() !!} 
                    <div class="col-md-8">
                        <table class="table table-responsive" id="myTable" >
                            <thead>                                                            
                            <th>CODIGO</th> 
                            <th>AREAS</th>                                                    
                            <th>ACCIONES</th>            
                            </thead>
                            <tbody>
                                @foreach($areas as $area)
                                {{--*/ @$name = str_replace(' ','&nbsp;', $area->area) /*--}}
                                <tr>                                            
                                    <td>{{$area->id}}</td>
                                    <td>{{$area->area}}</td>                                                        
                                    <td>                                          
                                        <a href="#"  OnClick='EdiArea({{$area->id}});' data-toggle='modal' data-target='#myModal'><span class="glyphicon glyphicon-pencil"data-toggle="tooltip" data-placement="top" title="Editars"></span></a>
                                        <a href="#" onclick="EliArea('{{$area->id}}','{{$name}}')" ><span data-toggle="tooltip" data-placement="top" title="Eliminar" class="glyphicon glyphicon-remove"></span></a>                                                            
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
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">ACTUALIZAR DATO</h4>
        </div>
          <div class="modal-body">
              {!! Form::open(['id'=>'form1']) !!}
              <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
              {!! Form::label('area','Area:',['class' => 'control-label col-xs-1'])!!}                    
              {!! Form::text('area',null,['id'=>'area_1','class'=>'form-control','placeholder'=>'Nombre del Area'])!!}                                        
              {!! Form::close() !!} 
          </div>
        <div class="modal-footer">
            {!!link_to('#', $title='Actualizar', $attributes = ['id'=>'ActArea', 'class'=>'btn btn-primary btn-sm m-t-10'])!!} 
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

  
</script>
@stop