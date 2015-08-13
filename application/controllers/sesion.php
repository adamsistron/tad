<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sesion extends CI_Controller {

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
                $this->load->library(array('session'));
	

	}
	public function index()
	{
		
		//echo "sss";die();
		
		$this->load->view('login_1.php');
	}
	public function inicio()
	{
		
		//echo "sss";die();
		$this->load->view('login_1.php');
	}

        //Funcion: Devuelve Arreglo de Información de un usuario en un directorio de activos a traves de su cedula
//Parametro 1: texto cedula
//Retorna: Arreglo si ubica al usuario, 0 si no lo encuentra
function verificar_usuario_c($cedula)
{
	//global $SERVIDOR_LDAP, $PUERTO_LDAP;
	
	$ldap_server = "167.134.201.179";
	$puerto = "389";
	
	if ($connect=@ldap_connect($ldap_server,$puerto))
	{ //ECHO "$cedula.SSSSSSSS";DIE();
		ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);
		
		if (($bind=@ldap_bind($connect)) == false) return 0;
                
		if (($res_id = @ldap_search($connect,"OU=Usuarios,DC=pdvsa,DC=com","pdvsacom-AD-cedula=$cedula")) == false) 
                    {
                           @ldap_close($connect);
                           return 0; 
                    }

		if (ldap_count_entries($connect, $res_id) != 1) 
		{
			@ldap_close($connect);
			return 0;
		}

		if (( $entry_id = @ldap_first_entry($connect, $res_id))== false) 
		{	
			@ldap_close($connect);
			return 0;
		}
		
		$attr=ldap_get_attributes($connect, $entry_id);
		
		@ldap_close($connect);
		
		print_r($attr);
	} else return 0;
}

//Funcion: Devuelve Arreglo de Información de un usuario en un directorio de activos a traves de su indicador
//Parametro 1: texto indicador
//Retorna: Arreglo si ubica al usuario, 0 si no lo encuentra
function verificar_usuario_i($indicador)
{
	
	
	//global $SERVIDOR_LDAP, $PUERTO_LDAP;
	
	$ldap_server = "167.134.201.179";
	$puerto = "389";
	
	if ($connect=@ldap_connect($ldap_server,$puerto))
	{ 
		ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);
		
		if (($bind=@ldap_bind($connect)) == false) return "0GGGGGGGGG";
		if (($res_id = @ldap_search( $connect,"OU=Usuarios,DC=pdvsa,DC=com","UID=$indicador")) == false) 
                    {
                           @ldap_close($connect);
                           return 0; 
                    }
		
		if (ldap_count_entries($connect, $res_id) != 1) 
		{
			@ldap_close($connect);
			return 0;
		}
		if (( $entry_id = @ldap_first_entry($connect, $res_id))== false) 
		{	
			@ldap_close($connect);
			return 0;
		}
	
		$attr=ldap_get_attributes($connect, $entry_id);
		
		@ldap_close($connect);
		
		return $attr;
	} else return 0;
}
        
       public function auth_pdvsa($user,$pass)
        {
        if ($user == '' or empty($user) or $pass == '' or empty($pass))
           return false;
            $ldap = ldap_connect("167.134.201.179");
		//print($ldap);die();
            if ($ldap){
                if (!(@ldap_bind($ldap, 'pdvsa2000\\'.$user, $pass)))
                            return false;
                    @ldap_close($ldap);
		}                
		return true;
        }
       public function datos_pdvsa($textIndicadorPDVSA, $textPassword)
        {
           $ds = ldap_connect("167.134.201.179");
		if($ds)
		{
                    $textUsuario=$textIndicadorPDVSA."@pdvsa.com";
                    
			ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
			ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
			$accesoValido=@ldap_bind($ds, $textUsuario, $textPassword);
			$sr = @ldap_search($ds,"OU=Usuarios,DC=pdvsa,DC=com","uid=$textIndicadorPDVSA");
       		//capturo el indicador del usuario dentro del servidor de dominio
        	$entrada = @ldap_first_entry($ds, $sr); 
			//se extraen los atributos del usuario existentes en el servidor de dominio
        	$atributos = @ldap_get_attributes($ds,$entrada);
       		//extracion de datos
        	$primer_nombre = $atributos['givenName'][0];
        	$segundo_nombre = $atributos['middleName'][0];
        	$apellido = $atributos['sn'][0];
        	$ci = $atributos['pdvsacom-AD-cedula'][0];
			//$Nom_Comp= $primer_nombre+" "+$segundo_nombre+" "+$apellido;
			$Nomb_comp=$ci.'  '.$primer_nombre.'  '.$segundo_nombre.'  '.$apellido;
			
                        //echo "aqui";die();
                        //echo $Nomb_comp;die();
                        $n=strlen($ci);
                                if($n<9){
                                    $d=9-$n;
                                    $img=str_repeat("0", $d).$ci;
                                    
                                }
                        
                        
                        $datos_pdvsa = array(
                       'primer_nombre'  => $primer_nombre,
                       'segundo_nombre'  => $segundo_nombre,
                       'apellido'  => $apellido,
                       'ci'  => $ci,
                       'img'  => $img                       
                        );
                        $this->session->set_userdata('pdvsa', $datos_pdvsa);
                        
                        
			ldap_close($ds);
		}
        }
        public function login()
        {
        $user = trim(strtolower($this->input->post('indicador')));
        $pssw = trim($this->input->post('password'));
        
        //echo "$user - $pssw";
        
                $auth_pdvsa=$this->auth_pdvsa($user,$pssw);
                
                $this->datos_pdvsa($user,$pssw);
                //echo $auth_pdvsa; die();
                //$query_usuario = $this->db->get_where('usuario', array('indicador_usuario' => $user));
                /***************************************************************************************/
                $db=$this->load->database('siev',TRUE);
                 $sql="SELECT usuario.id_usuario,usuario.indicador_usuario, usuario.nombre_usuario, usuario.id_rol
                   FROM 
                    public.usuario
                  WHERE                     
                    usuario.indicador_usuario='$user'
                   group by id_usuario
                   order by
                    id_usuario
                ";
                   $query = $db->query("$sql");
                //echo $sql;die();

                    $id_usuario = 0;
                    $indicador_usuario = "";
                    $nombre_usuario = "";
                    foreach ($query->result_array() as $row)
                    {
                        $id_usuario = $row['id_usuario'];
                        $indicador_usuario = $row['indicador_usuario'];
                        $nombre_usuario = $row['nombre_usuario']; 
                        $rol = explode("|", $row['id_rol']);
                    }
                    
                    if(!empty($rol)){
                        $this->view_data['rol'] = $rol;
                    }
                    
                     if($id_usuario<>0){
                        $newdata = array(
                       'id_usuario'  => $id_usuario,
                       'indicador_usuario'  => $indicador_usuario,
                       'nombre_usuario'  => $nombre_usuario,
                       'id_rol'  => $rol,
                       
                                
                        );

                        if(!$auth_pdvsa){
                            echo "<script>alert('Indicador y/o Contraseña Incorrecta')</script>";
                            redirect('/', 'refresh');
                        }else{
                            $this->session->set_userdata($newdata);
                            //print_r($this->session->all_userdata());die();
                            //$this->logs($accion='sesion-inicio');
                            $indicador=  strtoupper($user);
                            //echo "<script>alert('Bienvenido $indicador')</script>";
                            redirect(base_url('/inicio'), 'refresh');
                        } 
                         
                     }else{                        
                        echo "<script>alert('Indicador NO Registrado en el Sistema')</script>";
                        redirect(base_url(''), 'refresh');
                     }


        }
	public function logout()
	{
            $indicador = strtoupper($this->session->userdata('indicador'));
            $this->session->sess_destroy();
            //echo "<script>alert('Hasta Luego $indicador')</script>";
            redirect(base_url(''), 'refresh');
	}



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

