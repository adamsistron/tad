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
                    echo "<a href='#' class='list-group-item' onClick='selectCountry(".'"'.$column[$opcion_v].'"'.")'>".$column[$opcion_v]."</a>";
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
