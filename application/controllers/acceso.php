<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acceso extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->template->render();
		
	}
}

/* End of file acceso.php */
/* Location: ./application/controllers/acceso.php */