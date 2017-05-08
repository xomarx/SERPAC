@extends('Certificacion.masterCertificacion')
@section('contentheader_title')
    CONDICION
@stop
@section('main-content')

<div class="col-md-5">
    <div class="box box-primary">
        <div class="box-body">
            {!!Form::open(['id'=>'formcondicion'])!!}
            {!!Form::label('condicion','Condicion: ',['class'=>'control-label'])!!}
            {!!Form::text('condicion',null,['id'=>'condicion','class'=>'form-control','placeholder'=>'Condicion'])!!}
            {!!Form::label('descripcion','Descripcion: ',['class'=>'control-label'])!!}
            {!!Form::textarea('descripcion',null,['id'=>'descripcion','class'=>'form-control','rows'=>'3','placeholder'=>'Descripcion de la condicion'])!!}
            <a class="btn btn-dropbox" >Registrar</a>
            {!!Form::close()!!}
        </div>
    </div>
</div>
<div class="col-md-7">
    <div class="box box-primary">
        <table class="table table-hover table-responsive table-condensed">
            <thead>
                <tr>
                    <th style="border-bottom-color: #0089db; ">CONDICION</th>
                    <th style="border-bottom-color: #0089db; ">DESCRIPCION</th>                    
                    <th style="border-bottom-color: #0089db; ">ACCION</th>
                </tr>
            </thead>
            <tbody>
                @foreach($condicions as $condicion)
                <tr>
                    <td>{{$condicion->condicion}}</td>
                    <td>{{$condicion->descripcion}}</td>
                    <td>
                        <a class="btn-xs btn-primary" style="cursor: pointer" data-toggle='tooltip' title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
                        <a class="btn-xs btn-danger" style="cursor: pointer" data-toggle='tooltip' title="Eliminar"><i class="glyphicon glyphicon-remove"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop

@section('script')
<script>
 $(document).ready(function(){
    $("#menucertificacion").addClass('active');
    $("#subbasicoCert").addClass('active');
    $("#subcondicion").addClass('active');
 });
</script>
@stop