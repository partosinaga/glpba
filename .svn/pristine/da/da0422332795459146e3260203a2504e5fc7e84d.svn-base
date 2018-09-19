<?php
class M_user extends CI_Model{

	function get_user(){
		$data = $this->db->query("select * from user");
		return $data->result();
	}

	function add_user($data,$table){
		$this->db->insert($table,$data);
	}

	public function edit_user($user_id){
		$data = $this->db->query("select * from user where user_id = '".$user_id."' ");
		return $data->result();
	}

	public function save_edit($user_id, $username, $password, $departemen,$arentry,$arpost,$apentry,$appost,$glentry,$glpost,$reportacc,$adminacc){
		$data = $this->db->query(" update user set username = '".$username."' , password = '".$password."' , departemen = '".$departemen."' , AREntry = '".$arentry."' , ARPost = '".$arpost."' , APEntry = '".$apentry."' , APPost = '".$appost."' , GLEntry = '".$glentry."' , GLPost = '".$glpost."' , reportACC = '".$reportacc."' , adminACC = '".$adminacc."' 
			where user_id = '".$user_id."' ");
	
	}
}
?>