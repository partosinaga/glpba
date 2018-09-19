<?php

class M_cashflow extends CI_Model
{
    public function get_detail_category(){
        $data = $this->db->query("
            SELECT
              sc.id_subcategory,
              sc.`name`,
              dc.id_detail,
              dc.account,
              c.report_type,
              dc.id_report,
              c.subgroup
            FROM
              detail_category dc
              JOIN coa c ON dc.id_detail = c.cashflow
              JOIN subcategory sc ON sc.id_subcategory = dc.id_subcategory
            WHERE
              dc.id_report = 3
            GROUP BY
              id_detail
            ORDER BY
	            dc.is_cf ASC
        ");
        return $data->result();
    }
    public function get_monthly($date){
        $data = $this->db->query(" CALL p_cf_monthly ('".$date."' ) ");
        mysqli_next_result( $this->db->conn_id );
        return $data->result();

    }
    public function get_monthly_prev($date_from){
        $data = $this->db->query(" CALL p_cf_prev_monthly ( '".$date_from."' ) ");
        mysqli_next_result( $this->db->conn_id );
        return $data->result();

    }

    public function get_total($yearStart, $date){
        $data = $this->db->query(" call p_cf_total('".$yearStart."' , '".$date."') ");
        mysqli_next_result( $this->db->conn_id );
        return $data->result();

    }
    public function get_total_prev($prevYearStart){
        $data = $this->db->query(" call p_cf_total_prev('".$prevYearStart."') ");
        mysqli_next_result( $this->db->conn_id );
        return $data->result();

    }
    public function get_coa($id_detail){
        $data = $this->db->query("SELECT c.cashflow, c.coa_id, c.name_coa FROM coa c WHERE c.cashflow = '".$id_detail."' ");
        return $data->result();
    }
    public function get_current_month($date_to,$id_detail){
        $data = $this->db->query(" call breakdown_monthly ('".$date_to."', '".$id_detail."') ");
        mysqli_next_result( $this->db->conn_id );
        return $data->result();

    }
    public function get_prev_month($date_from,$id_detail){
        $data = $this->db->query(" call breakdown_monthly_prev ('".$date_from."', '".$id_detail."') ");
        mysqli_next_result( $this->db->conn_id );
        return $data->result();

    }

    public function get_breakdown_annual($yearStart, $date, $id_detail){
        $data = $this->db->query(" call breakdown_annual ('".$yearStart."', '".$date."', '".$id_detail."') ");
        mysqli_next_result( $this->db->conn_id );
        return $data->result();

    }
    public function get_breakdown_annual_prev($prevYearStar, $prevYearEnd, $id_detail){
        $data = $this->db->query(" call breakdown_annual_prev ('".$prevYearStar."', '".$prevYearEnd."', '".$id_detail."') ");
        mysqli_next_result( $this->db->conn_id );
        return $data->result();
    }

    public function get_breakdown_total($yearStart, $date_to, $id_detail){
        $data = $this->db->query(" call breakdown_total ('".$yearStart."','".$date_to."', '".$id_detail."') ");
        mysqli_next_result( $this->db->conn_id );
        return $data->result();
    }
    public function get_breakdown_total_prev($prevYearStart, $id_detail){
        $data = $this->db->query(" call breakdown_total_prev ('".$prevYearStart."', '".$id_detail."') ");
        mysqli_next_result( $this->db->conn_id );
        return $data->result();
    }

    public function get_cash_bank($date_from){
    $data = $this->db->query("
            SELECT
              sum( cs.saldo ) AS begining
            FROM
              closed_saldo cs
              JOIN coa c ON c.coa_id = cs.coa_id
              JOIN detail_category dc ON dc.id_detail = c.id_detail
              JOIN subcategory sc ON sc.id_subcategory = dc.id_subcategory
              JOIN category ctg ON ctg.id_category = dc.id_category
            WHERE
              cs.date <= '".$date_from."' - INTERVAL 1 DAY
              AND cs.state IS NULL
              AND dc.id_detail = (SELECT min(id_detail) from detail_category)
            GROUP BY
              dc.id_detail
        ");
    return $data->row();
    }
    public function get_cash_bank_ytd($date){
        $data = $this->db->query("
            SELECT
              sum( cs.saldo ) AS begining_ytd
            FROM
              closed_saldo cs
              JOIN coa c ON c.coa_id = cs.coa_id
              JOIN detail_category dc ON dc.id_detail = c.id_detail
              JOIN subcategory sc ON sc.id_subcategory = dc.id_subcategory
              JOIN category ctg ON ctg.id_category = dc.id_category
            WHERE
              cs.date <= '".$date."'
              AND cs.state IS NULL
              AND dc.id_detail = (SELECT min(id_detail) from detail_category)
            GROUP BY
              dc.id_detail
        ");
        return $data->row();
    }
}

