@extends('socios.mastersocio')
@section('contentheader_title')
    ASIGNACION DE DIRECTIVOS
@stop
@section('main-content')
@permission('ver asigDirectivos')
<div class="box box-primary box-solid" >
    <div class="box-header">
        @permission('crear asigDirectivos')
        <a class="btn btn-dropbox" data-toggle='modal'  data-target='#modal-form'>ASIGNAR DIRECTIVO</a>
        @endpermission
        <div class="col-sm-3 form-group-sm" style="float: right">            
            {!! Form::text('buscar',null,['id'=>'buscar','class'=>'form-control','placeholder'=>'Buscar..'])!!}
        </div>
    </div>
    <div class="box-body" id="contenidos-box">
        @include('socios.asigDirectivosList')
    </div>
</div>
@endpermission
<section id="conten-modal">
    @permission(['crear asigDirectivos','editar asigDirectivos'])
    <div class="modal fade" id="modal-form" role="dialog">
    <div class="modal-dialog modal-primary">
        <div class="modal-content" id="error-modal">
            <div class="modal-header">
                <button type="button" class="close btn-sm" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">ASIGNACION DE DIRECTIVOS</h3>
            </div>
            <div class="modal-body form-horizontal">     
                {!! Form::open(['id'=>'formAsigDirec']) !!}
                <input type="hidden" name="id" id="id" />
                    @include('mensajes.mensaje')                                        
                    <div class="col-md-3">
                        {!! Form::label('dni','DNI: ',['class'=>'control-label'])!!}
                        {!! Form::text('dni',null,['id'=>'dni','class'=>'form-control','placeholder'=>'N° DNI','maxlength'=>'8'])!!}
                        <div class="text-red" id="error-dni"></div>
                    </div>
                    <div class="col-md-6">
                        {!! Form::label('datos','Apellidos y Nombres: ',['class'=>'control-label'])!!}
                        {!! Form::text('datos',null,['id'=>'datos','class'=>'form-control','placeholder'=>'Apellidos y Nombres'])!!}
                        <div class="text-red" id="error-datos"></div>
                    </div>
                    <div class="col-md-3">
                        {!! Form::label('estado','Estado: ',['class'=>'control-label'])!!}
                        {!! Form::select('estado',['ACTIVO'=>'Activo','INACTIVO'=>'inactivo'],null,['id'=>'estado','class' =>'form-control','placeholder'=>'Seleccione']) !!}   
                        <div class="text-red" id="error-estado"></div>
                    </div>
                    <div class="col-md-4">
                        {!! Form::label('inicio','Fecha Inicio: ',['class'=>'control-label'])!!}
                        {!! Form::date('inicio',null,['id'=>'inicio','class'=>'form-control','placeholder'=>'001-000000'])!!}
                        <div class="text-red" id="error-inicio"></div>
                    </div>
                    <div class="col-md-3">
                        {!! Form::label('final','Periodo (Mes): ',['class'=>'control-label'])!!}
                        {!! Form::number('final',null,['id'=>'final','class'=>'form-control','placeholder'=>'N° de meses','min'=>'1'])!!}
                        <div class="text-red" id="error-final"></div>
                    </div>
                    <div class="col-md-5" style="padding-bottom: 10px">
                        {!! Form::label('cargo','Cargo: ',['class'=>'control-label'])!!}
                        {!! Form::select('directivo',$directivos,null,['id'=>'directivo','class' =>'form-control','placeholder'=>'Seleccione']) !!}   
                        <div class="text-red" id="error-cargo"></div>
                    </div>
                    
                    <div class="col-md-12">                        
                        <button type="button" class="btn btn-default" style="float: right" data-dismiss="modal">Salir</button>
                        <a  id="RegAsigDirectivos" class="btn btn-dropbox" style="float: right">Registrar</a>
                    </div>
                    <div class="modal-footer ">
            </div>
                {!!Form::close()!!}
            </div>                                                      
        </div>
    </div>
</div>
    @endpermission
</section>

@endsection

@section('script')
<script>
   
     
$(document).ready(function(){
    $("#subasigdirectivos").addClass('active');
       $("#menusocios").addClass('active');
       activarForm(18);
})

$("#dni").autocomplete({
    minLength:1,           
           autoFocus:true,
           delay:1,
           source: "{{url('Auxiliar/dnipersonas')}}",
           select: function(event, ui){               
               $("#datos").val(ui.item.id+' '+ui.item.materno+' '+ui.item.nombre);
           }
});

$("#datos").autocomplete({
    minLength:1,           
           autoFocus:true,
           delay:1,
           source: "{{url('Auxiliar/datosPersonas')}}",
           select: function(event, ui){               
               $("#dni").val(ui.item.id);
           }
});

$(document).ready().on('keyup','#buscar',function(event){
    activarForm(18);
})

</script>
@stop






@section('script')
<script>
  
  
</script>
@stop