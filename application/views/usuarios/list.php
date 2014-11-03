
<?php if (!empty($msg_success)): ?>
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">x</button>
		<?php echo $msg_success; ?>
	</div>
<?php endif ?>

<h2 class="col-12">Usuarios</h2>

<form action="<?php echo (isset($form_action)) ? $form_action:''?>" id="consulta" method="post">

	<div class="input-group col-sm-6 col-12 search-block">
		<input type="text" name="buscar" placeholder="buscar" value="<?php echo $buscar ?>" class="form-control">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-default"><i class="icon-search"></i></button>
		<?php if (!empty($buscar)): ?>
			<a href="/usuarios" class="btn btn-default"><i class="icon-undo"></i></a>
		<?php endif ?>

		</span>
	</div>			
	
	<div class="col-sm-6 col-12 search-block">
		<a href="./usuarios/nuevo" class="btn btn-success"><i class="icon-plus"></i> Agregar Usuario</a>
	</div>

	<div class="col-12">
		<table class="table table-striped table-crud">
			<thead>
				<tr>
					<th width="1%">#</th>
					<th class="hidden-sm">Nombre</th>
					<th class="hidden-sm">Apellidos</th>
					<th>Usuario</th>
					<th>Estado</th>
					<th class="visible-lg">Creado</th>
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
					<td><input type="checkbox" name="del[]" value="<?php echo $row->id; ?>"<?php echo ($row->id == 1 || $row->usuario == 'admin') ? ' disabled':'' ?>></td>
					<td class="hidden-sm text-center"><?php echo $row->nombre ?></td>
					<td class="hidden-sm text-center"><?php echo $row->apellidos ?></td>
					<td class="text-center"><?php echo $row->usuario ?></td>
					<td class="text-center"><?php echo ($row->activo == 1) ? 'Activo':'Suspendido' ?></td>
					<td class="text-center visible-lg"><?php echo $row->creado ?></td>
					<td class="table-crud-options">
						<div class="btn-group">
							<a href="./usuarios/detalle/<?php echo $row->id; ?>" class="btn btn-default" title="detalles" data-toggle="modal" data-target="#detalle-usuario<?php echo $row->id; ?>"><i class="icon-user"></i></a>
							<a href="/usuarios/editar/<?php echo $row->id; ?>" class="btn btn-default" title="editar"><i class="icon-pencil"></i></a>
							<a href="/usuarios/eliminar/<?php echo $row->id; ?>" class="btn btn-danger<?php echo ($row->id == 1 || $row->usuario == 'admin') ? ' disabled':'' ?>" title="eliminar"><i class="icon-trash"></i></a>
						</div>
					</td>
				</tr>
				<div id="detalle-usuario<?php echo $row->id; ?>" class="modal fade"></div>
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