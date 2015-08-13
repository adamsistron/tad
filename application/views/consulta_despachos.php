<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>SIE-MENA | Despachos Mercado Nacional</title>
        <link rel="shortcut icon" href="<?php echo base_url('images/pdvsa.ico');?>" />

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 30px;
		font: 10px/15px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}
        input {
                width: 200px;
        }
        select {
                width: 200px;
        }

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	.body{
		margin: 0 15px 0 15px;
	}
        
        p.label{
            width: 150px;
            margin: 5px;
            padding: 0;
            font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 14px;
		color: red;
		display: block;
        }
	
	p.footer{
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
        <script type="text/javascript" language="javascript" src="<?php echo base_url('js/jquery.js');?>"></script>
        <script type="text/javascript">

function consulta(){
	var opcion = $("#opcion").val();
	var parametro = $("#parametro").val();
        $("#resultado").empty();
        $("#cargando").show();
        
        //alert(opcion+'-'+parametro);
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
function salir(){
 window.location.href = "<?php  echo base_url('sesion/logout');?>";
}
</script>
</head>
<body>

<div id="container">
    <h1>Consulta de Despachos SCLi </h1>
        <div style="text-align: right; margin-right: 30px;">
            <button onclick="salir()">SALIR (<?php echo $this->session->userdata('indicador_usuario');?>)</button>
        </div>
	<div id="consulta" class="body">
		<p>Seleccione Opción e Introduzca El parametro de Búsqueda.</p>
                    <label for="opcion">
                        <p class="label">OPCION</p>
                    </label> 
                    <select id="opcion" name="opcion">
                        <option value="0">--Seleccione--</option>
                        <option value="1">EESS</option>
                        <option value="2">DOC-TRANSPORTE</option>
                        <option value="3">CI-CONDUCTOR</option>
                        <option value="4">PLACA-CISTERNAR</option>
                        <option value="5">PLANTA-DISTRIBUCION</option>
                    </select>
                    <br>
                    <label for="parametro">
                        <p class="label">PARAMETRO</p></label>
                    <input id="parametro" name="parametro" type="text"/>Use (*) para consultar semenjantes
                    <br> <br>
                    <input type="button" value="Consultar" onclick="consulta()"/>
                
	</div>
    
        
        <div id="resultado" class="body" style="display: none">
            
        </div>
        <br>
        <div id="cargando" class="body" style="display: none">
            <img src="<?php echo base_url('images/cargando.gif');?>">
        </div>

	
</div>

</body>
</html>
