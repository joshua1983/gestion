<body>
<div class="row">
	<div class="col-xs-12">
		<div class="alert alert-danger" role="alert"><?php echo $error; ?></div>		
	</div>
</div>

<div class="row">
	<div class="col-xs-1"></div>
	<div class="col-xs-2">
		Seleccione el archivo a cargar, CSV o TXT separado por punto y coma.
	</div>
	<div class="col-xs-9">
		<div class="form-group">
			<?php 
				echo form_open_multipart('Admin/cargarArchivo');
			?>
			
			<input type="file" name="archivo" size="20" >	
			<br>
			<input type="submit" value="Subir archivo" class="btn btn-success">	
			<br><br>
			</form>
		</div>		
	</div>
</div>
<div class="row">
	<div class="col-xs-1"></div>
	<div class="col-xs-10">
		El contenido del archivo debe ser:
		<table class="table">
			<thead>
				<th>Login Usuario</th>
				<th>Nombres</th>
				<th>Apellidos</th>
				<th>Email</th>
				<th>Identifiaci&oacuten</th>
				<th>Entidad</th>
				<th>Fecha activacion</th>
				<th>Fecha inactivacion</th>
			</thead>
			<tbody></tbody>
		</table>
	</div>
	<div class="col-xs-1"></div>
</div>


</body>
