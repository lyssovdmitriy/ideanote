<?php 
	/**
	* 
	*/
	class DataBase extends CI_Model
	{
		
		function __construct(){
			parent::__construct();
			$this->load->library('session');
			$this->load->database();
		}

		private function updateLastNote($id)
		{
			$user_id = $this->session->user_id;
			$ret_ar = $this->db->query('SELECT * FROM last_note WHERE user_id = ? LIMIT 1',array($user_id))->row_array();
			if (is_array($ret_ar)) {
				$this->db->query('UPDATE last_note SET note_id = ? WHERE user_id = ? LIMIT 1',array($id,$user_id));
			} else {
				$ar_insert = array(
					'user_id' => $user_id,
					'note_id' => $id,
					);
				$this->db->insert('last_note',$ar_insert);
			}
		}

		private function getLastNote()
		{
			$user_id = $this->session->user_id;
			$ret_ar = $this->db->query('SELECT * FROM last_note WHERE user_id = ? LIMIT 1',array($user_id))->row_array();
			if (is_array($ret_ar)) {
				return $ret_ar['note_id'];
			} 
		}

		public function getNote($id)
		{
			if (is_numeric($id)) {
				$ar_note = $this->db->query('SELECT * FROM notes WHERE id = ? LIMIT 1',array($id))->row_array();
				if (is_array($ar_note)) {
					$this->updateLastNote($id);
					return $ar_note;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}

		public function saveNote()
		{
			$user_id = $this->getUserID();
			if (isset($_POST)&&!empty($_POST)) {
				$ar_data = $this->session->get_userdata();
				if (isset($this->session->current_note_id)) { // обновить запись
					$this->db->query('UPDATE notes SET parent_id = ?, pad_id = ?, title = ?, text = ? WHERE id = ?',
						array(
							$ar_data['parent_id'],
							$ar_data['pad_id'],
							$_POST['title'],
							$_POST['text'],
							$ar_data['current_note_id'],
							));
					return $ar_data['current_note_id'];
				} else { //создать новую запись
					$ar_insert = array(
						'parent_id' => 0,
						'user_id' => $user_id,
						'pad_id' => $ar_data['pad_id'],
						'title' => 	$_POST['title'],
						'text' =>	$_POST['text'],
						'datetime' => date('Y-m-d h:m:s'),
						);
					$this->db->insert('notes',$ar_insert);
					$id = $this->db->insert_id();
					return $id;
				}
			}
		}

		public function auth()
		{
			$ar_user = $this->db->query('SELECT * FROM user WHERE login = ? AND password = ? LIMIT 1',
				array($_POST['login'],md5($_POST['password'])))->row_array();
			if (is_array($ar_user)) {
				return $ar_user['id'];
			} else {
				return false;
			}
		}

		public function getPads()
		{
			$user_id = $this->getUserID();
			if ($user_id) {
				$ar_pads = $this->db->query("SELECT * FROM pad WHERE user_id = ?", array($user_id))->result_array();
				if (is_array($ar_pads)) {
					return $ar_pads;
				}
			}
			return false;
		}

		public function getNotes($pad_id)
		{
			$user_id = $this->getUserID();
			if ($user_id) {
				$ar_notes = $this->db->query("SELECT * FROM notes WHERE pad_id = ? AND user_id = ?", array($pad_id, $user_id))->result_array();
				if (is_array($ar_notes)) {
					return $ar_notes;
				}
			}
			return false;
		}

		private function getUserID()
		{
			if (isset($this->session->user_id)&&is_numeric($this->session->user_id)) {
				return $this->session->user_id;
			} else {
				echo "need_login";
				exit;
				return false;
			}
		}


		public function deleteNote($id){
			$user_id = $this->getUserID();
			$this->db->query('DELETE FROM notes WHERE id = ? AND user_id = ? LIMIT 1',array($id,$user_id));
		}


		public function newPad()
		{
			if(!empty($_REQUEST['title'])){
				$ses = $this->session->get_userdata();
				$ar_insert = array(
					'user_id' => $ses['user_id'],
					'title' => $_REQUEST['title'],
					'content' => $_REQUEST['content'],
					);
				$this->db->insert('pad',$ar_insert);
				$pad_id = $this->db->insert_id();

				$ar_insert = array(
						'parent_id' => 0,
						'user_id' => $ses['user_id'],
						'pad_id' => $pad_id,
						'title' => 	'Новая заметка',
						'text' =>	"# Привет :)",
						'datetime' => date('Y-m-d h:m:s'),
						);
					$this->db->insert('notes',$ar_insert);
					$note_id = $this->db->insert_id();
				return array('pad'=>$pad_id,'note'=>$note_id);
			}


		}


	}
 ?>