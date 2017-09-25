<?
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
	 	parent::__construct();
		$ret = $this->load->helper('client_helper');
		$Client = new Client();
		if ($Client->check_mobile_device()) {
			// echo "mobile";
		} else {
			// echo "browser";
		}

		if (!isset($this->session->user_id)) {
			redirect('/login');
		}

	}

	public function index()
	{
		$menu = 'menu';
		$data['sidebar'] = 'menu left';
		$data['title'] = 'IDEANOTE';
	    
		$this->load->view('templates/header', $data);
	  $this->load->view('index', $data);
	  $this->load->view('templates/footer', $data);
	}

}
