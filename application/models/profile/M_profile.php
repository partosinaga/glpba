<?php
class M_profile extends CI_Model{
	public function view_profile($user){
		$data = $this->db->query("select * from user where user_id ='".$user."'  ");
		return $data->result();
	}
}
?>