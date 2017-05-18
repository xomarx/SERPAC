@extends('RRHH.masterempleados')
@section('contentheader_title')
    ALMACENES DE ACOPIO
@stop
@section('main-content')
@permission('ver almacen')
<div class="box-body">
    <div class="box box-solid box-primary">
        <div class="box-header" >
            @permission('crear almacen')
            <a id="nuevasucursal" data-toggle='tooltip'  title="Agregar Almacen" class="btn btn-dropbox">AGREGAR ALMACEN <span class="glyphicon glyphicon-plus"></span></a>               
            @endpermission
            <div class="col-sm-3 form-group-sm" style="float: right">            
                {!! Form::text('buscar',null,['id'=>'buscar','class'=>'form-control','placeholder'=>'Buscar..'])!!}
            </div>
        </div>
        <div class="box-body" id="contenidos-box">
            @include('RRHH.sucursalList')
        </div>
    </div>
</div>

@endpermission
@permission(['crear almacen','editar almacen'])
<section id="conten-modal"></section>
@endpermission

@stop

@section('script')
<script>
   $(document).ready(function (){
      $("#subalmacen").addClass('active');
    $("#menuRRHH").addClass('active');
        activarForm(20);
   });   
   $("#buscar").keyup(function(){
       activarForm(20);
   });
</script>
@stop