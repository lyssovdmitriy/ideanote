<?
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->dbs = new DataBase();
	}

	public function index()
	{
		$this->load->view('login/login');
	}

	public function out(){
		$this->session->unset_userdata('user_id');
		redirect('/login');
	}

	public function auth()
	{
		$id = $this->dbs->auth();
		if ($id) {
			$this->session->user_id = $id;
			redirect('/');
		} else {
			H::setMsg('Неверный логин или пароль','danger');
			redirect('/login');
		}
	}



}
