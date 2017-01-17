<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendedor extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->session;
	}

	public function index(){
		$this->load->view('header');
		$this->load->view('vendedores');
		$this->load->view('pie');
	}

	public function getVendedores(){
		$sqlSelect = "select a.usuidentificador, a.usucodigo, a.usuusuario, a.nombres, a.apellidos, a.email, a.num_doc, a.sede, a.salon, a.enabled, a.etiqueta, b.cantidad from usuarios a, (select count(1) cantidad, etiqueta from usuarios where usutipo=3 group by etiqueta) b where usutipo = 4 and a.etiqueta = b.etiqueta";
		$consulta = $this->db->query($sqlSelect);
		$resultado = $consulta->result_array();
		if ($resultado){
			echo utf8_encode(json_encode($resultado));
		}else{
			echo '{"mensaje": "No hay datos"}';
		}
	} 

	public function getVendedorCedula($cedula){
		$query = "select a.usuidentificador, a.usucodigo, a.usuusuario, a.nombres, a.apellidos, a.email, a.num_doc, a.sede, a.salon, a.enabled, a.etiqueta, b.cantidad from usuarios a, (select count(1) cantidad, etiqueta from usuarios group by etiqueta) b where usutipo = 4 and a.etiqueta = b.etiqueta and a.num_doc = ?";
		$consulta = $this->db->query($query,array($cedula));
		$resultado = $consulta->result_array();
		if ($resultado){
			echo utf8_encode(json_encode($resultado));
		}else{
			echo '{"mensaje": "No hay datos"}';
		}
	}

	public function nuevoVendedor(){
		$this->load->view('header');
		$this->load->view('newVendedor');
		$this->load->view('pie');
	}

	public function guardarVendedor(){
		$identificacion = $this->input->post("txt_identificacion");
		$email = $this->input->post("txt_email");
		$nombres = $this->input->post("txt_nombres");
		$apellidos = $this->input->post("txt_apellidos");
		$codigo = $this->input->post("txt_codigo");
		$pwd = sha1(md5($identificacion));

		$this->form_validation->set_rules('txt_identificacion', 'Identificacion', 'required');
		$this->form_validation->set_rules('txt_email', 'Email', 'required|callback_check_email');
		$this->form_validation->set_rules('txt_nombres', 'Nombres', 'required');
		$this->form_validation->set_rules('txt_apellidos', 'Apellidos', 'trim|required');

		if  ($this->form_validation->run() == FALSE){
			$sqlInsert = "insert into usuarios (usuusuario, usucontrasena, nombres, apellidos, email, num_doc, usutipo, usuperfil, etiqueta) values (?,?,?,?,?,?,?,?,?)";
			$this->db->query($sqlInsert,array($email,$pwd,$nombres, $apellidos, $email, $identificacion, 4, 4, $codigo));

			$this->load->view('header');
			$this->load->view('vendedores'); 
			$this->load->view('pie');
		}		
                
	}
	public function check_email($str){
		$query = "select count(1) from usuarios where email = ?";
		$consulta = $this->db->query($query,array($str));
		$resultado = $consulta->result_array();
		if ($resultado[0] > 0){
			$this->form_validation->set_message('check_email', 'El correo %s ya existe');
			return FALSE;
		}else{				
			return TRUE;
		}
	}

	public function setConfiguracionVendedor(){
		$valor_vend_princ = $this->input->post("val_vend_princ");
		$valor_vend_princ_rec = $this->input->post("val_vend_princ_rec");
		$valor_junior = $this->input->post("val_jun");
		$valor_junior_recompra = $this->input->post("val_jun_rec");

		$update = "update configuracion set valor = ? where id = ?";
		$this->db->query($update,array($valor_vend_princ, 1));
		$this->db->query($update,array($valor_vend_princ_rec, 2));
		$this->db->query($update,array($valor_junior, 3));
		$this->db->query($update,array($valor_junior_recompra, 4));


	}


}