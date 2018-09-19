<?php

class M_balance_sheetv2 extends CI_Model
{
    public function get_account()
    {
        $data = $this->db->query("
            SELECT
              dc.id_detail,
              ctg.id_category,
              ctg.account AS ctg_caption,
              sc.id_subcategory,
              sc.`name` AS subcategory,
              dc.account
            FROM
              coa c
              JOIN detail_category dc ON dc.id_detail = c.id_detail
              JOIN subcategory sc ON sc.id_subcategory = dc.id_subcategory
              JOIN category ctg ON ctg.id_category = dc.id_category
            WHERE
              dc.id_report = 1
            GROUP BY
              c.id_detail
            ORDER BY
              dc.is_cf ASC
			");
        return $data->result();
    }

    public function get_current($date_to)
    {
        $data = $this->db->query("
           SELECT
              dc.id_detail,
              ctg.id_category,
              ctg.account AS ctg_caption,
              sc.id_subcategory,
              sc.`name` AS subcategory,
              dc.account,
              sum( cs.saldo ) AS balance_current
            FROM
              closed_saldo cs
              JOIN coa c ON c.coa_id = cs.coa_id
              JOIN detail_category dc ON dc.id_detail = c.id_detail
              JOIN subcategory sc ON sc.id_subcategory = dc.id_subcategory
              JOIN category ctg ON ctg.id_category = dc.id_category
            WHERE
              cs.date <= '".$date_to."' AND cs.state IS NULL AND dc.id_report = 1
            GROUP BY
              dc.id_detail
            ORDER BY
              sc.id_subcategory ASC,
              dc.is_cf ASC
			");
        return $data->result();
    }



    //LABA DITAHAN
    public function LD_income_akun5($tld){
        $data = $this->db->query("
			SELECT
				SUM(cs.saldo) AS ldi5
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				cs.date  <= '".$tld."'
			AND sg.kelompok = 5
			");
        return $data->row();
    }

    public function LD_income_akun8($tld){
        $data = $this->db->query("
			SELECT
				SUM(cs.saldo) AS ldi8
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				cs.date <= '".$tld."' AND sg.subgroup_id = 801
			");
        return $data->row();
    }

    public function LD_expense_akun7($tld){
        $data = $this->db->query("
			SELECT
				SUM(cs.saldo) AS lde7
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				cs.date <= '".$tld."'
			AND sg.kelompok = 7
			");
        return $data->row();
    }

    public function LD_expense_akun802($tld){
        $data = $this->db->query("
			SELECT
				SUM(cs.saldo) AS lde802
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				sg.subgroup_id BETWEEN 802 AND 999
			AND cs.date <= '".$tld."'
			");
        return $data->row();
    }
    //END OF LABA DITAHAN

    //LABA RUGI TAHUN BERJALAN
    public function LR_income_akun5($yy,$date_to){
        $data = $this->db->query("
          SELECT
            SUM(cs.saldo) AS lri5
          FROM
            closed_saldo cs
          JOIN coa ON coa.coa_id = cs.coa_id
          JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
          WHERE
            cs.date BETWEEN '".$yy."' AND '".$date_to."'
          AND sg.kelompok = 5
			");
        return $data->row();
    }

    public function LR_income_akun8($yy,$date_to){
        $data = $this->db->query("
			SELECT
				SUM(cs.saldo) AS lri8
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				sg.subgroup_id = 801
			AND cs.date BETWEEN '".$yy."' AND '".$date_to."'
			");
        return $data->row();
    }

    public function LR_expense_akun7($yy, $date_to){
        $data = $this->db->query("
			SELECT
				SUM(cs.saldo) AS lre7
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				cs.date BETWEEN '".$yy."' AND '".$date_to."'
			AND sg.kelompok = 7
			");
        return $data->row();
    }

    public function LR_expense_akun802($yy, $date_to){
        $data = $this->db->query("
			SELECT
				SUM(cs.saldo) AS lre802
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				sg.subgroup_id BETWEEN 802 AND 999
			AND cs.date BETWEEN '".$yy."' AND '".$date_to."'
			");
        return $data->row();
    }

    //END OF LABA RUGI TAHUN BERJALAN


    //PREVIOUS MONTH
    public function get_previous($date_from)
    {
        $data = $this->db->query("
            SELECT
              dc.id_detail,
              ctg.id_category,
              ctg.account AS ctg_caption,
              sc.id_subcategory,
              sc.`name` AS subcategory,
              dc.account,
              sum( cs.saldo ) AS balance_previous
            FROM
              closed_saldo cs
              JOIN coa c ON c.coa_id = cs.coa_id
              JOIN detail_category dc ON dc.id_detail = c.id_detail
              JOIN subcategory sc ON sc.id_subcategory = dc.id_subcategory
              JOIN category ctg ON ctg.id_category = dc.id_category
            WHERE
              cs.date <= '".$date_from."' - INTERVAL 1 DAY
              AND cs.state IS NULL
              AND dc.id_report = 1
            GROUP BY
              dc.id_detail
            ORDER BY
              sc.id_subcategory ASC,
              dc.is_cf ASC

			");
        return $data->result();
    }
    //END OF PREVIOUS MONTH


    // PREVIOUS LABA RUGI TAHUN BERJALAN
    public function PLR_income_akun5($yy,$date_from){
        $data = $this->db->query("
			SELECT
				SUM(cs.saldo) AS plri5
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
			 cs.date BETWEEN '".$yy."' AND '".$date_from."'-INTERVAL 1 DAY
			AND sg.kelompok = 5
			 AND cs.state IS NULL
			");
        return $data->row();
    }

    public function PLR_income_akun8($yy,$date_from){
        $data = $this->db->query("
			SELECT
				SUM(cs.saldo) AS plri8
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				sg.subgroup_id = 801
			AND cs.date BETWEEN '".$yy."' AND '".$date_from."'-INTERVAL 1 DAY
			");
        return $data->row();
    }

    public function PLR_expense_akun7($yy, $date_from){
        $data = $this->db->query("
          SELECT
            SUM(cs.saldo) AS plre7
          FROM
            closed_saldo cs
          JOIN coa ON coa.coa_id = cs.coa_id
          JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
          WHERE
            cs.date BETWEEN '".$yy."' AND '".$date_from."'-INTERVAL 1 DAY
          AND sg.kelompok = 7
			");
        return $data->row();
    }

    public function PLR_expense_akun802($yy, $date_from){
        $data = $this->db->query("
			SELECT
				SUM(cs.saldo) AS plre802
			FROM
				closed_saldo cs
			JOIN coa ON coa.coa_id = cs.coa_id
			JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
			WHERE
				sg.subgroup_id BETWEEN 802 AND 999
			AND cs.date BETWEEN '".$yy."' AND '".$date_from."'-INTERVAL 1 DAY
			");
        return $data->row();
    }
    //END OF PREVIOUS LABA RUGI TAHUN BERJALAN

    //GET BREAK DOWN
    public function get_breakdown($id_detail, $period){
        $data = $this->db->query("
            SELECT
              c.id_detail,
              c.coa_id,
              c.name_coa,
              sum( cs.saldo ) AS balance
            FROM
              closed_saldo cs
              JOIN coa c ON c.coa_id = cs.coa_id
            WHERE
              cs.date <= '".$period."'
              AND c.id_detail = '".$id_detail."'
              AND cs.state IS NULL
            GROUP BY
              cs.coa_id
        ");
        return $data->result();
    }

    public function total_breakdown($id_detail, $period){
        $data = $this->db->query("
            SELECT
              sum( cs.saldo ) AS total
            FROM
              closed_saldo cs
              JOIN coa c ON c.coa_id = cs.coa_id
            WHERE
              cs.date <= '".$period."'
              AND c.id_detail = '".$id_detail."'
              AND cs.state IS NULL
        ");
        return $data->row();
    }

    //GET BREAK DOWN PREVIOUS
    public function get_breakdownPrev($id_detail, $period){
        $data = $this->db->query("
            SELECT
              c.id_detail,
              c.coa_id,
              c.name_coa,
              sum( cs.saldo ) AS balance
            FROM
              closed_saldo cs
              JOIN coa c ON c.coa_id = cs.coa_id
            WHERE
              cs.date <= '".$period."' - INTERVAL 1 DAY
              AND c.id_detail = '".$id_detail."'
              AND cs.state IS NULL
            GROUP BY
              cs.coa_id
        ");
        return $data->result();
    }

    public function total_breakdownPrev($id_detail, $period){
        $data = $this->db->query("
            SELECT
              sum( cs.saldo ) AS total
            FROM
              closed_saldo cs
              JOIN coa c ON c.coa_id = cs.coa_id
            WHERE
              cs.date <= '".$period."' - INTERVAL 1 DAY
              AND c.id_detail = '".$id_detail."'
              AND cs.state IS NULL
        ");
        return $data->row();
    }



    //GET BREAK DOWN LABA BERJALAN
    public function get_laba_berjalan_coa($id){
        $data = $this->db->query("SELECT id_detail, coa_id, name_coa, debit as balance FROM coa WHERE id_detail = '".$id."'");
        return$data->result();
    }
}

?>