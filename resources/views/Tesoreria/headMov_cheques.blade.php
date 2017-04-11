
<div class="box-header ">
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


