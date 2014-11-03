<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Imagen_Producto extends MY_Model {

	protected $_id    = 'id';
	protected $_table = 'imagen_producto';
	protected $field_names = array('idProducto','tipoImagen','chica','mediana', 'original');

	public function __construct()
	{
		parent::__construct();
	}

}
/* End of file imagen_promocion.php */
/* Location: ./application/models/imagen_promocion.php */