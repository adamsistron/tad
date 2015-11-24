<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class scli extends CI_Controller {

       function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
                $this->load->library(array('session','table'));
                $this->load->model('consulta_despachos_model');
                //$this->load->database();
		$session_id = $this->session->userdata('indicador_usuario');
		//$session_id = "adac";
		//echo $session_id;die();
		if($session_id==""){
		redirect(base_url(''), 'refresh');
		}
	}
	
	public function index()
	{
      
             redirect(base_url('/scli/scli_1/'), 'refresh');
	}
        
        public function _example_output($output = null)
	{
            
            //print_r($output);die();
            
            $this->load->view('output.php',$output);
	}
        public function datatables()
	{
            
            $this->datatables->set_database('scli');
            $this->datatables->select('id_store_consulta_despachos, opcion, parametro, indicador');
            $this->datatables->from('store_consulta_despachos');
            $results = $this->datatables->generate('json', 'ISO-8859-1');

            print_r($results);
	}
        
        public function scli_1()
	{
            $serie_data[] = array('name' => 'Diesel', 'data' => '0');
            $serie_data[] = array('name' => 'G-91', 'data' => '0');
            $serie_data[] = array('name' => 'G-95', 'data' => '0');
            $serie_data[] = array('name' => 'Jet-A1', 'data' => '0');
            $serie_data[] = array('name' => 'Av-Gas', 'data' => '0');
            $serie_data[] = array('name' => 'Fuel Oil', 'data' => '0');
            $serie_data[] = array('name' => 'Insol 210', 'data' => '0');
            $serie_data[] = array('name' => 'Kerosene', 'data' => '0');
            
            $this->view_data['serie_data'] = json_encode($serie_data, JSON_NUMERIC_CHECK);
            $this->view_data['view_name'] = "view_scli1";
            $this->view_data['menu'] = "scli";
            $this->view_data['plantas'] = $this->consulta_despachos_model->select_option_plantas();
            
            //$this->load->view('view_scli1', $this->view_data);
            //$this->output_data['output'] = $this->load->view('view_scli1', $this->view_data);
            $this->load->view('output', $this->view_data);
            
	}
public function scli_2()
	{
          $planta=$this->input->post('planta');  
            $db=$this->load->database('scli',TRUE);           
            
            $query = $db->query("
                                SELECT pd, velocidad AS velocidad, created
                                FROM ds_velocidad_despachos
                                WHERE pd='$planta'
                                ORDER BY created DESC
                              ");
           $dato1=  array();
            foreach ($query->result_array() as $row)
            {
                $dato1[]= $row['pd'];
                $dato1[]= $row['velocidad'];
                $dato1[]= $row['created'];               
            }
            
            $query2 = $db->query("
                                SELECT indice AS indice
                                FROM ds_indicador_despachos_dia_semana
                                WHERE pd='$planta'
                                ");
            $dato2='';
            foreach ($query2->result_array() as $row)
            {
                $dato2= $row['indice'];            
            }
            $query3 = $db->query("
                                SELECT pd, indice_avance AS indice_avance
                                FROM ds_indicador_despachos_avance_programado
                                WHERE pd='$planta'
                                ");
            $dato3='';
            foreach ($query3->result_array() as $row)
            {
                $dato3= $row['indice_avance'];            
            }
            
//            Consulta de Volumen de Despacho por Producto
            $query4 = $db->query("
                                 SELECT pd, producto,
                                 fecha_programada,
                                 TRUNC(volumen_btd*0.006289811,0) as volumen_btd
                                 FROM ds_volumen_despachado
                                 WHERE fecha_programada=CURRENT_DATE
                                 and pd='$planta'
                                ");
            $diesel= 0;
            $g91= 0;
            $g95= 0;
            $jet= 0;
            $av_gas= 0;
            $fuel_oil= 0;
            $insoil= 0;
            $kerosene= 0;

            $estatus_ant = "";
            
            foreach ($query4->result_array() as $row)
            {
                if($row['producto'] == 'Diesel')
                {
                    $diesel = $row['volumen_btd'];
                }
                if($row['producto'] == 'G-91')
                {
                    $g91 = $row['volumen_btd'];
                } 
                if($row['producto'] == 'G-95')
                {
                    $g95 = $row['volumen_btd'];
                } 
                if($row['producto'] == 'Jet-A1')
                {
                    $jet = $row['volumen_btd'];
                } 
                if($row['producto'] == 'Av-Gas')
                {
                    $av_gas = $row['volumen_btd'];
                } 
                if($row['producto'] == 'Fuel Oil')
                {
                    $fuel_oil = $row['volumen_btd'];
                } 
                if($row['producto'] == 'Insol 210')
                {
                    $insoil = $row['volumen_btd'];
                } 
                if($row['producto'] == 'Kerosene')
                {
                    $kerosene = $row['volumen_btd'];
                } 
                
                $estatus_ant = $row['producto'];
            }
            $serie_data[] = array('name' => 'Diesel', 'data' => $diesel);
            $serie_data[] = array('name' => 'G-91', 'data' => $g91);
            $serie_data[] = array('name' => 'G-95', 'data' => $g95);
            $serie_data[] = array('name' => 'Jet-A1', 'data' => $jet);
            $serie_data[] = array('name' => 'Av-Gas', 'data' => $av_gas);
            $serie_data[] = array('name' => 'Fuel Oil', 'data' => $fuel_oil);
            $serie_data[] = array('name' => 'Insol 210', 'data' => $insoil);
            $serie_data[] = array('name' => 'Kerosene', 'data' => $kerosene);
            // Estados de Despachos
             
            $query9 = $db->query("
                                 SELECT pd, cantidad, fe_programada, co_estado_despacho, estado_despacho, 
                                 created
                                 FROM ds_estatus_despachado
                                 WHERE pd ='$planta'
                                ");
            $autorizado= 0;
            $en_despacho= 0;
            $env_scli= 0;
            $desp_env= 0;
            $anu_fac= 0;
            
            $estatus_ant88 = "";
            
            foreach ($query9->result_array() as $row)
            {
                if($row['estado_despacho'] == 'AUTORIZADO')
                {
                    $autorizado = $row['cantidad'];
                }
                if($row['estado_despacho'] == 'EN DESPACHO')
                {
                    $en_despacho = $row['cantidad'];
                } 
                if($row['estado_despacho'] == 'ENVIADO AL SCLI')
                {
                    $env_scli = $row['cantidad'];
                }
                if($row['estado_despacho'] == 'DESPACHADO Y ENVIADO')
                {
                    $desp_env = $row['cantidad'];
                }
                if($row['estado_despacho'] == 'ANULADO POR FACTURACION')
                {
                    $anu_fac = $row['cantidad'];
                }
                $estatus_ant88 = $row['cantidad'];
            }
                        
            //Consultar para Despacho / Historico
            $query5=$db->query("
                                SELECT pd, dia_semana, estatus, 'HISTORICO' AS tipo, historico AS cantidad, indice, created
                                FROM ds_indicador_despachos_dia_semana
                                where pd='$planta'
                                UNION  
                                SELECT pd, dia_semana, estatus,  'DESPACHADO' AS tipo, actual AS cantidad, indice, created
                                FROM ds_indicador_despachos_dia_semana
                                where pd='$planta'
                               ");
            $historico = '0';
            $despachado = '0';
            $estatus_ant1 = "";
     
            foreach ($query5->result_array() as $row)
            {
                if($row['tipo'] == 'HISTORICO' and $row['cantidad']!='')
                {
                    $historico= $row['cantidad'];
                }
                if($row['tipo'] == 'DESPACHADO'and $row['cantidad']!='')
                {
                    $despachado = $row['cantidad'];
                } 

                $estatus_ant1 = $row['cantidad'];
            }
            
if($dato1[1]>0 && $dato1[1] <> ""){
    $velocidad = $dato1[1];
}else{
    $velocidad = 0;
}
if($dato2>0 && $dato2 <> ""){
    $avance_historico = $dato2;
}else{
    $avance_historico = 0;
}
if($dato3>0 && $dato3 <> ""){
    $avance_programado = $dato3;
}else{
    $avance_programado = 0;
}
if($diesel>0 && $diesel <> ""){
    $diesel = $diesel;
}else{
    $diesel = 0;
}
if($g91>0 && $g91 <> ""){
    $g91 = $g91;
}else{
    $g91 = 0;
}
if($g95>0 && $g95 <> ""){
    $g95 = $g95;
}else{
    $g95 = 0;
}
if($jet>0 && $jet <> ""){
    $jet = $jet;
}else{
    $jet = 0;
}

                 
            echo "$velocidad*$avance_historico*$avance_programado*$diesel*$g91*$g95*$jet*$av_gas*$fuel_oil*$insoil*$kerosene*$autorizado*$en_despacho*$env_scli*$desp_env*$anu_fac*$historico*$despachado";
            
            
                   
            //echo json_encode(array("status"=>"ok","series_data"=>$series_data, "mensaje_error"=>"Ocurrio un error al actualizar."));
            //$this->load->view('view_scli1', $this->view_data);
            

	} 

public function medidor(){
    
  $planta=$this->input->post('planta'); 
  //$planta="Planta Dist. Yagua";
  $db=$this->load->database('scli',TRUE);           

  $query = $db->query("
                    SELECT 
                      dia_semana as dia, 
                      to_char(fe_programada,'DD/MM/YYYY') as fecha, 
                      hora, 
                      pd, 
                      estatus, 
                      count
                    FROM 
                      detalle_velocidad_despacho
                      where pd = '$planta'
                    ORDER BY fe_programada ASC;
                     ");
  $dato=  array();
  $fecha_actual=date("d/m/Y");
echo "<center><table cellspacing='0' FRAME='void' RULES='rows'>";
echo"<tr><td align='center' width='300px'><strong>Dia - Fecha - Hora</strong></td>";
echo"<td align='center' width='50px'><strong> UTC </strong></td></tr>"; 
$suma=0;
$dia="";
$promedio=0;
$cont=0;$utc_today=0;$velocidad=0;
$velocidad_format=0;
   $band='0';
   foreach ($query->result_array() as $row)
   {
       if($band=='0')
       { 
           if($row['fecha']<>$fecha_actual)
            {
                $suma= $suma+$row['count'];
                $cont=$cont+1;
                echo "<tr><td><FONT SIZE=3>".$row['dia']." - ".$row['fecha']." - ".$row['hora'].":00     </FONT></td> ";
                echo "<td align='center'><FONT SIZE=3>".$row['count']."</FONT></td></tr>";                 
            }
            else
            {     
                $utc_today= $row['count'];   
                echo "<tr><td><b><FONT SIZE=3>".$row['dia']." - ".$row['fecha']." - ".$row['hora'].":00</FONT></b></td> ";
                echo "<td align='center'><b><FONT SIZE=3>".$row['count']."</FONT></b></td></tr>";
                $dia= $row['dia'];
            }
            $band=1;
       }
       else 
       {
              if($row['fecha']<>$fecha_actual)
            {
                $suma= $suma+$row['count'];
                $cont=$cont+1;
                echo "<tr bgcolor='#F6EFEF'><td><FONT SIZE=3>".$row['dia']." - ".$row['fecha']." - ".$row['hora'].":00     </FONT></td> ";
                echo "<td align='center'><FONT SIZE=3>".$row['count']."</FONT></td></tr>";                 
            }
            else
            {     
                $utc_today= $row['count'];   
                echo "<tr bgcolor='#F6EFEF'><td><b><FONT SIZE=3>".$row['dia']." - ".$row['fecha']." - ".$row['hora'].":00</FONT></b></td> ";
                echo "<td align='center'><b><FONT SIZE=3>".$row['count']."</FONT></b></td></tr>";
                $dia= $row['dia'];
            }
          $band='0'; 
        }
    } 
  $promedio= number_format($suma/$cont, 2); 
  $velocidad=$utc_today/$promedio*100; 
  $velocidad_format = number_format($velocidad, 2);
echo"</table><BR>";
echo "El promedio de UTC de los ultimos $cont ".$dia." es ".$promedio."<BR>";
echo "La velocidad de Despacho a esta hora es <b>(".$row['count']."</b>/<b>".$promedio.")*100</b> = <font color='#9a0202'><b>".$velocidad_format."%</b></font>";
echo "</center>";   
}

public function avance(){
    
  $planta=$this->input->post('planta'); 
  //$planta="Planta Dist. Yagua";
  $db=$this->load->database('scli',TRUE);           
//echo $planta;die();
  $sql = "SELECT 
a.tx_codigo as cod_sap, a.tx_nombre_1 as nombre_es, COUNT(DISTINCT a.tx_despacho) as numero
FROM public.detalle_despachos_planta as a 
WHERE a.pd = '$planta' 
GROUP BY a.tx_codigo, a.tx_nombre_1";
  
  
  //echo $sql;die();
  
  $query = $db->query($sql);
  $dato=  array();
  $fecha_actual=date("d/m/Y");
echo "<center><table cellspacing='0' FRAME='void' RULES='rows'>";
echo"<tr><td align='center' width='30'><strong>N&deg;</strong></td>";
echo "<td align='center' width='120px'><strong>Codigo SAP</strong></td>";
echo "<td align='center' width='400px'><strong> Nombre de E/S </strong></td>";
echo"<td align='center' width='30px'><strong> N° Despachos </strong></td></tr>"; 
$suma=0;
$dia="";
$promedio=0;
$cont=1;$utc_today=0;$velocidad=0;
$velocidad_format=0;
   $band='0';
   $base_url="";
   foreach ($query->result_array() as $row)
   {
       $codigo = (string)$row["cod_sap"];
       
       if($band=='0')
       { 
                //$suma= $suma+$row['count'];
                //$cont=$cont+1;
                echo "<tr><td><font size=3><strong>".$cont."</strong></font></td> ";
                echo "<td align='center'><a onclick=detalle('$codigo')><font color='blue' size=3>".$row['cod_sap']."</font></a></td> ";
                echo "<td align='left'><font size=3>".$row['nombre_es']."</font></td>";
                echo "<td align='center'><font size=3><strong>".$row['numero']."</strong></font></td></tr>";                     
                //$utc_today= $row['count'];   
                //$dia= $row['dia'];
            
            $band=1;
       }
       else 
       {
                //echo "<tr><td>".$row['cod_sap']." </td> ";
                echo "<tr bgcolor='#F6EFEF'><td><font size=3><strong>".$cont."</strong></font></td> ";
                echo "<td align='center'><a onclick=detalle('$codigo')><font color='blue' size=3>".$row['cod_sap']."</font></a></td> ";
                echo "<td align='left'><font size=3>".$row['nombre_es']."</font></td>";
                echo "<td align='center'><font size=3><strong>".$row['numero']."</strong></font></td></tr>";                      
          $band='0'; 
        }
    $cont=$cont+1;    
    } 
  /*$promedio= number_format($suma/$cont, 2); 
  $velocidad=$utc_today/$promedio*100; 
  $velocidad_format = number_format($velocidad, 2);*/
echo"</table><BR>";
//echo "El promedio de UTC de los ultimos $cont ".$dia." es ".$promedio."<BR>";
//echo "La velocidad de Despacho a esta hora es <b>".$row['count']."</b>/<b>".$promedio."</b> = <font color='#9a0202'><b>".$velocidad_format."</b></font>";
echo "</center>";   
}

public function detalle_despacho($codigo_despacho,$planta){
    

  $db=$this->load->database('scli',TRUE);           
  //$codigo_despacho="0000503124";
  
  $planta = str_replace("%20", " ", $planta);
  
  $sql1 = "SELECT 
  a.tx_despacho as cod_sap_despacho, 
  a.nu_cedula_de_identidad as cedula, 
  a.tx_nombre_2 as nombre_chofer, 
  a.cisterna, 
  /*b.serial_modem, 
  b.sistema,*/
  'N/P' AS serial_modem,
  'N/D' AS sistema,
  a.chuto, 
  a.tx_nombre_3 as nombre_combustible, 
  a.nu_volumen_bruto_despachado as volumen, 
  a.fe_salida_llenado as fecha 
  FROM public.detalle_despachos_planta as a /*, utc as b*/
  WHERE a.tx_codigo = '$codigo_despacho' and pd = '$planta'
      /*AND  b.placa_chuto = a.chuto*/
  ORDER BY fe_salida_llenado asc, cod_sap_despacho asc;";
 
  //ECHO $sql1;DIE();
  
  $query = $db->query($sql1);
  
  $rows = $query->num_rows();
  
  //echo $rows;die();

  if($rows==0){
    $sql2 = "    SELECT 
    a.tx_despacho as cod_sap_despacho, 
    a.nu_cedula_de_identidad as cedula, 
    a.tx_nombre_2 as nombre_chofer, 
    a.cisterna, 
    'N/P' AS serial_modem,
    'N/D' AS sistema,
    a.chuto, 
    a.tx_nombre_3 as nombre_combustible, 
    a.nu_volumen_bruto_despachado as volumen, 
    a.fe_salida_llenado as fecha 
    FROM public.detalle_despachos_planta as a
    WHERE a.tx_codigo = '$codigo_despacho'
    ORDER BY fe_salida_llenado asc, cod_sap_despacho asc;";
    
    //echo $sql2;die();
    $query = $db->query($sql2);
  }
  
  
  $dato=  array();
  $fecha_actual=date("d/m/Y");
echo "<center><strong>$codigo_despacho</strong><br><table cellspacing='0' FRAME='void' RULES='rows'>";
echo"<tr><td align='left' width='30px'><strong><FONT SIZE=2>N°</FONT></strong></td>";
echo"<td align='left' width='100px'><strong><FONT SIZE=2>SAP Despacho</FONT></strong></td>";
echo"<td align='left' width='100px'><strong><FONT SIZE=2>C&eacute;dula Chofer</FONT></strong></td>";
echo"<td align='left' width='200px'><strong><FONT SIZE=2> Nombre Chofer </FONT></strong></td>";
echo"<td align='left' width='100px'><strong><FONT SIZE=2> Placa Cisterna </FONT></strong></td>";
echo"<td align='left' width='100px'><strong><FONT SIZE=2> Placa Chuto </FONT></strong></td>";
echo"<td align='left' width='100px'><strong><FONT SIZE=2> Alias/Serial </FONT></strong></td>";
echo"<td align='left' width='100px'><strong><FONT SIZE=2> Sistema </FONT></strong></td>";
echo"<td align='left' width='100px'><strong><FONT SIZE=2> Producto </FONT></strong></td>";
echo"<td align='left' width='100px'><strong><FONT SIZE=2> Volumen(Lts.) </FONT></strong></td>";
echo"<td align='center' width='160px'><strong><FONT SIZE=2> Fecha </FONT></strong></td></tr>"; 
   $band='0';
   $i=0;
   $j=1;
   $ant="";
   foreach ($query->result_array() as $row)
   {
       
       if($row['cod_sap_despacho']<>$ant){
           $i++;
           $j=1;
       }
       
       if($band=='0')
       { 
           
                echo "<tr><td align='left'><FONT SIZE=2><strong>".$i.".".$j."</strong></FONT></td>"; 
                echo "<td align='left'><FONT SIZE=2>".$row['cod_sap_despacho']."</FONT></td>"; 
                echo "<td align='left'><FONT SIZE=2>".$row['cedula']."</FONT></td>"; 
                echo "<td align='left'><FONT SIZE=2>".$row['nombre_chofer']."</FONT></td>";  
                echo "<td align='left'><FONT SIZE=2>".$row['cisterna']."</FONT></td>";  
                echo "<td align='left'><FONT SIZE=2>".$row['chuto']."</FONT></td>";  
                echo "<td align='left'><FONT SIZE=2>".$row['serial_modem']."</FONT></td>";  
                echo "<td align='left'><FONT SIZE=2>".$row['sistema']."</FONT></td>";  
                echo "<td align='left'><FONT SIZE=2>".$row['nombre_combustible']."</FONT></td>";
                echo "<td align='left'><FONT SIZE=2>".$row['volumen']."</FONT></td>";
                echo "<td align='center'><FONT SIZE=2>".$row['fecha']."</FONT></td></tr>";                
            $band=1;
       }
       else 
       {
                //echo "<tr><td>".$row['cod_sap']." </td> ";
                echo "<tr  bgcolor='#F6EFEF'><td align='left'><FONT SIZE=2><strong>".$i.".".$j."</strong></FONT></td>"; 
                echo "<td align='left'><FONT SIZE=2>".$row['cod_sap_despacho']."</FONT></td>"; 
                echo "<td align='left'><FONT SIZE=2>".$row['cedula']."</FONT></td>"; 
                echo "<td align='left'><FONT SIZE=2>".$row['nombre_chofer']."</FONT></td>";  
                echo "<td align='left'><FONT SIZE=2>".$row['cisterna']."</FONT></td>";  
                echo "<td align='left'><FONT SIZE=2>".$row['chuto']."</FONT></td>";  
                echo "<td align='left'><FONT SIZE=2>".$row['serial_modem']."</FONT></td>";  
                echo "<td align='left'><FONT SIZE=2>".$row['sistema']."</FONT></td>";  
                echo "<td align='left'><FONT SIZE=2>".$row['nombre_combustible']."</FONT></td>";
                echo "<td align='left'><FONT SIZE=2>".$row['volumen']."</FONT></td>";
                echo "<td align='center'><FONT SIZE=2>".$row['fecha']."</FONT></td></tr>";                   
          $band='0'; 
        }
        $ant=$row['cod_sap_despacho'];
        $j++;
    } 
echo"</table><BR>";
//echo "El promedio de UTC de los ultimos $cont ".$dia." es ".$promedio."<BR>";
//echo "La velocidad de Despacho a esta hora es <b>".$row['count']."</b>/<b>".$promedio."</b> = <font color='#9a0202'><b>".$velocidad_format."</b></font>";
echo "</center>";   
}

public function historico(){
    
  $planta=$this->input->post('planta'); 
  //$planta="Planta Dist. Yagua";
  $db=$this->load->database('scli',TRUE);           

  $query = $db->query("
                    SELECT 
                      dia_semana as dia, 
                      to_char(fe_programada,'DD/MM/YYYY') as fecha, 
                      hora, 
                      pd, 
                      estatus, 
                      count
                    FROM 
                      detalle_velocidad_despacho_dia
                      where pd = '$planta'
                    ORDER BY fe_programada ASC;
                     ");
  $dato=  array();
  $fecha_actual=date("d/m/Y");
echo "<center><table cellspacing='0' FRAME='void' RULES='rows'>";
echo"<tr><td align='center' width='300px'><strong>Dia - Fecha</strong></td>";
echo"<td align='center' width='50px'><strong> UTC </strong></td></tr>"; 
$suma=0;
$dia="";
$promedio=0;
$cont=0;$utc_today=0;$velocidad=0;
$velocidad_format=0;
   $band='0';
   foreach ($query->result_array() as $row)
   {
       if($band=='0')
       { 
           if($row['fecha']<>$fecha_actual)
            {
                $suma= $suma+$row['count'];
                $cont=$cont+1;
                echo "<tr><td><FONT SIZE=3>".$row['dia']." - ".$row['fecha']."</FONT></td> ";
                echo "<td align='center'><FONT SIZE=3>".$row['count']."</FONT></td></tr>";                 
            }
            else
            {     
                $utc_today= $row['count'];   
                echo "<tr><td><FONT SIZE=3><b>".$row['dia']." - ".$row['fecha']."</FONT></b></td> ";
                echo "<td align='center'><FONT SIZE=3><b>".$row['count']."</FONT></b></td></tr>";
                $dia= $row['dia'];
            }
            $band=1;
       }
       else 
       {
              if($row['fecha']<>$fecha_actual)
            {
                $suma= $suma+$row['count'];
                $cont=$cont+1;
                echo "<tr bgcolor='#F6EFEF'><td><FONT SIZE=3>".$row['dia']." - ".$row['fecha']."</FONT></td> ";
                echo "<td align='center'><FONT SIZE=3>".$row['count']."</FONT></td></tr>";                 
            }
            else
            {     
                $utc_today= $row['count'];   
                echo "<tr bgcolor='#F6EFEF'><td><b><FONT SIZE=3>".$row['dia']." - ".$row['fecha']."</FONT></b></td> ";
                echo "<td align='center'><b><FONT SIZE=3>".$row['count']."</b></FONT></td></tr>";
                $dia= $row['dia'];
            }
          $band='0'; 
        }
    } 
  $promedio= number_format($suma/$cont, 2); 
  $velocidad=$utc_today/$promedio*100; 
  $velocidad_format = number_format($velocidad, 2);
echo"</table><BR>";
echo "El promedio de UTC de los ultimos $cont ".$dia." es ".$promedio."<BR>";
echo "Porcentaje de Avance de Despacho Vs Historico <b>(".$row['count']."</b>/<b>".$promedio.")*100</b> = <font color='#9a0202'><b>".$velocidad_format."%</b></font>";
echo "</center>";   
}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

