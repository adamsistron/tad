<?php
class Consulta_Despachos_Model extends CI_Model {

    /*var $title   = '';
    var $content = '';
    var $date    = '';*/
    

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();

    }

    function general()
    {

            $db=$this->load->database('scli',TRUE);

            $sql = "SELECT dia_semana, pd, estatus, actual, historico, velocidad, created
  FROM ds_velocidad_despachos;";
            
            $q = $db->query($sql);
            //print_r($q);die();
            $data=array();
		foreach ($q->result_array() as $row){
			$data[] = $row;

		}
		$q->free_result();
		$db->close();
                //print_r($data);die();
		return($data);
    }
    function consultas($opcion='*', $parametro='*')
    {

            $db=$this->load->database('scli',TRUE);

if (empty($opcion)){
};
            
            $parametro=  str_replace('*', '%', strtoupper($parametro));
                    
            //echo "$opcion & $parametro"; die();
            /*
            if($opcion==1){
               $sql="SELECT 
                    staging_despachos.co_sap_despacho, 
                    dim_cisterna.tx_placa_cisterna AS placa_cisterna, 
                    DATE(staging_despachos.fe_programada) AS fecha_programada, 
                    staging_despachos.nu_volumen_programado AS volumen_programado, 
                    staging_despachos.tx_nombre_producto AS producto, 
                    staging_despachos.tx_nombre_estado_despacho AS estatus, 
                    dim_cliente.tx_nombre_cliente_final AS cliente
                  FROM 
                    public.staging_despachos, 
                    public.dim_cisterna, 
                    public.dim_cliente
                  WHERE 
                    staging_despachos.co_cliente_final = dim_cliente.co_cliente_final AND
                    dim_cisterna.co_cisterna = staging_despachos.co_cisterna AND
                    staging_despachos.fe_programada > CURRENT_DATE - INTERVAL '6 DAY' AND
                    staging_despachos.fe_programada <= CURRENT_DATE AND
                    UPPER(dim_cliente.tx_nombre_cliente_final) LIKE '$parametro'
                  ORDER BY 
                    fe_programada DESC;"; 
            }
            if($opcion==2){
                $sql="SELECT 
                    staging_despachos.co_sap_despacho, 
                    DATE(staging_despachos.fe_programada) AS fecha_programada, 
                    dim_cliente.tx_nombre_cliente_final AS cliente, 
                    staging_despachos.tx_nombre_producto AS producto, 
                    staging_despachos.nu_volumen_programado AS volumen_programado, 
                    staging_despachos.tx_nombre_estado_despacho AS estatus
                  FROM 
                    public.staging_despachos, 
                    public.dim_cliente
                  WHERE 
                    staging_despachos.co_cliente_final = dim_cliente.co_cliente_final AND
                    staging_despachos.fe_programada > CURRENT_DATE - INTERVAL '6 DAY' AND
                    staging_despachos.fe_programada <= CURRENT_DATE AND
                    TEXT(staging_despachos.co_sap_despacho) LIKE '$parametro';
                  ";
            }
            if($opcion==3){
                
                if(strpos($parametro,'%')==false){
                    $parametro="V$parametro";
                }
                //echo $parametro;die();
                
                $sql="SELECT 
                    dim_conductor.nu_cedula_de_identidad AS cedula_identidad, 
                    dim_conductor.tx_nombre_tx_apellido AS nombre_apellido,  
                    dim_conductor.fe_venc_licencia_de_conducir AS vencimiento_lc, 
                    dim_conductor.fe_venc_certificado_medico AS vencimiento_cm, 
                    staging_despachos.co_sap_despacho, 
                    staging_despachos.tx_nombre_producto AS producto,
                    staging_despachos.tx_nombre_estado_despacho AS estatus,
                    staging_despachos.nu_volumen_programado AS volumen_programado, 
                    DATE(staging_despachos.fe_programada) AS fecha_programada, 
                    staging_despachos.tx_nombre_planta_distribucion AS planta_distribucion, 
                    dim_cliente.tx_nombre_cliente_final AS cliente
                  FROM 
                    public.staging_despachos, 
                    public.dim_conductor,  
                    public.dim_cliente
                  WHERE 
                    
                    staging_despachos.co_cliente_final = dim_cliente.co_cliente_final AND
                    dim_conductor.nu_cedula_de_identidad = staging_despachos.nu_cedula_de_identidad AND
                    staging_despachos.fe_programada > CURRENT_DATE - INTERVAL '6 DAY' AND
                    staging_despachos.fe_programada <= CURRENT_DATE AND
                    UPPER(staging_despachos.nu_cedula_de_identidad) LIKE '$parametro'
                  ORDER BY 
                    fe_programada DESC;";
            }
            if($opcion==4){
                $sql="SELECT 
                    DATE(staging_despachos.fe_programada) AS fecha_programada, 
                    dim_cliente.tx_nombre_cliente_final AS cliente, 
                    dim_chuto.tx_placa_chuto AS placa_chuto,
                    staging_despachos.co_sap_despacho,
                    staging_despachos.nu_volumen_programado AS volumen_programado,
                    staging_despachos.tx_nombre_producto AS producto,
                    staging_despachos.tx_nombre_estado_despacho AS estatus,
                    dim_cisterna.tx_placa_cisterna AS placa_cisterna, 
                    staging_despachos.tx_nombre_planta_distribucion AS planta_distribucion
                  FROM 
                    public.staging_despachos, 
                    public.dim_chuto, 
                    public.dim_cisterna, 
                    public.dim_cliente
                  WHERE 
                    staging_despachos.co_chuto = dim_chuto.co_chuto AND
                    staging_despachos.co_cisterna = dim_cisterna.co_cisterna AND
                    staging_despachos.co_cliente_final = dim_cliente.co_cliente_final AND
                    staging_despachos.fe_programada > CURRENT_DATE - INTERVAL '6 DAY' AND
                    staging_despachos.fe_programada <= CURRENT_DATE AND
                    UPPER(dim_cisterna.tx_placa_cisterna) LIKE '$parametro'
                  ORDER BY 
                    fe_programada DESC;";
            }
            */
	    if($opcion==0){
                $condicion="";
            }
            if($opcion==1){
                $condicion="WHERE UPPER(nombre_cliente) LIKE '$parametro'";
            }
            if($opcion==2){
                $condicion="WHERE UPPER(codigo_sap_despacho) LIKE '$parametro'";
            }
            if($opcion==3){
                $condicion="WHERE UPPER(cedula_conductor) LIKE '$parametro'";
            }
            if($opcion==4){
                $condicion="WHERE UPPER(placa_cisterna) LIKE '$parametro'";
            }
            if($opcion==5){
                $condicion="WHERE UPPER(pd) LIKE '$parametro'";
            }
            
            $sql="SELECT 
                    substr(pd,14) as pd, codigo_sap_despacho, placa_cisterna, 
                    cedula_conductor, nombre_conductor, rif_cliente, codigo_sap_cliente, 
                    nombre_cliente, volumen_programado, volumen_bruto_despachado, 
                    estatus_despacho, producto, date(fecha_programada) as fecha_programada, created
                  FROM ds_despachos_sie_mena
                  $condicion order by fecha_programada DESC
                  ;";

            
            //echo $sql;die();
            
            $q = $db->query($sql);
            //print_r($q);die();
            $data=array();
		foreach ($q->result_array() as $row){
			$data[] = $row;

		}
		$q->free_result();
		$db->close();
                //print_r($data);die();
		return($data);
    }
}
?>
