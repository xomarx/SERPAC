@extends('socios.mastersocio')
@section('contentheader_title')
    CARGOS DIRECTIVOS
@stop
@section('main-content')

<div class="box-body">
    @permission(['crear directivos','editar directivos'])
    <div class="col-md-4">
        <div class="box box-solid box-primary">
            <div class="box-header">
                <h3 class="box-title">CARGO DIRECTIVO</h3>
            </div>
            {!! Form::open(['id'=>'formdirectivos']) !!}
            <div class="box-body">
                @include('mensajes.mensaje')                
                <input type="hidden" id="iddirectivo">
                {!! Form::label('directivo','Cargo Directivo:',['class' => 'control-label '])!!}                    
                {!! Form::text('cargo_directivo',null,['id'=>'cargo_directivo','class'=>'form-control','placeholder'=>'NOMBRE DEL CARGO DEL DIRECTIVO'])!!}   
                <div class="text-danger" id="error_directivo"></div>
            </div>
            <div class="box-footer">
                <input type="reset" value="Nuevo" class="btn btn-primary btn-sm m-t-10" id="nuevodirectivo">
                {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegDirectivo', 'class'=>'btn btn-primary btn-sm m-t-10'])!!}
            </div>
            {!! Form::close() !!} 
        </div>
    </div>
    @endpermission
    @permission('ver directivos')
    <div class="col-md-8">
        <div class="box box-solid box-primary">
            <div class="box-header">
                <h3 class="box-title">LISTA DE CARGOS DE DIRECTIVOS</h3>
            </div>
            <div class="box-body">
                <table class="table table-responsive" id="myTable" >
                    <thead>                                                            
                    <th>CODIGO</th> 
                    <th>CARGOS DIRECTIVOS</th>                                                    
                    <th>ACCIONES</th>            
                    </thead>
                    <tbody>
                        @foreach($directivos as $directivo)
                        {{--*/ @$name = str_replace(' ','&nbsp;', $directivo->cargo_directivo) /*--}}
                        <tr>                                            
                            <td>{{$directivo->id}}</td>
                            <td>{{$directivo->cargo_directivo}}</td>                                                        
                            <td>    
                                @permission('editar directivos')
                                <a href="#"  OnClick='EdDirectivo({{$directivo->id}});' class="btn-sm btn-primary"><span class="glyphicon glyphicon-pencil"data-toggle="tooltip" data-placement="top" title="Editars"></span></a>
                                @endpermission
                                @permission('eliminar directivos')
                                    <a href="#" onclick="EliDirectivo('{{$directivo->id}}','{{$name}}')" class="btn-sm btn-danger"><span data-toggle="tooltip" data-placement="top" title="Eliminar" class="glyphicon glyphicon-remove"></span></a>
                                @endpermission
                            </td>                    
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <section id="conten-modal"></section>
    @endpermission
</div>


@stop

