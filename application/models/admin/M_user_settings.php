<?php
class M_user_settings extends CI_Model{
	public function get_user(){
		$data = $this->db->query("select * from user");
		return $data->result();
	}

	public function log_login($uid){
		$data = $this->db->query("
			SELECT
				MAX(lg.date_time) as date_time,
				lg.user_id,
				u.username
			FROM
				`log_login` lg
			join `user` u on u.user_id = lg.user_id 
			WHERE
				lg.user_id = '".$uid."'
			");
		return $data->result();
	}

	public function change_password($id, $new){
		$this->db->query("update user set password = '".$new."' where username = '".$id."' ");
	}
}
?>