<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Direccion_Ip extends MY_Model {

	protected $_table = 'direcciones_ip';
	protected $_id    = 'ip';

	public function __construct()
	{
		parent::__construct();
	}

	public function intento($ip = '')
	{
		if (empty($ip)) {
			$ip = $this->input->ip_address();
		}

		$data = array();
		$data['bloqueo'] = date("Y-m-d H:i:s");
		$query = $this->db->where('ip', $ip)->limit(1)->get($this->_table);

		if ($query->num_rows() == 1) {
			$row = $query->row();
			$data['intentos'] = $row->intentos + 1;			
			$this->update($data, $ip);

			return $data['intentos'];
		} else {
			$data['intentos'] = 1;
			$data['ip'] = $ip;
			$this->insert($data);

			return 1;
		}
	}

	public function clean()
	{
		$this->db->where("TIMEDIFF(CURRENT_TIMESTAMP, bloqueo) > '00:30:00'", NULL, FALSE);
		$this->db->delete($this->_table);
	}

	public function validar($ip = '')
	{
		if (empty($ip)) {
			$ip = $this->input->ip_address();
		}

		$this->clean();
		$query = $this->db->where('ip', $ip)->limit(1)->get($this->_table);
		$row   = $query->row();

		if ($query->num_rows() == 0 || $row->intentos < 3) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

}

/* End of file direccion_ip.php */
/* Location: ./application/models/direccion_ip.php */