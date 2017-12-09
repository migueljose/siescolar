	<style type="text/css">
	    
	    label.error{color:red;}
	</style>


<div class="container-fluid">

	<div class="row">
      <div class="col-lg-12">
          <h1 class="page-header"><i class='fa fa-user'></i>&nbsp;GESTIÓN DE PROFESORES</h1>
      </div>
    </div>

    <div class="row">

    	<div class="col-lg-3">
            <div class="form-group">
    		  <button type="submit" name="btn_agregar_profesor" id="btn_agregar_profesor" class="btn btn-success"><i class='fa fa-plus'></i>&nbsp;Agregar Profesor</button>
            </div>
    	</div>

	    <div class="col-lg-offset-2 col-lg-3">
		    <div class="form-group">
		    	<div class="input-group">
			        <input type="text" class="form-control" id="buscar_profesor" name="buscar_profesor"
			                 placeholder="Buscar..">
			      	<span class="input-group-btn">
				        <button type="submit" name="btn_buscar_profesor" id="btn_buscar_profesor" class="btn btn-primary">
				         	<i class="fa fa-search"></i>
				        </button>
			      	</span>
		        </div>
		    </div>  
	    </div>

    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-primary">
    			<div class="panel-heading"><i class='fa fa-list'></i>&nbsp;Lista De Profesores</div>
    				<div class="panel-body">

    					<div class="form-group">
						  <label for="cantidad_profesor">Mostrar Por:</label>
						  <select class="selectpicker" id="cantidad_profesor" name="cantidad_profesor" >
						    <option value="5">5</option>
		  					<option value="10">10</option>
		  					<option value="15">15</option>
		  					<option value="20">20</option>
						  </select>
						</div>

						<div class="table-responsive">
						<table border='1' id="lista_profesores" class="table table-bordered table-condensed table-hover table-striped">
							<thead>
								<tr>
									<th><i class='fa fa-sort-amount-asc'></i></th>
									<th><i class='fa fa-newspaper-o'></i>&nbsp;Identificacion</th>
									<th><i class='fa fa-file-text-o'></i>&nbsp;Nombre</th>
									<th><i class='fa fa-file-text-o'></i>&nbsp;Apellido1</th>
									<th><i class='fa fa-file-text-o'></i>&nbsp;Apellido2</th>
									<th><i class='fa fa-intersex'></i>&nbsp;Sexo</th>
									<th><i class='fa fa-calendar-check-o'></i>&nbsp;Fecha Nacimiento</th>
									<th><i class='fa fa-phone-square'></i>&nbsp;Telefono</th>
									<th><i class='fa fa-envelope'></i>&nbsp;Correo</th>
									<th><i class='fa fa-map'></i>&nbsp;Direccion</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
						</div>

						<div class="text-center paginacion_profesor">
						
						</div>

    				</div>

    		</div>
    	</div>
    </div>



</div>

<!-- Modal  agregar nuev profesor -->
<div id="modal_agregar_profesor" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-plus'></i>&nbsp;REGISTRAR PROFESORES</h4>
      </div>
      <div class="modal-body">
        

        <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>profesores_controller/insertar" name="" method="post" id="form_profesores">

        	<!--LOS TABS-->
        	<ul class="nav nav-tabs">
  				<li class="active"><a data-toggle="tab" href="#home">Identificacion</a></li>
  				<li><a data-toggle="tab" href="#menu1">Persona</a></li>
  				<li><a data-toggle="tab" href="#menu2">Contacto</a></li>
  				<li><a data-toggle="tab" href="#menu3">Educativo</a></li>
			</ul>

			<!--CONTENIDO DE LOS TABS-->
			<div class="tab-content">

				<div id="home" class="tab-pane fade in active">

					</br>
					<div class="form-group">
    					<label class="control-label col-sm-3" for="identificacion">IDENTIFICACION:</label>
    					<div class="col-sm-7">
      						<input type="text" class="form-control" id="identificacion" name="identificacion" placeholder="Introduce tu identificación">
    					</div>
  					</div>

  					<div class="form-group">
    					<label class="control-label col-sm-3" for="tipo_id">TIPO DE IDENTIFICACION:</label>
    					<div class="col-sm-2">
      						<select class="form-control" id="tipo_id" name="tipo_id">
								<option value="rc">RC</option>
								<option value="ti">TI</option>
								<option value="cc">CC</option>
								<option value="ce">CE</option>
							</select>
    					</div>
  					</div>

				</div>
				<!--C***********************************************************************************************************-->

				<div id="menu1" class="tab-pane fade">

					</br>
					<div class="form-group">
    					<label class="control-label col-sm-3" for="nombres">NOMBRES:</label>
    					<div class="col-sm-7">
      						<input type="text" class="form-control" id="nombres" name="nombres" placeholder="Nombres">
    					</div>
  					</div>

  					<div class="form-group">
    					<label class="control-label col-sm-3" for="apellido1">APELLIDO 1:</label>
    					<div class="col-sm-7">
      						<input type="text" class="form-control" id="apellido1" name="apellido1" placeholder="Primer apellido">
    					</div>
  					</div>

  					<div class="form-group">
    					<label class="control-label col-sm-3" for="apellido2">APELLIDO 2:</label>
    					<div class="col-sm-7">
      						<input type="text" class="form-control" id="apellido2" name="apellido2" placeholder="Segundo apellido">
    					</div>
  					</div>

  					<div class="form-group">
    					<label class="control-label col-sm-3" for="sexo">SEXO:</label>
    					<div class="col-sm-4">
      						<select class="form-control" id="sexo" name="sexo">
								<option value="M">Masculino</option>
					  			<option value="F">Femenino</option>
							</select>
    					</div>
  					</div>

  					<div class="form-group">
    					<label class="control-label col-sm-3" for="fecha_nacimiento">FECHA DE NACIMIENTO:</label>
    					<div class="col-sm-7">
      						<input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
    					</div>
  					</div>

				</div>
				<!--C***********************************************************************************************************-->

				<div id="menu2" class="tab-pane fade">

					</br>
 					<div class="form-group">
    					<label class="control-label col-sm-3" for="telefono">TELEFONO:</label>
    					<div class="col-sm-7">
      						<input type="text" class="form-control" id="telefono" name="telefono" placeholder="Telefono">
    					</div>
  					</div>

  					<div class="form-group">
    					<label class="control-label col-sm-3" for="correo">CORREO:</label>
    					<div class="col-sm-7">
      						<input type="text" class="form-control" id="correo" name="correo" placeholder="Correo">
    					</div>
  					</div>

  					<div class="form-group">
    					<label class="control-label col-sm-3" for="direccion">DIRECCION:</label>
    					<div class="col-sm-7">
      						<input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion">
    					</div>
  					</div>

				</div>
				<!--C***********************************************************************************************************-->

				<div id="menu3" class="tab-pane fade">

					</br>
 					<div class="form-group">
    					<label class="control-label col-sm-3" for="perfil">PERFIL:</label>
    					<div class="col-sm-7">
      						<input type="text" class="form-control" id="perfil" name="perfil" placeholder="Perfil">
    					</div>
  					</div>

  					<div class="form-group">
    					<label class="control-label col-sm-3" for="escalafon">ESCALAFON:</label>
    					<div class="col-sm-2">
      						<select class="form-control" id="escalafon" name="escalafon">
								<option value="1">1</option>
					  			<option value="2">2</option>
					  			<option value="3">3</option>
					  			<option value="4">4</option>
					  			<option value="5">5</option>
					  			<option value="6">6</option>
					  			<option value="7">7</option>
					  			<option value="8">8</option>
					  			<option value="9">9</option>
					  			<option value="10">10</option>
					  			<option value="11">11</option>
					  			<option value="12">12</option>
					  			<option value="13">13</option>
					  			<option value="14">14</option>
							</select>
    					</div>
  					</div>

  					<div class="form-group">
    					<label class="control-label col-sm-3" for="fecha_inicio">FECHA DE INICIO:</label>
    					<div class="col-sm-7">
      						<input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio">
    					</div>
  					</div>

  					<div class="form-group">
    					<label class="control-label col-sm-3" for="tipo_contrato">TIPO CONTRATO:</label>
    					<div class="col-sm-7">
      						<select class="form-control" id="tipo_contrato" name="tipo_contrato">
								<option value="1">Termino fijo</option>
					  			<option value="2">Termino indefinido</option>
					  			<option value="3">Obra o labor</option>
					  			<option value="4">Prestacion de servicios</option>
					  			<option value="5">Aprendizaje</option>
							</select>
    					</div>
  					</div>


				</div>

			</div>

			<div class="form-group"> 
    			<div class="col-sm-offset-4 col-sm-5">
      				<button type="submit" name="btn_registrar_profesor" id="btn_registrar_profesor" class="btn btn-primary btn-lg btn-block">Registrar</button>
    			</div>
 			</div>

        </form>

      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      </div>
    </div>

  </div>
</div>

<!-- Modal  actualizar profesor -->
<div id="modal_actualizar_profesor" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='fa fa-refresh'></i>&nbsp;ACTUALIZAR PROFESORES</h4>
      </div>
      <div class="modal-body">
        

        <form class="form-horizontal" role="form" id="form_profesores_actualizar">

        	<!--LOS TABS-->
        	<ul class="nav nav-tabs">
  				<li class="active"><a data-toggle="tab" href="#home1">Identificacion</a></li>
  				<li><a data-toggle="tab" href="#menu11">Persona</a></li>
  				<li><a data-toggle="tab" href="#menu22">Contacto</a></li>
  				<li><a data-toggle="tab" href="#menu33">Educativo</a></li>
			</ul>

			<!--CONTENIDO DE LOS TABS-->
			<div class="tab-content">

				<div id="home1" class="tab-pane fade in active">

					</br>
					<div class="form-group">
								    
						<input type="hidden" class="form-control" id="id_personasele" name="id_persona">
					</div>

					<div class="form-group">
    					<label class="control-label col-sm-3" for="identificacion">IDENTIFICACION:</label>
    					<div class="col-sm-7">
      						<input type="text" class="form-control" id="identificacionsele" name="identificacion" placeholder="Introduce tu identificación">
    					</div>
  					</div>

  					<div class="form-group">
    					<label class="control-label col-sm-3" for="tipo_id">TIPO DE IDENTIFICACION:</label>
    					<div class="col-sm-2">
      						<select class="form-control" id="tipo_idsele" name="tipo_id">
								<option value="rc">RC</option>
								<option value="ti">TI</option>
								<option value="cc">CC</option>
								<option value="ce">CE</option>
							</select>
    					</div>
  					</div>

				</div>
				<!--C***********************************************************************************************************-->

				<div id="menu11" class="tab-pane fade">

					</br>
					<div class="form-group">
    					<label class="control-label col-sm-3" for="nombres">NOMBRES:</label>
    					<div class="col-sm-7">
      						<input type="text" class="form-control" id="nombressele" name="nombres" placeholder="Nombres">
    					</div>
  					</div>

  					<div class="form-group">
    					<label class="control-label col-sm-3" for="apellido1">APELLIDO 1:</label>
    					<div class="col-sm-7">
      						<input type="text" class="form-control" id="apellido1sele" name="apellido1" placeholder="Primer apellido">
    					</div>
  					</div>

  					<div class="form-group">
    					<label class="control-label col-sm-3" for="apellido2">APELLIDO 2:</label>
    					<div class="col-sm-7">
      						<input type="text" class="form-control" id="apellido2sele" name="apellido2" placeholder="Segundo apellido">
    					</div>
  					</div>

  					<div class="form-group">
    					<label class="control-label col-sm-3" for="sexo">SEXO:</label>
    					<div class="col-sm-4">
      						<select class="form-control" id="sexosele" name="sexo">
								<option value="M">Masculino</option>
					  			<option value="F">Femenino</option>
							</select>
    					</div>
  					</div>

  					<div class="form-group">
    					<label class="control-label col-sm-3" for="fecha_nacimiento">FECHA DE NACIMIENTO:</label>
    					<div class="col-sm-7">
      						<input type="date" class="form-control" id="fecha_nacimientosele" name="fecha_nacimiento">
    					</div>
  					</div>

				</div>
				<!--C***********************************************************************************************************-->

				<div id="menu22" class="tab-pane fade">

					</br>
 					<div class="form-group">
    					<label class="control-label col-sm-3" for="telefono">TELEFONO:</label>
    					<div class="col-sm-7">
      						<input type="text" class="form-control" id="telefonosele" name="telefono" placeholder="Telefono">
    					</div>
  					</div>

  					<div class="form-group">
    					<label class="control-label col-sm-3" for="correo">CORREO:</label>
    					<div class="col-sm-7">
      						<input type="text" class="form-control" id="correosele" name="correo" placeholder="Correo">
    					</div>
  					</div>

  					<div class="form-group">
    					<label class="control-label col-sm-3" for="direccion">DIRECCION:</label>
    					<div class="col-sm-7">
      						<input type="text" class="form-control" id="direccionsele" name="direccion" placeholder="Direccion">
    					</div>
  					</div>

				</div>
				<!--C***********************************************************************************************************-->

				<div id="menu33" class="tab-pane fade">

					</br>
 					<div class="form-group">
    					<label class="control-label col-sm-3" for="perfil">PERFIL:</label>
    					<div class="col-sm-7">
      						<input type="text" class="form-control" id="perfilsele" name="perfil" placeholder="Perfil">
    					</div>
  					</div>

  					<div class="form-group">
    					<label class="control-label col-sm-3" for="escalafon">ESCALAFON:</label>
    					<div class="col-sm-2">
      						<select class="form-control" id="escalafonsele" name="escalafon">
								<option value="1">1</option>
					  			<option value="2">2</option>
					  			<option value="3">3</option>
					  			<option value="4">4</option>
					  			<option value="5">5</option>
					  			<option value="6">6</option>
					  			<option value="7">7</option>
					  			<option value="8">8</option>
					  			<option value="9">9</option>
					  			<option value="10">10</option>
					  			<option value="11">11</option>
					  			<option value="12">12</option>
					  			<option value="13">13</option>
					  			<option value="14">14</option>
							</select>
    					</div>
  					</div>

  					<div class="form-group">
    					<label class="control-label col-sm-3" for="fecha_inicio">FECHA DE INICIO:</label>
    					<div class="col-sm-7">
      						<input type="date" class="form-control" id="fecha_iniciosele" name="fecha_inicio">
    					</div>
  					</div>

  					<div class="form-group">
    					<label class="control-label col-sm-3" for="tipo_contrato">TIPO CONTRATO:</label>
    					<div class="col-sm-7">
      						<select class="form-control" id="tipo_contratosele" name="tipo_contrato">
								<option value="1">Termino fijo</option>
					  			<option value="2">Termino indefinido</option>
					  			<option value="3">Obra o labor</option>
					  			<option value="4">Prestacion de servicios</option>
					  			<option value="5">Aprendizaje</option>
							</select>
    					</div>
  					</div>


				</div>

			</div>
	
        </form>

        <div class="row">
          <div class="form-group">
          	<div class="col-sm-offset-4 col-sm-5"> 
          		<button type="submit" name="btn_actualizar_profesor" id="btn_actualizar_profesor" class="btn btn-primary btn-lg btn-block">Actualizar</button>
          	</div>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      </div>
    </div>

  </div>
</div>