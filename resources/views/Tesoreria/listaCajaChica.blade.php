<a onclick="activarmodal(5);" class="btn btn-dropbox" class="btn btn-dropbox" data-toggle="tooltip" data-placement="top" title="Nueva Caja Chica"> AGREGAR CAJA <span class="fa fa-plus"></span></a>
<div class="box box-body">
    <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}" >
    <table class="table table-hover table-responsive">
            <thead>
                <tr>
                    <th>FECHA</th>
                    <th>CAJA</th>
                    <th>IMPORTE S/.</th>
                    <th>CHEQUE</th>
                    <th>N° CHEQUE</th>                    
                    <th>USUARIO</th>
                    <th>ACCION</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cajas as $caja)
                {{--*/ @$name = '' /*--}}
                <tr class="{{$name}}" >
                    <td>{{$caja->created_at}}</td>
                    <td>{{$caja->num_caja}}</td>
                    <td>{{$caja->importe}} </td>
                    <td>{{$caja->cheque }}</td>
                    <td>{{$caja->num_cheque}}</td>                    
                    <td>{{$caja->name}}</td>
                    <td>                        
                        <a onclick="EdiCajaChica('{{$caja->id}}')" class="btn btn-sm btn-primary" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="Editar"><span class="glyphicon glyphicon-pencil" ></span></a>                        
                        <a onclick="AnulCajaChica('{{$caja->id}}','{{$caja->num_caja}}','{{$caja->cheque}}')" style="cursor: pointer;"  class= "btn btn-sm btn-danger " data-toggle="tooltip" data-placement="top" title="Anular Caja Chica"><span  class="glyphicon glyphicon-remove"></span></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
</div>   