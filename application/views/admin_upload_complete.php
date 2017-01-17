<body>
<div class="row">
	<div class="col-xs-12">
		
<?php
if ($upload_data != null){

	?>
	<h3>El archivo ha sido cargado correctamente</h3>
	<?php 

			$archivo = fopen ($upload_data["full_path"], "r");

			//inicializo una variable para llevar la cuenta de las líneas y los caracteres
			$num_lineas = 0;
			$caracteres = 0;
			$cont = 0;
			$separador = ";";

			//Hago un bucle para recorrer el archivo línea a línea hasta el final del archivo
			?>
			<table class="table">
				<tbody>
			<?php 
			while (!feof ($archivo)) {
			    //si extraigo una línea del archivo y no es false
			    if ($linea = fgets($archivo)){
			       //acumulo una en la variable número de líneas
			       $num_lineas++;
			       //acumulo el número de caracteres de esta línea
			       $caracteres += strlen($linea);

			       $datos = explode(";",$linea);
			       $cantidadColumnas = count($datos);
		       ?>
			       <tr>
		       	<?php 
		       		if ($cont < 10){
						for ($col = 0; $col < $cantidadColumnas; $col++ ){
		       		
				?>
						<td>
							<?php 
								echo $datos[$col]; 
								
							?>
						</td>
				<?php 
						}
					}
					$cont++;
				?>
			       </tr>
			       <?php 
			    }
			}


			fclose ($archivo);
			echo "
			<h4>Total de registros: " . $num_lineas.", se muestran los 10 primeros</h4>";
			

		?>
				</tbody>
			</table>
		<p align="center">
			<a href="procesarArchivo/<?php echo $upload_data["file_name"] ?>" class="btn btn-warning">Registrar Estudiantes en el Sistema </a>
			
		</p>
	</div>
	<?php 
}
	?>
	<div class="row">
		<div class="col-xs-12">
			<div class="alert alert-warning alert-dismissible" role="alert"><?php echo $mensaje; ?></div>		
		</div>
	</div>
</div>
	
</body>