		<?php if (!empty($msg_success)): ?>
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">x</button>
				<?php echo $msg_success; ?>
			</div>
		<?php endif ?>
		<h2 class="col-12"><?php echo $titulo_form ?></h2>

		<?php if (validation_errors() != ''): ?>
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert">x</button>
				<h4>Error</h4>
				La información está incompleta o errónea.
			</div>	
		<?php endif ?>
		<form action="" method="post" class="form-horizontal" accept-charset="utf-8" enctype="multipart/form-data">
			<div class="form-group">
				<?php if(!empty($imagenes)):?>
					<div class="row">
						<?php if ($imagenes->num_rows()): ?>
							<ul class="media-list">
							<?php foreach ($imagenes->result() as $row): ?>
								<li>
									<img src="assets/img/<?php echo $class?>/<?php echo $id?>/<?php echo $row->original?>" class="thumbnail" width="200" alt="Responsive image">
									<a class="eliminar" href="/<?php echo $class?>/eliminar_img/<?php echo $row->id;?>/<?php echo $id;?>"><i class="fa fa-times-circle-o"></i></a>
								</li>
							<?php endforeach ?>
							</ul>
							<?php else: ?>
								<h5>No se encontraron resultados.</h5>
							<?php endif ?>
						</div>
				<?php endif?>
			</div>
			<div class="form-group">
				<label for="imagen" class="col-lg-2 control-label">Logo</label>
				<div class="col-lg-3">
					<input type="file" name="imagen" id="imagen"> 
				</div>
			</div>

			<?php $error = form_error('datos[tipoImagen]'); ?>
			<div class="form-group<?php echo ($error != '') ? ' has-error' : ''; ?>">
				<label for="tipoImagen" class="col-lg-2 control-label">Tipo de imagen</label>
				<div class="col-lg-3">
					<select name="datos[tipoImagen]" id="tipoImagen" class="form-control">
						<option value="2" <?php echo validar_seleccion($tipoImagen, '0'); ?>>Normal</option>
						<option value="1" <?php echo validar_seleccion($tipoImagen, '1'); ?>>Principal</option>
					</select>					
				</div>
				<?php echo $error; ?>
			</div>

			<div class="form-group">
				<div class="col-lg-3 col-sm-offset-2 btn-crud">
					<button type="submit" class="btn btn-success">Guardar</button>
					<a href="/productos" class="btn btn-default">Regresar</a>
				</div>
			</div>

		</form>