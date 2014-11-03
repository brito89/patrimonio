
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 class="modal-title">Detalle de Usuario</h3>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-sm-12 span-underlined">
					<span class="text-label">Nombre</span>
					<?php echo $nombre.' '.$apellidos ?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6 span-underlined">
					<span class="text-label">Usuario</span>
					<?php echo $usuario ?>
				</div>
				<div class="col-sm-6 span-underlined">
					<span class="text-label">Correo</span>
					<?php echo $correo ?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6 span-underlined">
					<span class="text-label">Estado</span>
					<?php echo ($activo == 1) ? 'Activo':'Suspendido' ?>
				</div>
				<div class="col-sm-6 span-underlined">
					<span class="text-label">Tipo</span>
					<?php echo ($activo == 1) ? 'Usuario':'Administrador' ?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6 span-underlined-last">
					<span class="text-label">Creado</span>
					<?php echo $creado ?>
				</div>
				<div class="col-sm-6">
					<span class="text-label">Último Acceso</span>
					<?php echo ($acceso == '0000-00-00 00:00:00') ? 'No ha iniciado sesión':$acceso ?>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cerrar</button>
		</div>
	</div>
</div>