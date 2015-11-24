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

        
        <script type="text/javascript" language="javascript" src="<?php echo base_url('DataTables-1.10.4/media/js/jquery.js');?>"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url('DataTables-1.10.4/media/js/jquery.dataTables.js');?>"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url('DataTables-1.10.4/examples/resources/syntax/shCore.js');?>"></script>
        <!--<script type="text/javascript" language="javascript" src="<?php echo base_url('DataTables-1.10.4/examples/resources/demo.js');?>"></script>-->
        <script type="text/javascript" language="javascript" src="<?php echo base_url('/js/dataTables.responsive.js');?>"></script>
       
        <script type="text/javascript">

$(document).ready(function(){
    
    //**************************AUTOCOMPLETAR
$("#parametro").keyup(function(){

var opcion = parseInt($("#opcion").val());
if(opcion !== 0){
if($(this).val().length>=1){
$.ajax({
    type: "POST",
    url: "<?php  echo base_url('consulta_despachos/autoparametros');?>",
    data:{
        opcion:opcion,
        parametro:$(this).val(),
},
    beforeSend: function(){
            $("#parametro").css("background","#FFF url(images/cargando.gif) no-repeat 150px");
    },
    success: function(data){
            $("#suggesstion-box").show();
            $("#suggesstion-box").html(data);
            $("#parametro").css("background","#FFF");
    }
    });
    }
    }else{
        //alert('Sele');
        $( "#opcion" ).focus().select();
    }
});
    
$("#opcion").change(function(){
    $("#parametro").val('');
    $("#resultado").hide();
    $("#suggesstion-box").hide();
    //buscar();
    });
   
$('#example').dataTable( {
		"bProcessing": true,
		"bServerSide": true,
                "responsive": true,
                "scrollY": 450,
                "order": [[ 2, "asc" ]],
                "iDisplayLength":25,
                "language": {
                "lengthMenu": " _MENU_ registros por página",
                "zeroRecords": "No se encontrarón registros",
                "info": "Mostrando la página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado desde _MAX_ total registros)",
                "search":         "Búsqueda",
                "bProcessing": "Procesando",
                },
		"sAjaxSource": "<?php  echo base_url('consulta_despachos/datatables');?>",
                "fnServerData": function ( sSource, aoData, fnCallback ) {
                aoData.push( {"name": "opcion", "value": $('#opcion').val()} );
                aoData.push( {"name": "parametro", "value": $('#parametro').val()} );
                $.getJSON( sSource, aoData, function (json) {
                fnCallback(json)
                } );
                },
                        
	} );   
        
$('#buscar').click( function () {
    oTable = $('#example').dataTable();
    oTable.fnDraw();
} );        
});
function buscar(){
    oTable = $('#example').dataTable();
    oTable.fnDraw();
}
//Select Opcion
function selectOpcion(val) {
    $("#parametro").val(val);
    $("#suggesstion-box").hide();
    }

function salir(){
    window.location.href = "<?php  echo base_url('sesion/logout');?>";
    }
</script>
</head>

<body>
        <div class="row success">
             <form class="form-horizontal" role="form" id="form" name="form" action="<?=base_url()?>producto/guardar" method="POST">
            <div class="form-group col-lg-4">
                <select class="form-control" id="opcion" name='opcion' >
                    <option value='0' >---Seleccione Opción---</option>
                    <option value='5' >Planta de Distribución</option>
                    <option value='1' >Estación de Servicio</option>
                    <option value='2' >Documento Transporte SAP</option>
                    <option value='3' >Cédula de Conductor</option>
                    <option value='4' >Placa Cisterna</option>
                    <option value='6' >Placa Chuto</option>
                    
                </select>
                
            </div>
           
            <div class="form-group col-lg-4">
                <input type="text" id="parametro" name='parametro' value="" class="form-control" placeholder="Escriba parametro de búsqueda para esta opción">
                <div id="suggesstion-box" style="position:absolute; z-index:1;"></div>
            </div>
             
            
            <div class="form-group col-lg-4">
                <button type="button" id="buscar" class="btn btn-primary">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar</button>
                
            </div>
            </form>
            
</div>
        <div class="row">
            <div class="">
                <table id="example" class="display nowrap compact" cellspacing="0" width="90%">
                    <thead>
                        <tr>
                        <th>Planta</th>
                        <th>Cliente</th>
                        <th>Documento Transporte</th>
                        <th>Estatus Desapacho</th>
                        <th>Fecha Salida Llenado</th>
                        <th>Placa Cisterna</th>
                        <th>Placa Chuto</th>                        
                        <th>Cedula Conductor</th>
                        <th>Nombre Conductor</th>
                        <th>Código SAP cliente</th>			
                        <th>RIF cliente</th>			
                        <th>Fecha Programada</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
         
    
</body>
</html>
