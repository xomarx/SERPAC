@extends('tesoreria.mastertesoreria')
@section('contentheader_title')
    CHEQUES
@stop
@section('main-content')
<div class="box box-solid box-primary">
    <div class="box-header">
        <a onclick="activarmodal(3)" class="btn btn-dropbox" data-toggle="tooltip" data-placement="top" title="Nuevos Cheques">NUEVO CHEQUE &nbsp;<span class="glyphicon glyphicon-plus"></span></a>
        <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}" >
    </div>
    <div class="box-body">
        <table class="table table-hover table-responsive">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>CHEQUE</th>
                    <th>N° CUENTA</th>
                    <th>DESCRIPCION</th>
                    <th>ACCION</th>                    
                </tr>
            </thead>
            <tbody>
                {{--*/ @$name = 0 /*--}}
                @foreach($cheques as $cheque)
                {{--*/ @$name =$name + 1 /*--}}
                <tr>
                    <td>{{$name}}</td>
                    <td>{{$cheque->cheque}}</td>
                    <td>{{$cheque->num_cuenta}}</td>
                    <td>{{$cheque->descripcion}}</td>
                    <td>
                        <a onclick="EdiCheque('{{$cheque->id}}')" href="javascript:void(0);" class=" btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Editar Cheque"><i class="glyphicon glyphicon-pencil" ></i></a>
                        <a onclick="ElimCheque('{{$cheque->id}}','{{$cheque->cheque}}')" href="javascript:void(0);" class=" btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar Cheque"><i class="glyphicon glyphicon-remove" ></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>                    
    </div>
</div>

<section id="conten-modal"></section>
@stop
