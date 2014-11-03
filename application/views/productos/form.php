		
		<h2 class="col-12"><?php echo $titulo_form ?></h2>

		<?php if (validation_errors() != ''): ?>
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert">x</button>
				<h4>Error</h4>
				La información está incompleta o errónea.
			</div>	
		<?php endif ?>

		<form action="" method="post" class="form-horizontal">
			
			<?php $error = form_error('datos[idCategoria]'); ?>
			<div class="form-group<?php echo ($error != '') ? ' has-error' : ''; ?>">
				<label for="categoria" class="col-lg-2 control-label">Categoría</label>
				<div class="col-lg-6">
					<select name="datos[idCategoria]" data-idSubcategoria="<?php echo $idSubcategoria?>" id="categoria" class="form-control categoria-ajax">
						<?php if ($categoria->num_rows()): ?>
							<?php foreach ($categoria->result() as $row): ?>
								<option value="<?php echo $row->id?>" <?php echo validar_seleccion($idCategoria, $row->id); ?>><?php echo $row->nombre?></option>
							<?php endforeach ?>
						<?php else: ?>
							<option value="">No se encontraron resultados.</option>
						<?php endif ?>
					</select>					
				</div>
				<?php echo $error; ?>
			</div>

			<?php $error = form_error('datos[idSubcategoria]'); ?>
			<div class="form-group<?php echo ($error != '') ? ' has-error' : ''; ?>">
				<label for="subcategoria" class="col-lg-2 control-label">Sub-Categoría</label>
				<div class="col-lg-6 recarga-list-sub-categoria">
					<select name="datos[idSubcategoria]" id="subcategoria" class="form-control">
						<option value="">Seleccione una categoría</option>
					</select>					
				</div>
				<?php echo $error; ?>
			</div>

			<?php $error = form_error('datos[nombre]'); ?>
			<div class="form-group<?php echo ($error != '') ? ' has-error' : ''; ?>">
				<label for="nombre" class="col-lg-2 control-label">Nombre Producto</label>
				<div class="col-lg-6">
					<input type="text" name="datos[nombre]" id="nombre" class="form-control" value="<?php echo set_value('nombre', $nombre); ?>"> 
				</div>
				<?php echo $error; ?>
			</div>

			<?php $error = form_error('datos[descripcion_breve]'); ?>
			<div class="form-group<?php echo ($error != '') ? ' has-error' : ''; ?>">
				<label for="descripcion_breve" class="col-lg-2 control-label">Descripcion Breve</label>
				<div class="col-lg-6">
					<input type="text" name="datos[descripcion_breve]" id="descripcion_breve" class="form-control" value="<?php echo set_value('descripcion_breve', $descripcion_breve); ?>"> 
				</div>
				<?php echo $error; ?>
			</div>

			<?php $error = form_error('datos[descripcion]'); ?>
			<div class="form-group<?php echo ($error != '') ? ' has-error' : ''; ?>">
				<label for="descripcion" class="col-lg-2 control-label">Descripcion</label>
				<div class="col-lg-8">
					<textarea name="datos[descripcion]" class="form-control editor"><?php echo $descripcion; ?></textarea> 
				</div>
				<?php echo $error; ?>
			</div>

			<?php $error = form_error('datos[color]'); ?>
			<div class="form-group<?php echo ($error != '') ? ' has-error' : ''; ?>">
				<label for="color" class="col-lg-2 control-label">Color Producto</label>
				<div class="col-lg-6">
					<input type="text" name="datos[color]" id="color" class="form-control" value="<?php echo set_value('color', $color); ?>"> 
				</div>
				<?php echo $error; ?>
			</div>

			<?php $error = form_error('datos[medida]'); ?>
			<div class="form-group<?php echo ($error != '') ? ' has-error' : ''; ?>">
				<label for="medida" class="col-lg-2 control-label">Medidas Producto</label>
				<div class="col-lg-6">
					<input type="text" name="datos[medida]" id="medida" class="form-control" value="<?php echo set_value('medida', $medida); ?>"> 
				</div>
				<?php echo $error; ?>
			</div>
			
			<?php $error = form_error('datos[material]'); ?>
			<div class="form-group<?php echo ($error != '') ? ' has-error' : ''; ?>">
				<label for="material" class="col-lg-2 control-label">Material Producto</label>
				<div class="col-lg-6">
					<input type="text" name="datos[material]" id="material" class="form-control" value="<?php echo set_value('material', $material); ?>"> 
				</div>
				<?php echo $error; ?>
			</div>

			<?php $error = form_error('datos[precio]'); ?>
			<div class="form-group<?php echo ($error != '') ? ' has-error' : ''; ?>">
				<label for="precio" class="col-lg-2 control-label">Precio Producto</label>
				<div class="col-lg-4 input-group">
					<span class="input-group-addon">$</span>
					<input type="text" name="datos[precio]" id="precio" class="form-control" value="<?php echo set_value('precio', $precio); ?>">
				</div>
				<?php echo $error; ?>
			</div>
			
			<?php $error = form_error('datos[visible]'); ?>
			<div class="form-group<?php echo ($error != '') ? ' has-error' : ''; ?>">
				<label for="visible" class="col-lg-2 control-label">Producto Visible</label>
				<div class="col-lg-6">
					<select name="datos[visible]" id="visible" class="form-control">
						<option value="1" <?php echo validar_seleccion($visible, '1'); ?>>Producto Visible</option>
						<option value="0" <?php echo validar_seleccion($visible, '0'); ?>>Producto No Visible</option>
					</select>					
				</div>
				<?php echo $error; ?>
			</div>

			<div class="form-group">
				<div class="col-lg-3 col-sm-offset-2 btn-crud">
					<button type="submit" class="btn btn-success">Guardar</button>
					<a href="/promociones" class="btn btn-default">Regresar</a>
				</div>
			</div>

		</form>