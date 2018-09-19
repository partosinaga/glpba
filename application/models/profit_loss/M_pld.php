<?php

class M_pld extends CI_Model
{
    public function get_income($date)
    {
        $data = $this->db->query("
          SELECT
            cs.coa_id,
            coa.name_coa,
            SUM(cs.saldo) AS income
          FROM
            closed_saldo cs
          JOIN coa ON coa.coa_id = cs.coa_id
          JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
          WHERE
            cs.date <= '" .$date. "'
          AND sg.kelompok = 5
          GROUP BY
            coa.coa_id
		");
        return $data->result();
    }
    public function sum_income($date)
    {
        $data = $this->db->query("
          SELECT
            SUM(cs.saldo) AS sum_income
          FROM
            closed_saldo cs
          JOIN coa ON coa.coa_id = cs.coa_id
          JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
          WHERE
            cs.date<= '".$date."'
          AND sg.kelompok = 5
		");
        return $data->row();
    }

    public function get_expense($date){
        $data = $this->db->query("
          SELECT
            cs.coa_id,
            coa.name_coa,
            SUM(cs.saldo) AS expense
          FROM
            closed_saldo cs
          JOIN coa ON coa.coa_id = cs.coa_id
          JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
          WHERE
            cs.date <= '".$date."'
          AND sg.kelompok BETWEEN 6 AND 7
          GROUP BY
            coa.coa_id
				");
        return $data->result();
    }
    public function sum_expense($date){
        $data = $this->db->query("
          SELECT
            cs.coa_id,
            coa.name_coa,
            SUM(cs.saldo) AS sum_expense
          FROM
            closed_saldo cs
          JOIN coa ON coa.coa_id = cs.coa_id
          JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
          WHERE
            cs.date <= '".$date."'
          AND sg.kelompok BETWEEN 6 AND 7
				");
        return $data->row();
    }

    public function other_in_ex($date){
        $data = $this->db->query("
          SELECT
              cs.coa_id,
              coa.name_coa,
              SUM( cs.saldo ) AS other_in_ex
            FROM
              closed_saldo cs
              JOIN coa ON coa.coa_id = cs.coa_id
              JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
            WHERE
              cs.date <= '".$date."'
              AND sg.kelompok BETWEEN 8 AND 9
            GROUP BY
              coa.coa_id
				");
        return $data->result();
    }

    public function sum_other($date){
        $data = $this->db->query("
          SELECT
              SUM( cs.saldo ) AS sum_other
            FROM
              closed_saldo cs
              JOIN coa ON coa.coa_id = cs.coa_id
              JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
            WHERE
              cs.date <= '".$date."'
              AND sg.kelompok BETWEEN 8 AND 9
				");
        return $data->row();
    }

    public function subtraction($date){
        $data = $this->db->query("
          SELECT
            cs.coa_id,
            coa.name_coa,
            SUM(cs.saldo) AS subtraction
          FROM
            closed_saldo cs
          JOIN coa ON coa.coa_id = cs.coa_id
          JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
          WHERE
            cs.date <= '".$date."'
          AND sg.kelompok BETWEEN 8 AND 9 AND coa.name_coa LIKE 'B%'
			");
        return $data->row();
    }
}