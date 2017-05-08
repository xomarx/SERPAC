<div class="modal fade" id="modal-form" role="dialog">
    <div class="modal-dialog modal-primary">
        <div class="modal-content" id="error-modal">
            <div class="modal-header">
                <button type="button" class="close btn-sm" data-dismiss="modal">&times;</button>
                <h3 class="modal-title" >CAJA CHICA </h3>
            </div>
            <div class="modal-body form-horizontal">     
                <div class="col-sm-5 form-sm" style="float: right">                      
                    {!! Form::text('buscarc',null,['id'=>'buscarc','class'=>'form-control','placeholder'=>'Buscar..'])!!}
                </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>FECHA</th>
                                <th>RAZON SOCIAL</th>
                                <th>COMPROBANTE</th>
                                <th>N° COMP</th>
                                <th>MONTO S/.</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                    
                                                                                        
            </div>                               
        </div>
    </div>
</div>
