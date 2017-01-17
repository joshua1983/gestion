<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Docente extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->session;
	}

	public function index(){
		$this->load->view('header');
		$this->load->view('docentes');
		$this->load->view('pie');
	}

	public function getDocentes(){
		$sqlSelect = "select usuidentificador, usucodigo, usuusuario, nombres, apellidos, email, num_doc, sede, salon, enabled from usuarios where usutipo = 2";
		$consulta = $this->db->query($sqlSelect);
		$resultado = $consulta->result_array();
		if ($resultado){
			echo utf8_encode(json_encode($resultado));
		}else{
			echo '{"mensaje": "No hay datos"}';
		}
	} 
	
	public function getSeguimiento(){
		$id_usuario = $this->input->post("id");
		$sqlSelect = "select b.opcion, c.unidad, c.fecha  from  usuarios a, tbl_seguimiento b, tbl_seguimiento_estudiante c where a.usuidentificador = c.id_estudiante and c.id_seguimiento = b.id and a.usuidentificador = ?";
		$consulta = $this->db->query($sqlSelect,array($id_usuario));
		$resultado = $consulta->result_array();
		if ($resultado){
			echo utf8_encode(json_encode($resultado));
		}else{
			echo '{"mensaje": "No hay datos"}';
		}

	}

	public function getDocenteCedula($cedula){
		$query = "select usuidentificador, usucodigo, usuusuario, nombres, apellidos, email, num_doc, sede, salon, enabled from usuarios where usutipo = 2 and num_doc = ?";
		$consulta = $this->db->query($query,array($cedula));
		$resultado = $consulta->result_array();
		if ($resultado){
			echo utf8_encode(json_encode($resultado));
		}else{
			echo '{"mensaje": "No hay datos"}';
		}
	}

	public function nuevoDocente(){
		$this->load->view('header');
		$this->load->view('newDocente');
		$this->load->view('pie');
	}

	public function guardarDocente(){
		$identificacion = $this->input->post("txt_identificacion");
		$email = $this->input->post("txt_email");
		$nombres = $this->input->post("txt_nombres");
		$apellidos = $this->input->post("txt_apellidos");
		$pwd = sha1(md5($identificacion));

		$this->form_validation->set_rules('txt_identificacion', 'Identificacion', 'required');
		$this->form_validation->set_rules('txt_email', 'Email', 'required|callback_check_email');
		$this->form_validation->set_rules('txt_nombres', 'Nombres', 'required');
		$this->form_validation->set_rules('txt_apellidos', 'Apellidos', 'trim|required');

		if  ($this->form_validation->run() == FALSE){
			require '/var/www/httpdocs/yesynergy/PHPMailerAutoload.php';

			$sqlInsert = "insert into usuarios (usuusuario, usucontrasena, nombres, apellidos, email, num_doc, usutipo, usuperfil, enabled, fin_activo) values ('.$email.','.$pwd.','.$nombres.','.$apellidos.','.$email.','.$identificacion.',2,2,1,CURRENT_TIMESTAMP() + interval 1 year)";
			$this->db->query($sqlInsert);



			/*
			* Enviar Correo al usuario:
			*/



			$message ="<center><strong>INSTRUCTIVO DE INGRESO</strong></center>
			<br>
			<br>
			·	Synergy Group, te da la Bienvenida como docente del Programa de Inglés “YESynergy”.<br>
			·	En este momento eres un docente activo, por tal  motivo  tu clave de usuario y contraseña son las siguientes:<br><br>

			USUARIO: $email<br>
			CONTRASEÑA: $identificacion <br><br>

			·	Te invitamos a hacer uso de la plataforma y de las herramientas que te brinda “YESynergy” a traves de la direccion: https://plataforma.yesynergy.com/login.php .<br>
			·	Te deseamos éxitos y un cordial saludo.";

			$subject = "Nuevo docente en www.yesynergy.com"; 
			$headers = 'From: YESynergy <no-reply@yesinergy.com>' . "\n"; 
			$headers .= 'MIME-Version: 1.0' . "\n"; 
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 


			$mail = new PHPMailer();
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'email-smtp.us-west-2.amazonaws.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'AKIAI5BBOT3OLXTVSBPA';                 // SMTP username
			$mail->Password = 'AmN7/xI4wTxjltULj4lscvE9xfTMayRv9iSwaw2vq2RI';                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port =587 ;                                    // TCP port to connect to

			$mail->setFrom('mailer@yesynergy.com', 'Mailer Yesynergy');
			$mail->addAddress($email, $nombres);     // Add a recipient
			$mail->addCC("juanpablobueno87@gmail.com", "Juan Pablo");     // Add a recipient
			$mail->addCC("javierm1122@hotmail.com", "Francisco Javier");     // Add a recipient
			$mail->addCC("josue.barrios@gmail.com", "Josue");     // Add a recipient
			$mail->isHTML(true);                                  // Set email format to HTML

			$mail->Subject = $subject;
			$mail->Body    = $message;
			$mail->send();

			$this->load->view('header');
			$this->load->view('docentes'); 
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

}