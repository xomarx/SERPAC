


function cargar_barras($an,$mes) {
    
    $.get('grafica-socios/'+$an+'/'+$mes, function (data) {
       var datos = jQuery.parseJSON(data);
        var registro = datos.Registros;
        var meses = datos.meses;                        
         var options = {        
	 chart: {
	 	    renderTo: 'div-graficas',
            type: 'column'
        },
        title: {
            text: 'REGISTROS DE SOCIOS'
        },
        subtitle: {
            text: 'ACOPAGRO'
        },
        xAxis: {            
            categories: datos.anios,        
             title: {
                text: 'FECHA - AÑOS'
            },
            crosshair: true
        },
        legend: {
        enabled: true
    },
        yAxis: {
            min: 0,
            title: {
                text: 'N° DE SOCIOS REGISTRADOS'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} Cantidad</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
        },
        plotOptions: {
            series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}'
            }
        }
        },
        series: [{
            name: 'Activos',            
            data: datos.activos
        },
        {
            name: 'Reinscritos',            
            data: datos.reinscrito
        },
        {
            name: 'Retirados',            
            data: datos.retirado
        },
        {
            name: 'Renunciante',            
            data: datos.renunciante
        }
    ],
    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    align: 'center',
                    verticalAlign: 'bottom',
                    layout: 'horizontal'
                },
                yAxis: {
                    labels: {
                        align: 'left',
                        x: 0,
                        y: -5
                    },
                    title: {
                        text: null
                    }
                },
                subtitle: {
                    text: null
                },
                credits: {
                    enabled: false
                }
            }
        }]
    }
    }
    chart = new Highcharts.Chart(options);
//        $.each(datos.anios, function (index, value) {
//            options.series[0].data.push(registro[index]);
//            options.xAxis.categories.push(value);
//
//        });
    });                       
}

function grafico_barra_k_Dinero($an,$mes){
    
    $.get('Fondos-Acopio/'+$an+'/'+$mes, function (data) {
       var datos = jQuery.parseJSON(data);        
                                
         var options = {        
	 chart: {
	 	    renderTo: 'div-graficas',
            type: 'column'
        },
        title: {
            text: 'DISTRIBUCION DE FONDOS POR FECHAS'
        },
        subtitle: {
            text: 'ACOPAGRO'
        },
        xAxis: {            
            categories: datos.fechas,        
             title: {
                text: 'FECHAS'
            },
            crosshair: true
        },
        legend: {
        enabled: true
    },
        yAxis: {
            min: 0,
            title: {
                text: 'MONTO EN S/. '
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} Soles</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
        },
        plotOptions: {
            series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}'
            }
        }
        },
        series: [{
            name: 'Montos S/. ',            
            data: datos.montos
              }
    ],
    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    align: 'center',
                    verticalAlign: 'bottom',
                    layout: 'horizontal'
                },
                yAxis: {
                    labels: {
                        align: 'left',
                        x: 0,
                        y: -5
                    },
                    title: {
                        text: null
                    }
                },
                subtitle: {
                    text: null
                },
                credits: {
                    enabled: false
                }
            }
        }]
    }
    }
    chart = new Highcharts.Chart(options);

    });                       
};

// *******************************  TESORERIA *******************************

function grafico_barra_delivery_money($anio,$mes){       
    $.get('Grafica-giros/'+$anio+'/'+$mes, function (data) {        
    var datos = jQuery.parseJSON(data);                         
    var seriesx =[];
    $.each(datos.cheques,function( index,value){
            var cars = {name:value,data:datos.montos[index]};
           seriesx.push(cars);
       });              
         var options = {   
    chart: {
                 renderTo: 'div-graficas',
        type: 'column'
    },
    title: {
        text: 'GRAFICA DE GIROS DE CHEQUES'
    },
    subtitle: {
        text: 'ACOPAGRO'
    },
    legend: {
        align: 'right',
        verticalAlign: 'middle',
        layout: 'vertical'
    },
    tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>S/. {point.y:.1f}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
        },
    plotOptions: {
            column: {
            pointPadding: 0.2,
            borderWidth: 0
        
        }
        },
    xAxis: {
        categories: datos.fechas,
        title: {
                text: 'FECHAS'
            },
            crosshair: true
    },
    yAxis: {
        allowDecimals: false,
        title: {
            text: 'MONTO EN S/. '
        }
    },
    series: seriesx,             
    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    align: 'center',
                    verticalAlign: 'bottom',
                    layout: 'horizontal'
                },
                yAxis: {
                    labels: {
                        align: 'left',
                        x: 0,
                        y: -5
                    },
                    title: {
                        text: null
                    }
                },
                subtitle: {
                    text: null
                },
                credits: {
                    enabled: false
                }
            }
        }]
    }    
    }
    chart = new Highcharts.Chart(options);
    });
}

/*
 
 
 
 
 
 * 
 * 
 * 
 */

 