<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Content-Type: text/html; charset=UTF-8'); 
?>


<style type="text/css">
	.row{
		padding-left: 2%;
	}
</style>
<div class="row">
	<div class="col-xs-2">
		<div class="list-group">
			<button id="btn_mes" class="list-group-item" type="button" onclick="javascript:cargarVentasMes()">Ventas en el mes</button>
			<button id="btn_vendedor" class="list-group-item" type="button" onclick="javascript:cargarVentasVendedor()">Ventas por vendedor</button>
			<button id="btn_config_vendedor" class="list-group-item" type="button" onclick="javascript:cargarConfiguracionVendedor()">Configuraci&oacute;n vendedor</button>
			<button id="btn_conectados" class="list-group-item" type="button" onclick="javascript:cargarConectados()">Estudiantes - Docentes conectados</button>
			<button id="btn_examenes" class="list-group-item" type="button" onclick="javascript:cargarExamenes()">Examenes externos</button>
			<button id="btn_examenes_int" class="list-group-item" type="button" onclick="javascript:cargarExamenesInt()">Examenes internos </button>
		</div>
	</div>
	<div class="col-xs-10">
		<div id="lista"></div>
	</div>
</div>

</body>
<script type="text/template" id="lista_examenes_int">
	<button class="btn btn-success" onclick="javascript:exportar('tabla_examenes_int')">Exportar Excel </button>
	<table id="tabla_examenes_int" class="table table-responsive">
		<caption><h3 align="center"> Examenes presentados por estudiantes </h3> </caption>
		<thead>
			<th>Nombres</th>
			<th>Apellidos</th>
			<th>Correo</th>
            <th>Puntaje</th>
            <th>Tag</th>
		</thead>
		<tbody>
		<%
		_.each(examenes, function(data){
        
			
		%>
			<tr>
				<td><%= data.nombres %></td>
				<td><%= data.apellidos %></td>
				<td><%= data.email %></td>
                <td><%= data.nota %></td>
                <td><%= data.etiqueta %></td>
			</tr>
		
	<%
		});
	%>
	</tbody>
	</table>
</script>
<script type="text/template" id="lista_examenes">
	<button class="btn btn-success" onclick="javascript:exportar('tabla_examenes')">Exportar Excel </button>
	<table id="tabla_examenes" class="table table-responsive">
		<caption><h3 align="center"> Examenes presentados  </h3> </caption>
		<thead>
			<th>Nombres</th>
			<th>Fecha Presentacion</th>
			<th>Correo</th>
			<th>Telefono</th>
            <th>Pais </th>
            <th>Nivel </th>
            <th>Puntaje</th>
            <th>Borrar</th>
		</thead>
		<tbody>
		<%
		_.each(examenes, function(data){
        var notaTexto = "";
            if (data.nota <= 69)
                notaTexto = "0 - 69";
            if (data.nota > 69 && data.nota <= 79)
                notaTexto = "A1";
            if (data.nota > 79 && data.nota <= 89)
                notaTexto = "A2.1";
            if (data.nota > 89 && data.nota <= 100)
                notaTexto = "A2.2";
			
		%>
			<tr>
				<td><%= data.nombre_estudiante %></td>
				<td><%= data.fecha %></td>
				<td><%= data.correo %></td>
				<td><%= data.telefono %></td>
				<td><%= data.pais %></td>
                <td><%= notaTexto %></td>
                <td><%= data.nota %></td>
                <td>
                    <button class="btn" onclick="borrarExamen('<%=data.correo%>')">Borrar</button>
                </td>
			</tr>
		
	<%
		});
	%>
	</tbody>
	</table>
</script>

<script type="text/template" id="lista_detalle_vendedor">
	<button class="btn btn-success" onclick="javascript:exportar('tabla_usuarios')">Exportar Excel </button>
	<table id="tabla_usuarios" class="table table-responsive">
		<caption><h3 align="center"> Detalle usuarios registrador por vendedor </h3> </caption>
		<thead>
			<th>Nombres</th>
			<th>Apellidos</th>
			<th>Documento</th>
			<th>Correo</th>
			<th>Fecha de registro</th>
		</thead>
		<tbody>
		<%
		_.each(usuarios, function(data){
			
		%>
			<tr>
				<td><%= data.nombres %></td>
				<td><%= data.apellidos %></td>
				<td><%= data.num_doc %></td>
				<td><%= data.email %></td>
				<td><%= data.activate %></td>
			</tr>
		
	<%
		});
	%>
	</tbody>
	</table>
</script>

<script type="text/template" id="lista_ventas">

<div class="col-xs-10">
	<div class="col-xs-3">
		<button class="btn btn-success" onclick="javascript:exportar('mes')">Exportar Excel </button>	
	</div>
	<div class="col-xs-9">
		<div class="form-inline">
			<div class="form-group">
				<label for="txt_mes">Mes:</label>
				<select name="txt_mes" id="txt_mes" class="form-control">
					<option value="1">Enero</option>
					<option value="2">Febrero</option>
					<option value="3">Marzo</option>
					<option value="4">Abril</option>
					<option value="5">Mayo</option>
					<option value="6">Junio</option>
					<option value="7">Julio</option>
					<option value="8">Agosto</option>
					<option value="9">Septiembre</option>
					<option value="10">Octubre</option>
					<option value="11">Noviembre</option>
					<option value="12">Diciembre</option>
				</select>
			</div>
			<div class="form-group">
				<label for="txt_year">Año:</label>
				<input type="number" size="4" maxlength="4" id="txt_year" class="form-control" >
			</div>
			
			<button type="button" class="btn btn-default" aria-label="Buscar" onclick="cargarVentasMes()">
				<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
			</button>
		</div>
		
		
	</div>
</div>
	
	<table id="mes" class="table table-responsive">
		<caption><h3 align="center"> <%= etiq%> </h3> </caption>
		<thead>
			<th>Cedula</th>
			<th>Nombres</th>
			<th>Apellidos</th>
			<th>Correo</th>
			<th>Cantidad</th>
			<th>Costo</th>
		</thead>
		<tbody>
		<%
		_.each(usuarios, function(data){

		
		%>
			<tr style="cursor:pointer" onclick="cargarDetalleVendedor(<%= data.usuidentificador %>)">
				<td><%= data.num_doc %></td>
				<td><%= data.nombres %></td>
				<td><%= data.apellidos %></td>
				<td><%= data.email %></td>
				<td><%= data.cantidad %></td>
				<td><%= '$ ' + numeral( data.costo * data.cantidad ).format('0,0') %></td>
				
			</tr>
		
	<%
		});
	%>
	</tbody>
	</table>
</script>
<script type="text/template" id="lista_vendedor">
	<button class="btn btn-success" onclick="javascript:exportar('vendedor')">Exportar Excel </button>
	<table id="vendedor" class="table table-responsive">
		<caption><h3 align="center"> Ventas acumuladas realizadas por vendedor  </h3> </caption>
		<thead>
			<th>Cedula</th>
			<th>Nombres</th>
			<th>Apellidos</th>
			<th>Correo</th>
			<th>Cantidad</th>
			<th>Costo</th>
			<th>Etiqueta</th>
		</thead>
		<tbody>
		<%
		_.each(usuarios, function(data){

		%>
			<tr  style="cursor:pointer" onclick="cargarDetalleVendedor(<%= data.usuidentificador %>)">
				<td><%= data.num_doc %></td>
				<td><%= data.nombres %></td>
				<td><%= data.apellidos %></td>
				<td><%= data.email %></td>
				<td><%= data.cantidad %></td>
				<td><%= '$ ' + numeral( data.costo * data.cantidad ).format('0,0') %></td>
				<td><%= data.etiqueta %></td>
				
			</tr>
		
	<%
		});
	%>
	</tbody>
	</table>
</script>
<script type="text/template" id="lista_conectados">
<%
var cantidad_estudiantes = 0;
var cantidad_docentes = 0;
_.each(usuarios, function(data){
	if (data.usutipo == "3" || data.usutipo == "4"){
		cantidad_estudiantes++;
	}
	if (data.usutipo == "2"){
		cantidad_docentes++;
	}
});
%>
<div class="col-xs-6">
	<div class="panel panel-defaul">
		<div class="panel-heading"><h3 align="center"> Estudiantes conectados <%= cantidad_estudiantes %> </h3></div>
		<div class="panel panel-body">
			<table id="conectados" class="table table-responsive">
					<thead>
						<th>Cedula</th>
						<th>Nombres</th>
						<th>Apellidos</th>
						<th>Correo</th>
					</thead>
					<tbody>
					<%
					_.each(usuarios, function(data){
						if (data.usutipo == "3" || data.usutipo == "4"){
					%>
						<tr>
							<td><%= data.num_doc %></td>
							<td><%= data.nombres %></td>
							<td><%= data.apellidos %></td>
							<td><%= data.email %></td>
							
						</tr>
					
				<%
					}
				});
				%>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="col-xs-6">
	<div class="panel  panel-defaul">
		<div class="panel-heading"><h3 align="center"> Docentes conectados <%= cantidad_docentes %> </h3></div>
		<div class="panel panel-body">
			<table id="conectados" class="table table-responsive">
					<thead>
						<th>Cedula</th>
						<th>Nombres</th>
						<th>Apellidos</th>
						<th>Correo</th>
					</thead>
					<tbody>
					<%
					_.each(usuarios, function(data){
						if (data.usutipo == "2"){
					%>
						<tr>
							<td><%= data.num_doc %></td>
							<td><%= data.nombres %></td>
							<td><%= data.apellidos %></td>
							<td><%= data.email %></td>
							
						</tr>
					
				<%
					}
				});
				%>
				</tbody>
			</table>
		</div>
	</div>
</div>

</script>

<script type="text/template" id="templ_configuracion">

	<div class="col-xs-10">
		<div class="panel panel-defaul">
			<div class="panel-heading"><h3>Configuracion de comisi&oacute;n</h3></div>
			<div class="panel panel-body">
				<table id="configuracion" class="table table-responsive">
					<thead>
						<th>Valor Vendedor Principal</th>
						<th>Valor Vendedor Principal Recompra</th>
						<th>Vendedor Junior</th>
						<th>Vendedor Junior Recompra</th>
					</thead>
					<tbody>
						<tr>
							<td>
								<input class="form-control" type="text" id="val_vend_princ" value="<%= configuracion[0].valor %>" >
							</td>
							<td>
								<input class="form-control" type="text" id="val_vend_princ_rec" value="<%= configuracion[1].valor %>">
							</td>
							<td>
								<input class="form-control" type="text" id="val_jun" value="<%= configuracion[2].valor %>">
							</td>
							<td>
								<input class="form-control" type="text" id="val_jun_rec" value="<%= configuracion[3].valor %>">
							</td>
						</tr>
						<tr>
							<td colspan="4">
								<input type="button" class="btn btn-success" value="Guardar" onclick="guardarConfiguracionVendedor()">
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</script>
