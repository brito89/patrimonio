<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Create_Producto extends CI_Migration {
	
	public function up()
	{
		$fields = array(
				"`id` int(11) NOT NULL AUTO_INCREMENT",
				"`nombre` varchar(200) NOT NULL",
				"`descripcion` text NOT NULL",
				"`descripcion_breve` text NOT NULL",
				"`color` varchar(70) NOT NULL",
				"`medida` varchar(70) NOT NULL",
				"`material` varchar(150) NOT NULL",
				"`precio` float(10,2) NOT NULL",
				"`idCategoria` int(11) NOT NULL",
				"`idSubcategoria` int(11) NOT NULL",
				"`visible` varchar(2) NOT NULL DEFAULT '1'",
				"`creado` datetime NOT NULL",
				"`modificado` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'"
				);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('productos', TRUE);
		$this->db->simple_query('ALTER TABLE  `productos` DEFAULT CHARSET=utf8');

		$fields = array(
			"`id` bigint(20) NOT NULL AUTO_INCREMENT",
			"`original` varchar(250) NOT NULL DEFAULT ''",
			"`mediana` varchar(250) NOT NULL DEFAULT ''",
			"`chica` varchar(250) NOT NULL",
			"`tipoImagen` int(2) NOT NULL",
			"`idProducto` int(12) NOT NULL",
			);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('imagen_producto', TRUE);
		$this->db->simple_query('ALTER TABLE  `imagen_producto` DEFAULT CHARSET=utf8');

		
	}

	public function down()
	{
		$this->dbforge->drop_table('productos');
		$this->dbforge->drop_table('imagen_producto');
	}
}

/* End of file 003-create-categoria.php */
/* Location: ./application/migrations/003_create_categoria.php */