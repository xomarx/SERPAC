@extends('tesoreria.mastertesoreria')
@section('contentheader_title')
    INGRESOS - EGRESOS DE DINERO
@stop
@section('main-content')
<div class="box box-primary box-solid">
    <div class="box-header">
        <a class="btn btn-dropbox" onclick="activarForm(13)">Con Documento</a>
        <a class="btn btn-dropbox"  id="SDdocumento">Sin Documento</a>
        <div class="col-sm-3 form-group-sm" style="float: right">            
            {!! Form::text('buscar',null,['id'=>'buscar','class'=>'form-control','placeholder'=>'Buscar..'])!!}
        </div>
    </div>
    <div class="box-body" id="contenidos-box">
        @include('Tesoreria.movDineroList')
    </div>
</div>
<section id="conten-modal"></section>
@stop

@section('script')
<script>
    $(document).ready(function(){$("#menutesoreria").addClass('active');$("#submovdinero").addClass('active');})
            .on('click','#nuevoMovDinero',function(event){
       var route = 'Mov-Dinero/Modal-Dinero';            
        $.get(route,function(data){            
            $("#conten-modal").html(data);
            $("#modal-form").modal();
            $("#fecha").datepicker({
        autoclose: true,
        language: "es"
    });  
        });              
   });
   $(document).ready().on('click','#SDdocumento',function(event){
       var route = '/Tesoreria/Mov-Dinero/Sin-Documento';        
        $.ajax({
            type:'get',
            url:route,
            success:function(data){                
                $("#contenidos-box").html(data); 
                
                $("#dniE").autocomplete({
                    minLength:1,
                    autoFocus:true,
                    delay:1,
                    source: '/RRHH/autoempleadoDni',
                    select: function(event, ui){                        
                        $("#nombresE").val(ui.item.id);
                    }
                });
                
                $("#nombresE").autocomplete({
                    minLength:1,
                    autoFocus:true,
                    delay:1,
                    source: '/RRHH/autoempleado',
                    select: function(event, ui){                        
                        $("#dniE").val(ui.item.id);
                    }
                });    
                $("#dniS").autocomplete({
                    minLength:1,
                    autoFocus:true,
                    delay:1,
                    source: '/RRHH/autoempleadoDni',
                    select: function(event, ui){                        
                        $("#nombresS").val(ui.item.id);
                    }
                });
                
                $("#nombresS").autocomplete({
                    minLength:1,
                    autoFocus:true,
                    delay:1,
                    source: '/RRHH/autoempleado',
                    select: function(event, ui){                        
                        $("#dniS").val(ui.item.id);
                    }
                });
                $("#dniG").autocomplete({
                    minLength:1,
                    autoFocus:true,
                    delay:1,
                    source: '/RRHH/autoempleadoDni',
                    select: function(event, ui){                        
                        $("#nombresG").val(ui.item.id);
                    }
                });
                
                $("#nombresG").autocomplete({
                    minLength:1,
                    autoFocus:true,
                    delay:1,
                    source: '/RRHH/autoempleado',
                    select: function(event, ui){                        
                        $("#dniG").val(ui.item.id);
                    }
                });
                $("#dniF").autocomplete({
                    minLength:1,
                    autoFocus:true,
                    delay:1,
                    source: '/RRHH/autoempleadoDni',
                    select: function(event, ui){                        
                        $("#nombresF").val(ui.item.id);
                    }
                });
                
                $("#nombresF").autocomplete({
                    minLength:1,
                    autoFocus:true,
                    delay:1,
                    source: '/RRHH/autoempleado',
                    select: function(event, ui){                        
                        $("#dniF").val(ui.item.id);
                    }
                });
               
               
            }            
        })
   });
   
   
</script>
@stop