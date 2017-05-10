<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {    
    return view('auth.login');
});

    
    

Route::group(['middleware' => ['auth']], function () {    
    
    
////tambien pueden ir por roles separados con el | 
//'middleware' => ['role:administrador|miembro']
// 
////para dejar pasar a los usuarios con un o mas determinado permiso
//'middleware' => ['permission:crearPost', 'permission:editarPost']
    
    route::resource('auxiliar/DNIpersonas','Configuracion\AuxiliarController@PersonDNI');
    route::resource('Auxiliar/datoSocios','Configuracion\AuxiliarController@autoDatoSocios');
    route::resource('Auxiliar/codigoSocios','Configuracion\AuxiliarController@autoCodigoSocios');
    route::resource('Auxiliar/dniSocios','Configuracion\AuxiliarController@autoDNISocios');
    route::resource('Auxiliar/dniParientesSocios','Configuracion\AuxiliarController@autoDNIParientesSocios');
    route::resource('Auxiliar/dnipersonas','Configuracion\AuxiliarController@autoDNIPersonas');
    route::resource('Auxiliar/datosPersonas','Configuracion\AuxiliarController@autoDatosPersonas');
    
    Route::get('sign-out', 'Auth\AuthController@getsignOut');
    
    route::get('Usuarios', ['as'=> 'usuarios','uses'=>'Auth\AuthController@listUsers']);
    route::get('Usuarios/crear-usuario', ['as'=> 'usuarios','uses'=>'Auth\AuthController@CrearUser']);
    
    route::resource('error-403','Configuracion\usuarioController@errorModal');
    
    route::resource('NewRolUsuario','Configuracion\usuarioController@storerol');
    route::resource('RolUsuario','Configuracion\usuarioController@roluser');
    route::resource('ListaRoles','Configuracion\usuarioController@listaRoles');//listaRoles
    route::resource('PermisoUser','Configuracion\usuarioController@PermisoUser');    
    route::resource('headPermisos','Configuracion\usuarioController@HeadPermisoUser');//HeadPermisoUser
    route::resource('NewPermisoUser','Configuracion\usuarioController@PermisoStore');//PermisoStore
    route::resource('AsigPermisos','Configuracion\usuarioController@AsigPermisoStore');//AsigPermisoStore
    route::get('ListaPermisos/{id?}/{modulo?}','Configuracion\usuarioController@show');    
    route::resource('modalRolUser','Configuracion\usuarioController@asigRolUser');
    route::resource('NewRolUser','Configuracion\usuarioController@AsigRolUserStore');
    route::resource('ListUsuarios','Configuracion\usuarioController@ListUsers');
    route::resource('estado-user','Configuracion\usuarioController@ActDesact');
//    route::get('ListaPermisos/{id?}/{modu?}','Configuracion\usuarioController@showPermisos');
    
    Route::get('comite_locales/{id}','socios\comite_localcontroller@getcomites_locales');
    Route::get('comites_centrales/{id}','socios\comite_centralcontroller@getcomites_centrales');
    Route::get('provincias/{id}','socios\provinciacontroller@getprovincias');
    Route::get('distritos/{id}','socios\distritocontroller@getdistritos');   
//    route::post('socios/{codigo}','socios\sociocontroller@update');   
    //*******************************************************************       SOCIOS ******************************************************************
    route::get('socios/Asignacion-Delegados/ListaAsigDelegados/{dato?}/{page?}','socios\cargodelegadosociocontroller@listaAsigDelegados');
    route::resource('socios/Asignacion-Delegados','socios\cargodelegadosociocontroller');
    route::get('socios/Asignacion-Directivos/ListaAsigDirectivos/{dato?}/{page?}','socios\cargodirectivosociocontroller@listaAsigDirectivos');
    route::resource('socios/Asignacion-Directivos','socios\cargodirectivosociocontroller');
    
    route::resource('socios/transferencias/newtransferencias','socios\transferenciacontroller@NewTransferencia');
    route::resource('socios/transferencias','socios\transferenciacontroller');    
    route::resource('socios/transferencias/datos','socios\transferenciacontroller@datossocio');
    route::resource('socios/transferencias/nuevo','socios\transferenciacontroller@datosnuevo');//datosnuevo
    route::resource('socios/transferencias/persona','socios\transferenciacontroller@datosnuevobeneficiario');//datosnuevobeneficiario    
    route::resource('socios/transferencias/ficha','socios\transferenciacontroller@fichaTransferencia');//fichaTransferencia            
    
    route::resource('socios/propiedadinmueble','socios\fundoscontroller@propiedadinmueble');
    route::resource('socios/propiedadfauna','socios\fundoscontroller@propiedadfauna');
    route::resource('socios/propiedadflora','socios\fundoscontroller@propiedadflora');
    
    route::resource('socios/basicos/floras','socios\floracontroller');
    route::resource('socios/basicos/faunas','socios\faunacontroller');
    route::resource('socios/basicos/inmuebles','socios\inmueblescontroller');
    route::resource('socios/basicos/delegados','socios\delegadoscontroller');
    route::resource('socios/basicos/directivos','socios\directivoscontroller');
    
    route::resource('socios/comite-local','socios\comite_localcontroller');
    route::resource('socios/comite-central','socios\comite_centralcontroller');    
    route::resource('socios/distritos','socios\distritocontroller');
    route::resource('socios/provincias','socios\provinciacontroller');    
    route::resource('socios/departamentos','socios\departamentocontroller');        
//    route::resource('socios','socios\sociocontroller@create');
    
    route::resource('socios/autopersonas','socios\sociocontroller@autoSociosPersonas');    
    route::resource('socios/autoDniSocios','socios\sociocontroller@autoSociosDni');
        
    //autocompletados
                    
    route::get('socios/fundos/Listfundos/{data?}/{page?}','socios\fundoscontroller@ListaFundos');
    route::resource('socios/eliminarpropiedades','socios\fundoscontroller@EliminarPropiedadesFundo');//EliminarPropiedadesFundo
    route::resource('socios/modalfundo','socios\fundoscontroller@ModalFundo');
    route::resource('socios/fundos','socios\fundoscontroller');
    
    route::get('socios/parientes/ListaParientes/{dato?}/{page?}','socios\parientescontroller@listaParientes');
    route::resource('socios/modalparientes','socios\parientescontroller@ModalPariente');    
    route::resource('socios/parientes','socios\parientescontroller');
    route::delete('socios/parientes/{dni}/{cod}','socios\parientescontroller@destroy');
    route::get('socios/parientes/{idsocio?}/{dnipar?}','socios\parientescontroller@datosparientes');
    
    route::delete('socios/Condicions-socios/{cod?}','socios\sociocontroller@limpiarCondicion');
    route::resource('socios/Condicions-socios','socios\sociocontroller@condicions');
    route::get('socios/ListaSocios/{dato?}/{page?}','socios\sociocontroller@Listasocios');
    route::resource('socios/modalsocio','socios\sociocontroller@ModalSocio');    
    route::resource('socios','socios\sociocontroller');
    
    
    route::get('PadronSocio/{idsocio}','socios\sociocontroller@verPadronsocio');
   //  *********************************************************   RRHH  ************************************************************************
    route::resource('RRHH/Sucursalsearch','RRHH\sucursalescontroller@autocomplete');//autocomplete
    route::resource('RRHH/Sucursales','RRHH\sucursalescontroller@autocompletesucursal');//autocompletesucursal  
    
    route::resource('RRHH/autoempleadoDni','RRHH\empleadocontroller@autocompleteEmpleadoDni');
    route::resource('RRHH/autoempleado','RRHH\empleadocontroller@autocompleteEmpleado');//   autocompleteEmpleado 
    route::resource('RRHH/modalempleado','RRHH\empleadocontroller@modalEmpleado');
    route::resource('RRHH/Empleados','RRHH\empleadocontroller');
    
    route::resource('RRHH/Cargos','RRHH\cargoscontroller');
    route::resource('RRHH/Area','RRHH\areascontroller');    
    
    route::resource('RRHH/Sucursal/Acopiador','RRHH\sucursalescontroller@listaacopiadores');//listaacopiadores
    route::resource('RRHH/Sucursal','RRHH\sucursalescontroller');
    
    route::resource('RRHH/Tecnicos/Tecnico-Local','RRHH\tecnicoscontroller@listaSectorAsignados');//listaSectorAsignados
    route::resource('RRHH/modaltecnicos','RRHH\tecnicoscontroller@modalTecnicos');
    route::resource('RRHH/Tecnicos','RRHH\tecnicoscontroller');
    
    route::resource('RRHH/Empresas/ListaEmpresa','RRHH\EmpresaController@ListEmpresa');
    route::resource('RRHH/Empresas','RRHH\EmpresaController');
    // *************************************************************************************  ACOPIO **********************************************
    route::get('Acopio/listaRecepcionFondos/{an?}/{mes?}/{dato?}','Acopio\recepcion_fondoscontroller@recepcionfondos'); 
    route::resource('Acopio/Fondos-Acopio','Acopio\recepcion_fondoscontroller');
//    route::resource('Acopio/PlanillaSemanal/{id}','Acopio\planillacontroller@planillasemanal');
    
    route::get('Acopio/Planilla-Semanal/ListaSemanal/{page?}','Acopio\planillacontroller@ListaSemanal');
    route::resource('Acopio/newplanillasemanal','Acopio\planillacontroller@newPlanillaSemanal');
    route::resource('Acopio/Planilla-Semanal','Acopio\planillacontroller');
    route::resource('Acopio/Planilla-Semanal/PDF','Informes\RecibosController@PlanillaSemanalPDF');
    
    route::resource('Acopio/Planilla-Mensual','Acopio\planillacontroller@cierremensual');//cierremensual
    
    route::resource('nosocios','Acopio\comprascontroller@autoCompleteNosocios');
    
    route::get('Acopio/Compra-Grano/Recibo-Compra/{id?}','Informes\RecibosController@ReciboCompras');
    route::resource('Acopio/modalcompras','Acopio\comprascontroller@modalCompras');
    route::get('Acopio/Compra-Grano/ListaCompras/{page?}','Acopio\comprascontroller@ListCompras');
    route::resource('Acopio/Compra-Grano','Acopio\comprascontroller');
    route::resource('Acopio/Tara','Acopio\tarascontroller');
    route::resource('Acopio/Transporte','Acopio\transportecontroller');
    route::resource('Acopio/Excel','Acopio\planillacontroller@excel');
    route::resource('Acopio/Pdf','Acopio\planillacontroller@pdf');
    route::resource('Acopio/Gastos-Almacen','Acopio\EgresosController');
    route::resource('Acopio/Adelantos-Acopio/Modal-Adelanto','Acopio\AdelantoAcopioController@adelantoacopio');
    route::resource('Acopio/Adelantos-Acopio','Acopio\AdelantoAcopioController');
    route::resource('Acopio/Persona-Juridica','Tesoreria\persona_juridicacontroller');
    
    // *********************************************************************************   MODULO DE TESORERIA ************************************     
    route::resource('Tesoreria/Caja/Apertura-Cierre-Caja','Tesoreria\CajaController@Caja');
    route::resource('Tesoreria/Caja/Lista-caja','Tesoreria\CajaController@listacaja');
    route::resource('Tesoreria/Caja/Datos-Caja','Tesoreria\CajaController@DatoCaja');
    route::resource('Tesoreria/Caja','Tesoreria\CajaController');
        
    route::get('Tesoreria/Distribucion/ReciboAcopio/{id}','Tesoreria\tesoreriacontroller@recibofondoAcopiador');//recibofondoAcopiador    
    route::get('Tesoreria/Distribucion-Fondos/Distribucion-Pdf/{anio?}/{mes?}/{dato?}','Informes\Reportecontroller@pdfDistribucionFondo');
    route::get('Tesoreria/Distribucion-Fondos/Distribucion-Excel/{anio?}/{mes?}/{dato?}','Informes\Reportecontroller@excelDistribucionFondo');
    route::resource('Tesoreria/Distribucion/Recibodistribucion','Tesoreria\tesoreriacontroller@recibofondoDistribucion');//recibofondoTecnicoo    
    route::get('Tesoreria/ListaDistribucion/{anio?}/{mes?}/{dato?}/{page?}','Tesoreria\tesoreriacontroller@listaDistribucion');
    route::get('Tesoreria/MontoFondosCheque/{id?}','Tesoreria\tesoreriacontroller@MontoFondoCheque');
    route::resource('Tesoreria/Distribucion-Fondos','Tesoreria\tesoreriacontroller');
    
    route::get('Tesoreria/ListMovcheques/{anio?}/{mes?}/{dato?}/{page?}','Tesoreria\Mov_chequeController@listMovcheques');    
    route::resource('Tesoreria/headmovcheque','Tesoreria\Mov_chequeController@headmovcheque');
    route::resource('Tesoreria/modalmovcheque','Tesoreria\Mov_chequeController@movcheque');
    route::resource('Tesoreria/Cheques-Girados','Tesoreria\Mov_chequeController');
    route::resource('Tesoreria/Cheques-Girados/numeroCheque','Tesoreria\Mov_chequeController@numCheque');
    route::resource('uploadimage','Tesoreria\Mov_chequeController@uploadImage');//uploadImage    
    route::get('Tesoreria/numCheque/{id}','Tesoreria\Caja_chicaController@autoNumCheque');
    route::resource('Tesoreria/headcajachica','Tesoreria\Caja_chicaController@headcajachica');
    
    route::resource('Tesoreria/Mov-Caja-Chica/modalCaja','Tesoreria\Caja_chicaController@cajachica');
    route::resource('Tesoreria/Mov-Caja-Chica/Crear-Caja','Tesoreria\Caja_chicaController@create');
    route::resource('Tesoreria/Mov-Caja-Chica','Tesoreria\Caja_chicaController');
    route::get('Tesoreria/Mov-Caja-Chica/{anio?}/{mes?}/{dato?}/{page?}','Tesoreria\Caja_chicaController@index');
    
    route::resource('Tesoreria/Mov-Dinero/DineroSD','Tesoreria\Mov_dineroController@StoreSinDocumentos');
    route::resource('Tesoreria/Mov-Dinero/Sin-Documento','Tesoreria\Mov_dineroController@MDSinDocumento');
    route::resource('Tesoreria/Mov-Dinero/Con-Documento','Tesoreria\Mov_dineroController@MDConDocumento');
    route::resource('Tesoreria/Mov-Dinero/Modal-Dinero','Tesoreria\Mov_dineroController@modalDinero');
    route::resource('Tesoreria/Mov-Dinero','Tesoreria\Mov_dineroController');
    
    route::resource('Tesoreria/Mov-Bancario','Tesoreria\Mov_bancarioController');
    
    route::resource('Tesoreria/modalcheque','Tesoreria\ChequeController@cheque');//cheque  
    route::resource('Tesoreria/RegistrarCheques','Tesoreria\ChequeController@store');
    route::put('Tesoreria/ActualizarCheques/{id}','Tesoreria\ChequeController@update'); 
    route::delete('Tesoreria/deleteCheques/{id}','Tesoreria\ChequeController@destroy');        
    route::get('Tesoreria/ListaCheques/{buscar?}/{page?}','Tesoreria\ChequeController@listaCheque');   
    route::resource('Tesoreria/Cheques','Tesoreria\ChequeController');
    
    route::put('Tesoreria/UpdateMovCheque/{id}','Tesoreria\Mov_chequeController@updateAnular');
//    route::resource('Tesoreria/NewMovCheque','Tesoreria\Mov_chequeController');
    
    
    
               
    route::resource('Tesoreria/Tipos-egresos','Tesoreria\tipo_egresoscontroller');
            
    route::resource('Creditos/Creditos-Financieros','Creditos\prestamoscontroller');
    //********************************   CONDIGURACION *******************************************************************************
            
    route::resource('Configuracion/Documentos','Configuracion\tipo_documentoController');
    
    // ******************************************************************  REPORTES O INFORMES GRAFICAS ******************************** 
    route::get('Acopio/Fondos-Acopio/Report-Fondos-Acopio/{an?}/{mes?}/{dato?}','Informes\Reportecontroller@pdfrecepcion');
    route::get('Acopio/Fondos-Acopio/excel-Fondos-Acopio/{an?}/{mes?}','Informes\Reportecontroller@excelrecepcion');
    
    route::get('Tesoreria/Cheques-Girados/Reporte-cheques/{an?}/{mes?}/{dato?}','Informes\Reportecontroller@pdfGiroCheques');
    route::get('Tesoreria/Cheques-Girados/Excel-cheques/{an?}/{mes?}/{dato?}','Informes\Reportecontroller@ExcelGiroCheques');
    
    route::resource('ReporpadronSocios','Informes\Reportecontroller@ReporpadronSocios');
    
    route::get('Informes/Acopio/Fondos-Acopio/{a?}/{mes?}','Informes\ListaInformescontroller@grafica_acopio_dinero');
    route::resource('Informes/Acopio/Grafica-Fondos','Informes\ListaInformescontroller@grafica_fondos');
    route::get('Informes/Tesoreria/Grafica-giros/{a?}/{mes?}','Informes\ListaInformescontroller@grafica_Giro_cheques');
    route::resource('Informes/Tesoreria/Giro-Cheques','Informes\ListaInformescontroller@Giro_cheques');
    route::get('Informes/Tesoreria/Grafica-Distribucion/{tecnico?}/{a?}/{mes?}','Informes\ListaInformescontroller@grafica_distribucion_fondos');
    route::resource('Informes/Tesoreria/Distribucion-Fondos','Informes\ListaInformescontroller@distribucion_fondos');
    
    route::get('Informes/grafica-socios/{a?}/{mes?}','Informes\ListaInformescontroller@grafico_socios');    
    route::resource('Informes/Padron-Socios','Informes\ListaInformescontroller@padronsocios');
    route::resource('Informes','Informes\ListaInformescontroller');
    
        
    route::get('codrecibos/{id}','Configuracion\tipo_documentoController@getnumerodocumento');
    route::resource('codrecibos','Configuracion\tipo_documentoController@autoCompleteCodRecibo');//
    //*****************************************************************     CERTIFICACION *************************************************************
    
    route::resource('Certificacion/Condicion','Certificacion\condicioncontroller');
    route::resource('Certificacion','Certificacion\condicioncontroller@certificacion');    
    
});
