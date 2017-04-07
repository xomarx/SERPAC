@extends('Reportes.masterInform')
@section('contentheader_title')
    REPORTE DE PADRON DE SOCIOS
@stop
@section('main-content')
<div class="box box-primary ">
    <div class="box-header">
        <a class="btn btn-dropbox">GRAFICOS <i class="glyphicon glyphicon-stats"></i></a>
        <a class="btn btn-dropbox">PADRON SOCIOS <i class="fa fa-file-pdf-o"></i></a>
    </div>
    <div class="box box-body box-primary">
        <div class="col-md-12">
            <div class="col-md-2">
               {!!Form::label('anio','Año: ',['class'=>'control-label'])!!}
            {!! Form::select('anio',$anios,null,['id'=>'anio','placeholder'=>'seleccione','class'=>'form-control']) !!} 
           
            </div>
            <div class="col-md-2">
                {!!Form::label('mes','Mes: ',['class'=>'control-label'])!!}
            {!! Form::select('anio',$meses,null,['id'=>'anio','placeholder'=>'seleccione','class'=>'form-control']) !!}
            </div>
            <div class="col-md-2">
                {!!Form::label('departamento','Departamento: ',['class'=>'control-label'])!!}
            {!! Form::select('departamento',$departamentos,null,['id'=>'departamento','placeholder'=>'Seleccione','class'=>'form-control','onclick'=>'department()']) !!}
            </div>
            <div class="col-md-2">
                {!!Form::label('provincia','Provincia: ',['class'=>'control-label'])!!}
            {!! Form::select('provincia',[],null,['id'=>'provincia','placeholder'=>'Seleccione','class'=>'form-control','onclick'=>'province()']) !!}
            </div>
            <div class="col-md-3">
                {!!Form::label('distrito','Distrito: ',['class'=>'control-label'])!!}
            {!! Form::select('distrito',[],null,['id'=>'distrito','placeholder'=>'Seleccione','class'=>'form-control','onclick'=>'district()']) !!}
            </div>            
        </div>
        <div class="col-md-12">
            <div class="col-md-3">
                {!!Form::label('central','Comite Central: ',['class'=>'control-label'])!!}
            {!! Form::select('comite_central',[],null,['id'=>'comite_central','placeholder'=>'Seleccione','class'=>'form-control','onclick'=>'central_committe()']) !!}
            </div>
            <div class="col-md-3">
                {!!Form::label('local','Comite Local: ',['class'=>'control-label'])!!}
            {!! Form::select('comite_local',[],null,['id'=>'comite_local','placeholder'=>'Seleccione','class'=>'form-control']) !!}
            </div>
        </div>
        <div class="col-md-12" id="grafiSocios">
            
        </div>
        {{$lava->render('ComboChart','socios','grafiSocios')}}
    </div>
</div>

@stop
