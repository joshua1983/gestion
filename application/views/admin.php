<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Content-Type: text/html; charset=UTF-8'); 
?>
	<script type="text/javascript">
	$(document).ready(function(){
		getListadoUsuarios();

	});
	</script>
	
	<div class="alert alert-success" id="mensaje"></div>
	<div class="container-fluid">
		<div class="row">
			<div class="panel panel-default">
				<div id="lista"></div>
			</div>
		</div>
		
	</div>



</body>
<script type="text/template" id="lista_usuarios">

    <div class="col-xs-12" align="center">	
        <div class="col-xs-4"> 
            <button class="btn btn-success" onclick="javascript:exportar('lista_estudiantes')">Exportar Excel </button> 
        </div>
        <div class="col-xs-4">
            <select onchange="filtrarEstudiantes(this)" class="form-control">
            <%
                if (opcionFiltroEstudiante == 1){
            %>
                <option selected="selected" value="1"> Activos </option>
                <option value="0"> Inactivos </option>
            <%
                }else{
            %>
                <option value="1"> Activos </option>
                <option selected="selected" value="0"> Inactivos </option>
            <%                
                }
            %>  
            </select>
        </div>
        <div class="col-xs-4"></div>

    </div>


	<table id="lista_estudiantes" class="display">
		<caption><h3 align="center"> Listado de estudiantes </h3> </caption>
		<thead>
			<th>Usuario</th>
			<th>Nombres</th>
			<th>Apellidos</th>
			<th>Correo</th>
			<th>Cedula</th>
			<th>Etiqueta</th>
			<th>Estado</th>
			<th>Ultimo ingreso</th>
			<th>Opcion</th>	
		</thead>
		<tbody>
		<%
		_.each(usuarios, function(data){

		var ls_estado = (data.enabled == 1)? "Activo": "Inactivo";
		var ls_label_btn = (data.enabled == 1)? "Inactivar": "Activar";
		var li_new_estado = (data.enabled == 1)? "0": "1";
		%>
			<tr onclick='javascript:getSeguimientoEstudiante(<%= data.usuidentificador %>)' style="cursor:pointer">
				<td><%= data.usuusuario %></td>
				<td><%= data.nombres %></td>
				<td><%= data.apellidos %></td>
				<td><%= data.email %></td>
				<td><%= data.num_doc %></td>
				<td><%= data.etiqueta %></td>
				<td><%= ls_estado %></td>
				<td><%= data.estado %></td>
				<td>
					<button class="btn btn-success" onclick="cambiarEstado(<%= data.usuidentificador%>,<%= li_new_estado%>)">
					<%= ls_label_btn %>
					</button><br>
                    
                    
                    
				</td>
			</tr>
		
	<%
		});
	%>
	</tbody>
	</table>

</script>
<script type="text/template" id="detalle_seguimiento">
<div class="col-xs-4">
    <a href="/admin/index.php/admin" class="btn btn-success"> Volver </a>
</div>
<div class="col-xs-4">
	<button class="btn btn-success" onclick="javascript:exportar('seguimiento_estudiante')">Exportar Excel </button><br>
    <button class="btn btn-success" onclick="enviarCorreoExamen('<%= usuario %>')">Enviar correo examen</button>
    <button class="btn btn-success" onclick="enviarCorreoBienvenida('<%= usuario %>')">Enviar correo bienvenida</button>
</div>
<div class="col-xs-4">
    
<div id="div_examenes">
<%
var examenes = {};
examenes.a1 = 0;
examenes.a21 = 0;
examenes.a22 = 0;
examenes.b11 = 0;
examenes.b12 = 0;
examenes.b2 = 0;
%>
    <table class="table">
        <caption>Pruebas Diagnosticas</caption>
        <thead>
            <th>Level A1</th>
            <th>Level A2.1</th>
            <th>Level A2.2</th>
            <th>Level B1.1</th>
            <th>Level B1.2</th>
            <th>Level B2</th>
        </thead>
        <tbody>
            <tr>
                <td><%= examenes.a1 %></td>
                <td><%= examenes.a21 %></td>
                <td><%= examenes.a22 %></td>
                <td><%= examenes.b11 %></td>
                <td><%= examenes.b12 %></td>
                <td><%= examenes.b2 %></td>
                
            </tr>
        </tbody>
    
    </table>

</div>
    
</div>

	<table id="seguimiento_estudiante" class="table table-responsive">
		<caption><h3 align="center"> Seguimiento al estudiante </h3> </caption>
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