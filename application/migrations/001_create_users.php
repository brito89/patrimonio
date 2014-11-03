<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Create_Users extends CI_Migration {
	
	public function up()
	{
		$fields = array(
				"`id` int(11) NOT NULL AUTO_INCREMENT",
				"`razon_social` varchar(200) NOT NULL",
				"`rfc` varchar(15) NOT NULL",
				"`nombre` varchar(150) NOT NULL DEFAULT ''"	,
				"`apellidos` varchar(150) NOT NULL DEFAULT ''",
				"`direccion` varchar(200) NOT NULL",
				"`usuario` varchar(50) NOT NULL",
				"`pass` varchar(100) NOT NULL",
				"`correo` varchar(50) NOT NULL",
				"`recomendado_por` varchar(200) NOT NULL",
				"`pago_mensual` varchar(50) NOT NULL",
				"`activo` int(1) NOT NULL DEFAULT '0'",
				"`activoPago` int(1) NOT NULL DEFAULT '0'",
				"`tipo` int(1) NOT NULL DEFAULT '1'",
				"`fecha_limite` int(3) NOT NULL",
				"`creado` datetime NOT NULL",
				"`modificado` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'",
				"`acceso` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'"
				);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('usuarios', TRUE);
		$this->db->simple_query('ALTER TABLE  `usuarios` DEFAULT CHARSET=utf8');
		$this->db->simple_query("INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `usuario`, `pass`, `correo`, `activo`, `tipo`, `creado`) VALUES (1, 'Administrador', 'Sistema', 'admin', '09ae22c2c195d71cca64d461a1603332efb073d9', 'admin@fnyasociados.com', 1, 0, CURRENT_TIMESTAMP)");

		$fields = array(
				"`ip` varchar(20) NOT NULL",
				"`intentos` tinyint(1) NOT NULL",
				"`bloqueo` datetime NOT NULL",
				);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('ip', TRUE);
		$this->dbforge->create_table('direcciones_ip', TRUE);
		$this->db->simple_query('ALTER TABLE  `direcciones_ip` ENGINE=MyISAM DEFAULT CHARSET=utf8');

		$fields = array(
				"`session_id` varchar(40) NOT NULL DEFAULT '0'",
				"`ip_address` varchar(45) NOT NULL DEFAULT '0'",
				"`user_agent` varchar(120) NOT NULL",
				"`last_activity` int(10) unsigned NOT NULL DEFAULT '0'",
				"`user_data` text NOT NULL"
				);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('session_id', TRUE);
		$this->dbforge->add_key('last_activity');
		$this->dbforge->create_table('ci_sessions', TRUE);
		$this->db->simple_query('ALTER TABLE  `ci_sessions` ENGINE=MyISAM DEFAULT CHARSET=utf8');
	}

	public function down()
	{
		$this->dbforge->drop_table('users');
		$this->dbforge->drop_table('direcciones_ip');
		$this->dbforge->drop_table('ci_sessions');
	}

}

/* End of file 001-create-users.php */
/* Location: ./application/migrations/001_create_users.php */