<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
           
        <script type="text/javascript" language="javascript" src="<?php echo base_url('DataTables-1.10.4/media/js/jquery.js');?>"></script>
        <script type="text/javascript" language="javascript" class="init">



$(document).ready(function() {
	
        setTimeout(function(){location.reload(); }, 60000);//120000=2min
} );



	</script>

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
          <th>Estatus</th>
        </tr>
      </thead>

            
            
      
      <tbody>
        
          
          <?php
                           
                            $i=0;
                            $fila="";
                            foreach($resultado as $dato){
                                $i++;
                                if($dato['velocidad']<=50){
                                    $class = "danger";
                                    $icon = "remove";
                                }elseif ($dato['velocidad']>50 && $dato['velocidad']<75) {
                                    $class = "warning";
                                    $icon = "alert";
                                }else{
                                    $class = "success";
                                    $icon = "ok";
                                }
                                $fila.="
                                <tr >
                                    <th scope='row'>$i</th>
                                    <td><span class='label label-".$class."'>".$dato['pd']."</span></td>
                                    <td>".$dato['velocidad']."</td>
                                    <td>".$dato['actual']."</td>
                                    <td>".$dato['historico']."</td>
                                    <td>
                                    <a class='label label-".$class."' href='#'>
                                        <span class='glyphicon glyphicon-$icon'></span>
                                    </a>
                                    </td>
                                </tr>";
                        
                        
                            }
                            echo $fila;
                            ?>
          
          
      </tbody>
      
    </table>
            
	</div>
</body>
</html>