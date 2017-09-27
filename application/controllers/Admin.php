<?
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->dbs = new DataBase();
		$this->load->library('session');
		if(!$this->dbs->isAdmin()){
			redirect('/');
		}
	}

	public function index()
	{
		$data['user'] = $this->dbs->getUser();
		$data['users'] = $this->dbs->getUsers();
		$this->load->view('admin/header.php',$data);
		$this->load->view('admin/index.php',$data);
		$this->load->view('admin/footer.php',$data);
	}

	public function pads($id){
		$ar_pads = $this->dbs->getPadsByUserID($id);
		$data['pads'] = $ar_pads;
		$this->load->view('admin/header.php',$data);
		$this->load->view('admin/pads.php',$data);
		$this->load->view('admin/footer.php',$data);
	}

	public function notes($pad_id){
		$ar_notes = $this->dbs->getNotesByPadID($pad_id);
		$data['ar_notes'] = $ar_notes;
		$this->load->view('admin/header.php',$data);
		$this->load->view('admin/notes.php',$data);
		$this->load->view('admin/footer.php',$data);
	}

	public function note($note_id){
		$ar_note = $this->dbs->getNoteByID($note_id);
		$data['ar_note'] = $ar_note;
		$this->load->view('admin/header.php',$data);
		$this->load->view('admin/note.php',$data);
		$this->load->view('admin/footer.php',$data);
	}


}
