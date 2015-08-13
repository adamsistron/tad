<?php
//$this->load->view('menu_scli');
?>

<?php
  
$tablet_browser = 0;
$mobile_browser = 0;
$body_class = 'desktop';
 
if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
    $tablet_browser++;
    $body_class = "tablet";
}
 
if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
    $mobile_browser++;
    $body_class = "mobile";
}
 
if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
    $mobile_browser++;
    $body_class = "mobile";
}
 
$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
$mobile_agents = array(
    'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
    'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
    'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
    'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
    'newt','noki','palm','pana','pant','phil','play','port','prox',
    'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
    'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
    'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
    'wapr','webc','winw','winw','xda ','xda-');
 
if (in_array($mobile_ua,$mobile_agents)) {
    $mobile_browser++;
}
 
if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'opera mini') > 0) {
    $mobile_browser++;
    //Check for tablets on opera mini alternative headers
    $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'])?$_SERVER['HTTP_X_OPERAMINI_PHONE_UA']:(isset($_SERVER['HTTP_DEVICE_STOCK_UA'])?$_SERVER['HTTP_DEVICE_STOCK_UA']:''));
    if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
      $tablet_browser++;
    }
}
if ($tablet_browser > 0) {
// Si es tablet has lo que necesites
   $dispositivo = 2;
   $center = 87;
   $size = 120;
}
else if ($mobile_browser > 0) {
// Si es dispositivo mobil has lo que necesites
   //print 'es un mobil';
    $dispositivo = 3;
    $center = 90;
    $size = 100;
}
else {
// Si es ordenador de escritorio has lo que necesites
   $dispositivo = 1;
   $center = 87;
   $size = 120;
   
} 
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <link rel="shortcut icon" type="image/ico" href="<?php echo base_url('images/pdvsa.ico');?>">
		<title>SCLi</title>
                
                <script type="text/javascript" src="<?php echo base_url('js/jquery.min_1.js');?>"></script>
                <link rel="stylesheet" href="<?php echo base_url('css/jquery-ui.css');?>">
                <script src="<?php echo base_url('js/jquery-ui.js');?>"></script>
                

		<script type="text/javascript">
$(function() {
$( ".dialog" ).dialog({
    autoOpen: false,

    show: {
      effect: "clip",
      duration: 500
    },
    hide: {
      effect: "clip",
      duration: 400
    },
    resizable: false,
    modal: true,
    width:'auto',
    height: 450
});

  });
//MEDIDOR DE VELOCIDAD                    
$(function () {

    $('#medidor_velocidad').highcharts({

        chart: {
            type: 'gauge',
            
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false,
            events:{
                click:function(){
               
                explicacion('medidor');
        
                }
            }
        },
        title: {
            text: 'Ritmo de Despachos',
            margin: 5,
            style: {
                    color: '#1F2B37',
                    fontSize: '12px'        
                    }
        },
        pane: {
            startAngle: -150,
            endAngle: 150,
            background: [{
                backgroundColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                    stops: [
                        [0, '#FFF'],
                        [1, '#333']
                    ]
                },
                borderWidth: 0,
                outerRadius: '109%'
            }, {
                backgroundColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                    stops: [
                        [0, '#333'],
                        [1, '#FFF']
                    ]
                },
                borderWidth: 1,
                outerRadius: '107%'
            }, {
                // default background
            }, {
                backgroundColor: '#DDD',
                borderWidth: 0,
                outerRadius: '105%',
                innerRadius: '103%'
            }]
        },
        credits: {
            enabled: false
        },
        // the value axis
        yAxis: {
            min: 0,
            max: 120,

            minorTickInterval: 'auto',
            minorTickWidth: 1,
            minorTickLength: 13,
            minorTickPosition: 'inside',
            minorTickColor: 'gray',

            tickPixelInterval: 30,
            tickWidth: 2,
            tickPosition: 'inside',
            tickLength: 13,
            tickColor: '#666',
            labels: {
                step: 2,
                rotation: 'auto'
            },
            title: {
                text: ''
            },
            plotBands: [{
                from: 0,
                to: 50,
                color: '#FA5858' // rojo
            }, {
                from: 50,
                to: 75,
                color: '#F4FA58' // amarillo
            }, {
                from: 75,
                to: 100,
                color: '#55BF3B' // verde
            }, {
                from: 100,
                to: 120,
                color: '#81BEF7' // azul
            }]
        },

        series: [{
            name: 'Velocidad',
            data: [0],
            tooltip: {
                valueSuffix: ' '
            }
        }]

    });
});
//AVANCES DE DESPACHO
$(function () {

    var gaugeOptions = {

        chart: {
            type: 'solidgauge'/*,
            events:{
                click:function(){
               		explicacion('avance');

                }
            }*/
        },

        title: null,

        pane: {
            center: ['50%', '<?php echo "$center%";?>'],
            size: '<?php echo "$size%";?>',
            startAngle: -90,
            endAngle: 90,
            background: {
                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#EEE',
                innerRadius: '60%',
                outerRadius: '100%',
                shape: 'arc'
            }
        },

        tooltip: {
            enabled: false
        },

        // the value axis
        yAxis: {
            stops: [
                [0, '#DF5353'], // green 55BF3B
                [0.65, '#DDDF0D'], // yellow DDDF0D
                [0.85, '#55BF3B'] // red DF5353
            ],
            lineWidth: 0,
            minorTickInterval: null,
            tickPixelInterval: 400,
            tickWidth: 0,
            title: {
                y: -135
            },
            labels: {
                y: 16
            }
        },

        plotOptions: {
            solidgauge: {
                dataLabels: {
                    y: 15,
                    borderWidth: 0,
                    useHTML: true
                }
            }
        },
        credits: {
            enabled: false
            }
    };

// AVANCE vs. HISTORICO
    $('#avance_historico').highcharts(Highcharts.merge(gaugeOptions, {
        yAxis: {
            min: 0,
            max: 120,
            title: {
                text: 'Avance vs. Historico',
                style: {
                    color: '#1F2B37',
                    fontSize: '12px'        
                    }
            },
            
        },
        chart: {
            type: 'solidgauge',
            events:{
                click:function(){
               		explicacion('historico');
                        //alert("GRIS");
                }
            }
            
        },
        
        credits: {
            enabled: false
        },

        series: [{
            name: 'Avance vs. Historico',
            data: [0],
            dataLabels: {
                format: '<div style="text-align:center"><span style="font-size:25px;color:' +
                    ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y:.1f} %</span><br/>' +
                       '<span style="font-size:12px;color:silver">Despachos / Historico</span></div>'
            },
            tooltip: {
                valueSuffix: ' '
            },
            events:{
                click:function(){
               		explicacion('historico');
                        //alert("COLOR");
                }
            }
                    
        }]

    }));

// AVANCE vs. PROGRAMADO
    $('#avance_programado').highcharts(Highcharts.merge(gaugeOptions, {
        yAxis: {
            min: 0,
            max: 120,
            title: {
                text: 'Avance vs. Programado',
                style: {
                    color: '#1F2B37',
                    fontSize: '12px'        
                    }
            }
        },
           chart: {
            type: 'solidgauge',
            events:{
                click:function(){
               		explicacion('avance');
                        //alert("GRIS");
        
                }
            }
            
        }, 

        series: [{
            name: 'Avance vs. Programado',
            data: [0],
            dataLabels: {
                format: '<div style="text-align:center"><span style="font-size:25px;color:' +
                    ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y:.1f} %</span><br/>' +
                       '<span style="font-size:12px;color:silver">Despachos / Programado </span></div>'
            },
            credits: {
            enabled: false
            },        
            tooltip: {
                valueSuffix: ' revolutions/min'
            },
            events:{
                click:function(){
               		explicacion('avance');
                        //alert("COLOR");
                }
            }
        }]

    }));

});
//VOLUMEN DE PRODUCTO
$(function () {
   
    $('#volumen_producto').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Volumen Despachado',
            margin: 10,
            style: {
                    color: '#1F2B37',
                    fontSize: '12px'        
                    }
        },
        xAxis: {
            categories: ['Productos'],
            title: {
                text: ''
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Volumen (Bls.)'
            },
            labels: {
                overflow: 'justify'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        tooltip: {
            valueSuffix: ' Barriles'
        },
        plotOptions: {
            column: {
                //stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: 'black',
                    //y: 18,
                    
                    style: {
                        fontSize: '10px',
                        textShadow: '0 0 3px white'
                    }
                }
            },
            series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function () {
                            //alert(this.category+this.series.name);
                            //nomina_lenel(this.series.name);
                        }
                    }
                }
            }
        },
        exporting: {
            enabled: true
        },
        credits: {
            enabled: false
        },
        series:  <?php echo $serie_data; ?>,
        colors: ['#3E65FF', '#d8352f', '#55BF3B', '#ff692a', '#1aadce','#492970', '#ffc22a', '#00858c']
    });
  
});
//ESTATUS DE DESPACHOS
$(function () {

    $(document).ready(function () {

        // Build the chart
        $('#estatus_despachos').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Estatus por Despacho',
                style: {
                    color: '#1F2B37',
                    fontSize: '12px'        
                    }
            },
            tooltip: {
                pointFormat: 'UTC: <b>{point.y} de {point.total}</b><br>Corresponde al: <b>{point.percentage:.1f}%</b>',
            },
            credits: {
            enabled: false
            },
            
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                type: 'pie',
                name: 'Porcentaje',
                data: [
                    ['Autorizados',0],//
                    ['En Despacho',0],//
                    ['Enviado a SCLI',0],//
                    ['Despachado y Enviado',0],//#1d9d63
                    ['Anulado por Facturación',0]//#d8352f
                ]
            }],
        colors: ['#1aadce', '#ff692a', '#ffd83e', '#55BF3B', '#d8352f', 
   '#492970', '#f28f43', '#77a1e5', '#c42525', '#a6c96a']
        });
    });

});
//DESPACHO vs. PROYECTADO
$(function () {
    $('#despachos_proyectado').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Despachos Real vs Optimo',
            style: {
                    color: '#1F2B37',
                    fontSize: '12px'        
                    }
        },
        credits: {
            enabled: false
            },
        xAxis: {
            categories: [
                'Despachado vs. Historico'
            ]
        },
        yAxis: [{
            min: 0,
                title: {
                    text: ''
                }
            }, {
                title: {
                    text: 'UTC'
                },
                opposite: true
            }],
        legend: {
            shadow: false
        },
        tooltip: {
            shared: true
        },
        plotOptions: {
            column: {
                grouping: false,
                shadow: false,
                borderWidth: 0
            }
        },
        series: [{
            name: 'UTC Optimo',
            color: '#81BEF7',
            data: [0],
            pointPadding: 0.3,
            pointPlacement: 0.2,
            yAxis: 1
        }, {
            name: 'UTC Real',
            color: '#0B0B61',
            data: [0],
            
            pointPadding: 0.4,
            pointPlacement: 0.2,
            yAxis: 1
        }]
    });
});
//AJAX ACUALIZA CHARTS
function planta(){

    var planta= $('#planta').val();    
        $.ajax({
          url:"<?php echo base_url('scli/scli_2');?>",
          type: "POST",
          data:{planta:planta},
          success: function(response) {

            $("#valores").val(response);
             
            var array = $("#valores").val().split("*"); 
            //SET CHARTS 
            var chart1 = $('#medidor_velocidad').highcharts();
            var chart2 = $('#avance_programado').highcharts();
            var chart3 = $('#avance_historico').highcharts();
            var chart4 = $('#volumen_producto').highcharts();
            var chart5 = $('#estatus_despachos').highcharts();
            var chart6 = $('#despachos_proyectado').highcharts();
            
            //CHART 1 
            if(!isNaN(array[0])){
                var point1 = chart1.series[0].points[0];
                var newValue1 = parseFloat(array[0]);
                point1.update(newValue1);
            }else{
                var point1 = chart1.series[0].points[0];
                point1.update(0);
            }
            //CHART 2
            var point2 = chart2.series[0].points[0];
            var newValue2 = parseFloat(array[2]);
            point2.update(newValue2);
            //CHART 3
            var point3 = chart3.series[0].points[0];
            var newValue3 = parseFloat(array[1]);
            point3.update(newValue3);
            //CHART 4
            if(parseFloat(array[3])>0){
                chart4.series[0].setData([parseFloat(array[3])]);
                chart4.series[0].show();
            }else{
                chart4.series[0].hide();
                //chart4.series[0].setData(0);
            }
            if(parseFloat(array[4])>0){
                chart4.series[1].setData([parseFloat(array[4])]);
                chart4.series[1].show();
            }else{
                chart4.series[1].hide();
                //chart4.series[1].setData(0);
            }
            if(parseFloat(array[5])>0){
                chart4.series[2].setData([parseFloat(array[5])]);
                chart4.series[2].show();
            }else{
                chart4.series[2].hide();
                //chart4.series[2].setData(0);
            }
            if(parseFloat(array[6])>0){
                chart4.series[3].setData([parseFloat(array[6])]);
                chart4.series[3].show();
            }else{
                chart4.series[3].hide();
                //chart4.series[3].setData(0);
            }
            if(parseFloat(array[7])>0){
                chart4.series[4].setData([parseFloat(array[7])]);
                chart4.series[4].show();
            }else{
                chart4.series[4].hide();
                //chart4.series[4].setData(0);
            }
            if(parseFloat(array[8])>0){
                chart4.series[5].setData([parseFloat(array[8])]);
                chart4.series[5].show();
            }else{
                chart4.series[5].hide();
                //chart4.series[5].setData(0);
            }
            if(parseFloat(array[9])>0){
                chart4.series[6].setData([parseFloat(array[9])]);
                chart4.series[6].show();
            }else{
                chart4.series[6].hide();
                //chart4.series[6].setData(0);
            }
            if(parseFloat(array[10])>0){
                chart4.series[7].setData([parseFloat(array[10])]);
                chart4.series[7].show();
            }else{
                chart4.series[7].hide();
                //chart4.series[7].setData(0);
            }
            //CHART 5            
            if(parseInt(array[11])>0){
                chart5.series[0].points[0].setVisible(true);
            }else{
                chart5.series[0].points[0].setVisible(false);
            }
            if(parseInt(array[12])>0){
                chart5.series[0].points[1].setVisible(true);
            }else{
                chart5.series[0].points[1].setVisible(false);
            }
            if(parseInt(array[13])>0){
                chart5.series[0].points[2].setVisible(true);
            }else{
                chart5.series[0].points[2].setVisible(false);
            }
            if(parseInt(array[14])>0){
                chart5.series[0].points[3].setVisible(true);
            }else{
                chart5.series[0].points[3].setVisible(false);
            }
            if(parseInt(array[15])>0){
                chart5.series[0].points[4].setVisible(true);
            }else{
                chart5.series[0].points[4].setVisible(false);
            }
            
            chart5.series[0].setData([parseInt(array[11]),parseInt(array[12]),parseInt(array[13]),parseInt(array[14]),parseInt(array[15])]);
            
            //CHART 6
            chart6.series[0].setData([parseInt(array[16])]);
            chart6.series[1].setData([parseInt(array[17])]);
            
          }
        });
        }
//AJAX EXPLICACION CHARTS
function explicacion(chart){

    var planta= $('#planta').val();
    if(planta!=0){
                  $.ajax({
                          url:"<?php echo base_url('scli');?>/"+chart,
                          type: "POST",
                          data:{planta:planta},
                          success: function(html) {
                            //alert(chart + html);
                            $("#"+chart).empty();
                            $("#"+chart).append(html);            
                            $("#"+chart).dialog( "open" );
                          }
                        });

        }else{
        alert("Seleccione una Planta Dist.");
        }
        
        }
//AJAX DETALLE CHARTS
function detalle(codigoo){  
//alert(codigoo);
var planta= $('#planta').val();
        if(codigoo!=0){
                  $.ajax({
                          url:"<?php echo base_url('scli/detalle_despacho');?>/"+codigoo+"/"+planta,
                          type: "POST",
                          data:{codigoo:codigoo},
                          success: function(html) {
                            //alert(chart + html);
                            $("#detalle_avance").empty();
                            $("#detalle_avance").append(html);            
                            $("#detalle_avance").dialog( "open" );
                          }
                        });

        }else{
            alert("No se encontro detalle del código: "+codigoo);
        }
        
        }
  
//REFRESCAR CHARTS
$(function () {
    setInterval(function () {
       planta();
    }, 180000);   

});
                </script>
	</head>
	<body>
                <script type="text/javascript" src="<?php echo base_url('Highcharts-4.0.4/js/highcharts.js');?>"></script>
                <script type="text/javascript" src="<?php echo base_url('Highcharts-4.0.4/js/highcharts-more.js');?>"></script>
                <script type="text/javascript" src="<?php echo base_url('Highcharts-4.0.4/js/modules/exporting.js');?>"></script>
                <script type="text/javascript" src="<?php echo base_url('Highcharts-4.0.4/js/modules/solid-gauge.src.js');?>"></script>
<?php if($dispositivo == 1 || $dispositivo == 2){?>
<table style="margin:auto; width:100%; height: 30%" cellpadding="0" cellspacing="0" border="0" >
                    <tbody>
                        <tr>

                            <td colspan="3" >
                    <center>
                        <select class="form-control" id="planta" name='plantas' onchange='planta();' style="" >
                                <option value='0' selected>---Seleccione Planta---</option>
                                <option value='Planta Dist. Bajo Grande'>Planta Dist. Bajo Grande</option>
                                <option value='Planta Dist. Barquisimeto'>Planta Dist. Barquisimeto</option>
                                <option value='Planta Dist. Catia La Mar'>Planta Dist. Catia La Mar</option>
                                <option value='Planta Dist. Cardon'>Planta Dist. Cardon</option>
                                <option value='Planta Dist. Ciudad Bolivar'>Planta Dist. Ciudad Bolivar</option>
                                <option value='Planta Dist. El Palito'>Planta Dist. El Palito</option>
                                <option value='Planta Dist. El Vigia'>Planta Dist. El Vigia</option>
                                <option value='Planta Dist. Guatire'>Planta Dist. Guatire</option>
                                <option value='Planta Dist. Maturin'>Planta Dist. Maturin</option>
                                <option value='Planta Dist. Puerto La Cruz'>Planta Dist. Puerto La Cruz</option>
                                <option value='Planta Dist. Puerto Ordaz'>Planta Dist. Puerto Ordaz</option>
                                <option value='Planta Dist. San Lorenzo'>Planta Dist. San Lorenzo</option>
                                <option value='Planta Dist. San Tome'>Planta Dist. San Tome</option>
                                <option value='Planta Dist. Yagua'>Planta Dist. Yagua</option>
                                </select>
                        
                    </center>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 33%; height: 280px" id="medidor_velocidad"></td>
                            <td style="width: 33%" id="avance_programado"></td>
                            <td style="width: 33%" id="avance_historico"></td>
                        </tr>
                        <tr>
                            <td style="width: 33%; height: 310px" id="volumen_producto"></td>
                            <td style="width: 33%" id="estatus_despachos"></td>
                            <td style="width: 33%" id="despachos_proyectado"></td>
                        </tr>
                    </tbody>
                </table>
<?php }else{?>
<div class="container-fluid"> 
    <select class="form-control" id="planta" name='plantas' onchange='planta();'>
            <option value='0' selected>---Seleccione Planta---</option>
            <option value='Planta Dist. Bajo Grande'>Planta Dist. Bajo Grande</option>
            <option value='Planta Dist. Barquisimeto'>Planta Dist. Barquisimeto</option>
            <option value='Planta Dist. Catia La Mar'>Planta Dist. Catia La Mar</option>
            <option value='Planta Dist. Cardon'>Planta Dist. Cardon</option>
            <option value='Planta Dist. Ciudad Bolivar'>Planta Dist. Ciudad Bolivar</option>
            <option value='Planta Dist. El Palito'>Planta Dist. El Palito</option>
            <option value='Planta Dist. El Vigia'>Planta Dist. El Vigia</option>
            <option value='Planta Dist. Guatire'>Planta Dist. Guatire</option>
            <option value='Planta Dist. Maturin'>Planta Dist. Maturin</option>
            <option value='Planta Dist. Puerto La Cruz'>Planta Dist. Puerto La Cruz</option>
            <option value='Planta Dist. Puerto Ordaz'>Planta Dist. Puerto Ordaz</option>
            <option value='Planta Dist. San Lorenzo'>Planta Dist. San Lorenzo</option>
            <option value='Planta Dist. San Tome'>Planta Dist. San Tome</option>
            <option value='Planta Dist. Yagua'>Planta Dist. Yagua</option>
    </select>

<div class="row">
    <div class="col-md-4" id="medidor_velocidad"></div>
    <div class="col-md-4" id="avance_programado"></div>
    <div class="col-md-4" id="avance_historico"></div>
</div>
<div class="row">
    <div class="col-md-4" id="volumen_producto"></div>
    <div class="col-md-4" id="estatus_despachos"></div>
    <div class="col-md-4" id="despachos_proyectado"></div>
</div>

</div>
<?php }?>
                
                <div id="contenedor">
                    <div id="medidor" class="dialog" title="Detalle Velocidad Despacho"></div>
                    <div id="avance" class="dialog" title="Detalle Avance vs Programado - Detalle E/S Despachadas"></div>
                    <div id="detalle_avance" class="dialog" title="Detalle Despacho"></div>
                    <div id="historico" class="dialog" title="Detalle Avance vs Histórico"></div>
                </div>
<input type="hidden" id="planta_seleccionada" />    
                        <input type="hidden" id="valores" />
	</body>
</html>
