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
    return view('home');
});

    
    

Route::group(['middleware' => ['web']], function () {    
    // Authentication routes...
    //Route::get('auth/login', 'Auth\AuthController@getLogin');
//    Route::post('auth/login', ['as'=> 'login','uses'=>'Auth\AuthController@postLogin']);
//    Route::get('auth/logout', ['as'=>'logout','uses'=>'Auth\AuthController@getLogout']);
    // Registration routes...
//    Route::get('register', 'Auth\AuthController@getRegister');
//    Route::post('register',['as'=>'auth/register','uses'=>'Auth\AuthController@postRegister']);

    
    
    Route::get('comite_locales/{id}','socios\comite_localcontroller@getcomites_locales');
    Route::get('comites_centrales/{id}','socios\comite_centralcontroller@getcomites_centrales');
    Route::get('provincias/{id}','socios\provinciacontroller@getprovincias');
    Route::get('distritos/{id}','socios\distritocontroller@getdistritos');   
//    route::post('socios/{codigo}','socios\sociocontroller@update');   
        
    route::resource('socios/asignacion-delegados','socios\cargodelegadosociocontroller');
    route::resource('socios/asignacion-directivos','socios\cargodirectivosociocontroller');
    
    route::resource('socios/transferencias','socios\transferenciacontroller');
    route::resource('socios/transferencias/datos','socios\transferenciacontroller@datossocio');
    route::resource('socios/transferencias/nuevo','socios\transferenciacontroller@datosnuevo');//datosnuevo
    route::resource('socios/transferencias/persona','socios\transferenciacontroller@datosnuevobeneficiario');//datosnuevobeneficiario    
    route::resource('socios/transferencias/ficha','socios\transferenciacontroller@fichaTransferencia');//fichaTransferencia
    
    route::resource('socios/fundos','socios\fundoscontroller');
    route::resource('socios/eliminarpropiedades','socios\fundoscontroller@EliminarPropiedadesFundo');//EliminarPropiedadesFundo
    
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
    route::resource('socios/parientes','socios\parientescontroller');
    route::get('socios/parientes/{idsocio?}/{dnipar?}','socios\parientescontroller@datosparientes');
    // autocomplete 
    route::resource('socios/search','socios\sociocontroller@autocomplete');//autocomplete
    route::resource('socios/dni','socios\sociocontroller@autocompleteDniSocio');//autocompleteDniSocio
    route::resource('socios/codigo','socios\sociocontroller@autocompleteCodigoSocio');//autocompleteCodigoSocio
    route::resource('socios/dnipersona','socios\personacontroller@autoCompleteDniPersona');//autoCompleteDniPersona
    route::resource('socios/dnibeneficiario','socios\parientescontroller@autocompleteDNIpariente');//autocompleteDNIpariente
    route::resource('RRHH/Sucursalsearch','RRHH\sucursalescontroller@autocomplete');//autocomplete
    route::resource('RRHH/Sucursales','RRHH\sucursalescontroller@autocompletesucursal');//autocompletesucursal
    
    route::resource('socios','socios\sociocontroller');
    route::get('PadronSocio/{idsocio}','socios\sociocontroller@verPadronsocio');
                    
    route::resource('RRHH/empleados','RRHH\empleadocontroller');    
    
    route::resource('RRHH/Cargos','RRHH\cargoscontroller');
    route::resource('RRHH/Area','RRHH\areascontroller');    
    
    route::resource('RRHH/Sucursal/Acopiador','RRHH\sucursalescontroller@listaacopiadores');//listaacopiadores
    route::resource('RRHH/Sucursal','RRHH\sucursalescontroller');
    
    route::resource('RRHH/Tecnicos/Tecnico-Local','RRHH\tecnicoscontroller@listaSectorAsignados');//listaSectorAsignados
    route::resource('RRHH/Tecnicos','RRHH\tecnicoscontroller');
    
    
    route::resource('Acopio/Fondos-Acopio','Acopio\recepcion_fondoscontroller');
//    route::resource('Acopio/PlanillaSemanal/{id}','Acopio\planillacontroller@planillasemanal');
    route::resource('Acopio/Planilla-Semanal','Acopio\planillacontroller');
    route::resource('Acopio/Planilla-Mensual','Acopio\planillacontroller@cierremensual');//cierremensual
    
    route::resource('nosocios','Acopio\comprascontroller@autoCompleteNosocios');
    route::resource('Acopio/Compra-Grano','Acopio\comprascontroller');        
    route::resource('Acopio/Tara','Acopio\tarascontroller');
    route::resource('Acopio/Transporte','Acopio\transportecontroller');
    route::resource('Acopio/Excel','Acopio\planillacontroller@excel');
    route::resource('Acopio/Pdf','Acopio\planillacontroller@pdf');
    route::resource('Acopio/Gastos','Tesoreria\egresoscontroller');
    route::resource('Acopio/Persona-Juridica','Tesoreria\persona_juridicacontroller');
     
    route::get('Tesoreria/Distribucion/ReciboAcopio/{id}','Tesoreria\tesoreriacontroller@recibofondoAcopiador');//recibofondoAcopiador
    route::resource('Tesoreria/Distribucion/ReciboTecnico','Tesoreria\tesoreriacontroller@recibofondoTecnico');//recibofondoTecnicoo
    route::resource('Tesoreria/Distribucion-Fondos','Tesoreria\tesoreriacontroller');
    
    
    route::resource('Tesoreria/Tipos-egresos','Tesoreria\tipo_egresoscontroller');
            
    route::resource('Creditos/Creditos-Financieros','Creditos\prestamoscontroller');
    
    route::resource('Configuracion/Usuarios','Configuracion\usuarioController');
    route::resource('Configuracion','Configuracion\documentoController');
        
    route::get('codrecibos/{id}','Configuracion\tipo_documentoController@getnumerodocumento');
    route::resource('codrecibos','Configuracion\tipo_documentoController@autoCompleteCodRecibo');//
    
    
});
