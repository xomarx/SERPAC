<div class="box box-body form-group" id="boxplanilla">
    <button type="button" class="close" id="cerrarplanilla">&times;</button>
    {!! Form::open(['id'=>'formsemanal']) !!}    
    <div class="col-md-3">
        <img src="{{ url('img/acopagro.png')}}" class="img-responsive" >
    </div>
    <div class="col-md-7">
        <h3><center>COOPERATIVA AGRARIA CACAOTERA ACOPAGRO Ltda</center></h3>
        <h4><center>PLANILLA DE ACOPIO Y BENEFICIO CENTRALIZADO DE CACAO</center></h4>
    </div>
    <div class="col-md-2 ">
        {!!Form::label('numero','N°',['class'=>'control-label'] )!!}
        {!! Form::text('planilla',null,['class'=>'forma-control','id'=>'planilla','placeholder'=>'N° de Planilla'])!!}
        <div class="text-danger" id="error-planilla"></div>
    </div>                
    
    <div class="col-md-5">
        {!!Form::label('almacen','Cod. Centro de Acopio' )!!}
        {!! Form::text('almacen',null,['class'=>'forma-control','id'=>'almacencod','placeholder'=>'cod centro de acopio'])!!}
        <div class="text-danger" id="error-almacen"></div>
    </div>
    <div class="col-md-4">
        {!!Form::label('lote','N° de SubLote' )!!}
        {!! Form::text('lote',null,['class'=>'forma-control','id'=>'lote','placeholder'=>'N° Sub Lote'])!!}
        <div class="text-danger" id="error-lote"></div>
    </div>
    <div class="col-md-3" >
        {!!Form::label('fecha','Fecha' )!!}
        {!! Form::date('fecha',null,['class'=>'forma-control','id'=>'fecha'])!!}
        <div class="text-danger" id="error-fecha"></div>
    </div>
    <div class="col-md-12">
        @foreach ($condiciones as $condicion)
        <label class="radio-inline form-group" onclick="clickplanilla();">
                {!!  Form::radio('condicion',$condicion->id, null, ['class' => 'forma-control','id'=>'condicion','checked']) !!} {{$condicion->condicion }}</label>                
        @endforeach
    </div>
    <table border='1' class="table table-responsive table-hover" id="tablaplanilla"  >
        <thead>
            <tr style="border-bottom: #000000 solid;">
                <th >FECHA</th>
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
</table>
    <br>
    <div class="col-md-12">
        <div class="col-md-2">
            <hr style="background-color: black; height: 1px;  width: 100%;" />
            <center> {!!Form::label('firma','Firma del Acopiador' )!!}</center>
        </div>
        <div class="col-md-2" >
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

    <div class="col-sm-7">
        {!!Form::label('acopiador','Acopiador:',['class'=>'col-sm-2'] )!!}
        <b id="firmaacopiador"></b>        
    </div>

    <div class="col-sm-5"  >
        {!!Form::label('responsable','Responsable:',['class'=>'col-sm-4'] )!!}
        <b id="firmatecnico"></b>        
    </div>    
    {!! Form::close() !!} 
</div>