<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Content-Type: text/html; charset=UTF-8');
?>
	<script type="text/javascript">
	$(document).ready(function(){
		getListadoDocentes();
	});
	</script>
	
	<div class="alert alert-success" id="mensaje">
		
			<?php 
if (isset($correcto)) echo $correcto; ?>
		
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-6">
				<label for="txt_cedula">Cedula</label>
				<input id="txt_cedula" type="text" maxlength="20" >
				<button class="btn btn-success" onclick="getListaDocenteCedula()">Buscar</button>
			</div>
			<div class="col-xs-6">
				<button onclick="javascript:MiRutas.docente.toNew()" class="btn">Crear nuevo</button>
			</div>
		</div>
		<div id="lista"></div>
	</div>
</body>


<script type="text/template" id="lista_usuarios">
	<table id="lista_docentes" class="table table-responsive">
		<caption><h3 align="center"> Listado de docentes </h3> </caption>
		<thead>
			<th>Usuario</th>
			<th>Nombres</th>
			<th>Apellidos</th>
			<th>Correo</th>
			<th>Cedula</th>
			<th>Estado</th>
			<th>Opcion</th>	
		</thead>
		<tbody>
		<%
		_.each(usuarios, function(data){

		var ls_estado = (data.enabled == 1)? "Activo": "Inactivo";
		var ls_label_btn = (data.enabled == 1)? "Inactivar": "Activar";
		var li_new_estado = (data.enabled == 1)? "0": "1";
		%>
			<tr  onclick='javascript:getSeguimientoDocente(<%= data.usuidentificador %>)'  style="cursor:pointer">
				<td><%= data.usuusuario %></td>
				<td><%= data.nombres %></td>
				<td><%= data.apellidos %></td>
				<td><%= data.email %></td>
				<td><%= data.num_doc %></td>
				<td><%= ls_estado %></td>
				<td>
					<button class="btn btn-success" onclick="cambiarEstado(<%= data.usuidentificador%>, <%= li_new_estado %>)">
					<%= ls_label_btn %>
					</button>
				</td>
			</tr>
		
	<%
		});
	%>
	</tbody>
	</table>
</script>
<script type="text/template" id="detalle_seguimiento">
<div class="col-xs-6">
<button class="btn btn-success" onclick="javascript:window.history.back();">Volver </button>
</div>
<div class="col-xs-6">
	<button class="btn btn-success" onclick="javascript:exportar('seguimiento_estudiante')">Exportar Excel </button>
</div>

	<table id="seguimiento_estudiante" class="table table-responsive">
		<caption><h3 align="center"> Seguimiento al docente </h3> </caption>
		<thead>
			<th>Book</th>
			<th>Unit</th>
			<th>Option</th>
			<th>Fecha</th>
			
		</thead>
		<tbody>
<%

		_.each(usuarios, function(data){
			var book = "";
			var unit = "";
			var option = "";
			var fecha = "";
			if (data.unidad == undefined){

			}else{
				var ls_unidad = data.unidad;
				var ly_libro = ls_unidad.split('-');
				unit = ly_libro[1];
				book = ly_libro[0];
			}
			
		%>
			<tr>
				<td><%= book %></td>
				<td><%= unit %></td>
				<td><%= data.opcion %></td>
				<td><%= data.fecha %></td>
			</tr>
		
	<%
		});
	%>
		</tbody>
	</table>
</script>