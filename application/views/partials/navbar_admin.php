<?php

$active = $this->uri->segment(1);

function active($a, $b)
{
	if($a == $b)
	{
		echo 'class="active"';
	}
}
?>
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<?php if ($this->session->userdata('id')): ?>
					<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<?php endif ?>

					<a class="navbar-brand" href="/"><span>Froggy</span></a>
				</div>

				<?php if ($this->session->userdata('id')): ?>				
				<div class="collapse navbar-collapse navbar-ex1-collapse">					
					<ul class="nav navbar-nav">
						<li <? active('banners', $active)?>><a href="/banners">Banner</a></li>
						<li <? active('productos', $active)?>><a href="/productos">Productos</a></li>
						<li <? active('categorias', $active)?>><a href="/categorias">Categorías</a></li>
						<li <? active('usuarios', $active)?>><a href="/usuarios">Usuarios</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="/usuarios/logout"><i class="fa fa-power-off"></i>Salir</a></li>
					</ul>
				</div>
				<?php endif?>
			</div>
		</nav>
