<div id="modal-form" class="modal fade" role="dialog">
  <div class="modal-dialog modal-primary">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ASIGNACION DE ZONAS A LOS TECNICOS</h4>
      </div>
        
        <div class="modal-body">
            {!! Form::open(['id'=>'formtecnicos']) !!}
            @include('mensajes.mensaje')
            <div class="box-body bg-primary">
                <div class="form-group col-lg-12" >                   
                {!! Form::label('tecnico','EXTENSIONISTAS',['class'=>'control-label']) !!}
                {!! Form::select('tecnico',$tecnics,null,['id'=>'tecnico','placeholder'=>'Seleccione un Extensionista !','onchange'=>'changetecnicos()','style'=>'width:100%']) !!}
                <div class="text-danger" id="error_tecnico"></div>
            </div>    
            {!! Form::label('tecnico','ZONAS LOCALES',['class'=>'control-label col-lg-12']) !!}
                         
                <div class="col-lg-6">
                    <input type="text" id="buscarinicial" class="form-control" placeholder="buscar Sector central/Local" name="buscarinicial"/>                
                    <button id="inicial" type="button" class="btn btn-default glyphicon glyphicon-arrow-right col-lg-12"><span class="glyphicon glyphicon-arrow-right"> </span></button>
                    {!! Form::select('zona_inicial',$locales,null,['id'=>'zona_inicial','class'=>'form-control','multiple']) !!}
                </div>

                <div class="col-sm-6 form-group has-feedback">
                    <input type="text" id="buscarfinal" class="form-control" placeholder="buscar Sector central/Local" name="buscarfinal"/>                
                    <button id="final" type="button" class="btn btn-default glyphicon glyphicon-arrow-left col-lg-12"><span class="glyphicon glyphicon-arrow-left"> </span></button>
                    {!! Form::select('zona_final',[],null,['id'=>'zona_final','class'=>'form-control','multiple']) !!}
                </div>
            </div>
            
            {!! Form::close() !!}
        </div>
      <div class="modal-footer">
          {!!link_to('#', $title='Registrar', $attributes = ['id'=>'RegTecnicos', 'class'=>'btn btn-primary btn-sm m-t-10'])!!}
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
        
    </div>

  </div>
</div>

