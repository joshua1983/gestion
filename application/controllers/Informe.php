<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informe extends CI_Controller {

	public function __construct(){

		parent::__construct();
		
		$this->load->helper(array('form', 'url'));
		$this->session;
		$this->db->query('SET SESSION time_zone =  "America/Bogota"');
	}

	public function index(){
		if (!$this->session->has_userdata("id")){
			$this->load->view('login');
		}else{
			$this->load->view('header');
			$this->load->view('informes');
			$this->load->view('pie');
		}		
	}
    
    public function borrarExamen(){
        $id_usuario = $this->input->post("id");
		$sqlSelect = "delete from prueba_diagnostica_notas_publica where correo = ?";
		$consulta = $this->db->query($sqlSelect,array($id_usuario));
        $sqlDelete = "delete from maestro_prueba_publica where correo = ?";
        $consulta = $this->db->query($sqlDelete,array($id_usuario));
		
		echo '{"mensaje": 1}';
		
    }
    
    public function getExamenesPresentadosInternos(){
        $sqlSelect = "SELECT coalesce(sum(nb.nota),0) nota, a.nombres, a.apellidos, a.email, a.etiqueta  FROM correctas_prueba_diagnostica nb, prueba_diagnostica_notas n, usuarios a WHERE  n.nombre = nb.nombre AND nb.respuesta = n.respuesta AND n.usuario = a.usuidentificador group by a.usuidentificador";
        $consulta = $this->db->query($sqlSelect);
		$resultado = $consulta->result_array();
		if ($resultado){
			echo utf8_encode(json_encode($resultado));
		}else{
			echo '{"mensaje": "No hay datos"}';
		}
    }
    
    public function getExamenesPresentados(){
        $sqlSelect = "select coalesce(sum(nb.nota),0) nota, a.nombre as nombre_estudiante, coalesce(n.fecha,'') fecha, a.pais, a.telefono, a.correo from maestro_prueba_publica a, correctas_prueba_diagnostica nb, prueba_diagnostica_notas_publica n where a.correo = n.correo and nb.nombre = n.nombre  and nb.respuesta = n.respuesta group by a.correo union select 0, a.nombre, '', a.pais, a.telefono, a.correo from maestro_prueba_publica a where a.correo not in (select correo from prueba_diagnostica_notas_publica) group by a.correo;";
        $consulta = $this->db->query($sqlSelect);
		$resultado = $consulta->result_array();
		if ($resultado){
			echo utf8_encode(json_encode($resultado));
		}else{
			echo '{"mensaje": "No hay datos"}';
		}
    }

    public function getDetalleVendedor(){
    	$vendedor = $this->input->post("vendedor");

		$sqlSelect = "SELECT   a.usuidentificador,
						       a.nombres,
						       a.apellidos,
						       a.num_doc,
						       a.email,
							   a.activate
						  FROM usuarios a
						 WHERE a.etiqueta = (select etiqueta from usuarios where usuidentificador = ".$vendedor." )";

		$consulta = $this->db->query($sqlSelect);
		$resultado = $consulta->result_array();
		if ($resultado){
			echo utf8_encode(json_encode($resultado));
		}else{
			echo '{"mensaje": "No hay datos"}';
		}
    }

	public function getResumenMes(){
		$mes = $this->input->post("p_mes");
		$year = $this->input->post("p_year");
		$sqlExtra = "";

		if ($mes != ''){
			$sqlExtra = " and EXTRACT(month FROM a.activate) = ".$mes;
		}
		if ($year != ''){
			$sqlExtra = $sqlExtra . " and EXTRACT(year FROM a.activate) = ".$year;
		}

		$sqlSelect = "select a.usuidentificador, a.nombres, a.apellidos, a.num_doc, a.email, b.cantidad, EXTRACT(month FROM a.activate) mes,EXTRACT(year FROM a.activate) year, ifnull(b.cantidad * c.valor,0) costo from usuarios a left join configuracion c on a.tipovend = c.id, (select count(1) cantidad, etiqueta from usuarios where usutipo = 3  group by etiqueta)b  where a.etiqueta = b.etiqueta and usutipo = 4 and EXTRACT(month FROM a.activate) = EXTRACT( month FROM now()) and EXTRACT(year FROM a.activate) = EXTRACT( year FROM now()) ".$sqlExtra;

		$consulta = $this->db->query($sqlSelect);
		$resultado = $consulta->result_array();
		if ($resultado){
			echo utf8_encode(json_encode($resultado));
		}else{
			echo '{"mensaje": "No hay datos"}';
		}
	}

	public function getResumenVendedor(){
		$sqlSelect = "select a.usuidentificador, a.nombres, a.apellidos, a.num_doc, a.email, b.cantidad, b.etiqueta, ifnull(b.cantidad * c.valor,0) costo  from usuarios a left join configuracion c on a.tipovend = c.id, (select count(1) cantidad, etiqueta from usuarios where usutipo = 3  group by etiqueta)b  where a.etiqueta = b.etiqueta and usutipo = 4 ";
		$consulta = $this->db->query($sqlSelect);
		$resultado = $consulta->result_array();
		if ($resultado){
			echo utf8_encode(json_encode($resultado));
		}else{
			echo '{"mensaje": "No hay datos"}';
		}
	}

	public function getConectados(){
		$sqlSelect = "select  usuusuario, nombres, apellidos, email, num_doc, usutipo from usuarios WHERE TIMESTAMPDIFF(MINUTE,ping,now()) < 15";
		$consulta = $this->db->query($sqlSelect);
		$resultado = $consulta->result_array();
		if ($resultado){
			echo utf8_encode(json_encode($resultado));
		}else{
			echo '{"mensaje": "No hay datos"}';
		}
	}

	public function getConfiguracionVendedor(){
		$sqlSelect = "select id, valor from configuracion where id in (1,2,3,4) order by id asc";
		$consulta = $this->db->query($sqlSelect);
		$resultado = $consulta->result_array();
		if ($resultado){
			echo utf8_encode(json_encode($resultado));
		}else{
			echo '{"id": "-1" }';
		}
	}
	
}