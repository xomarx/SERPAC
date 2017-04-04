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
    $("#subasigdelegados").addClass('active');
    $("#menusocios").addClass('active');
})
  
</script>
@stop

