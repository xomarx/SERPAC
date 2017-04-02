@extends('RRHH.masterempleados')
@section('contentheader_title')
    AREAS
@stop
@section('main-content')

<div class="box box-solid">
    @permission(['crear areas','editar areas'])
    <div class="col-md-4">
        <div class="box box-solid box-primary">
            <div class="box-header">
            </div>
            <div class="box-body">
                @include('mensajes.mensaje')
                {!! Form::open(['id'=>'formArea']) !!}   
                <input type="hidden" name="idarea" id="idarea" />
                {!! Form::label('area','Area:',['class' => 'control-label'])!!}                    
                {!! Form::text('area',null,['id'=>'area','class'=>'form-control','placeholder'=>'Nombre del Area'])!!}
                <div class="text-danger" id="error-area"></div>
                {!! Form::close() !!} 
            </div>
            <div class="box-footer">
                <button type="button" class="btn btn-dropbox" id="nuevaarea">Nuevo</button>
                {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegArea', 'class'=>'btn btn-dropbox'])!!}                
            </div>
        </div>
    </div>
    @endpermission
    @permission('ver areas')
    <div class="col-md-8">
        <div class="box box-solid box-primary">    
            <div class="box-header">

            </div>
            <div class="box-body">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
                                @permission('editar areas')
                                <a href="#"  OnClick='EdiArea({{$area->id}});' data-toggle='modal' data-target='#myModal' class="btn-sm btn-primary"><span class="glyphicon glyphicon-pencil"data-toggle="tooltip" data-placement="top" title="Editars"></span></a>
                                @endpermission
                                @permission('eliminar areas')
                                <a href="#" onclick="EliArea('{{$area->id}}','{{$name}}')"  class="btn-sm btn-danger"><span data-toggle="tooltip" data-placement="top" title="Eliminar" class="glyphicon glyphicon-remove"></span></a>                                                            
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
      $("#menuRRHH").addClass('active');
      $("#subareas").addClass('active');
   });
</script>   

@stop
