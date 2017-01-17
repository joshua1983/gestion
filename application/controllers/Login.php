<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('session');
		$this->session;
	}

	public function index(){

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('header');
			$this->load->view('login');
			$this->load->view('pie');
		}else{
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$sqlSelect = "select usuidentificador  from usuarios where usuusuario = ? and usucontrasena = ? and statususer = 1 and admin = 1 ";
			$consulta = $this->db->query($sqlSelect, array($username,sha1(md5($password))));
			$resultado = $consulta->result_array();
			 
			if ($resultado){
				$_SESSION["online"] = true;
				$_SESSION["id"] = $resultado[0];
				redirect('admin');
			}else{
				redirect('login','refresh'); 
			}
		}

	}

	public function salir(){
		if (isset($_SESSION['id'])) {
			
			// remove session datas
			foreach ($_SESSION as $key => $value) {
				unset($_SESSION[$key]);
			}
			
			redirect('login','refresh'); 
			
		} else {
			redirect('admin');
			
		}
	}

}