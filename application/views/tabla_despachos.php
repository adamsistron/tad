<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

        
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('DataTables-1.10.4/media/css/jquery.dataTables.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('DataTables-1.10.4/examples/resources/syntax/shCore.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('DataTables-1.10.4/examples/resources/demo.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/css/dataTables.responsive.css');?>">
	<style type="text/css" class="init">

	div.container { max-width: 1200px }

	</style>
        
        <script type="text/javascript" language="javascript" src="<?php echo base_url('DataTables-1.10.4/media/js/jquery.js');?>"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url('DataTables-1.10.4/media/js/jquery.dataTables.js');?>"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url('DataTables-1.10.4/examples/resources/syntax/shCore.js');?>"></script>
        <script type="text/javascript" language="javascript" src="<?php echo base_url('DataTables-1.10.4/examples/resources/demo.js');?>"></script>
        <script type="text/javascript" language="javascript" src="<?php echo base_url('/js/dataTables.responsive.js');?>"></script>
		<script type="text/javascript" language="javascript" class="init">



$(document).ready(function() {
	$('#example').DataTable( {
		responsive: true,
                "scrollY": 300,
		"scrollX": false,
                "pageLength": 20,
                "order": [[ 6, "asc" ]],
                "language": {
                    "lengthMenu": " _MENU_ registros por página",
                    "zeroRecords": "No se encontrarón registros",
                    "info": "Mostrando la página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado desde _MAX_ total registros)",
                    "search":         "Búsqueda",
                }
	} );
        //setTimeout(function(){ location.reload(); }, 60000);//120000=2min
} );



	</script>
	</head>
	<body id="dt_example">
		<div id="container">
                        <div class="alert alert-success" role="alert"><?php echo "$opcion = $parametro";?></div>
			
                        <section style="margin-top: 2em">
                            
                            
<table id="example" class="display nowrap compact" cellspacing="0" width="100%">
    
    
	<thead>
		<tr>
			<th>Planta</th>
			<th>Documento Transporte</th>
			<th>Placa Cisterna</th>
			<th>Cedula Conductor</th>
			<th>Nombre Conductor</th>
			<th>Código SAP EESS</th>
			<th>EESS</th>
			<th>Volumen Progrmado</th>
			<th>Volumen Bruto Despachado</th>
			<th>Estatus Desapacho</th>
			<th>Producto</th>
			<th>Fecha</th>
                     
		</tr>
	</thead>
	<tbody>
                 <?php
                           
                            $i=0;
                            $fila="";
                            foreach($resultado as $dato){
                                $i++;
                                $fila.="
                                <tr>
                                    <td>".$dato['pd']."</td>
                                    <td>".$dato['codigo_sap_despacho']."</td>
                                    <td>".$dato['placa_cisterna']."</td>
                                    <td>".$dato['cedula_conductor']."</td>
                                    <td>".$dato['nombre_conductor']."</td>
                                    <td>".$dato['codigo_sap_cliente']."</td>
                                    <td>".$dato['nombre_cliente']."</td>
                                    <td>".$dato['volumen_programado']."</td>
                                    <td>".$dato['volumen_bruto_despachado']."</td>
                                    <td>".$dato['estatus_despacho']."</td>
                                    <td>".$dato['producto']."</td>
                                    <td>".$dato['fecha_programada']."</td>
                                </tr>";
                        
                        
                            }
                            echo $fila;
                            ?>
	
	</tbody>

</table>
			</div>
                        <p class="footer">Cargada en: <strong>{elapsed_time}</strong> seg.</p>
                        <div class="spacer"></div>
        </section>
              
	</body>
</html>
