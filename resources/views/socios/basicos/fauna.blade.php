@extends('socios.mastersocio')
@section('contentheader_title')
    FAUNAS
@stop
@section('main-content')
<div class="box-body">
@permission(['crear faunas','editar faunas'])
<div class="col-md-4">
    <div class="box box-solid box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">REGISTRO DE ANIMALES</h3>
        </div><!-- /.box-header -->
        {!! Form::open(['id'=>'formfauna']) !!}
        <div class="box-body">            
            @include('mensajes.mensaje') 
            <input type="hidden" id="idfauna" name="idfauna">
            {!! Form::label('fauna','Fauna:',['class' => 'control-label col-xs-1'])!!}                    
            {!! Form::text('fauna',null,['id'=>'fauna','class'=>'form-control','placeholder'=>'Nombre de la Fauna'])!!}
            <div class="text-danger" id="error_fauna"></div>
        </div><!-- /.box-body -->
        <div class="box-footer">
            <input type="reset" value="Nuevo" id="nuefauna" class="btn btn-primary btn-sm m-t-10">
            {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegFauna', 'class'=>'btn btn-primary btn-sm m-t-10'])!!}               
        </div>
        {!! Form::close() !!}
    </div><!-- /.box -->
</div>
@endpermission
@permission('ver faunas')
<div class="col-md-8">
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">LISTA DE ANIMALES</h3>
        <div class="box-tools pull-right">
      <div class="has-feedback">
        <input type="text" class="form-control input-sm" placeholder="Buscar...">
        <span class="glyphicon glyphicon-search form-control-feedback"></span>
      </div>
    </div><!-- /.box-tools -->
    </div>
    <div class="box-body with-border">
    <table class="table table-responsive" id="myTable" >
        <thead>                                                            
        <th>CODIGO</th> 
        <th>FAUNAS</th>                                                    
        <th>ACCIONES</th>            
        </thead>
        <tbody>
            @foreach($faunas as $fauna)
            {{--*/ @$name = str_replace(' ','&nbsp;', $fauna->fauna) /*--}}
            <tr>                                            
                <td>{{$fauna->id}}</td>
                <td>{{$fauna->fauna}}</td>                                                        
                <td>       
                    @permission('editar faunas')
                    <a href="javascript:void(0);"  OnClick='EditFauna({{$fauna->id}});' class="btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"data-toggle="tooltip" data-placement="top" title="Editars"></span></a>
                    @endpermission
                    @permission('eliminar faunas')
                    <a href="javascript:void(0);" onclick="EliFauna('{{$fauna->id}}','{{$name}}')"class="btn-xs btn-danger" ><span data-toggle="tooltip" data-placement="top" title="Eliminar" class="glyphicon glyphicon-remove"></span></a>
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
</div>
<section id="conten-modal"></section>
@endsection

@section('script')

<script>
$(document).ready(function(){
        $("#menusocios").addClass('active');
        $("#subbasicos").addClass('active');
        $("#subfaunas").addClass('active');
    });
</script>
@stop
