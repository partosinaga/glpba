<?php
class M_contact extends CI_Model{


	public function add($data,$table){
		$this->db->insert($table,$data);
	}
	public function get_data(){
		$data = $this->db->query("SELECT * FROM contact");
		return $data->result();
	}

	public function get_edit($id){
		$data = $this->db->query("SELECT * FROM contact WHERE contact_id ='".$id."' ");
		return $data->result();
	}


	public function save_edit($debtor_id, $name, $address, $contact, $is_debtor, $is_creditor){
		$this->db->query("
		UPDATE contact
		SET
		 `name`= '".$name."',
		address = '".$address."',
		contact = '".$contact."',
		is_debtor = '".$is_debtor."',
		is_creditor = '".$is_creditor."'
		WHERE
			contact_id = '".$debtor_id."'
		");
	}
}
?>