<?
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

	public function __construct()
	{
	 	parent::__construct();
		$this->load->library('parsedown');
		$this->load->library('session');
		$this->load->model('database');
		$this->load->helper('url');
		$this->dbs = new DataBase();
		if (!isset($this->session->user_id)) {
			redirect('/login');
		}
	}

	public function editor($new = false)
	{
		if ($new == 'new') {
			$this->session->unset_userdata('current_note_id');
		  $this->load->view('ajax/editor');			
		  return;
		}
		if (!$this->session->current_note_id) {
			echo "выберите запись или создайте новую";
			return;
		}
		$id = $this->session->current_note_id;
		$ret = $this->dbs->getNote($id);
		if ($ret) {		
			$data['note'] = $ret;
		} else {
			echo "выберите запись или создайте новую";
			return;
		}
	  $this->load->view('ajax/editor', $data);
	}

	public function note($id = false){
		if (is_numeric($id)) {
			$this->session->current_note_id = $id;
		} 
		if(!isset($this->session->current_note_id)){
			$id = $this->dbs->getLastNote();
		}
		$ret = $this->dbs->getNote($this->session->current_note_id);
		if ($ret) {		
			$this->session->pad_id = $ret['pad_id'];
			$this->session->parent_id = $ret['parent_id'];
			$parsedown = new Parsedown();	
			$ret['text'] = $parsedown->text($ret['text']);
			$data['note'] = $ret;
		} else {
			echo "выберите запись или создайте новую";
			return;
		}
	  $this->load->view('ajax/note', $data);
	}

	public function save(){
		$id = $this->dbs->saveNote();
		redirect('/ajax/note/'.$id);
		// $ret = $this->dbs->getNote($id);
		// if ($ret) {		
		// 	$this->session->current_note_id = $ret['id'];
		// 	$this->session->pad_id = $ret['pad_id'];
		// 	$this->session->parent_id = $ret['parent_id'];
		// 	$parsedown = new Parsedown();	
		// 	$ret['text'] = $parsedown->text($ret['text']);
		// 	$data['note'] = $ret;
		// } else {
		// 	echo "нет такого";
		// }
	 //  $this->load->view('ajax/note', $data);
	}


	public function getpads(){
		if ($ar_pad = $this->dbs->getPads()) {
			$data['pads'] = $ar_pad;
			$data['cur_pad_id'] = $this->session->pad_id;
			$this->load->view('templates/pad_menu',$data);
		}
	}

	public function getnotes($id = false){
		if(!$id){
			$id = $this->session->pad_id;
		}
		$ar_notes = $this->dbs->getNotes($id);
		if (!is_array($ar_notes)) {
			$this->dbs->setValidCurrentPad();
			$id = $this->session->pad_id;			
			$ar_notes = $this->dbs->getNotes($id);
		}
		$this->session->pad_id = $id;
		$this->session->current_note_id = $ar_notes[0]['id'];
		$data['notes'] = $ar_notes;
		$data['cur_note_id'] = $this->session->current_note_id;
		$this->load->view('templates/notes_menu',$data);
	}

	public function delete(){
			$this->dbs->deleteNote($this->session->current_note_id);
	}

	public function newpad()
	{
		$this->load->view('templates/new_pad');
	}


	public function editpad($id)
	{
		$data['pad'] = $this->dbs->getPad($id);
		$this->load->view('templates/edit_pad',$data);
	}


	public function makenewpad(){
		$ar_id = $this->dbs->newPad();
		if(is_numeric($ar_id['pad'])){
			$this->session->pad_id = $ar_id['pad'];
			$this->session->note_id = $ar_id['note'];
		}
	}

	public function deletepad($id)
	{
		if(is_numeric($id)){
			$this->dbs->deletePad($id);
			$this->dbs->setValidCurrentPad();
		}
	}


	public function savepad(){
		$this->dbs->savePad();
	}

}
