<div class="box box-body ">
    
    <div class="col-sm-3">
        <img src="{{ url('img/acopagro.png')}}" class="img-responsive" >
    </div>
    <div class="col-sm-7">
        <h3><center>COOPERATIVA AGRARIA CACAOTERA ACOPAGRO Ltda</center></h3>
        <h4><center>PLANILLA DE ACOPIO Y BENEFICIO CENTRALIZADO DE CACAO</center></h4>
    </div>
    <div class="col-sm-2 ">
        {!!Form::label('numero','N°',['class'=>'control-label'] )!!}        
        {!! Form::text('numero',null,['class'=>'forma-control','id'=>'numero','placeholder'=>'N° de Planilla'])!!}
    </div>
        
        <div class="col-sm-12">
        <hr size="0.5px" color="red"/>
        </div>
    <div class="col-sm-9 form-group">        
        {!!Form::label('numero','Cod. Centro de Acopio' )!!}
        {!! Form::text('acopio',null,['class'=>'forma-control','id'=>'acopio','placeholder'=>'cod centro de acopio'])!!}
        {!!Form::label('lote','N° de SubLote' )!!}
        {!! Form::text('numero',null,['class'=>'forma-control','id'=>'numero','placeholder'=>'N° Sub Lote'])!!}                
    </div>
    <div class="col-sm-3" >
        {!!Form::label('fecha','Fecha' )!!}
        {!! Form::text('fecha',null,['class'=>'forma-control','id'=>'fecha','placeholder'=>'mes/año'])!!}
    </div>
    <div class="col-sm-12">
        <div class="col-sm-2">
            {!!Form::label('imo','ORGANICO IMO',['class'=>'control-label'] )!!}
            {!!  Form::checkbox('imo','IMO', null, ['class' => 'field','onClick'=>'deshabilita()']) !!}        
        </div>
        <div class="col-sm-2">
            {!!Form::label('ceres','ORGANICO CERES',['class'=>'control-label'] )!!}
            {!!  Form::checkbox('ceres','CERES', null, ['class' => 'field']) !!}        
        </div>

        <div class="col-sm-3">
            {!!Form::label('socio','CONVENCIONAL SOCIO',['class'=>'control-label'] )!!}
            {!!  Form::checkbox('socio','CONVENCIONAL', null, ['class' => 'field']) !!}        
        </div>
        <div class="col-sm-3">
            {!!Form::label('cns','CONVENCIONAL NO SOCIO ',['class'=>'control-label'] )!!}
            {!!  Form::checkbox('cns','CNS', null, ['class' => 'field']) !!}        
        </div>    
        <div class="col-sm-1">
            {!!Form::label('rfa','RFA',['class'=>'control-label'] )!!}
            {!!  Form::checkbox('rfa','CERES', null, ['class' => 'field']) !!}        
        </div>
        <div class="col-sm-1">
            {!!Form::label('utz','UTZ',['class'=>'control-label'] )!!}
            {!!  Form::checkbox('utz','CERES', null, ['class' => 'field']) !!}        
        </div>
    </div> 
    <table class="table table-responsive" id="tablaplanilla">
        <thead>
            <tr>
                <th>FECHA</th>
                <th>CODIGO SOCIO</th>
                <th>APELLIDOS Y NOMBRES</th>
                <th>GRADO I</th>
                <th>GRADO II</th>
                <th>KG.</th>
                <th>P.U. S/.</th>
                <th>TOTAL S/.</th>
                <th>FIRMA</th>
            </tr>
        </thead>
        <tbody>                         
        </tbody>
</table>
    <div class="col-sm-12">
        <div class="col-sm-2">
            <hr style="background-color: black; height: 1px;  width: 100%;" />
            <center> {!!Form::label('firma','Firma del Acopiador' )!!}</center>
        </div>

        <div class="col-sm-2" >
            <table style="border: black 1px solid; text-align: justify;  padding: 1px;">
                <td style="width: 70px; height: 70px;" >           
                </td>    
            </table>
        </div>

        <div class="col-sm-2" style="float: right;" >
            <table style="border: black 1px solid; text-align: justify;  padding: 1px;">
                <td style="width: 70px; height: 70px;" >           
                </td>    
            </table>
        </div>
        <div class="col-sm-3" style="float: right;">
            <hr style="background-color: black; height: 1px;  width: 100%;" />
            <center> {!!Form::label('firma','Firma Responsable Acopio' )!!}</center>
        </div>
    </div>

    <div class="col-sm-6">
        {!!Form::label('firma','Nombre:',['class'=>'col-sm-2'] )!!}
        {!! Form::text('numero',null,['class'=>'forma-control','id'=>'numero','placeholder'=>'Acopiador','class'=>'col-sm-5'])!!} 
    </div>

    <div class="col-sm-6"  >
        {!!Form::label('fecha','Nombre Responsable:',['class'=>'col-sm-4'] )!!}
        {!! Form::text('numero',null,['class'=>'forma-control','id'=>'numero','placeholder'=>'Responsable','class'=>'col-sm-6'])!!}
    </div>
    <div class="col-sm-12" >
        {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegCompras', 'class'=>'btn btn-primary btn-sm m-t-10','style'=>"float: right;"])!!}
        &sbquo;
        <button  class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" >Exportar
            <span class="caret"></span></button>
        <ul class="dropdown-menu ">
            <li><a href="{{ url('/Acopio/Excel') }}">Exportar a Excel</a></li>
            <li><a href="{{ url('/Acopio/Pdf') }}">Exportar a PDF</a></li>        
        </ul>
    </div>
</div>