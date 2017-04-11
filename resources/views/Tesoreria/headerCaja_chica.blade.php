<div class="box-header ">
    @permission('crear movimientos')
    <a onclick="activarmodal(5);" class="btn btn-dropbox" class="btn btn-dropbox" data-toggle="tooltip" data-placement="top" title="Nueva Caja Chica"> AGREGAR CAJA <span class="fa fa-plus"></span></a>
    @endpermission
    <div class="col-sm-3 form-group-sm" style="float: right">            
        {!! Form::text('buscarc',null,['id'=>'buscarc','class'=>'form-control','placeholder'=>'Buscar..'])!!}
    </div>
    <div class="col-sm-2 form-group-sm" style="float: right">
        {!! Form::select('mesc',['Seleccione el Mes'],null,['id'=>'mesc','class'=>'form-control']) !!} 
    </div>   
    <div class=" form-group-sm" style="float: right">           
        {!! Form::select('anioc',$anios,null,['id'=>'anioc','class'=>'form-control col-md-1']) !!} 
    </div>        
</div>