@extends('socios.mastersocio')
@section('contentheader_title')
    INMUEBLES
@stop
@section('main-content')

<div class="box-body ">
    @permission(['crear inmuebles','editar inmuebles'])
    <div class="col-md-4">
        <div class="box box-solid box-primary">

            <div class="box-header">
                <h3 class="box-title">INMUEBLES</h3>
            </div>
            {!! Form::open(['id'=>'forminmueble']) !!}
            <div class="box-body">
                @include('mensajes.mensaje')
                <input type="hidden" id="idinmueble">  
                {!! Form::label('nomre','Inmueble:',['class' => 'control-label col-xs-1'])!!}                    
                {!! Form::text('inmueble',null,['id'=>'inmueble','class'=>'form-control','placeholder'=>'Nombre del Inmueble'])!!} 
                <div class="text-danger" id="error_inmueble"></div>
            </div>
            <div class="box-footer">
                <input type="reset" value="Nuevo" class="btn btn-primary btn-sm m-t-10" id="nuevoinmueble">
                {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegInmueble', 'class'=>'btn btn-primary btn-sm m-t-10'])!!} 
            </div>
            {!! Form::close() !!} 
        </div>
    </div>
    @endpermission
    @permission('ver inmuebles')
    <div class="col-md-8">
        <div class="box box-solid box-primary">
            <div class="box-header">
                <h3 class="box-title">LISTA DE INMUEBLES</h3>
            </div>
            <div class="box-body">
                <table class="table table-responsive" id="myTable" >
                    <thead>                                                            
                    <th>CODIGO</th> 
                    <th>INMUEBLES</th>                                                    
                    <th>ACCIONES</th>            
                    </thead>
                    <tbody>
                        @foreach($inmuebles as $inmueble)
                        {{--*/ @$name = str_replace(' ','&nbsp;', $inmueble->inmueble) /*--}}
                        <tr>                                            
                            <td>{{$inmueble->id}}</td>
                            <td>{{$inmueble->inmueble}}</td>                                                        
                            <td>    
                                @permission('editar inmuebles')
                                <a href="javascropt:void(0);"  OnClick='EdInmueble({{$inmueble->id}});' class="btn-sm btn-primary"><span class="glyphicon glyphicon-pencil"data-toggle="tooltip" data-placement="top" title="Editars"></span></a>
                                @endpermission
                                @permission('eliminar inmuebles')
                                <a href="javascropt:void(0);" onclick="EliInmueble('{{$inmueble->id}}','{{$name}}')" class="btn-sm btn-danger"><span data-toggle="tooltip" data-placement="top" title="Eliminar" class="glyphicon glyphicon-remove"></span></a>
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
