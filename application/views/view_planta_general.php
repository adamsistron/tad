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
        

</head>

<body class="dt-example">
	<div class="container">
            
              
                
                <div class="row"> 
    <table class="table table-hover">
      <thead>
        <tr>
            
          <th>#</th>
          <th>Planta de Distribución</th>
          <th>Ritmo de Despacho</th>
          <th>UTC Actual</th>
          <th>UTC Histórico</th>
        </tr>
      </thead>

            
            
      
      <tbody>
        
          
          <?php
                           
                            $i=0;
                            $fila="";
                            foreach($resultado as $dato){
                                $i++;
                                if($dato['velocidad']<50){
                                    $class = "danger";
                                }elseif ($dato['velocidad']>50 && $dato['velocidad']<75) {
                                    $class = "warning";
                                }else{
                                    $class = "success";
                                }
                                $fila.="
                                <tr class=".$class.">
                                    <th scope='row'>$i</th>
                                    <td>".$dato['pd']."</td>
                                    <td>".$dato['velocidad']."</td>
                                    <td>".$dato['actual']."</td>
                                    <td>".$dato['historico']."</td>
                                </tr>";
                        
                        
                            }
                            echo $fila;
                            ?>
          
          
      </tbody>
      
    </table>
            
	</div>
</body>
</html>