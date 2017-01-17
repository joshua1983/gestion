<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href=<?php echo base_url("css/bootstrap.css") ?> type="text/css" />
    <link rel="stylesheet" href=<?php echo base_url("css/datepicker.css") ?> type="text/css" />
    <link rel="stylesheet" href=<?php echo base_url("css/estilos.css") ?> type="text/css" />
    
    <script type="text/javascript" src="<?php echo base_url("js/jquery.js") ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("js/jquery-ui.min.js") ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("js/underscore.js") ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("js/moment.js") ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("js/numeral.min.js") ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("js/bootstrap.min.js") ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("js/collapse.js") ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("js/transition.js") ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("js/bootstrap-datepicker.js") ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("js/tableExport.js") ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("js/jquery.base64.js") ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("js/rutas.js") ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("js/main.js") ?>"></script>
    <script type="text/javascript">
		$(document).ready(function(){
			moment.locale(window.navigator.language);
		});
	</script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
    <link href='https://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
	<title>Interfaz Administrador Yesynergy</title>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Navegacion</span>
				</button>
				<div class="navbar-brand">
					Administraci&oacute;n 
				</div>
			</div>
			<?php 
			if (isset($_SESSION["online"]) && $_SESSION["online"]==true){
			?>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="#" onclick="javascript:MiRutas.admin.toIndex()">Estudiantes</a></li>
					<li><a href="#" onclick="javascript:MiRutas.docente.toIndex()">Docentes</a></li>
					<li><a href="#" onclick="javascript:MiRutas.vendedor.toIndex()">Vendedores</a></li>
					<li><a href="#" onclick="javascript:MiRutas.admin.toUpload()">Cargue Masivo Estudiantes</a></li>
					<li><a href="#" onclick="javascript:MiRutas.admin.toNewEst()">Crear Nuevo Estudiantes</a></li>
					<li><a href="#" onclick="javascript:MiRutas.info.toIndex()">Informes</a></li>
					<li><a href="#" onclick="javascript:MiRutas.general.toExit()">Salir</a></li>
				</ul>
			</div>
			<?php 
			}
			?>
		</div>
	</nav>