<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Content-Type: text/html; charset=UTF-8'); 
?>
<script type="application/javascript">
$( function() {
    $( "#fecha_activacion" ).datepicker({
        dateFormat: 'dd/mm/yyyy'
    });
    $( "#fecha_inactivacion" ).datepicker({
        dateFormat: 'dd/mm/yyyy'
    });
} );

</script>
<form action="guardarNuevoEstudiante" method="post">  	
	<div class="alert alert-success" id="mensaje"></div>
	<div class="container-fluid">
	
		<div class="row">
			
        <div class="col-md-12">
         <div class="col-md-2"></div>
         <div class="col-md-8">
           <div class="row">
               <div class="col-md-12">
                   <h3>Registro de nuevo estudiante</h3>
               </div>
           </div>
        <div class="row">
            <div class="panel panel-default">
            <div class="panel-heading">
                Datos de acceso
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <label for="usuario">Usuario</label>
                        <input type="text" class="form-control" name="usuario" id="usuario">
                    </div>
                    <div class="col-md-6">
                        <label for="password">Contraseña</label>
                        <input type="text" name="password" id="password" class="form-control">
                    </div>
                </div>
           </div>
           </div>
	    </div>
       <div class="row">
           <div class="panel panel-default">
            <div class="panel-heading">
                Datos del estudiante
            </div>
            <div class="panel-body">
                <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6">

                       <div class="form-group">
                        <label for="exampleInputNombre">Nombre</label>
                        <input type="text" size="30%" class="form-control" name="nombre" id="exampleInputNombre">
                      </div>

                    </div>
                    <div class="col-md-6">

                       <div class="form-group">
                        <label for="exampleInputApellido">Apellidos</label>
                        <input type="text" size="30%" class="form-control" name="apellidos" id="exampleInputApellidos">
                      </div>

                    </div>
                </div>
                <div class="col-md-12">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="fecha_activacion">Fecha de activaci&oacute;n</label>
                        <input id="fecha_activacion" class="form-control" name="fecha_activacion" type="text">
                        <span class="add-on">
                          <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                          </i>
                        </span>
                    </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="fecha_inactivacion">Fecha de inactivaci&oacute;n</label>
                        <input id="fecha_inactivacion" class="form-control" name="fecha_inactivacion" type="text">
                        <span class="add-on">
                          <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                          </i>
                        </span>
                    </div>
                  </div>
                </div>
              </div>
                <div class="row">
                  <div class="col-md-12">
                     <div class="col-md-6">
                         <div class="form-group">
                            <label for="exampleInputEmail1">Tipo</label>
                           <select class="form-control" name="tipo">
                              <option value="4">Mercadeo</option>
                              <option value="3">Estudiante</option>
                              <option value="2">Docente</option>
                            </select>
                         </div>
                     </div>
                      <div class="col-md-6">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Correo</label>
                            <input type="email" class="form-control" name="correo" id="exampleInputEmail1" >
                          </div>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                     <div class="col-md-6">
                          <div class="form-group">
                            <label for="identificacion">Documento identificaci&oacute;n</label>
                            <input type="text" class="form-control" name="documento" id="exampleInputEmail1" >
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                            <label for="identificacion">Etiqueta</label>
                            <input type="text" class="form-control" name="etiqueta" id="exampleInputEmail1" >
                          </div>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="activo">Activar</label>
                              <select name="activo" id="activo" class="form-control">
                                  <option value="1">Activo</option>
                                  <option value="0">Inactivo</option>
                              </select>
                          </div>
                      </div>
                  </div>
              </div>
            <div class="row">
             <div class="col-md-12" align="center">
                <button type="submit" class="btn btn-default">Guardar</button> 
             </div>
            </div>
            
            </div>
           </div>
       </div>
        
    </div>
    <div class="col-md-2"></div>
    </div>
    </div>
</div>
    
</form>
             

</body>
