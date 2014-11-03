<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends MY_Model {

	private   $salt_length = 10;
	protected $_id         = 'id';
	protected $pre_insert  = array('procesar_password', 'datetime_creado');
	protected $pre_update  = array('procesar_password', 'datetime_modificado');
	protected $field_names = array('nombre', 'apellidos', 'usuario', 'pass', 'activo', 'tipo', 'creado', 'modificado', 'acceso', 'correo');

	public function __construct()
	{
		parent::__construct();		
	}

	private function salt()
	{
		return substr(md5(uniqid(rand(), TRUE)), 0, $this->salt_length);
	}

	private function hash_password($password)
	{
		if (empty($password)){
			return '';
		}

		$salt = $this->salt();
		return $salt . substr(sha1($salt . $password), 0, -$this->salt_length);
	}

	private function to_hash($password, $almacenado)
	{
		if(!empty($password) AND !empty($almacenado)){
			$salt = substr($almacenado, 0, $this->salt_length);
			return $salt . substr(sha1($salt . $password), 0, -$this->salt_length);
		}else{
			return FALSE;
		}
	}

	public function auth($usuario, $pass)
	{
		if (!empty($usuario) && !empty($pass)) {
			$this->load->model('direccion_ip');
			$query = $this->db->where('usuario', $usuario)->where('activo', 1)->limit(1)->get($this->_table);
			if ($query->num_rows() == 1) {
				$datos = $query->row();
				$guardado = $this->to_hash($pass, $datos->pass);

				if ($datos->pass == $guardado) {
					$this->direccion_ip->delete($this->input->ip_address());
					return $datos;
				} else {
					$this->direccion_ip->intento();
				}
			}
		}

		return FALSE;
	}

	public function comparar_password($pass, $id)
	{
		if (!empty($pass) && !empty($id)) {
			$dato = $this->db->select('pass')->where('id', $id)->get($this->_table, 1)->row();
			$hashed = $this->to_hash($pass, $dato->pass);
			if ($dato->pass == $hashed) {
				return TRUE;
			}
		}

		return FALSE;
	}

	public function procesar_password($datos)
	{
		if(isset($datos['pass'])){
			$datos['pass'] = $this->hash_password($datos['pass']);
		}

		if (empty($datos['pass'])) {
			unset($datos['pass']);
		}

		return $datos;
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

	public function por_usuario($usuario)
	{
		return $this->db->where('usuario', $usuario)->get($this->_table, 1);
	}

	public function busqueda($buscar = '', $offset = 0, $limit = 15)
	{
		$this->db->select('SQL_CALC_FOUND_ROWS id, nombre, apellidos, usuario, tipo, activo, creado, modificado', FALSE);

		if (!empty($buscar)) {
			$this->db->like("CONCAT(nombre, ' ', apellidos)", $buscar, 'both', FALSE);
		}

		$this->db->order_by('nombre, apellidos', 'ASC');
		$limit  = (is_numeric($limit)) ? $limit:15;

		if ($limit != 0) {
			$offset = (is_numeric($offset)) ? $offset:0;
			$this->db->limit($limit, $offset);
		}

		return $this->db->get($this->_table);
	}

	public function update_acceso($id)
	{
		$this->db->set('acceso', date('Y-m-d H:i:s'))->where('id', $id)->update($this->_table);
	}

}

/* End of file usuario.php */
/* Location: ./application/models/usuario.php */