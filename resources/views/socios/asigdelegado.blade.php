@extends('socios.mastersocio')
@section('contentheader_title')
    ASIGNACION DE DELEGADOS
@stop
@section('main-content')

<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"></div>

                <div class="panel-body">
                    <img src="{{asset('img/construccion.png')}}" alt="Chania" class="img-responsive" width="70%"/>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    
    $(document).ready(function(){
        $('#actualizar').hide();
    });
    var mostrar = function(valor)
    {               
        $('#actualizar').hide();
        $('#Registrar').show();
    }
   
 //*******************************   
    $(document).ready(function () {        
        $('#myTable').DataTable();
    });
//************************  REGISTRAR 

$("#Registrar").click(function(event)
    {       
            var departamento = $("#departamento").val();
//            var token = $("input[departamento=_token]").val();
            var token = $("#token").val();           
            
            var route = "{{url('socios/departamentos')}}";
//            var dataSting = "departamento="+name; 
            alert(route);
          $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN':token},
            type:'post',
            datatype: 'json',
            //async: false,
//            data:dataSting,
            data: {departamento: departamento},
            success:function(data)
            {
                if(data.success == 'true')
                {
                    alert('se grabo correctamente');
                    //document.location.href= '{{ route("socios.index")}}';
                }
            },
            error:function(data)
            {
                
                $("#error").html(data.responseJSON.name);
                $("#message-error").fadeIn();
                if (data.status == 422) {
                   console.clear();
                }

            }  
          })
      


    });  

  //******************************
    var btneditar = function(id) 
    {
        $('#Registrar').hide();
        $('#actualizar').show();
        
        var route = "{{ url('socios/departamentos')}}/"+id+"/edit";

        $.get(route, function(data){
//            alert(id);
        $("#id").val(data.id);
        $("#departamento").val(data.departamento);        
        });
    }
        
$("#actualizar").click(function()
{

  var id = $("#id").val();
  
  var departamento = $("#departamento").val();
  var route = "{{url('socios/departamentos')}}/"+id+"";
  var token = $("#token").val();

  $.ajax({
    url: route,
    headers: {'X-CSRF-TOKEN': token},
    type: 'PUT',
    dataType: 'json',
    data: {departamento: departamento},
    success: function(data){
     
     if (data.success == 'true')
     {
        listmark();
        $("#myModal").modal('toggle');
        $("#message-update").fadeIn();
       }
    },
    error:function(data)
    {
        $("#error").html(data.responseJSON.name);
        $("#message-error").fadeIn();
        if (data.status == 422) {
           console.clear();
        }
    }  
  });
});
   
   
 

var Eliminar = function(id,name)
{ 
     // ALERT JQUERY     
   $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<br><strong><span style='color:#ff0000'>"+name+"</span></strong></br>").then(function() {  
      var route = "{{url('socios/departamentos')}}/"+id+"";
      var token = $("#token").val();

      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success == 'true')
        {
//          listmark();
          $("#message-delete").fadeIn();
         // $('#message-delete').toggle(3000);
          $('#message-delete').show().delay(3000).fadeOut(1);
        }
      }
      });
        
  
    });
};

  
</script>
@stop

