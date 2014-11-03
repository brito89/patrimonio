<?php if (!empty($msg_success)): ?>
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">x</button>
		<?php echo $msg_success; ?>
	</div>
<?php endif ?>
<h2 class="col-12">Productos</h2>
<form action="<?php echo (isset($form_action)) ? $form_action:''?>" id="consulta" method="post">

	<div class="input-group col-sm-6 col-12 search-block">
		<input type="text" name="buscar" placeholder="buscar" value="<?php echo $buscar ?>" class="form-control">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-default"><i class="icon-search"></i></button>
		<?php if (!empty($buscar)): ?>
			<a href="/<?php echo $class;?>" class="btn btn-default"><i class="icon-undo"></i></a>
		<?php endif ?>

		</span>
	</div>			
	<div class="col-sm-6 col-12 search-block">
		<a href="/<?php echo $class?>/nuevo" class="btn btn-success"><i class="icon-plus"></i> Agregar Producto</a>
	</div>

	<div class="col-12">
		<table class="table table-striped table-crud">
			<thead>
				<tr>
					<th width="1%">#</th>
					<th class="hidden-sm">Imagen</th>
					<th class="hidden-sm">Nombre</th>
					<th class="hidden-sm">Color</th>
					<th class="hidden-sm">Medidas</th>
					<th class="hidden-sm">Precio</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="7" class="row-fluid">						
						<div class="col-12">
							<button type="button" class="btn btn-danger btn-sm" id="btn-delete"><i class="icon-trash"></i> Eliminar Seleccion</button>
						</div>
						<div class="col-12 hidden-sm text-center">
							<?php echo $pages ?>
						</div>
						<div class="col-12 visible-sm text-center">
							<?php echo $pages_mobile ?>
						</div>
					</td>
				</tr>
			</tfoot>
			<tbody>
			<?php if ($query->num_rows()): ?>
				<?php foreach ($query->result() as $row): ?>
				<tr>
					<td><br clear="left"><input type="checkbox" name="del[]" value="<?php echo $row->id; ?>"></td>
					<td class="text-center"><?php if(!empty($row->foto)){ echo '<img src="/assets/img/productos/'.$row->id.'/'.$row->foto.'" width="130" class="img-responsive img-rounded" alt="Responsive image">';} else{ echo '<img src="/assets/img/sin-foto.jpg" width="70" class="img-responsive img-rounded" alt="Responsive image">';} ?></td>
					<td class="text-center"><br clear="left"><?php echo $row->nombre ?></td>
					<td class="text-center"><br clear="left"><?php echo $row->color ?></td>
					<td class="text-center"><br clear="left"><?php echo $row->medida ?></td>
					<td class="text-center"><br clear="left">$ <?php echo number_format($row->precio,2) ?></td>
					<td class="table-crud-options"><br clear="left">
						<div class="btn-group">
							<a href="/<? echo $class;?>/detalle/<?php echo $row->id; ?>" class="btn btn-default" title="detalles" data-toggle="modal" data-target="#detalle-<?php echo $row->id; ?>"><i class="fa fa-info-circle"></i></a>
							<a href="/<? echo $class;?>/images/<?php echo $row->id; ?>" class="btn btn-default" title="fotos"><i class="fa fa-picture-o"></i></a>
							<a href="/<? echo $class;?>/editar/<?php echo $row->id; ?>" class="btn btn-default" title="editar"><i class="icon-pencil"></i></a>
							<a href="/<? echo $class;?>/eliminar/<?php echo $row->id; ?>" class="btn btn-danger" title="eliminar"><i class="icon-trash"></i></a>
						</div>
					</td>
				</tr>
				<div id="detalle-<?php echo $row->id; ?>" class="modal fade"></div>
				<?php endforeach ?>
			<?php else: ?>
				<tr>
					<td class="text-center" colspan="7">No se encontraron resultados.</td>
				</tr>
			<?php endif ?>
			</tbody>
		</table>
	</div>
</form>