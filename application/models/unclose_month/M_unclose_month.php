<?php
class M_unclose_month extends CI_Model{

	public function unclose_month(){
		$data = $this->db->query(" select DISTINCT(month(gl_header.gl_date)) as month, year(gl_header.gl_date) as year
			from gl_header
			where Fclose = 'close'
			ORDER BY year(gl_header.gl_date)");
		return $data->result();
	}

	public function get_last(){
		$data = $this->db->query("
			SELECT DISTINCT
				max(gl_date) as last_date
			FROM
				gl_header 
			WHERE
				Fclose = 'close' 
			ORDER BY
				YEAR ( gl_header.gl_date )
			");
		return $data->row();
	}

	public function delete_closed_saldo($month, $year){
		$this->db->query("
			DELETE FROM closed_saldo where MONTH(date) = '".$month."' AND YEAR(date) = '".$year."'
			");
	}
	public function update_ar($month, $year){
		$this->db->query("
			UPDATE ar_header set Fmonth = NULL where MONTH(gl_date) = '".$month."' AND YEAR(gl_date) = '".$year."'
			");
	}
	public function update_ap($month, $year){
		$this->db->query("
			UPDATE ap_header set Fmonth = NULL where MONTH(gl_date) = '".$month."' AND YEAR(gl_date) = '".$year."'
			");
	}
	public function update_jv($month, $year){
		$this->db->query("
			UPDATE jv_header set Fmonth = NULL where MONTH(gl_date) = '".$month."' AND YEAR(gl_date) = '".$year."'
			");
	}
	public function update_Fclose($month, $year){
		$this->db->query("
			UPDATE gl_header set Fclose = NULL where MONTH(gl_date) = '".$month."' AND YEAR(gl_date) = '".$year."'
			");
	}
	
	

	

}
?>