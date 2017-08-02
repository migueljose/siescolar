	<style type="text/css">
	    
	    label.error{color:red;}
	</style>


<div class="container-fluid">

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">GESTIÓN DE ASIGNATURAS</h1>
        </div>
    </div>

    <div class="row">

    	<div class="col-lg-6">
    		<button type="submit" name="btn_agregar_asignatura" id="btn_agregar_asignatura" class="btn btn-success">Agregar Asignatura</button>
    	</div></br>

        <div class="col-lg-6">
            <form class="form-inline" role="form">
				<div class="form-group">
					<label class="sr-only" for="buscar_grado">Email</label>
					<input type="text" class="form-control" id="buscar_asignatura" name="buscar_asignatura"
					           placeholder="Introduce tu nombre">
				</div>

				<button type="submit" name="btn_buscar_asignatura" id="btn_buscar_asignatura" class="btn btn-primary">Buscar</button>
			</form></br></br>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-primary">
    			<div class="panel-heading">Lista De Asignaturas</div>
    				<div class="panel-body">

    					<div class="form-group">
						  <label for="cantidad_asignatura">Mostrar Por:</label>
						  <select class="selectpicker" id="cantidad_asignatura" name="cantidad_asignatura" >
						    <option value="5">5</option>
		  					<option value="10">10</option>
		  					<option value="15">15</option>
		  					<option value="20">20</option>
						  </select>
						</div>

						<div class="table-responsive">
						<table border='1' id="lista_asignaturas" class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Nombre</th>
									<th>Area</th>
									<th>Año lectivo</th>
									<th>Estado</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
						</div>

						<div class="text-center paginacion_asignatura">
						
						</div>

    				</div>

    		</div>
    	</div>
    </div>



</div>

<!-- Modal  agregar nuev asignatura -->
<div id="modal_agregar_asignatura" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">REGISTRAR ASIGNATURAS</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>

        <form role="form" action="<?php echo base_url(); ?>asignaturas_controller/insertar" name="" method="post" id="form_asignaturas">

        	<div class="form-group">
				<label for="nombre_asignatura">NOMBRE</label>
				<input type="text" class="form-control" id="nombre_asignatura" name="nombre_asignatura"
						 placeholder="Nombre">
			</div>

			<div class="form-group">
				<label for="id_area">AREA</label>
				<div id="area1">
					<select class="form-control" id="id_area" name="id_area">
									    
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="año_lectivo">AÑO LECTIVO</label>
				<div id="ano_lectivo1">
					<select class="form-control" id="ano_lectivo" name="ano_lectivo">
									    
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="estado_asignatura">ESTADO</label>
				<select class="form-control" id="estado_asignatura" name="estado_asignatura">
						<option value="Activo">Activo</option>
						<option value="Inactivo">Inactivo</option>
				</select>
			</div>

			<button type="submit" name="btn_registrar_asignatura" id="btn_registrar_asignatura" class="btn btn-primary btn-lg btn-block">Registrar</button>

        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Modal  actualizar asignatura -->
<div id="modal_actualizar_asignatura" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ACTUALIZAR ASIGNATURAS</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>

        <form role="form" id="form_asignaturas_actualizar">

        	<div class="form-group">
								    
				<input type="hidden" class="form-control" id="id_asignaturasele" name="id_asignatura">
			</div>

        	<div class="form-group">
				<label for="nombre_asignatura">NOMBRE</label>
				<input type="text" class="form-control" id="nombre_asignaturasele" name="nombre_asignatura"
						 placeholder="Nombre">
			</div>

			<div class="form-group">
				<label for="id_area">AREA</label>
				<div id="area1">
					<select class="form-control" id="id_areasele" name="id_area">
									    
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="año_lectivo">AÑO LECTIVO</label>
				<div id="ano_lectivo1">
					<select class="form-control" id="ano_lectivosele" name="ano_lectivo">
									    
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="estado_asignatura">ESTADO</label>
				<select class="form-control" id="estado_asignaturasele" name="estado_asignatura">
						<option value="Activo">Activo</option>
						<option value="Inactivo">Inactivo</option>
				</select>
			</div>

			
        </form>

        <button type="submit" name="btn_actualizar_asignatura" id="btn_actualizar_asignatura" class="btn btn-primary btn-lg btn-block">Actualizar</button>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>