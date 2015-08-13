<!DOCTYPE html>
<html>
<head>
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
       
        <script type="text/javascript">

function consulta(){
	var opcion = $("#opcion").val();
	var parametro = $("#parametro").val();
        $("#resultado").empty();
        $("#cargando").show();
        
        //alert(parametro);
        
        if(parametro==='*'){
        alert('Favor introduzca un parametro de consulta');
        $("#cargando").hide();
    }else{
    
    
    $.ajax({
            url:"<?php echo base_url('consulta_despachos/consulta_despachos_opcion');?>",
            type: "POST",
            data:{
                opcion:opcion,parametro:parametro
            },
            success: function(data) {
                var data=data.trim();
                $("#cargando").hide();
                
                $("#resultado").show();
                $("#resultado").append(data);
	}});
    }
}
function salir(){
 window.location.href = "<?php  echo base_url('sesion/logout');?>";
}
</script>

</head>

<body class="dt-example">
    <div class="container">
        <div class="row">
            <label class="col-sm-2 control-label" for="opcion">Opciones de Búsqueda</label>
            <div class="col-sm-6">
                <select class="form-control" id="opcion" name='opcion' >
                    <option value='0' selected>---Seleccione Opción---</option>
                    <option value='5' >Planta de Distribución</option>
                    <option value='1' >Estación de Servicio</option>
                    <option value='2' >Documento Transporte SAP</option>
                    <option value='3' >Cédula de Conductor</option>
                    <option value='4' >Placa Cisterna</option>
                    
                </select>
            </div>
        </div>
        <div class="row" style="margin-top: 0.5em">
            
            <label class="col-lg-2 control-label" for="parametro">Elemento a Buscar</label>
            <div class="col-sm-6">
                <input type="text" id="parametro" name='parametro'  class="form-control" placeholder="Parametro de búsqueda - Use asterisco * para completar">
            </div>
            
        </div>
        <div class="row text-right" style="margin-top: 0.5em">
            <div class="col-sm-8">
                <button type="button" class="btn btn-success"  onclick="consulta()">
                <span class="glyphicon glyphicon-search col-sm-6" aria-hidden="true"></span> Buscar</button>
        </div>
            </div>
        <div id="resultado" class="row" style="margin-top: 0.5em; display: none"></div>
        <br>
        <div id="cargando" class="body" style="display: none">
            <img src="<?php echo base_url('images/cargando.gif');?>">
        </div>
            
        </div>
         
    
</body>
</html>