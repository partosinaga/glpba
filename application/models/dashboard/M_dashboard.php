<?php
class M_dashboard extends CI_Model{
	public function get_log($user){
		$data = $this->db->query("
			SELECT
				`user`.username,
				log_login.date_time
			FROM
				`log_login`
			JOIN `user` ON `user`.user_id = log_login.user_id
			WHERE
				log_login.user_id = '".$user."'
			ORDER BY
				log_login.id DESC
			LIMIT 1,1;
		 ");
	return $data->row();
	}

	public function add_log($data,$table){
		$this->db->insert($table,$data);
	}
	public function get_ar(){
		$data = $this->db->query("
			SELECT
				COUNT(STATUS) AS t_ar
			FROM
				ar_header
			WHERE
				STATUS = 'post'
			OR STATUS = 'unposted'
		");
	return $data->row();
	}

	public function get_ap(){
		$data = $this->db->query("
			SELECT
				COUNT(STATUS) AS t_ap
			FROM
				ap_header
			WHERE
				STATUS = 'post'
			OR STATUS = 'unposted'
		");
	return $data->row();
	}

	public function get_jv(){
		$data = $this->db->query("
			SELECT
				COUNT(STATUS) AS t_jv
			FROM
				jv_header
			WHERE
				STATUS = 'post'
			OR STATUS = 'unposted'
		");
		return $data->row();
	}
	public function get_current($m, $y){
		$data = $this->db->query("SELECT `date` FROM `closed_saldo` where MONTH(date) = ".$m." AND YEAR(date) = ".$y." ");
		return $data->row();
	}
}
?>