<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class scli extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
       function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
                $this->load->library(array('session','table'));
                //$this->load->model('consulta_despachos_model');
                //$this->load->database();
		$session_id = $this->session->userdata('indicador_usuario');
		//echo $session_id;die();
		if($session_id==""){
		redirect(base_url(''), 'refresh');
		}

	}
	
	public function index()
	{
        
             redirect(base_url('/scli/scli_1/'), 'refresh');
	}
        
        public function scli_1()
	{
            //echo "qqqqq";die();
//            $db=$this->load->database('scli',TRUE);
//            
//            $query = $db->query("
//                                SELECT pd, velocidad AS velocidad, created
//                                FROM ds_velocidad_despachos
//                                WHERE pd='Planta Dist. Bajo Grande'
//                                ORDER BY created DESC
//                              ");
//           $dato1=  array();
//            foreach ($query->result_array() as $row)
//            {
//                $dato1[]= $row['pd'];
//                $dato1[]= $row['velocidad'];
//                $dato1[]= $row['created'];               
//            }
//           
//            $query2 = $db->query("
//                                SELECT TRUNC(indice,2) AS indice
//                                FROM ds_indicador_despachos_dia_semana
//                                WHERE pd='Planta Dist. Bajo Grande'
//                                ");
//            $dato2='';
//            foreach ($query2->result_array() as $row)
//            {
//                $dato2= $row['indice'];            
//            }
//            $query3 = $db->query("
//                                SELECT pd, indice_avance AS indice_avance
//                                FROM ds_indicador_despachos_avance_programado
//                                WHERE pd='Planta Dist. Bajo Grande'
//                                ");
//            $dato3='';
//            foreach ($query3->result_array() as $row)
//            {
//                $dato3= $row['indice_avance'];            
//            }
//            
////            Consulta de Volumen de Despacho por Producto
//            $query4 = $db->query("
//                                 SELECT pd, producto,
//                                 fecha_programada,
//                                 TRUNC(volumen_btd*0.006289811,2) as volumen_btd
//                                 FROM ds_volumen_despachado
//                                 WHERE fecha_programada=CURRENT_DATE
//                                 and pd='Planta Dist. Bajo Grande'
//                                ");
//            $diesel= '';
//            $g91= '';
//            $g95= '';
//            $jet= '';
//            $av_gas= '';
//            $fuel_oil= '';
//            $insoil= '';
//            $kerosene= '';
//            $estatus_ant = "";
//     
//            foreach ($query4->result_array() as $row)
//            {
//                if($row['producto'] == 'Diesel')
//                {
//                    $diesel[] = $row['volumen_btd'];
//                }
//                if($row['producto'] == 'G-91')
//                {
//                    $g91[] = $row['volumen_btd'];
//                } 
//                if($row['producto'] == 'G-95')
//                {
//                    $g95[] = $row['volumen_btd'];
//                } 
//                if($row['producto'] == 'Jet-A1')
//                {
//                    $jet[] = $row['volumen_btd'];
//                } 
//                if($row['producto'] == 'Av-Gas')
//                {
//                    $av_gas[] = $row['volumen_btd'];
//                } 
//                if($row['producto'] == 'Fuel Oil')
//                {
//                    $fuel_oil[] = $row['volumen_btd'];
//                } 
//                if($row['producto'] == 'Insol 210')
//                {
//                    $insoil[] = $row['volumen_btd'];
//                } 
//                if($row['producto'] == 'Kerosene')
//                {
//                    $kerosene[] = $row['volumen_btd'];
//                } 
//                
//                $estatus_ant = $row['producto'];
//            }
            $serie_data[] = array('name' => 'Diesel', 'data' => '0');
            $serie_data[] = array('name' => 'G-91', 'data' => '0');
            $serie_data[] = array('name' => 'G-95', 'data' => '0');
            $serie_data[] = array('name' => 'Jet-A1', 'data' => '0');
            $serie_data[] = array('name' => 'Av-Gas', 'data' => '0');
            $serie_data[] = array('name' => 'Fuel Oil', 'data' => '0');
            $serie_data[] = array('name' => 'Insol 210', 'data' => '0');
            $serie_data[] = array('name' => 'Kerosene', 'data' => '0');
            
            
            //Consultar para Despacho / Historico
//            $query5=$db->query("
//                                SELECT pd, dia_semana, estatus, 'HISTORICO' AS tipo, historico AS cantidad, indice, created
//                                FROM ds_indicador_despachos_dia_semana
//                                where pd='Planta Dist. Bajo Grande'
//                                UNION  
//                                SELECT pd, dia_semana, estatus,  'DESPACHADO' AS tipo, actual AS cantidad, indice, created
//                                FROM ds_indicador_despachos_dia_semana
//                                where pd='Planta Dist. Bajo Grande'
//                               ");
//            $historico = '0';
//            $despachado = '0';
//            $estatus_ant1 = "";
     
//            foreach ($query5->result_array() as $row)
//            {
//                if($row['tipo'] == 'HISTORICO' and $row['cantidad']!='')
//                {
//                    $historico= $row['cantidad'];
//                }
//                if($row['tipo'] == 'DESPACHADO'and $row['cantidad']!='')
//                {
//                    $despachado = $row['cantidad'];
//                } 
//
//                $estatus_ant1 = $row['cantidad'];
//            }
            //$serie_data1[] = array('name' => 'Historico', 'data' => $historico);
            //$serie_data1[] = array('name' => 'Despachado', 'data' => $despachado);
            //print_r ($historico);
            //echo "dato hist".$historico;
            //echo "dato desp".$despachado;
            //die();
            
            $this->view_data['serie_data'] = json_encode($serie_data, JSON_NUMERIC_CHECK);
            //$this->view_data['serie_data1'] = json_encode($serie_data, JSON_NUMERIC_CHECK);
           // $this->view_data['historico'] = $historico;
           // $this->view_data['despachado'] = $despachado;
           // $this->view_data['dato1'] = $dato1;
           // $this->view_data['dato2'] = $dato2;
           // $this->view_data['dato3'] = $dato3;
            $this->load->view('view_scli1', $this->view_data);
	}
public function scli_2()
	{
          $planta=$this->input->post('planta');  
        //echo "LA PLANTA SELECCIONADA FUE: ".$planta;
        //die();
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
                                SELECT TRUNC(indice,0) AS indice
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
                echo "<tr><td>".$row['dia']." - ".$row['fecha']." - ".$row['hora'].":00     </td> ";
                echo "<td align='center'>".$row['count']."</td></tr>";                 
            }
            else
            {     
                $utc_today= $row['count'];   
                echo "<tr><td><b>".$row['dia']." - ".$row['fecha']." - ".$row['hora'].":00</b></td> ";
                echo "<td align='center'><b>".$row['count']."</b></td></tr>";
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
                echo "<tr bgcolor='#F6EFEF'><td>".$row['dia']." - ".$row['fecha']." - ".$row['hora'].":00     </td> ";
                echo "<td align='center'>".$row['count']."</td></tr>";                 
            }
            else
            {     
                $utc_today= $row['count'];   
                echo "<tr bgcolor='#F6EFEF'><td><b>".$row['dia']." - ".$row['fecha']." - ".$row['hora'].":00</b></td> ";
                echo "<td align='center'><b>".$row['count']."</b></td></tr>";
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
echo "La velocidad de Despacho a esta hora es <b>".$row['count']."</b>/<b>".$promedio."</b> = <font color='#9a0202'><b>".$velocidad_format."</b></font>";
echo "</center>";   
}

public function avance(){
    
  $planta=$this->input->post('planta'); 
  //$planta="Planta Dist. Yagua";
  $db=$this->load->database('scli',TRUE);           

  $query = $db->query("
                        SELECT 
                        distinct
                        tx_codigo as cod_sap,
                        detalle_despachos_planta.tx_nombre_1 as nombre_es
                        FROM 
                        public.detalle_despachos_planta
                        where pd = '$planta'
                        order by detalle_despachos_planta.tx_nombre_1 asc;
                     ");
  $dato=  array();
  $fecha_actual=date("d/m/Y");
echo "<center><table cellspacing='0' FRAME='void' RULES='rows'>";
echo"<tr><td align='center' width='120px'><strong>Codigo SAP</strong></td>";
echo"<td align='center' width='400px'><strong> Nombre de E/S </strong></td></tr>"; 
$suma=0;
$dia="";
$promedio=0;
$cont=0;$utc_today=0;$velocidad=0;
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
                echo "<tr><td><a onclick=detalle('$codigo')><font color='blue'>".$row['cod_sap']."</font></a></td> ";
                echo "<td align='left'>".$row['nombre_es']."</td></tr>";                     
                //$utc_today= $row['count'];   
                //$dia= $row['dia'];
            
            $band=1;
       }
       else 
       {
                //echo "<tr><td>".$row['cod_sap']." </td> ";
                echo "<tr bgcolor='#F6EFEF'><td><a onclick=detalle('$codigo')><font color='blue'>".$row['cod_sap']."</font></a></td> ";
                echo "<td align='left'>".$row['nombre_es']."</td></tr>";                     
          $band='0'; 
        }
    } 
  /*$promedio= number_format($suma/$cont, 2); 
  $velocidad=$utc_today/$promedio*100; 
  $velocidad_format = number_format($velocidad, 2);*/
echo"</table><BR>";
//echo "El promedio de UTC de los ultimos $cont ".$dia." es ".$promedio."<BR>";
//echo "La velocidad de Despacho a esta hora es <b>".$row['count']."</b>/<b>".$promedio."</b> = <font color='#9a0202'><b>".$velocidad_format."</b></font>";
echo "</center>";   
}

public function detalle_despacho($codigo_despacho){
    
  //$planta=$this->input->post('planta'); 
  //$planta="Planta Dist. Yagua";
  $db=$this->load->database('scli',TRUE);           
  //$codigo_despacho="0000503124";
  $query = $db->query("
                        SELECT 
                        nu_cedula_de_identidad as cedula, 
                        tx_nombre_2 as nombre_chofer, 
                        tx_nombre_3 as nombre_combustible, 
                        nu_volumen_bruto_despachado as volumen, 
                        fe_salida_llenado as fecha
                       FROM 
                         public.detalle_despachos_planta
                            where tx_codigo = '$codigo_despacho'
                            order by fe_salida_llenado asc;
                     ");
  $dato=  array();
  $fecha_actual=date("d/m/Y");
echo "<center><table cellspacing='0' FRAME='void' RULES='rows'>";
echo"<tr><td align='center' width='120px'><strong>Cedula Chofer</strong></td>";
echo"<td align='center' width='400px'><strong> Nombre Chofer </strong></td>";
echo"<td align='center' width='400px'><strong> Producto </strong></td>";
echo"<td align='center' width='400px'><strong> Volumen(Lts.) </strong></td>";
echo"<td align='center' width='400px'><strong> Fecha </strong></td></tr>"; 
$suma=0;
$dia="";
$promedio=0;
$cont=0;$utc_today=0;$velocidad=0;
$velocidad_format=0;
   $band='0';
   $base_url="";
   foreach ($query->result_array() as $row)
   {
       if($band=='0')
       { 
                echo "<tr><td align='left'>".$row['cedula']."</td>"; 
                echo "<td align='left'>".$row['nombre_chofer']."</td>";  
                echo "<td align='left'>".$row['nombre_combustible']."</td>";
                echo "<td align='left'>".$row['volumen']."</td>";
                echo "<td align='left'>".$row['fecha']."</td></tr>";                
            $band=1;
       }
       else 
       {
                //echo "<tr><td>".$row['cod_sap']." </td> ";
                echo "<tr bgcolor='#F6EFEF'><td align='left'>".$row['cedula']."</td> "; 
                echo "<td align='left'>".$row['nombre_chofer']."</td>";  
                echo "<td align='left'>".$row['nombre_combustible']."</td>";
                echo "<td align='left'>".$row['volumen']."</td>";
                echo "<td align='left'>".$row['fecha']."</td></tr>";                
          $band='0'; 
        }
    } 
  /*$promedio= number_format($suma/$cont, 2); 
  $velocidad=$utc_today/$promedio*100; 
  $velocidad_format = number_format($velocidad, 2);*/
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
                echo "<tr><td>".$row['dia']." - ".$row['fecha']." - ".$row['hora'].":00     </td> ";
                echo "<td align='center'>".$row['count']."</td></tr>";                 
            }
            else
            {     
                $utc_today= $row['count'];   
                echo "<tr><td><b>".$row['dia']." - ".$row['fecha']." - ".$row['hora'].":00</b></td> ";
                echo "<td align='center'><b>".$row['count']."</b></td></tr>";
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
                echo "<tr bgcolor='#F6EFEF'><td>".$row['dia']." - ".$row['fecha']." - ".$row['hora'].":00     </td> ";
                echo "<td align='center'>".$row['count']."</td></tr>";                 
            }
            else
            {     
                $utc_today= $row['count'];   
                echo "<tr bgcolor='#F6EFEF'><td><b>".$row['dia']." - ".$row['fecha']." - ".$row['hora'].":00</b></td> ";
                echo "<td align='center'><b>".$row['count']."</b></td></tr>";
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
echo "La velocidad de Despacho a esta hora es <b>".$row['count']."</b>/<b>".$promedio."</b> = <font color='#9a0202'><b>".$velocidad_format."</b></font>";
echo "</center>";   
}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
