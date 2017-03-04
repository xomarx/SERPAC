@extends('Acopio.masteracopio')
@section('contentheader_title')
    PERSONAS JURIDICAS
@stop
@section('main-content')

<div class="box box-solid box-primary ">
    <div class="box-header" >
        <center><h3 class="box-title ">LISTA DE PERSONAS JURIDICAS</h3></center>
    </div>
    <div class="box-body">
        <a id="nuevoperjuridica" data-toggle='modal' data-target='#nuevoregistro' class="btn btn-primary btn-sm m-t-10" ><span class="glyphicon glyphicon-plus"data-toggle="tooltip" data-placement="top" title="Nueva Persona Juridica">Nuevo</span></a>    
    <table id="myTable" class="table table-hover">
        <thead>
        <th>RUC</th>
        <th>RAZON SOCIAL</th>
        <th>DIRECCION</th>
        <th>TELEFONO</th>
        <th>ACCIONES</th>
        </thead>
        <tbody>
            @foreach ($persona_juridicas as $persona_juridica )
            {{--*/ @$name = str_replace(' ','&nbsp;', $persona_juridica->razon_social) /*--}}
            <tr>
                <td>{{$persona_juridica->ruc }}</td>
                <td>{{$persona_juridica->razon_social }}</td>
                <td>{{$persona_juridica->direccion }}</td>
                <td>{{ $persona_juridica->telefono }}</td>
                <td>
                    <a href="" onclick="EditJuridico('{{$persona_juridica->id}}')" data-toggle='modal' data-target='#nuevoregistro'><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="Editar" ></span></a>                                    
                    <a href="#" onclick="AnulJuridico('{{$persona_juridica->id}}','{{$name}}')"><span class="glyphicon glyphicon-remove"></span></a>
                </td>
            </tr>            
            @endforeach
        </tbody>
    </table>
        </div> 
</div>


<div class="modal fade" id="nuevoregistro" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-blue-gradient">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">NUEVO REGISTRO</h3>
            </div>
            <div class="modal-body  form-group">
                {!! Form::open(['id'=>'form']) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <imput type='hidden' name='id' id='id'>
                    <div class="col-sm-6">
                        {!! Form::label('ruc','RUC:',['class' => 'control-label'])!!}
                        {!! Form::text('ruc',null,['id'=>'ruc','class'=>'form-control','placeholder'=>'N° de RUC'])!!} 
                    </div>
                    <div class="col-sm-6">
                        {!! Form::label('telefono','Telefono:',['class' => 'control-label'])!!}
                        {!! Form::text('telefono',null,['id'=>'telefono','class'=>'form-control','placeholder'=>'N° de Telefono'])!!} 
                    </div>                                
                {!! Form::label('razon','Razon Social:',['class' => 'control-label'])!!}
                {!! Form::text('razon',null,['id'=>'razon','class'=>'form-control','placeholder'=>'Razon Social'])!!} 
                {!! Form::label('direccion','Direccion:',['class' => 'control-label'])!!}
                {!! Form::text('direccion',null,['id'=>'direccion','class'=>'form-control','placeholder'=>'Direccion'])!!} 
                                                                                                                              
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">                
                {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegPersonaJuridica', 'class'=>'btn btn-primary btn-sm m-t-10'])!!}
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
@stop

@section('script')
<script>
    $("#RegPersonaJuridica").click(function(){
        var route = '/Acopio/Persona-Juridica';
        var token = $("#token").val();
        var telefono = $("#telefono").val();
        var ruc = $("#ruc").val();
        var id = $("#id").val();
        var razon_social = $("#razon").val();
        var direccion = $("#direccion").val();
        var tipo = 'POST';
        if($("#RegPersonaJuridica").text() == "Actualizar")
        {
            tipo = "PUT";
            route = "/Acopio/Persona-Juridica/" + id;
            console.log(route);
        }
        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN':token},
            type: tipo,
            dataType: 'json',
            data: {
                telefono: telefono,
                direccion: direccion,
                ruc: ruc,
                razon_social: razon_social
            },
            success: function (data) {
                        if(data.success = true)
                        {
                            document.location.reload();
                        }
                    }
        });
    });
    
    var EditJuridico = function(id){
        var route = '/Acopio/Persona-Juridica/'+id+"/edit";
        $("#id").val(id);
        $("#RegPersonaJuridica").text("Actualizar");
        $.get(route, function(data){                        
            $("#ruc").val(data.ruc);
            $("#telefono").val(data.telefono);
            $("#razon").val(data.razon_social);
            $("#direccion").val(data.direccion);
        });
    };
   
   var AnulJuridico = function(id,name){
       $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"
           +name+"</span></strong></br>").then(function() {  
      var route = "/Acopio/Persona-Juridica/"+id+"";
      var token = $("#token").val();
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success = 'true')
        {
            document.location.reload();
        }
      }
      });          
    });
   };
    
</script>
@stop