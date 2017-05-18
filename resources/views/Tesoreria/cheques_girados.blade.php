@extends('Tesoreria.mastertesoreria')
@section('contentheader_title')
    CHEQUES GIRADOS
@stop
@section('main-content')
@permission('ver movimientos')
<div class="box box-solid box-primary">
    <div class="box-header">   
        <button  class="btn btn-dropbox dropdown-toggle" type="button" data-toggle="dropdown" id="btnexportar">EXPORTAR
            <span class="caret"></span></button>
        <ul class="dropdown-menu btn btn-github">
            <li class="btn-dropbox"><a href="{{url('Tesoreria/Cheques-Girados/Excel-cheques')}}" target="_blank" id="ExcelGiroCheque">Exportar a Excel</a></li>
            <li class="btn-dropbox" ><a href="{{url('Tesoreria/Cheques-Girados/Reporte-cheques')}}" target="_blank" id="Pdfgirocheques">Exportar a PDF</a></li>        
        </ul>        
        @permission('crear movimientos')
        <a onclick="activarmodal(4);" class="btn btn-dropbox" class="btn btn-dropbox" data-toggle="tooltip" data-placement="top" title="Nuevo Giro de Cheque"> NUEVO GIRO <span class="fa fa-plus"></span></a>
        @endpermission
        <div class=" col-sm-4" style="float: right">            
            {!! Form::text('buscar',null,['id'=>'buscar','class'=>'form-control ','placeholder'=>'Buscar..'])!!}
        </div>
        <div class="form-group-sm" style="float: right">
            {!! Form::select('mes',['Seleccione el Mes'],null,['id'=>'mes','class'=>'form-control']) !!} 
        </div>   
        <div class=" form-group-sm" style="float: right">           
            {!! Form::select('anio',$anios,null,['id'=>'anio','class'=>'form-control col-md-1']) !!} 
        </div>

    </div>    
    <div class="box-body" id="conten-box">        
        
            @include('Tesoreria.listaMovCheques')        
    </div>
</div>
<!--,'style'=>'display:none'-->
<section id="conten-modal"></section>
@endpermission
@stop

    @section('script')
    <script>
        $(document).ready(function(){
           $("#menutesoreria").addClass('active');
           $("#submovcheque").addClass('active');
           activarForm(4);
        });
        $(document).on('change','#cheque',function(event){
            $.ajax({
                type:'get',
                url:'Cheques-Girados/numeroCheque/'+event.target.value,
                success:function(data){                   
                    $("#numero").val(data.numero.numero + 1);
                }
            });
        });
                
        $(document).on('change','#anio',function(event){
            meses(event.target.value);
            activarForm(4);
        });       
        $(document).on('keyup','#buscar',function(){
           activarForm(4); 
        });
        
        $(document).on('change','#mes',function(){
            activarForm(4);
        });
        $(document).on('change','#anioc',function (event){
            cargar_listames(event.target.value);            
            activarForm(3);
        });
        $(document).on('change','#mesc',function(){
            activarForm(3);
        });
        $(document).on('keyup','#buscarc',function(){
           activarForm(3); 
        });
        var cargar_listames = function(anio){            
            var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre", "Diciembre");
            var cont = 12;
            if(anio == (new Date).getFullYear()){
                cont = (new Date).getMonth() + 1;
            }
            var htm='<option value=0>Todo los Meses</option>';
            for(var i = 1;i <= cont ; i++){
                htm +='<option value='+i+'>'+meses[i-1]+'</option>';
            }
            $("#mesc").html(htm); 
        };
        
        var clicktipo = function(id){
        if (id == 1) {var route = '/socios/autopersonas'; var ruta = '/socios/autoDniSocios'}
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
        var route = "{{ url('Tesoreria/numCheque') }}/" + $("#lischeque").val() + '';        
        $("#numero").autocomplete({
        minLength:1,
                autoFocus:true,
                delay:1,
                source: route,
                select: function(event, ui){                
                }
        });
        };
    </script>

@stop
