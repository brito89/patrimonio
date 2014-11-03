

<form action="" class="row-fluid form-login" method="post">
	<h2 class="col-12 text-center clearfix"><i class="icon-lock"></i> Autenticación</h2>

	<?php if (isset($error)): ?>
	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert">x</button>
		Login incorrecto.
	</div>
	<?php endif ?>

	<div class="col-12">
		<input type="text" name="user" class="form-control" placeholder="usuario" required>
	</div>
	<div class="col-12">
		<input type="password" name="pass" class="form-control" placeholder="contraseña" required>
	</div>
	<div class="col-12">
		<button class="btn btn-dark btn-block">Iniciar</button>
	</div>
	<div class="col-12 text-center">
		<a href="#">¿Olvidaste tu contraseña?</a>
	</div>
</form>
