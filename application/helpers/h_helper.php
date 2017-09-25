<?php 
class H
{
	
	public static function setMsg($msg,$type){
		$ar_types = array(
			'primary',
			'seondary',
			'success',
			'danger',
			'warning',
			'info',
			'light',
			'dark',
			);

		if (!in_array($type, $ar_types)) {
			$type = 'info';
		}

		$_SESSION['messages'][] = array('type'=>$type,'msg'=>$msg);		
	}

	public static function getMsg(){
		if (isset($_SESSION['messages'])) {
			$ar_msg = $_SESSION['messages'];
			unset($_SESSION['messages']);
			return $ar_msg;
		} else {
			return false;
		}
	}


}
 ?>