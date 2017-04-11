@if(count($cajas) > 0)    
<input id="token" type="hidden" name="_token" value="{{ csrf_token() }}" >
<table class="table table-hover table-responsive">
    <thead>
        <tr>
            <th style="border-bottom-color: #0089db;">FECHA</th>
            <th style="border-bottom-color: #0089db;">CAJA</th>
            <th style="border-bottom-color: #0089db;">IMPORTE S/.</th>
            <th style="border-bottom-color: #0089db;">CHEQUE</th>
            <th style="border-bottom-color: #0089db;">N° CHEQUE</th>                    
            <th style="border-bottom-color: #0089db;">USUARIO</th>
            <th style="border-bottom-color: #0089db;">ACCION</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cajas as $caja)
        {{--*/ @$name = '' /*--}}
        <tr class="{{$name}}" >
            <td>{{$caja->created_at}}</td>
            <td>{{$caja->num_caja}}</td>
            <td>S/. {{$caja->importe}} </td>
            <td>{{$caja->cheque }}</td>
            <td>{{$caja->num_cheque}}</td>                    
            <td>{{$caja->name}}</td>
            <td>
                @permission('editar movimientos')
                <a onclick="EdiCajaChica('{{$caja->id}}')" class="btn-xs btn-primary" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Editar {{$caja->num_caja}}"><span class="glyphicon glyphicon-pencil" ></span></a>
                @endpermission
                @permission('eliminar movimientos')
                <a onclick="AnulCajaChica('{{$caja->id}}','{{$caja->num_caja}}','{{$caja->cheque}}')" style="cursor: pointer;"  class= "btn-xs btn-danger " data-toggle="tooltip" data-placement="top" title="Anular Caja Chica"><span  class="glyphicon glyphicon-remove"></span></a>
                @endpermission
            </td>
        </tr>
        @endforeach
    </tbody>
</table> 
<div class="text-center">
    {!! $cajas->links()!!}
</div>        
@else
<p class="text-info text-center">-->NO se encontro ningun registro ... </p>
@endif