<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Consulta_Despachos extends CI_Controller {

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
                $this->load->model('consulta_despachos_model');
                
                $session_id = $this->session->userdata('indicador_usuario');
		if($session_id==""){
		redirect(base_url(''), 'refresh');
		}

	}
	public function index()
	{
		//$this->load->view('consulta_despachos');
                
            $this->view_data['view_name'] = "view_despachos";
            $this->view_data['menu'] = "scli3";
            $this->load->view('output', $this->view_data);
	}
	public function autoparametros()
	{
            $opcion=$this->input->post('opcion');
            $parametro=$this->input->post('parametro');
            //ECHO $opcion; die();
            switch ($opcion) {
                case 0:
                $opcion_v = "";
                break;
                case 1:
                $opcion_v = "nombre_cliente";
                break;
                case 2:
                $opcion_v = "codigo_sap_despacho";
                break;
                case 3:
                $opcion_v = "cedula_conductor";
                break;
                    case 4:
                $opcion_v = "placa_cisterna";
                break;
                        case 5:
                $opcion_v = "pd";
                break;
                            case 6:
                $opcion_v = "placa_chuto";
                break;
            }
            
            $data = $this->consulta_despachos_model->autoparametros($opcion_v, $parametro);
            //print_r($data);die();
            if(!empty($data)) {
            echo "<div id='country-list'  class='list-group'>";
                foreach($data as $column) {
                    echo "<a class='list-group-item' onClick='selectOpcion(".'"'.$column[$opcion_v].'"'.")'>".$column[$opcion_v]."</a>";
                }
            echo "</div>";
            }

            
            
	}
	public function general()
	{
            
            $this->view_data['view_name'] = "view_planta_general";
            $this->view_data['resultado'] = $this->consulta_despachos_model->general();
            $this->view_data['menu'] = "scli1";
            $this->load->view('output', $this->view_data);
            
            
	}
	function consulta_despachos_opcion()
	{
	
            $opcion=$this->input->post('opcion');
            $parametro=$this->input->post('parametro');
                    
            switch ($opcion) {
                case 1:
                $opcion_v = "EE/SS";
                break;
                case 2:
                $opcion_v = "Doc. de Trassporte";
                break;
                case 3:
                $opcion_v = "Cedula del Conductor";
                case 4:
                $opcion_v = "Placa de Cisterna";
                case 5:
                $opcion_v = "Planta de Distribución";
                case 6:
                $opcion_v = "Placa Chuto";
                break;
            }
            
            $data['resultado']=$this->consulta_despachos_model->consultas($opcion, $parametro);
            $data['opcion']=$opcion_v;
            $data['parametro']=$parametro;
            
                $this->load->view('tabla_despachos',$data);
            
	}
	function datos_tabla()
	{
	
            $opcion=$this->input->post('opcion');
            $parametro=$this->input->post('parametro');
          
            
            $datos=$this->consulta_despachos_model->datos_tabla($opcion, $parametro);
           //echo json_encode($datos);
           echo json_encode($datos, JSON_NUMERIC_CHECK);
            
	}

        
        public function datatables(){
 
            $opcion=$this->input->get('opcion');
            
            $parametro=$this->input->get('parametro');
            
            
            
            if( $opcion==0 || $parametro==''){
                $output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => 0,
		"iTotalDisplayRecords" => 0,
		"aaData" => array()
	);
            }else{

	$aColumns = array('pd','nombre_cliente','codigo_sap_despacho','estatus_despacho',
            'fecha_salida_llenado','placa_cisterna', 'placa_chuto',
            'cedula_conductor','nombre_conductor','codigo_sap_cliente', 'rif_cliente', 'fecha_programada'
            );
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "codigo_sap_despacho";
	
	/* DB table to use */
	$sTable = "ds_despachos_sie_mena";
	
	/*
	 * Paging
	 */
	$sLimit = "";
	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
	{
		/*$sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".
			mysql_real_escape_string( $_GET['iDisplayLength'] );*/
		$sLimit = "LIMIT ".$_GET['iDisplayLength']." OFFSET ".$_GET['iDisplayStart'];
	}
	
	//echo $sLimit;die();
	/*
	 * Ordering
	 */
	if ( isset( $_GET['iSortCol_0'] ) )
	{
		$sOrder = "ORDER BY ";
		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
		{
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
			{
				$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]." ".$_GET['sSortDir_'.$i].", ";
			}
		}
		
		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY" )
		{
			$sOrder = "";
		}else{
                    
               
	}
	//echo $sOrder;die();
	
	/* 
	 * Filtering
	 * NOTE this does not match the built-in DataTables filtering which does it
	 * word by word on any field. It's possible to do here, but concerned about efficiency
	 * on very large tables, and MySQL's regex functionality is very limited
	 */
	$sWhere = "";
	if ( $_GET['sSearch'] != "" )
	{
		$sWhere = "WHERE (";
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			$sWhere .= " UPPER(".$aColumns[$i]."::text) LIKE UPPER('%".$_GET['sSearch']."%') OR ";
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
	}
	
	/* Individual column filtering */
	for ( $i=0 ; $i<count($aColumns) ; $i++ )
	{
		if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
		{
			if ( $sWhere == "" )
			{
				$sWhere = "WHERE ";
			}
			else
			{
				$sWhere .= " AND ";
			}
			$sWhere .= " UPPER(".$aColumns[$i]."::text) LIKE UPPER('%".$_GET['sSearch_'.$i]."%') ";
		}
	}
	
        //PARAMETRO ADICIONAL ENVIADO POR POST
        $columPost = array('','nombre_cliente', 'codigo_sap_despacho','cedula_conductor','placa_cisterna','pd', 'placa_chuto');
                    
        //echo $columPost[$opcion];die();
        
        if ( $sWhere == "" )
			{
				$sWhere = "WHERE ";
			}
			else
			{
				$sWhere .= " AND ";
			}
			$sWhere .= " UPPER(".$columPost[$opcion]."::text) LIKE UPPER('%".$parametro."%') ";
	
	/*
	 * SQL queries
	 * Get data to display
	 */
        
        $db=$this->load->database('scli',TRUE);
	$sQuery = "
		SELECT DISTINCT ".str_replace(" , ", " ", implode(", ", $aColumns))."
		FROM   $sTable
		$sWhere
		$sOrder
		$sLimit
	";
//echo $sQuery;die();
	$rResult = $db->query($sQuery);

	/* Total data set length */
	$sQuery2 = "
		SELECT COUNT(DISTINCT ".$sIndexColumn.")
		FROM   $sTable
                    $sWhere
	";
	$rResultTotal = $db->query($sQuery2);
        $row = $rResultTotal->row(); 
	$iTotal = $row->count;
        
               
	//$iFilteredTotal = round(($iTotal/$_GET['iDisplayLength']), 0, PHP_ROUND_HALF_UP);
	$iFilteredTotal = $iTotal*$_GET['iDisplayLength']-$_GET['iDisplayLength'];
//echo $iFilteredTotal;die();
	
	/*
	 * Output
	 */
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);
	
                foreach ($rResult->result_array() as $aRow)
	{
		$row = array();
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( $aColumns[$i] == "version" )
			{
				/* Special output formatting for 'version' column */
				$row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
			}
			else if ( $aColumns[$i] != ' ' )
			{
				/* General output */
				$row[] = $aRow[ $aColumns[$i] ];
			}
		}
		$output['aaData'][] = $row;
	}
         }
            }
	echo json_encode( $output );
        }
        //****************************************************************************
        //****************************************************************************
        public function stock($tipo){
		if ($this->tank_auth->is_logged_in()){
                    $data['estados'] = $this->bookmarks_model->obtenerEstados();
                    $this->load->view('headers/librerias');
                    $this->load->view("hc/$tipo", $data);
                    $this->load->view('hc/footer');
            }else{
			echo "No tienes permisos para entrar";
                        redirect('auth/login');
		}
	}
        
        public function stockDatosCompare($serie){
	            
            $obtenerStockDatosCompare = $this->bookmarks_model->obtenerStockDatosCompare($serie);
            
            echo json_encode($obtenerStockDatosCompare, JSON_NUMERIC_CHECK);
	}
        
        public function stockDatosCompareDespachos($condicion){
	            
            $obtenerStockDatosCompare = $this->bookmarks_model->obtenerStockDatosCompareDespachos($condicion);
            
            echo json_encode($obtenerStockDatosCompare, JSON_NUMERIC_CHECK);
	}

        
        public function stockDatosCompareVolumen($condicion){
	            
            $obtenerStockDatosCompare = $this->bookmarks_model->obtenerStockDatosCompareVolumen($condicion);
            
            echo json_encode($obtenerStockDatosCompare, JSON_NUMERIC_CHECK);
	}
        
       
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
