<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ap extends CI_Controller
{
    function __Construct()
    {
        parent::__construct();
        $this->load->model('ap/M_ap');
        $this->load->model('ar/M_ar');
        $this->load->library(array('import/PHPExcel', 'import/PHPExcel/IOFactory'));
        $this->load->helper('url');

    }

    public function view_ap()
    {
        if ($this->session->userdata('username') == null) {
            redirect('home');
        }
        $data['page'] = 'ap/view_ap';

        $data['bank'] = $this->M_ar->get_bank();
        //get form  table currency
        $data['curr'] = $this->db->get('currency');
        //get  table coa
        $data['coa'] = $this->M_ar->get_coa('coa');
        //get kode otomatis
        $data['kode'] = $this->M_ap->get_kode();
        //get tag
        $data['tag'] = $this->M_ar->get_tag();
        //geet contact
        $data['contact'] = $this->M_ar->get_contact();
        $this->load->view('template/template', $data);
    }

    public function input_ap()
    {
        $this->db->trans_begin();
        $validate = $this->M_ap->get_header($_POST['no_voucher']);
        if (count($validate) > 0) {
            $this->session->set_flashdata('error', 'Failed, try again!');
            redirect('ap/ap/view_ap');
        } else {
            $data['no_voucher'] = $_POST['no_voucher'];
            $data['date'] = $_POST['date'];
            $data['bank_id'] = $_POST['bank_id'];
            $data['description'] = $_POST['description'];
            $data['curr_id'] = $_POST['curr_id'];
            $data['total'] = $_POST['total'];
            $data['kurs'] = $_POST['kurs'];
            $data['receive_from'] = $_POST['receive_from'];
            $data['no_cek'] = $_POST['no_cek'];
            $data['gl_date'] = $_POST['gl_date'];
            $data['status'] = "post";
            $data['audit_user'] = $this->session->userdata('username');
            $data['audit_date'] = date("Y-m-d H:i:sa");
            //INPUT TO ap_header
            $this->db->insert('ap_header', $data);

//        INSERT TAG
            $data_tag = array();
            $tag_id = $this->input->post('tag');
            if(isset($tag_id) ){
                for ($i = 0; $i < count($tag_id); $i++) {
                    $data_tag[$i] = array(
                        'no_voucher' => $data['no_voucher'],
                        'tag_id' => $tag_id[$i],
                    );
                }
                $this->db->insert_batch('ap_tag', $data_tag);
            }
//        END OF INSERT TAG

            //input to ap_detail
            $no_vouc = $this->input->post('no_vouc');
            $coa_id = $this->input->post('coa_id');
            $desc = $this->input->post('desc');
            $debit = $this->input->post('debit');
            $credit = $this->input->post('credit');

            $datax = array();
            for ($i = 0; $i < count($coa_id); $i++) {
                $datax[$i] = array(
                    'coa_id' => $coa_id[$i],
                    'description' => $desc[$i],
                    'no_voucher' => $no_vouc[$i],
                    'debit' => $debit[$i],
                    'credit' => $credit[$i],

                );
            }
            $this->db->insert_batch('ap_detail', $datax);
        }

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $this->session->set_flashdata('error', 'Failed to save, try again!');
        }
        else
        {
            $this->db->trans_commit();
            $this->session->set_flashdata('success', 'Payment voucher saved!');
        }
        redirect('ap/ap/view_ap');
    }

    public function ap_list()
    {
        if ($this->session->userdata('username') == null) {
            redirect('home');
        }
        $data['page'] = 'ap/ap_list';
        $data['apList'] = $this->M_ap->get_ap();
        $this->load->view('template/template', $data);
    }

    public function detail_ap()
    {
        if (isset($_POST["id"])) {
            $output = '';
            $no_voucher = $_POST["id"];
            $data['header'] = $this->M_ap->get_header($no_voucher);
            $data['detail'] = $this->M_ap->get_detail($no_voucher);


            $output .= '
				<div class="">
					<table class="table table-striped table-bordered table-hover">';

            foreach ($data['header'] as $row){
                $output .= '
               <div class="row">
                    <div class="col-md-3">
                      <label>VOUCHER NO.</label><br>
                      ' . $row->no_voucher . '
                    </div>
                    <div class="col-md-3">
                      <label>DATE</label><br>
                    ' . $row->date . '
                    </div>
                    <div class="col-md-3">
                      <label>BANK CODE</label><br>
                      ' . $row->bank_id . '
                    </div>
               </div><br>

					      <div class="row">
                		<div class="col-md-12">
                  			<label>Desription</label><br>
                      		' . $row->description . '
                		</div>
                </div><br>
              	<div class="row">
                    <div class="col-md-3">
                      <label>CURRENCY</label><br>
                      ' . $row->curr_id . '
                    </div>
                    <div class="col-md-3">
                      <label>TOTAL</label><br>
                        ' . number_format($row->total) . '
                    </div>

                    <div class="col-md-3">
                      <label>EXCHANGE RATE</label><br>
                      ' . $row->kurs . '
                    </div>
					      </div><br>



                <div class="row">
                    <div class="col-md-3">
                      <label>NO.CEL/GIRO</label><br>
                    ' . $row->no_cek . '
                    </div>
                    <div class="col-md-3">
                      <label>GL. DATE</label><br>
                      ' . $row->gl_date . '
                    </div>
					 	        <i>created by:' . $row->audit_user . '</i>
					      </div><br>';


            };
            $output.='<table class="table">
                       <tr bgcolor="#E7505A">
                            <td width="100px" align="center"><b>ACCOUNT</td>
                            <td align="center"><b>DESCRIPTION</td>
                            <td width="200px" align="right"><b>DEBIT</td>
                            <td width="200px" align="right"><b>CREDIT</td>
                       </tr>';

                foreach($data['detail'] as $row2) {
                $output .= '
                       <div class="row">
                        <tr>
                            <td>' . $row2->coa_id . '</td>
                            <td>' . $row2->name_coa . '</td>
                            <td align="right">' . number_format($row2->debit) . '</td>
                            <td align="right">' . number_format($row2->credit) . '</td>
                       </tr>
                       </div>';
                };
            $output .= "</table></div>";
            echo $output;

        };
    }

    public function print_ap()
    {
        $no_voucher = $this->input->get('id');
        $data['terbilang'] = $this->M_ap->terbilang($no_voucher);
        //get headet
        $data['header'] = $this->M_ap->get_header($no_voucher);
        //get detail
        $data['detail'] = $this->M_ap->get_detail($no_voucher);
        $data['totalDetail'] = $this->M_ap->get_totalDetail($no_voucher);
        //get sytem parameter
        $data['syspar'] = $this->M_ap->get_syspar();
        $this->load->view('ap/ap_print', $data);
    }

    public function print_ap_up()
    {
        $no_voucher = $this->input->get('id');

        $data['terbilang'] = $this->M_ap->terbilang($no_voucher);

        //get headet
        $data['header'] = $this->M_ap->get_header($no_voucher);
        //get detail
        $data['detail'] = $this->M_ap->get_detail($no_voucher);
        $data['totalDetail'] = $this->M_ap->get_totalDetail($no_voucher);
        //get sytem parameter
        $data['syspar'] = $this->M_ap->get_syspar();
        $this->load->view('ap/ap_print_up', $data);
    }

    public function posting()
    {
        if ($this->session->userdata('username') == null) {
            redirect('home');
        }
        $data['page'] = 'ap/posting';
        $data['postlist'] = $this->M_ap->get_postList();
        $this->load->view('template/template', $data);
    }

    public function save_posting()
    {
        $this->db->trans_start();
        $valid = true;
        $noVoc = $this->input->post('noVoc');
        $posted_no = $this->input->post('posted_no');
        $gl_date = $this->input->post('gl_date');
        $audit_user = $this->session->userdata('username');
        $audit_date = date('Y-m-d H:i:s');

        $q = $this->db->query("
		          SELECT
		            MAX( RIGHT ( gl_no, 4 ) ) AS kt 
		          FROM
		            gl_header 
		          WHERE
		            Fmodule = 'AP' 
		            AND MONTH ( gl_date ) = MONTH ( '" . $gl_date . "' )
		            AND YEAR ( gl_date ) = YEAR ( '" . $gl_date . "' );
		          ");
        $kd = "";
        $posted_no = "";
        $tgl = date("my");
        $gld = New DateTime($gl_date);
        $kd2 = "4" . $gld->format('my');
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kt) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "4" . $gld->format('my') . "0001";
        }
        $posted_no = $kd2 . $kd;

        //validate transaction
        $glh = $this->M_ap->cek_header($posted_no);
        $gld = $this->M_ap->cek_detail($posted_no);


        if (count($glh) > 0 OR count($gld) > 0) {
            $this->session->set_flashdata('error', 'Posting Failed, Try again later(1)!');
            $valid = false;
        } else {
            //1. to update status AP and add posted no
            $data = $this->M_ap->save_posting($noVoc, $posted_no);

            $gl_no = $posted_no;
            $gl_date = $gl_date;
            $noVoc = $this->input->post('noVoc');
            $description = $this->input->post('description');
            $total = $this->input->post('total');
            $Fmodule = "AP";
            $Fmonth = date("m");
            $Fyear = date("Y");
            $status = "posted";
            $audit_user = $audit_user;
            $audit_date = $audit_date;

            $data = array(
                'gl_no' => $gl_no,
                'gl_date' => $gl_date,
                'reff_no' => $noVoc,
                'description' => $description,
                'total' => $total,
                'Fmodule' => $Fmodule,
                'Fmonth' => $Fmonth,
                'Fyear' => $Fyear,
                'status' => $status,
                'audit_user' => $audit_user,
                'audit_date' => $audit_date,
                'is_cashflow' => 'on'
            );

            $this->M_ap->save_glHead($data, 'gl_header');

            if ($gl_no == '' OR empty($gl_no)) {
                $this->session->set_flashdata('error', 'Posting Failed, Try again later(2)!');
                $valid = false;
            } else {
                //3. move from ar detail to gl detail
                $data = $this->M_ap->save_glDetail($noVoc, $gl_no);
                $this->session->set_flashdata('success', 'POSTED!');
            }

            //insert to gl_tag
            $this->M_ap->save_gl_tag($noVoc, $gl_no);
        }

        // validation comit or rolback
        if ($valid) {
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $this->session->set_flashdata('error', 'Posting Failed, Try again later(3).');
            } else {
                $this->db->trans_commit();
            }
        } else {
            $this->db->trans_rollback();
            $this->session->set_flashdata('error', 'Posting Failed, Try again later(4).');
        }

        redirect('ap/ap/posting');
    }

    public function unposting()
    {
        if ($this->session->userdata('username') == null) {
            redirect('home');
        }
        $data['page'] = 'ap/unposting';
        $data['unpostlist'] = $this->M_ap->get_unposting();
        $this->load->view('template/template', $data);
    }

    public function save_unposting()
    {
        $this->db->trans_begin();

        $id = $this->input->get('id');
        $gl = $this->input->get('gl');
        $this->M_ap->save_unposting($id);
        $this->M_ap->updateGLHposted($id);

        //remove from gl_tag
        $this->M_ar->delete_gl_tag($gl);

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $this->session->set_flashdata('error', 'Failed to unposting, try again!');
        }
        else
        {
            $this->db->trans_commit();
            $this->session->set_flashdata('success', 'UNPOSTED!');
        }
        redirect('ap/ap/unposting');
    }

    public function save_reposting()
    {
        $this->db->trans_begin();

        $id = $this->input->post('nv');
        $gl = $this->input->post('gl');
        //to update status to unpsted
        $this->M_ap->save_reposting($id);

        //to update status in gl header
        $this->M_ap->updateGLHunposted($id);

        //insert to gl_tag
        $this->M_ap->save_gl_tag($id, $gl);

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $this->session->set_flashdata('error', 'failed, try again!');
        }
        else
        {
            $this->db->trans_commit();
            $this->session->set_flashdata('success', 'POSTED and keep journal number!');
        }
        redirect('ap/ap/posting');
    }

    public function save_upd_reposting()
    {
        $this->db->trans_start();
        $valid = true;
        $id = $this->input->post("nv");
        $gl_date = $this->input->post("gl_date");
        $postedNo = $this->input->post("postedNo");

        $q = $this->db->query("
			  SELECT
				MAX( RIGHT ( gl_no, 4 ) ) AS kt 
			  FROM
				gl_header 
			  WHERE
				Fmodule = 'AP' 
				AND MONTH ( gl_date ) = MONTH ( '" . $gl_date . "' )
				AND YEAR ( gl_date ) = YEAR ( '" . $gl_date . "' );
			  ");
        $kd = "";
        $posted_no = "";
        $tgl = date("my");
        $gld = New DateTime($gl_date);
        $kd2 = "4" . $gld->format('my');
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kt) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "4" . $gld->format('my') . "0001";
        }
        $posted_no = $kd2 . $kd;


        $glh = $this->M_ap->cek_header($posted_no);
        $gld = $this->M_ap->cek_detail($posted_no);
        if (count($glh) > 0 OR count($gld) > 0) {
            $this->session->set_flashdata('error', 'Reposting Failed, Try again later(1)!');
            $valid = false;
        } else {
            //reupdate status in ap header
            $this->M_ap->save_upd_reposting($id, $posted_no);

            //update GL no in GL header
            //NB=> posted no on AR header = GL No in GL header
            $this->M_ap->save_upd_reposting2($id, $posted_no);

            //to update gl_no in GL detail
            $this->M_ap->updateGlNoGlDetail($posted_no, $postedNo);

            //to update status in gl header
            $this->M_ap->updateGLHunposted($id);
            $this->session->set_flashdata('success', 'Reposted and generate new journal number!');

            //insert to gl_tag
            $this->M_ap->save_gl_tag($id, $posted_no);
        }

        // validation comit or rolback
        if ($valid) {
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $this->session->set_flashdata('error', 'Reposting Failed, Try again later(2)');
            } else {
                $this->db->trans_commit();
            }
        } else {
            $this->db->trans_rollback();
            $this->session->set_flashdata('error', 'Reposting Failed, Try again later(3)');
        }

        redirect('ap/ap/posting');

    }

    public function edit_ap()
    {
        if ($this->session->userdata('username') == null) {
            redirect('home');
        }
        $no_voucher = $this->input->get('id');
        $data['page'] = 'ap/edit_ap';
        //get form  table bank
        $data['bank'] = $this->M_ar->get_bank();
        //get form  table currency
        $data['curr'] = $this->db->get('currency');

        //get tag
        $data['tag'] = $this->M_ar->get_tag();
        //get selected tag
        $data['selectedTag'] = $this->M_ap->get_tag_selected($no_voucher);
        //geet contact
        $data['contact'] = $this->M_ar->get_contact();
        //get  table coa
        $data['coa'] = $this->M_ar->get_coa('coa');
        $data['editAph'] = $this->M_ap->get_aph_edit($no_voucher);
        $data['editApd'] = $this->M_ap->get_apd_edit($no_voucher);
        $this->load->view('template/template', $data);
    }

    public function save_edit()
    {
        $this->db->trans_begin();

        $id = $this->input->post('id');
        $no_voucher = $this->input->post('no_voucher');
        $date = $this->input->post('date');
        $bank_id = $this->input->post('bank_id');
        $description = addslashes($this->input->post('description'));
        $curr_id = $this->input->post('curr_id');
        $total = $this->input->post('total');
        $kurs = $this->input->post('kurs');
        $paid_to = $this->input->post('paid_to');
        $no_cek = $this->input->post('no_cek');
        $gl_date = $this->input->post('gl_date');


        $this->M_ap->save_update_aph($id, $bank_id, $date, $description, $curr_id, $total, $kurs, $paid_to, $no_cek, $gl_date, $no_voucher);
        $this->M_ap->save_update_glh($total, $description, $gl_date, $no_voucher);

        $no_voucher = $this->input->post('no_voucher');
        $posted_no = $this->input->post('posted_no');
        $desc = $this->input->post('desc');
        $coa_id = $this->input->post('coa_id');
        $debit = $this->input->post('debit');
        $credit = $this->input->post('credit');


        //AP DETAIL
        $datax2 = array();
        for ($a = 0; $a < count($coa_id); $a++) {
            $datax2[$a] = array(
                'coa_id' => $coa_id[$a],
                'description' => $desc[$a],
                'no_voucher' => $no_voucher,
                'debit' => $debit[$a],
                'credit' => $credit[$a],
            );
        }
        $this->M_ap->delete_apd_old($no_voucher);
        $this->db->insert_batch('ap_detail', $datax2);

        //GL DETAIL, to check exist or no in gl detail
        if (!empty($posted_no)) {
            $datax3 = array();
            for ($a = 0; $a < count($coa_id); $a++) {
                $datax3[$a] = array(
                    'gl_no' => $posted_no,
                    'coa_id' => $coa_id[$a],
                    'description' => $desc[$a],
                    'debit' => $debit[$a],
                    'credit' => $credit[$a],

                );
            }
            $this->M_ap->delete_gld_old($posted_no);
            $this->db->insert_batch('gl_detail', $datax3);
        }


        //DELETE EXISTING TAG
        $this->M_ap->delete_existing_tag($no_voucher);
        //END OFDELETE EXISTING TAG

        //INSERT TAG
        $data_tag = array();

        $tag_id = $this->input->post('tag');
        if(isset($tag_id)){
            for($i = 0; $i < count($tag_id); $i++){
                $data_tag[$i] = array(
                    'no_voucher' =>$no_voucher,
                    'tag_id'=> $tag_id[$i],
                );
            }
            $this->db->insert_batch('ap_tag', $data_tag);
            //END OF INSERT TAG
        }




        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $this->session->set_flashdata('error', 'Edit failed, try again!');
        }
        else
        {
            $this->db->trans_commit();
            $this->session->set_flashdata('success', 'Update Success!');
        }
        redirect('ap/ap/ap_list');
    }

    public function edit_glDate()
    {
        $nv = $this->input->post('nv');
        $d = $this->input->post('hari');
        $m = $this->input->post('bulan');
        $y = $this->input->post('tahun');

        $date = $y . '-' . $m . '-' . $d;
        //edit in ap header
        $this->M_ap->edit_glDate($nv, $date);
        //edit in gl_header
        $this->M_ap->edit_glDate_glh($nv, $date);

    }

    function import()
    {
        $data['page'] = 'ap/import';
        $this->load->view('template/template', $data);
    }

    function download()
    {
        $this->load->helper('download');
        force_download('./uploads/ap/ap_format.rar', NULL);
        $this->session->set_flashdata('info', 'Your File Will Downloaded');
        redirect('ap/ap/import');
    }

    public function upload()
    {
        $fileName = $this->input->post('file', TRUE);
        $config['upload_path'] = './uploads/ap/';
        $config['file_name'] = "Header-" . date('Y-m-d');
        $config['allowed_types'] = 'xls|xlsx|csv|ods|ots';
        $config['max_size'] = 10000;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file')) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            redirect('ap/ap/import');
        } else {
            $media = $this->upload->data();
            $inputFileName = 'uploads/ap/' . $media['file_name'];

            try {
                $inputFileType = IOFactory::identify($inputFileName);
                $objReader = IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch (Exception $e) {
                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
            }

            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

            for ($row = 2; $row <= $highestRow; $row++) {
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                    NULL,
                    TRUE,
                    FALSE);

                $data = array(
                    "no_voucher" => $rowData[0][0],
                    "date" => $rowData[0][1],
                    "bank_id" => $rowData[0][2],
                    "description" => $rowData[0][3],
                    "curr_id" => $rowData[0][4],
                    "total" => $rowData[0][5],
                    "kurs" => $rowData[0][6],
                    "receive_from" => $rowData[0][7],
                    "no_cek" => $rowData[0][8],
                    "gl_date" => $rowData[0][9],
                    "status" => "post",
                    "audit_user" => $this->session->userdata('username'),
                    "audit_date" => date("Y-m-d H:i:sa")
                );
                $this->db->insert("ap_header", $data);
            }
            $this->session->set_flashdata('info', 'UPLOADED');
            redirect('ap/ap/import');
        }
    }

    public function upload2()
    {
        $fileName = $this->input->post('file', TRUE);
        $config['upload_path'] = './uploads/ap/';
        $config['file_name'] = "Detail-" . date('Y-m-d');
        $config['allowed_types'] = 'xls|xlsx|csv|ods|ots';
        $config['max_size'] = 10000;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file')) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            redirect('ap/ap/import');
        } else {
            $media = $this->upload->data();
            $inputFileName = 'uploads/ap/' . $media['file_name'];

            try {
                $inputFileType = IOFactory::identify($inputFileName);
                $objReader = IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch (Exception $e) {
                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
            }

            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

            for ($row = 2; $row <= $highestRow; $row++) {
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                    NULL,
                    TRUE,
                    FALSE);

                $data = array(
                    "no_voucher" => $rowData[0][0],
                    "description" => $rowData[0][1],
                    "coa_id" => $rowData[0][2],
                    "debit" => $rowData[0][3],
                    "credit" => $rowData[0][4],

                );
                $this->db->insert("ap_detail", $data);
            }
            $this->session->set_flashdata('info', 'UPLOADED');
            redirect('ap/ap/import');
        }
    }

    public function cancel_ap()
    {
        $id = $this->input->get('id');
        $status = $this->input->get('status');

        if ($status == 'post') {
            //cancel ar_header. belum ada di table gl
            $this->M_ap->cancel_ap($id);
        } else {
            //cancel ar_header
            $this->M_ap->cancel_ap_post($id);
            //cancel gl_header
            $this->M_ap->cancel_glh($id);
            //cancel gl_detil
            $this->M_ap->cancel_gld($id);
        }

        $this->session->set_flashdata('success', 'Voucher canceled!. Move to Canceled Voucher');
        redirect('ap/ap/ap_list');
    }

    public function cancel_list()
    {
        $data['page'] = 'ap/cancel_ap';
        $data['cancel'] = $this->M_ap->get_cancel();
        $this->load->view('template/template', $data);
    }

    public function open_ap()
    {
        $id = $this->input->get('id');
        $this->M_ap->open_ar($id);
        $this->session->set_flashdata('success', 'Voucher Opened!. Move to Receipt Voucher List');
        redirect('ap/ap/cancel_list');
    }

    public function edit_cek()
    {
        $nov = $this->input->post('nov');
        $value = $this->input->post('value');

        $this->M_ap->edit_cek($nov, $value);
    }

    public function mass_posting()
    {
        $no_voucher = $_POST['chkArray'];
        $gl_date = $_POST['gld'];

        //insert to gl_header & gl detail, update status in ar header
        $this->M_ap->mass_posting_head($no_voucher, $gl_date);
    }

    public function mass_unposting()
    {
        $no_voucher = $_POST['check'];
        $gl_no = $_POST['gln'];

        $this->M_ap->mass_unposting($no_voucher);

    }
}