@extends('tesoreria.mastertesoreria')
@section('contentheader_title')
    CAJA CHICAS
@stop
@section('main-content')
<div class="box box-solid box-primary">
    <div class="box-header">
        <a onclick="activarForm(4);" class="btn btn-dropbox" class="btn btn-dropbox" data-toggle="tooltip" data-placement="top" title="Nuevo Giro de Cheque"> GIRO DE CHEQUE <span class="fa fa-tasks"></span></a>
        <a onclick="activarForm(3);" class="btn btn-dropbox" class="btn btn-dropbox" data-toggle="tooltip" data-placement="top" title="Lista de Caja Chica"> CAJA CHICA <span class="glyphicon glyphicon-tasks"></span></a>
    </div>    
    <div class="box-body" id="contenidos-box">
    <a onclick="activarmodal(4);" class="btn btn-dropbox" class="btn btn-dropbox" data-toggle="tooltip" data-placement="top" title="Nuevo Giro de Cheque"> NUEVO GIRO <span class="fa fa-plus"></span></a>
    <div class="box box-body">
        <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}" >
        <table class="table table-hover table-responsive">
            <thead>
                <tr>
                    <th>FECHA</th>
                    <th>CHEQUE</th>
                    <th>N° CHEQUE</th>
                    <th>IMPORTE S/.</th>
                    <th>APELLIDOS Y NOMBRES</th>
                    <th>CONCEPTO</th>
                    <th>USUARIO</th>
                    <th>ACCION</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cheques as $cheque)
                {{--*/ @$name = '' /*--}}{{--*/ @$estado = '' /*--}}
                @if($cheque->estado == 'ANULADO')
                    {{--*/ @$name ='text-red' /*--}}
                    {{--*/ @$estado ='disabled' /*--}}
                    
                @endif
                <tr class="{{$name}}" >
                    <td>{{$cheque->created_at}}</td>
                    <td>{{$cheque->cheque}}</td>
                    <td>{{$cheque->num_cheque}} </td>
                    <td>{{$cheque->importe }}</td>
                    <td>{{$cheque->paterno}} {{$cheque->materno}} {{$cheque->nombre}}</td>
                    <td>{{$cheque->concepto}}</td>
                    <td>{{$cheque->name}}</td>
                    <td>
                        @if($estado != 'disabled')
                            {{--*/ @$evento =$cheque->id /*--}} {{--*/ @$numcheque =$cheque->num_cheque /*--}}
                        @else
                            {{--*/ @$evento =rand(1,100) /*--}} {{--*/ @$numcheque =rand(100,1000) /*--}}
                        @endif
                        <a onclick="EdiMovCheque('{{$evento}}')" class="btn btn-sm btn-primary {{$estado}}" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="Editar"><span class="glyphicon glyphicon-pencil" ></span></a>
                        <a class="btn btn-sm btn-success {{$estado}}" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Generar Recibo"><span class="glyphicon glyphicon-print" ></span></a>
                        <a onclick="AnulMovCheque('{{$evento}}','{{$cheque->cheque}}','{{$numcheque}}')" style="cursor: pointer;"  class= "btn btn-sm btn-danger {{$estado}}" data-toggle="tooltip" data-placement="top" title="Anular Cheque"><span  class="glyphicon glyphicon-remove"></span></a>
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

@section('script')
<script>
var clicktipo = function(id){       
       if(id==1) {var route = '/socios/autopersonas'; var ruta = '/socios/autoDniSocios'}
       else {var route = '/RRHH/autoempleado'; var ruta = '/RRHH/autoempleadoDni'}
       $("#dato").autocomplete({     
          minLength:1,           
           autoFocus:true,
           delay:1,
           source: route,
           select: function(event, ui){               
               $("#dni").val(ui.item.id);
           }
        });
        
        $("#dni").autocomplete({     
          minLength:1,           
           autoFocus:true,
           delay:1,
           source: ruta,
           select: function(event, ui){               
               $("#dato").val(ui.item.id);
           }
        });
   };    
   
   var changecheque = function(){       
       var route = "{{ url('Tesoreria/numCheque') }}/"+$("#lischeque").val()+'';
       console.log(route);
       $("#numero").autocomplete({     
          minLength:1,           
           autoFocus:true,
           delay:1,
           source: route,
           select: function(event, ui){               
               console.log(ui.item);
           }
        });
   };
</script>

@stop
