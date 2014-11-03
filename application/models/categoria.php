<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categoria extends MY_Model {

	protected $_id         = 'id';
	protected $pre_insert  = array('datetime_creado');
	protected $pre_update  = array('datetime_modificado');
	protected $field_names = array('nombre', 'visible', 'creado', 'modificado');

	public function __construct()
	{
		parent::__construct();		
	}
	
	public function datetime_creado($datos)
	{
		$datos['creado'] = date('Y-m-d H:i:s');
		return $datos;
	}

	public function datetime_modificado($datos)
	{
		$datos['modificado'] = date('Y-m-d H:i:s');
		return $datos;
	}

}

/* End of file categoria.php */
/* Location: ./application/models/categoria.php */