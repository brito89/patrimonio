<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Producto extends MY_Model {

	protected $_id    = 'id';
	protected $_table = 'productos';
	protected $pre_insert  = array('datetime_creado');
	protected $pre_update  = array('datetime_modificado');
	protected $field_names = array('idCategoria', 'idSubcategoria','nombre','descripcion', 'descripcion_breve', 'color', 'medida', 'material', 'precio', 'visible', 'creado', 'modificado');

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

	public function busqueda($buscar = '', $offset = 0, $limit = 15, $categoria = '', $subcategoria = '')
	{
		$this->db->select('SQL_CALC_FOUND_ROWS id, nombre, color, medida, precio, visible, descripcion_breve,
			(select nombre from categorias where categorias.id = productos.idCategoria limit 1) as categoria,
			(select nombre from subcategorias where subcategorias.id = productos.idSubcategoria limit 1) as subcategoria,
			(select original from imagen_producto where imagen_producto.idProducto = productos.id limit 1) as foto
			', FALSE);

		if (!empty($buscar)) {
			$this->db->like("CONCAT(nombre)", $buscar, 'both', FALSE);
		}

		if(!empty($categoria))
		{
			$this->db->where('idCategoria', $categoria);
			if(!empty($subcategoria))
			{
				$this->db->where('idSubcategoria', $subcategoria);
			}
		}

		$this->db->order_by('nombre', 'ASC');
		$limit  = (is_numeric($limit)) ? $limit:15;

		if ($limit != 0) {
			$offset = (is_numeric($offset)) ? $offset:0;
			$this->db->limit($limit, $offset);
		}

		return $this->db->get($this->_table);
	}

	public function destacados()
	{
		$this->db->select('SQL_CALC_FOUND_ROWS id, nombre, color, medida, precio, visible, descripcion_breve,
			(select original from imagen_producto where imagen_producto.idProducto = productos.id limit 1) as foto
			', FALSE);

		$this->db->order_by('nombre', 'random');
		
		$this->db->limit(5);

		return $this->db->get($this->_table);
	}
}
/* End of file producto.php */
/* Location: ./application/models/producto.php */