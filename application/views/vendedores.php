<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Content-Type: text/html; charset=UTF-8'); 
?>
	<script type="text/javascript">
	$(document).ready(function(){
		getListadoVendedores();
	});
	</script>
	
	<div class="alert alert-success" id="mensaje"></div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-6">
				<label for="txt_cedula">Cedula</label>
				<input id="txt_cedula" type="text" maxlength="20" >
				<button class="btn btn-success" onclick="getListaVendedorCedula()">Buscar</button>
			</div>
			<div class="col-xs-6">
				<button onclick="javascript:MiRutas.vendedor.toNew()" class="btn">Crear nuevo</button>
			</div>
		</div>
		<div id="lista"></div>
	</div>



</body>

<script type="text/template" id="lista_usuarios">
	<table class="table table-responsive">
		<caption><h3 align="center"> Listado de vendedores </h3> </caption>
		<thead>
			<th>Usuario</th>
			<th>Nombres</th>
			<th>Apellidos</th>
			<th>Correo</th>
			<th>Cedula</th>
			<th>Ventas</th>
			<th>Etiqueta</th>
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
			<tr>
				<td><%= data.usuusuario %></td>
				<td><%= data.nombres %></td>
				<td><%= data.apellidos %></td>
				<td><%= data.email %></td>
				<td><%= data.num_doc %></td>
				<td><%= data.cantidad -1 %></td>
				<td><%= data.etiqueta %></td>
				<td><%= ls_estado %></td>
				<td>
					<button class="btn btn-success" onclick="cambiarEstado(<%= data.usuidentificador%>,<%= li_new_estado%>)">
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
