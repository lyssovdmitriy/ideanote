<?
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->dbs = new DataBase();
		$this->load->library('session');
		$array_items = array( 'user_id' ,  'current_note_id','pad_id', 'parent_id','note_id' );
		$this->session->unset_userdata($array_items);
	}

	public function index()
	{
		$this->load->view('login/login');
	}

	public function out(){
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

	public function registration(){
		$this->session->unset_userdata('user_id','current_note_id','pad_id');
		$this->load->view('login/registration');
	}


	public function valid_login($login){
		$ret = $this->dbs->validLogin($login);
		if (!$ret) {
			echo "false";
		}
	}

	public function registration_do(){
		$ret = $this->dbs->newUser();
		if ($ret) {
			H::setMsg('Войдите используя свой логин и пароль','success');
			redirect('/login');
		} else {
			H::setMsg('Произошла ошибка попробуйте еще раз','danger');			
			redirect('/login/registration');
		}
	}

}
