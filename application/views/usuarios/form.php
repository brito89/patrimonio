	
		<h2 class="col-12"><?php echo $titulo_form ?></h2>

		<?php if (validation_errors() != ''): ?>
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert">x</button>
				<h4>Error</h4>
				La información está incompleta o errónea.
			</div>	
		<?php endif ?>

		<form action="" method="post" class="form-horizontal" autocomplete="off">
			<?php $error = form_error('datos[nombre]'); ?>
			<div class="form-group<?php echo ($error != '') ? ' has-error' : ''; ?>">
				<label for="nombre" class="col-lg-2 control-label">Nombre</label>
				<div class="col-lg-6">
					<input type="text" name="datos[nombre]" id="nombre" class="form-control" value="<?php echo set_value('nombre', $nombre); ?>"> 
				</div>
				<?php echo $error; ?>
			</div>

			<?php $error = form_error('datos[apellidos]'); ?>
			<div class="form-group<?php echo ($error != '') ? ' has-error' : ''; ?>">
				<label for="apellidos" class="col-lg-2 control-label">Apellidos</label>
				<div class="col-lg-6">
					<input type="text" name="datos[apellidos]" id="apellidos" class="form-control" value="<?php echo set_value('apellidos', $apellidos); ?>">					
				</div>
				<?php echo $error; ?>
			</div>

			<?php $error = form_error('datos[correo]'); ?>
			<div class="form-group<?php echo ($error != '') ? ' has-error' : ''; ?>">
				<label for="correo" class="col-lg-2 control-label">Correo</label>
				<div class="col-lg-6">
					<input type="text" name="datos[correo]" id="correo" class="form-control" value="<?php echo set_value('correo', $correo); ?>">					
				</div>
				<?php echo $error; ?>
			</div>

			<?php $error = form_error('datos[usuario]'); ?>
			<div class="form-group<?php echo ($error != '') ? ' has-error' : ''; ?>">
				<label for="usuario" class="col-lg-2 control-label">Usuario</label>
				<div class="col-lg-6">
					<input type="text" name="datos[usuario]" id="usuario" class="form-control" value="<?php echo set_value('usuario', $usuario); ?>">					
				</div>
				<?php echo $error; ?>
			</div>

			<?php $error = form_error('datos[pass]'); ?>
			<div class="form-group<?php echo ($error != '') ? ' has-error' : ''; ?>">
				<label for="pass" class="col-lg-2 control-label">Contraseña</label>
				<div class="col-lg-6">
					<input type="password" name="datos[pass]" id="pass" class="form-control">					
				</div>
				<?php echo $error; ?>
			</div>

			<?php $error = form_error('repetir'); ?>
			<div class="form-group<?php echo ($error != '') ? ' has-error' : ''; ?>">
				<label for="repetir" class="col-lg-2 control-label">Repetir</label>
				<div class="col-lg-6">
					<input type="password" name="repetir" id="repetir" class="form-control">					
				</div>
				<?php echo $error; ?>
			</div>

			<?php $error = form_error('datos[tipo]'); ?>
			<div class="form-group<?php echo ($error != '') ? ' has-error' : ''; ?>">
				<label for="tipo" class="col-lg-2 control-label">Tipo</label>
				<div class="col-lg-6">
					<select name="datos[tipo]" id="tipo" class="form-control">
						<option value="0" <?php echo validar_seleccion($tipo, '0'); ?>>Administrador</option>
						<option value="1" <?php echo validar_seleccion($tipo, '1'); ?>>Normal</option>
					</select>					
				</div>
				<?php echo $error; ?>
			</div>

			<?php $error = form_error('datos[activo]'); ?>
			<div class="form-group<?php echo ($error != '') ? ' has-error' : ''; ?>">
				<label for="activo" class="col-lg-2 control-label">Estado</label>
				<div class="col-lg-6">
					<select name="datos[activo]" id="activo" class="form-control">
						<option value="1" <?php echo validar_seleccion($activo, '1'); ?>>Cuenta Activada</option>
						<option value="0" <?php echo validar_seleccion($activo, '0'); ?>>Cuenta Suspendida</option>
					</select>					
				</div>
				<?php echo $error; ?>
			</div>

			<div class="form-group">
				<div class="col-lg-3 col-sm-offset-2 btn-crud">
					<button type="submit" class="btn btn-success">Guardar</button>
					<a href="/usuarios" class="btn btn-default">Regresar</a>
				</div>
			</div>

		</form>