<?php
class M_bsd extends CI_Model
{
    public function get_assets($date){
        //current month aset
        $data=$this->db->query("
          SELECT
            sg.subgroup_id,
            sg.name_sg,
            cs.date,
            cs.coa_id,
            coa.name_coa,
            sg.kelompok,
            SUM(cs.saldo) AS assets
          FROM
            closed_saldo cs
          JOIN coa ON coa.coa_id = cs.coa_id
          JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
          WHERE
            cs.date <= '".$date."'
          AND sg.kelompok = 1
          GROUP BY
            coa.coa_id
			");
        return $data->result();
    }

    public function total_assets($date){ //total aset
        $data = $this->db->query("
          SELECT
            SUM(cs.saldo) AS total_assets
          FROM
            closed_saldo cs
          JOIN coa ON coa.coa_id = cs.coa_id
          JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
          WHERE
            cs.date <='".$date."'
          AND sg.kelompok = 1
			");
        return $data->row();
    }

    public function get_liabilities($date){
        $data=$this->db->query("
          SELECT
            sg.subgroup_id,
            sg.name_sg,
            cs.date,
            cs.coa_id,
            coa.name_coa,
            sg.kelompok,
            SUM(cs.saldo) AS liabilities
          FROM
            closed_saldo cs
          JOIN coa ON coa.coa_id = cs.coa_id
          JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
          WHERE
            cs.date <= '".$date."'
            AND sg.kelompok = 2 OR sg.kelompok = 3 OR sg.kelompok = 4
          GROUP BY
            cs.coa_id

			");
        return $data->result();
    }
    public function total_liabilities($date){
        $data=$this->db->query("
          SELECT
            SUM(cs.saldo) AS total_liabilities
          FROM
            closed_saldo cs
          JOIN coa ON coa.coa_id = cs.coa_id
          JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
          WHERE
            cs.date <='".$date."'
          AND sg.kelompok = 2 OR sg.kelompok = 3 OR sg.kelompok = 4
			");
        return $data->row();
    }


    // LABA DITAHAN
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




//laba rugi tahun berjalan
    public function LR_income_akun5($yy,$date){
        $data = $this->db->query("
          SELECT
            SUM(cs.saldo) AS lri5
          FROM
            closed_saldo cs
          JOIN coa ON coa.coa_id = cs.coa_id
          JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
          WHERE
            cs.date >= '".$yy."' AND cs.date <= '".$date."'
          AND sg.kelompok = 5
			");
        return $data->row();
    }

    public function LR_income_akun8($yy,$date){
        $data = $this->db->query("
          SELECT
            SUM(cs.saldo) AS lri8
          FROM
            closed_saldo cs
          JOIN coa ON coa.coa_id = cs.coa_id
          JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
          WHERE
            sg.subgroup_id = 801
          AND cs.date >= '".$yy."' AND cs.date <= '".$date."'
			");
        return $data->row();
    }

    public function LR_expense_akun7($yy, $date){
        $data = $this->db->query("
          SELECT
            SUM(cs.saldo) AS lre7
          FROM
            closed_saldo cs
          JOIN coa ON coa.coa_id = cs.coa_id
          JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
          WHERE
            cs.date >= '".$yy."' AND cs.date <= '".$date."'
          AND sg.kelompok = 7
			");
        return $data->row();
    }

    public function LR_expense_akun802($yy, $date){
        $data = $this->db->query("
          SELECT
            SUM(cs.saldo) AS lre802
          FROM
            closed_saldo cs
          JOIN coa ON coa.coa_id = cs.coa_id
          JOIN subgroup sg ON sg.subgroup_id = coa.subgroup
          WHERE
            sg.subgroup_id BETWEEN 802 AND 999
          AND cs.date >= '".$yy."' AND cs.date <= '".$date."'
			");
        return $data->row();
    }

}