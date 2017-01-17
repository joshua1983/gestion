<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

	<div class="row">
		<div class="col-xs-1"></div>
		<div class="col-xs-10">
			<?php echo validation_errors(); ?>
			
		<?php echo form_open("Vendedor/guardarVendedor"); ?>
			<div class="form-group">
				<label for="txt_identificacion">Identificacion</label>
				<input type="text" class="form-control" id="txt_identificacion" name="txt_identificacion" value="<?php echo set_value('txt_identificacion');?>">
			</div>
			<div class="form-group">
				<label for="txt_email">Correo electr&oacute;nico</label>
				<input type="text" class="form-control" id="txt_email" name="txt_email" value="<?php echo set_value('txt_email');?>">
			</div>
			<div class="form-group">
				<label for="txt_nombres">Nombres</label>
				<input type="text" class="form-control" id="txt_nombres" name="txt_nombres" value="<?php echo set_value('txt_nombres');?>">
			</div>
			<div class="form-group">
				<label for="txt_apellidos">Apellidos</label>
				<input type="text" class="form-control" id="txt_apellidos" name="txt_apellidos" value="<?php echo set_value('txt_apellidos');?>">
			</div>
			<div class="form-group">
				<label for="txt_codigo">Codigo</label>
				<input type="text" class="form-control" id="txt_codigo" name="txt_codigo" readonly="readonly" value="<?php echo rand(1000,9000);?>">
			</div>
			<button type="submit" class="btn btn-success">Guardar</button>
		<?php echo form_close(); ?>
		</div>
		<div class="col-xs-1"></div>
	</div>