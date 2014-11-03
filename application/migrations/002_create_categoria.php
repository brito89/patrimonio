<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Create_Categoria extends CI_Migration {
	
	public function up()
	{
		$fields = array(
				"`id` int(11) NOT NULL AUTO_INCREMENT",
				"`nombre` varchar(200) NOT NULL",
				"`visible` varchar(150) NOT NULL DEFAULT '1'",
				"`creado` datetime NOT NULL",
				"`modificado` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'"
				);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('categorias', TRUE);
		$this->db->simple_query('ALTER TABLE  `categorias` DEFAULT CHARSET=utf8');

		$fields = array(
				"`id` int(11) NOT NULL AUTO_INCREMENT",
				"`nombre` varchar(200) NOT NULL",
				"`visible` varchar(150) NOT NULL DEFAULT '1'",
				"`creado` datetime NOT NULL",
				"`modificado` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'",
				"`nivel` int(11) NOT NULL DEFAULT '1'",
				"`idCategoria` int(11) NOT NULL",
				);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('subcategorias', TRUE);
		$this->db->simple_query('ALTER TABLE  `subcategorias` DEFAULT CHARSET=utf8');
		
	}

	public function down()
	{
		$this->dbforge->drop_table('categorias');
		$this->dbforge->drop_table('subcategorias');
	}
}

/* End of file 002-create-categoria.php */
/* Location: ./application/migrations/002_create_categoria.php */