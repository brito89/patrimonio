<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Create_Banner extends CI_Migration {
	
	public function up()
	{
		$fields = array(
				"`id` bigint(20) NOT NULL AUTO_INCREMENT",
				"`original` varchar(250) NOT NULL DEFAULT ''",
				"`tipoImagen` int(2) NOT NULL",
				);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('banner', TRUE);
		$this->db->simple_query('ALTER TABLE  `banner` DEFAULT CHARSET=utf8');
		
	}

	public function down()
	{
		$this->dbforge->drop_table('banner');
	}
}

/* End of file 004-create-banner.php */
/* Location: ./application/migrations/004_create_banner.php */