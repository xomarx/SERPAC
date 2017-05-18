@extends('Certificacion.masterCertificacion')
@section('contentheader_title')
    CONDICION
@stop
@section('main-content')
@permission(['crear condicion','editar condicion'])
<div class="col-md-5">
    <div class="box box-primary">
        <div class="box-body">
            {!!Form::open(['id'=>'formcondicion'])!!}
            <input type="hidden" name="id" id="id" />
            {!!Form::label('condicion','Condicion: ',['class'=>'control-label'])!!}
            {!!Form::text('condicion',null,['id'=>'condicion','class'=>'form-control','placeholder'=>'Condicion'])!!}
            <div class="text-danger" id="error-condicion"></div>
            {!!Form::label('descripcion','Descripcion: ',['class'=>'control-label'])!!}
            {!!Form::textarea('descripcion',null,['id'=>'descripcion','class'=>'form-control','rows'=>'3','placeholder'=>'Descripcion de la condicion'])!!}
            <div class="text-danger" id="error-descripcion"></div>            
            {!!Form::close()!!}
        </div>
        <div class="box-footer">
            <button type="reset" class="btn btn-dropbox">Nuevo</button>
            <a class="btn btn-dropbox" id="RegCondicion">Registrar</a>
        </div>
    </div>
    
</div>
@endpermission
@permission('ver condicion')
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
                        <a onclick="EditCondicion({{$condicion->id}})" class="btn-xs btn-primary" style="cursor: pointer" data-toggle='tooltip' title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
                        <a onclick="ElimCondicion({{$condicion->id}},{{$condicion->condicion}})" class="btn-xs btn-danger" style="cursor: pointer" data-toggle='tooltip' title="Eliminar"><i class="glyphicon glyphicon-remove"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endpermission
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