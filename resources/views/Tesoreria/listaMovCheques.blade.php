@extends('tesoreria.mastertesoreria')
@section('contentheader_title')
    CHEQUES GIRADOS
@stop
@section('main-content')
<div class="box box-solid box-primary">
    <div class="box-header">
        <a onclick="activarmodal(4);" class="btn btn-dropbox" class="btn btn-dropbox" data-toggle="tooltip" data-placement="top" title="Nuevo Giro de Cheque"> NUEVO GIRO <span class="fa fa-plus"></span></a>
    </div>
    <div class="box-body">
        <table class="table table-hover table-responsive">
            <thead>
                <tr>
                    <th>FECHA</th>
                    <th>CHEQUE</th>
                    <th>N° CHEQUE</th>
                    <th>APELLIDOS Y NOMBRES</th>
                    <th>CONCEPTO</th>
                    <th>USUARIO</th>
                    <th>ACCION</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cheques as $cheque)
                <tr>
                    <td>{{$cheque->created_at}}</td>
                    <td>{{$cheque->cheque}}</td>
                    <td>{{$cheque->num_cheque}}</td>
                    <td>{{$cheque->paterno}} {{$cheque->materno}} {{$cheque->nombre}}</td>
                    <td>{{$cheque->concepto}}</td>
                    <td>{{$cheque->name}}</td>
                    <td>
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!--,'style'=>'display:none'-->
<section id="conten-modal">
    
</section>
@stop