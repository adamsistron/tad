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
	<link rel="stylesheet" type="text/css" href="https://datatables.net/release-datatables/extensions/TableTools/css/dataTables.tableTools.css">

        
        <script type="text/javascript" language="javascript" src="<?php echo base_url('DataTables-1.10.4/media/js/jquery.js');?>"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url('DataTables-1.10.4/media/js/jquery.dataTables.js');?>"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url('DataTables-1.10.4/examples/resources/syntax/shCore.js');?>"></script>
        <!--<script type="text/javascript" language="javascript" src="<?php echo base_url('DataTables-1.10.4/examples/resources/demo.js');?>"></script>-->
        <script type="text/javascript" language="javascript" src="<?php echo base_url('/js/dataTables.responsive.js');?>"></script>
        <script type="text/javascript" language="javascript" src="https://datatables.net/release-datatables/extensions/TableTools/js/dataTables.tableTools.js"></script>
       
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
    var opcion = $(this).val();
    if(opcion==7){
        $("#parametro").attr('readonly','readonly');
        $("#parametro").attr('placeholder','...');
    }else{
       $("#parametro").removeAttr('readonly'); 
       $("#parametro").attr('placeholder','Escriba parametro de búsqueda para esta opción');

    }
    });
   
var table = $('#example').dataTable( {
/*dom: 'T<"clear">lfrtip',
        tableTools: {
            "sSwfPath": "../swf/copy_csv_xls_pdf.swf"
        },*/
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

var tableTools = new $.fn.dataTable.TableTools( table, {
        "buttons": [
            "copy",
            "csv",
            "xls",
            "pdf",
            { "type": "print", "buttonText": "Print me!" }
        ]
    } );
      
    $( tableTools.fnContainer() ).insertAfter('div.info');
        
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
    
    function detalle(codigo){
        $.ajax({
            type: "POST",
            url: "<?php  echo base_url('consulta_despachos/detalle_codigo');?>",
            data:{
                codigo:codigo,
    },
            /*beforeSend: function(){
                $("#parametro").css("background","#FFF url(images/cargando.gif) no-repeat 150px");
    },*/
            success: function(data){
                $('#exampleModalLabel').html("Documento de Transporte (SAP) #"+codigo);
                
                $('.modal-body').html(data);
                $('#exampleModal').modal('show');
    }
    });
    
    
    
}
</script>
</head>

<body>
    <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4 col-md-offset-1">
                <select class="form-control" id="opcion" name='opcion' required autofocus>
                    <option value='0' >---Seleccione Opción---</option>
                    <option value='5' >Planta de Distribución</option>
                    <option value='8' >Código SAP Cliente</option>
                    <option value='1' >Nombre Cliente</option>
                    <option value='2' >Documento Transporte SAP</option>
                    <option value='3' >Cédula de Conductor</option>
                    <option value='4' >Placa Cisterna</option>
                    <option value='6' >Placa Chuto</option>
                    <option value='7' >Todos</option>
                </select>
            </div>
            <div class="col-md-4">   
                
           
                <input type="text" id="parametro" name='parametro' value="" class="form-control" placeholder="Escriba parametro de búsqueda para esta opción">
                <div id="suggesstion-box" style="position:absolute; z-index:1;"></div>
             </div>
            <div class="col-md-">   
            
                <button type="button" id="buscar" class="btn btn-primary">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar</button>
             </div>   
            
</div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
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
         <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>
    
</body>
</html>
