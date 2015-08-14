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
            /*
            if($opcion==1){
                $this->load->view('tabla_1_nombre_es',$data);
            }
            if($opcion==2){
                $this->load->view('tabla_2_documento_transporte',$data);
            }
            if($opcion==3){
                $this->load->view('tabla_3_ci_conductor',$data);
            }
            if($opcion==4){
                $this->load->view('tabla_4_placa_cisterna',$data);
            }
            */
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
