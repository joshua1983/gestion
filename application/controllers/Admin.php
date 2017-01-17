<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){

		parent::__construct();
		
		$this->load->helper(array('form', 'url'));
		$this->session;
		$this->db->query('SET SESSION time_zone =  "America/Bogota"');
	}

	public function index(){
		if (!$this->session->has_userdata("id")){
			redirect('login');
		}else{
			$this->load->view('header');
			$this->load->view('admin');
			$this->load->view('pie');
		}
		
	}

	public function getSeguimiento(){
        $examenes = array("a1", "a21", "a22", "b11", "b12", "b2");
		//$id_usuario = $this->input->post("id");
        $id_usuario = 704;
		$sqlSelect = "select a.usuidentificador, b.opcion, c.unidad, c.fecha  from  usuarios a, tbl_seguimiento b, tbl_seguimiento_estudiante c where a.usuidentificador = c.id_estudiante and c.id_seguimiento = b.id and a.usuidentificador = ? order by fecha desc limit 100";
		$consulta = $this->db->query($sqlSelect,array($id_usuario));
		$resultado = $consulta->result_array();
		if ($resultado){
            $datos = array();
            $sqlExamenes = "SELECT sum(nb.nota) as nota, id_examen FROM correctas_prueba_diagnostica nb, prueba_diagnostica_notas n WHERE n.respuesta = nb.respuesta  AND n.nombre = nb.nombre AND n.usuario = ? group by id_examen order by id_examen asc";
            $consultaExamenes = $this->db->query($sqlExamenes,array($id_usuario));
            $i=0;
            foreach ($consultaExamenes->result_array() as $row){
                $datos[$examenes[$i]] = $row["nota"];
                $i++;
                if ($i==5) break;
            }
            
            $retorno = '{"examenes": '.json_encode($datos).', "resultado": '.json_encode($resultado).'}';
		
            
            
			echo utf8_encode($retorno);
		}else{
			echo '{"mensaje": "No hay datos"}';
		}

	}
    
    public function enviarCorreoExamen($id_estudiante){
        require '/var/www/httpdocs/yesynergy/PHPMailerAutoload.php';
        /*
        * Enviar Correo al usuario:
        */

        $sqlSelect = "select nombres, email from usuarios where usuidentificador = ?";
        $consulta = $this->db->query($sqlSelect,array($id_estudiante));
		$resultado = $consulta->result_array();
		$email = $resultado[0];
		$nombres = $resultado[1];


        $mensaje = '

<a href="http://plataforma.yesynergy.com/prueba/start.php?id='.$id_estudiante.'">
    <img src="http://ec2-52-32-48-65.us-west-2.compute.amazonaws.com/yesynergy/img_correo/bienvenida_examen.png">
</a>

';

        $subject = "Bienvenido a YESYNERGY ENGLISH"; 
        $headers = 'From: YESYNERGY ENGLISH <no-reply@yesynergy.com>' . "\n"; 
        $headers .= 'MIME-Version: 1.0' . "\n"; 
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 



        $mail = new PHPMailer();
        $mail->isSMTP();                                      
        $mail->Host = 'email-smtp.us-west-2.amazonaws.com';  
        $mail->SMTPAuth = true;                               
        $mail->Username = 'AKIAI5BBOT3OLXTVSBPA';                 
        $mail->Password = 'AmN7/xI4wTxjltULj4lscvE9xfTMayRv9iSwaw2vq2RI';                           
        $mail->SMTPSecure = 'tls';                            
        $mail->Port =587 ;                                    

        $mail->setFrom('info@yesynergy.com', 'Bienvenido a YESYNERGY ENGLISH');
        $mail->addAddress($email, $nombres);     // Add a recipient
        //$mail->addBCC("juanpablobueno87@gmail.com", "Juan Pablo");     // Add a recipient
        //$mail->addBCC("javierm1122@hotmail.com", "Francisco Javier");     // Add a recipient
        $mail->addBCC("coordinacion@yesynergy.com", "Laura Moreno");     // Add a recipient
        $mail->addBCC("josue.barrios@gmail.com", "Josue");     // Add a recipient
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = $subject;
        $mail->Body    = $mensaje;
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();

        echo '{"resultado": 1}';
        
        
    }

	public function getUsuariosCedula($cedula){
		$query = "select usuidentificador, usucodigo, usuusuario, nombres, apellidos, email, num_doc, sede, salon, enabled, etiqueta from where usutipo = 3 and usuarios where num_doc = ?";
		$consulta = $this->db->query($query,array($cedula));
		$resultado = $consulta->result_array();
		if ($resultado){
			echo utf8_encode(json_encode($resultado));
		}else{
			echo '{"mensaje": "No hay datos"}';
		}
	}
    
    public function getUsuariosInactivos(){
		$this->db->query('SET SESSION time_zone =  "America/Bogota"');
		$query = "select usuidentificador, usucodigo, usuusuario, nombres, apellidos, email, num_doc, sede, salon, enabled, etiqueta, usutipo, (select concat( max(a.fecha),' en ', b.opcion, '  ', a.unidad) from tbl_seguimiento_estudiante a, tbl_seguimiento b where id_estudiante = usuidentificador and a.id_seguimiento = b.id) estado
 from usuarios where usutipo in (3,4) and enabled=0 order by nombres asc";
		$consulta = $this->db->query($query);
		$resultado = $consulta->result_array();
		if ($resultado){
			echo utf8_encode(json_encode($resultado));
		}else{
			echo '{"mensaje": "No hay datos"}';
		}
	}

	public function getUsuarios(){
		$this->db->query('SET SESSION time_zone =  "America/Bogota"');
		$query = "select usuidentificador, usucodigo, usuusuario, nombres, apellidos, email, num_doc, sede, salon, enabled, etiqueta, usutipo, (select concat( max(a.fecha),' en ', b.opcion, '  ', a.unidad) from tbl_seguimiento_estudiante a, tbl_seguimiento b where id_estudiante = usuidentificador and a.id_seguimiento = b.id) estado
 from usuarios where usutipo in (3,4) and enabled=1 order by nombres asc";
		$consulta = $this->db->query($query);
		$resultado = $consulta->result_array();
		if ($resultado){
			echo utf8_encode(json_encode($resultado));
		}else{
			echo '{"mensaje": "No hay datos"}';
		}
	}

	public function cambiaEstado(){
		$id = $this->input->post("id");
		$nuevo = $this->input->post("nuevo");

		$query = "update usuarios set 	enabled = ?, statususer = ? where usuidentificador = ?";
		$this->db->query($query,array($nuevo,$nuevo,$id));
		echo "Usuario actualizado";

	}

	public function upload(){
		$this->load->view('header');
		$this->load->view("admin_upload", array('error' => ' ' ));
		$this->load->view('pie');
	}
    
    public function registrar(){
        $this->load->view('header');
		$this->load->view("registrar", array('error' => ' ' ));
		$this->load->view('pie');
    }
    
    public function guardarNuevoEstudiante(){
        $usucontrasena    = $this->input->post("password");
        $login            = $this->input->post("usuario");
        $nombre           = $this->input->post("nombre");
		$apellidos        = $this->input->post("apellidos");
		$tipo             = $this->input->post("tipo");
		$correo           = $this->input->post("correo");
		$fecha_activacion = $this->input->post("fecha_activacion");
		$fecha_inactivacion = $this->input->post("fecha_inactivacion");
		$documento        = $this->input->post("documento");
		$etiqueta         = $this->input->post("etiqueta");
        $activo           = $this->input->post("activo");

		$query = "insert into usuarios (usuusuario, usucontrasena, nombres, apellidos, email, num_doc, usuperfil, usutipo, enabled, fin_activo, ini_activo, password) values (  ?, ?, ?, ?, ?, ?, ?, ?, ?, str_to_date(?,'%m/%d/%Y'), str_to_date(?,'%m/%d/%Y'), ?)";
		$this->db->query($query,
                         array($login,sha1(md5($usucontrasena)),
                               $nombre,$apellidos,$correo,$documento,
                               $tipo,$tipo,$activo,$fecha_inactivacion,
                               $fecha_activacion, $usucontrasena)
                        );
		$insert_id = $this->db->insert_id();

		if (isset($insert_id)){
			$this->enviarCorreoExamen($insert_id);
		}else{
			echo $insert_id;
		}
		
        redirect('Admin','refresh');
    }

	public function cargarArchivo(){
		$config['upload_path']          = './cargues';
        $config['allowed_types']        = 'txt|cvs';
        $config['max_size']             = 10000;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('archivo'))
        {
                $error = array('error' => $this->upload->display_errors());

                $this->load->view('header');
                $this->load->view('admin_upload', $error);
                $this->load->view('pie');
        }
        else
        {
                $data = array('upload_data' => $this->upload->data(), 'mensaje' => '');

                $this->load->view('header');
                $this->load->view('admin_upload_complete', $data);
                $this->load->view('pie');
        }
	}

	public function procesarArchivo($nombre){
		$archivo = fopen ("./cargues/".$nombre, "r");
		require '/var/www/httpdocs/yesynergy/PHPMailerAutoload.php';

		/*
		* Proceso de creacion de usuario masivo:
		* Se necesita: correo, nombres y apellidos en campos separados
		*/
		while(!feof($archivo)){

			$linea = fgets($archivo);
			$datos = explode(";",$linea);
			$usucodigo = 0;
			$usuusuario = trim($datos[0]);
			$usucontrasena = trim($datos[4]);// trim($datos[4]);
			$nombres = trim($datos[1]);
			$apellidos = trim($datos[2]);
			$email = trim($datos[3]);
			$num_doc = trim($datos[4]);
			$label = trim($datos[5]);
			$fecha_act = trim($datos[6]);
			$fecha_desc = trim($datos[7]);

			$usuperfil = 3;
			$usutipo = 3;
            $fecha_limite= date('YYYY-MM-DD',strtotime("2017-01-01"));

			$data = array(
				'usucodigo' => 0,
				'usuusuario' => $usuusuario,
				'usucontrasena' => sha1(md5($usucontrasena)),
				'nombres' => $nombres,
				'apellidos' => $apellidos,
				'email' => $email,
				'num_doc' => $num_doc,
				'tipo_doc' => 1,
				'etiqueta' => $label,
				'enabled' => 1,
				'usuperfil' => $usuperfil,
				'usutipo' => $usutipo,
                'fin_activo' => $fecha_limite,
                'ini_activo' => $fecha_act,
                'password' => trim($datos[4])
				);

			$this->db->insert('usuarios',$data); 


			/*
			* Enviar Correo al usuario:
			*/

			$mensaje = '

<div  style="background: url(\'https://plataforma.yesynergy.com/yesynergy/img_correo/fondo.png\');background-repeat: no-repeat;width: 1043px;height: 689px;">

    <table width="1043px">
        
        <tr align="center">
            <td colspan="2" style="padding-top: 693px; padding-left: 250px">
            
                '.$email.':
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding-top: 1px; padding-left: 618px">
            <br>
                '.$usucontrasena.'
                
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div align="center" style="padding-top: 300px;padding-left:207px">
                    <br>
                    <a style="text-decoration:underline;color:#FFFFFF;" href="https://plataforma.yesynergy.com"><h3>https://plataforma.yesynergy.com</h3></a>
                    <br><br><br><br><br>
                </div>
            </td>
        </tr>
    </table>
</div>
';

			$subject = "Bienvenido a YESYNERGY ENGLISH"; 
			$headers = 'From: YESYNERGY ENGLISH <no-reply@yesynergy.com>' . "\n"; 
			$headers .= 'MIME-Version: 1.0' . "\n"; 
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 



			$mail = new PHPMailer();
			$mail->isSMTP();                                      
			$mail->Host = 'email-smtp.us-west-2.amazonaws.com';  
			$mail->SMTPAuth = true;                               
			$mail->Username = 'AKIAI5BBOT3OLXTVSBPA';                 
			$mail->Password = 'AmN7/xI4wTxjltULj4lscvE9xfTMayRv9iSwaw2vq2RI';                           
			$mail->SMTPSecure = 'tls';                            
			$mail->Port =587 ;                                    

			$mail->setFrom('info@yesynergy.com', 'Bienvenido a YESYNERGY ENGLISH');
			$mail->addAddress($email, $nombres);     // Add a recipient
			//$mail->addBCC("juanpablobueno87@gmail.com", "Juan Pablo");     // Add a recipient
			//$mail->addBCC("javierm1122@hotmail.com", "Francisco Javier");     // Add a recipient
            $mail->addBCC("coordinacion@yesynergy.com", "Laura Moreno");     // Add a recipient
			//$mail->addCC("josue.barrios@gmail.com", "Josue");     // Add a recipient
			//$mail->addReplyTo('info@example.com', 'Information');
			//$mail->addCC('cc@example.com');
			//$mail->addBCC('bcc@example.com');

			//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			$mail->isHTML(true);                                  // Set email format to HTML

			$mail->Subject = $subject;
			$mail->Body    = $mensaje;
			//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
			$mail->send();

			echo "<h3>Procesando usuario: ".$nombres." ".$apellidos."</h3>";

		}
		redirect('admin');


		fclose ($archivo);

		$data = array('upload_data' => null, 'mensaje' => 'Archivo procesado');

        $this->load->view('header');
        $this->load->view('admin_upload_complete', $data);
        $this->load->view('pie');		
		
	}


	
}