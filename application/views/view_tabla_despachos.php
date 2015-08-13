<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/ico" href="<?php echo base_url('images/pdvsa.ico');?>">
    <title>Consumos EESS</title>
        
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
                "scrollY": 400,
		"scrollX": true,
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
        setTimeout(function(){ location.reload(); }, 60000);//120000=2min
} );



	</script>
</head>

<body class="dt-example">
	<div class="container">
            <section style="margin-top: 2em">
			

			<table id="example" class="display nowrap compact" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Alerta</th>
						<th>E/S</th>
						<th>Placa</th>
                                                <th>Producto</th>
						<th>Volumen</th>
						<th>Fecha Consumo</th>
						<th>Minutos</th>
                                                <th>Registro</th>
						
						
					</tr>
				</thead>
                                <tbody>
                 <?php
                           //estacion_servicio, placa, fecha_consumo, combustible, volumen_consumo
                            $i=0;
                            $fila="";
                            $base_url ="";
                            foreach($datos as $dato){
                                $i++;
                                $base_url = base_url('sisccombf/eess_detalle/'.$dato['id_historico_consumo']);
                                
                                $minutos = $dato['minutos'];
                                
                                //echo $minutos;die();
                                if($minutos<=15){
                                    $alerta = 'roja';
                                    $tiempo = ': Menor a 15min';
                                }
                                if($minutos>15 && $minutos<=30){
                                    $alerta = 'amarilla';
                                    $tiempo = ': Entre (15-30)min';
                                }
                                if($minutos>30){
                                    $alerta = 'azul';
                                    $tiempo = ': Mayor a 30min';
                                }
                                
                                
                                $img = base_url("images/alerta-$alerta.png");
                                //<td>"."($fecha_i-$fecha_f)=$minutos"."</td>
                                
                                //<td><a target='_blank' href=$base_url>".$dato['estacion_servicio'].$minutos."</a></td>
                                $fila.="
                                <tr class='highlight'>
                                <td><img title='".$alerta.$tiempo."' src='".$img."'/></td>
                                    <td title='".$dato['id_historico_consumo']."'>".$dato['estacion_servicio']."</td>
                                    <td>".$dato['placa']."</td>
                                    <td>".$dato['combustible']."</td>
                                    <td>".$dato['volumen_consumo']."</td>
                                    <td>".$dato['fecha_consumo']."</td>
                                    <td>".$minutos."</td>
                                    <td>".$dato['id_historico_consumo']."</td>
                               </tr>";
                        
                        
                            }
                            echo $fila;
                            ?>
	
	</tbody>
			</table>


			
		</section>
	</div>
</body>
</html>