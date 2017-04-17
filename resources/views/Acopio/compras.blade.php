@extends('Acopio.masteracopio')
@section('contentheader_title')
    COMPRA DE GRANOS
@stop
@section('main-content')

@permission('ver compras')
<div class="box box-solid box-primary">
    <div class="box-header">
        @permission('crear compras')
        <a id="nuevacompra"  class="btn btn-dropbox btn-sm" data-toggle="tooltip" data-placement="top" title="COMPRAR GRANO"><span class="glyphicon glyphicon-plus"> COMPRAR</span></a>
        @endpermission
        <div class="col-sm-3 form-group-sm" style="float: right">            
            {!! Form::text('buscar',null,['id'=>'buscar','class'=>'form-control','placeholder'=>'Buscar..'])!!}
        </div>
    </div>
    <div class="box-body" id="contenidos-box">
        @include('Acopio.ListCompras')
    </div>
</div>
<section id="conten-modal"></section>
@endpermission

@stop

@section('script')
<script>   
    

   var habilita = function(){
       $("#sisocio").show();
       $("#nosocio").hide();
       $("#paterno").val('');$("#materno").val('');$("#nombres").val('');$("#dni").val('');
   };
   
   var desabilita = function(){
       $("#nosocio").show();
       $("#sisocio").hide();
       
       $("#socio").val('');               
       $("#codigo").val('');
       $("#comite").val('');
   }; 
    
 
   var numerorecibo = function(idrecibo){
       var route = "{{url('codrecibos')}}/"+idrecibo;       
       $.getJSON(route,function(data){           
           $("#numero").val(data);
       })
   }
   
   $("#buscar").keyup(function(event){
       activarForm(10);
   });
            
   $(document).ready(function (){
      $("#menuacopio").addClass('active');
      $("#subcompras").addClass('active');
      activarForm(10);
   });

</script>

@stop