<?php defined('BASEPATH') OR exit('No direct script access allowed');

class coa extends CI_Controller{
	function __Construct(){
	parent ::__construct();
	$this->load->model('master/M_coa');
	$this->load->library('PHPExcel');

		$this->load->helper('url');
        
    }

	public function view_coa(){
		$data['page']='master/view_coa';
		$data['group'] = $this->M_coa->get_group();
		$data['subgroup'] = $this->M_coa->get_subgroup();
		$data['coa'] = $this->M_coa->get_coa();
		//get form  table GROUP
		$data['getGroup']= $this->db->get('group_coa');
		//get form  table GROUP
		$data['getSubgroup']= $this->db->get('subgroup');
		$this->load->view('template/template', $data);
	}

	public function add_group(){
		$group_id = $this->input->post('group_id');
		$name = $this->input->post('name');

		$data = array(
			'group_id' => $group_id,
			'name'=> $name,
			);
		$this->M_coa->add_group($data, 'group_coa');
		$this->session->set_flashdata('success', 'ADDED');
		redirect('master/coa/view_coa');
	}

	public function delete_group($group_id){
		$this->db->where('group_id', $group_id);
		$this->db->delete('group_coa');
		$this->session->set_flashdata('success', 'DELETED');
		redirect('master/coa/view_coa');
	}

	public function edit_group($group_id){
		$data['page']='master/edit_group';
		$data['group'] = $this->M_coa->get_group();
		$data['editGroup'] = $this->M_coa->edit_group($group_id);
		$this->load->view('template/template', $data);
	}

	public function save_edit(){
		$group_id = $this->input->post('group_id');
		$name = $this->input->post('name');

		$data = array(
			'group_id' => $group_id,
			'name' => $name,
			);

		$this->M_coa->save_edit($group_id, $name);
		$this->session->set_flashdata('message', array('info', 'fa-check',  'SUCCESS', 'UPDATED!'));
		$this->session->set_flashdata('success', 'UPDATED');
		redirect('master/coa/view_coa');
	}

	public function add_subgroup(){
		$subgroup_id = $this->input->post('subgroup_id');
		$name_sg = $this->input->post('name_sg');
		$kelompok = $this->input->post('kelompok');

		$data = array(
			'subgroup_id' => $subgroup_id,
			'name_sg' => $name_sg,
			'kelompok' => $kelompok
			);

		$this->M_coa->add_subgroup($data, 'subgroup');
		$this->session->set_flashdata('success', 'ADDED');
		redirect('master/coa/view_coa#tab_1_2');
	}

	public function delete_subgroup($subgroup_id){
		$this->db->where('subgroup_id', $subgroup_id);
		$this->db->delete('subgroup');
		$this->session->set_flashdata('success', 'DELETED');

		redirect('master/coa/view_coa#tab_1_2');
	}

	public function edit_subgroup($subgroup_id){
		$data['page']='master/edit_subgroup';
		$data['group'] = $this->M_coa->get_group();
		$data['subgroup'] = $this->M_coa->get_subgroup();
		//get form  table GROUP
		$data['getGroup']= $this->db->get('group_coa');
		$data['editSubgroup'] = $this->M_coa->edit_subgroup($subgroup_id);
		$this->load->view('template/template', $data);
	}

	public function save_edit_subgroup(){
		$subgroup_id = $this->input->post('subgroup_id');
		$name_sg = $this->input->post('name_sg');
		$kelompok = $this->input->post('kelompok');

		$data = array(
			'subgroup_id' => $subgroup_id,
			'name_sg' => $name_sg,
			'kelompok' => $kelompok
			);

		$this->M_coa->save_edit_subgroup($subgroup_id, $name_sg, $kelompok);
		$this->session->set_flashdata('success', 'UPDATED');
		redirect('master/coa/view_coa#tab_1_2');
	}

	public function add_coa(){
		$coa_id = $this->input->post("coa_id");
		$name_coa = $this->input->post("name_coa");
		$date = $this->input->post("date");
		$subgroup = $this->input->post("subgroup");
		$debit = $this->input->post("debit");
		$credit = $this->input->post("credit");
		$cashflow = $this->input->post("cashflow");
		$header = $this->input->post("header");
		$active = $this->input->post("active");

		$data=array(
			'coa_id' => $coa_id,
			'name_coa' => $name_coa,
			'date' => $date,
			'subgroup' => $subgroup,
			'debit' => $debit,
			'credit' => $credit,
			'cashflow' => $cashflow,
			'header' => $header,
			'active' => $active,
			);
		$this->M_coa->add_coa($data, 'coa');
		$this->session->set_flashdata('success', 'ADDED');
		redirect('master/coa/view_coa#tab_1_3');
	}

	public function edit_coa($id){
		$data['page'] = 'master/edit_coa';

		$data['getSubgroup']= $this->db->get('subgroup');//to get all in dropdown
		$data['editCoa'] = $this->M_coa->get_data_edit($id);
		$this->load->view('template/template', $data);
	}
	public function save_edit_coa(){
		$id = $this->input->post("id");
		$coa_id = $this->input->post("coa_id");
		$name_coa = $this->input->post("name_coa");
		$date = $this->input->post("date");
		$subgroup = $this->input->post("subgroup");
		$debit = $this->input->post("debit");
		$credit = $this->input->post("credit");
		$cashflow = $this->input->post("cashflow");
		$header = $this->input->post("header");
		$active = $this->input->post("active");

		$data=array(
			'coa_id' => $coa_id,
			'name_coa' => $name_coa,
			'date' => $date,
			'subgroup' => $subgroup,
			'debit' => $debit,
			'credit' => $credit,
			'cashflow' => $cashflow,
			'header' => $header,
			'active' => $active,
			);
		// print_r($data);
		// exit();
		$this->M_coa->save_edit_coa($coa_id,$name_coa,$date,$subgroup,$debit,$credit,$cashflow, $header,$active, $id);

		$this->session->set_flashdata('success', 'UPDATED');
		redirect('master/coa/view_coa#tab_1_3');
	}
	public function delete_coa($coa_id){
		$this->db->where('coa_id', $coa_id);
		$this->db->delete('coa');
		$this->session->set_flashdata('success', 'DELETED');

		redirect('master/coa/view_coa#tab_1_3');
	}


	public function export_coa(){
	    $excel = new PHPExcel();

	    $excel->setActiveSheetIndex(0)->setCellValue('A1', "DAFTAR COA"); // Set kolom A1 dengan tulisan "DATA SISWA"
	    $excel->getActiveSheet()->mergeCells('A1:H1'); // Set Merge Cell pada kolom A1 sampai E1
	    $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
	    $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
	    $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
	    // Buat header tabel nya pada baris ke 3
	    $excel->setActiveSheetIndex(0)->setCellValue('A3', "COA ID");
	    $excel->setActiveSheetIndex(0)->setCellValue('B3', "COA NAME"); 
	    $excel->setActiveSheetIndex(0)->setCellValue('C3', "DATE");
	    $excel->setActiveSheetIndex(0)->setCellValue('D3', "SUBGROUP"); 
	    $excel->setActiveSheetIndex(0)->setCellValue('E3', "DEBIT"); 
	    $excel->setActiveSheetIndex(0)->setCellValue('F3', "CREDIT");
	    $excel->setActiveSheetIndex(0)->setCellValue('G3', "HEADER"); 
	    $excel->setActiveSheetIndex(0)->setCellValue('H3', "ACTIVE"); 
	    
	    // Panggil function view yang ada di M_coa untuk menampilkan semua data siswanya
	    $siswa = $this->M_coa->view();
	    $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
	    foreach($siswa as $data){ // Lakukan looping pada variabel siswa
	      
	      $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $data->coa_id);
	      $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->name_coa);
	      $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->date);
	      $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->subgroup);
	      $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->debit);
	      $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->credit);
	      $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->header);
	      $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->active);
	      $numrow++; // Tambah 1 setiap kali looping
	    }
	    // Set width kolom
	    	$excel->getActiveSheet()->getColumnDimension('A')->setWidth(15); // Set width kolom A
	    	$excel->getActiveSheet()->getColumnDimension('B')->setWidth(50); // Set width kolom B
	    	$excel->getActiveSheet()->getColumnDimension('C')->setWidth(20); // Set width kolom C
	    

	    // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
	    $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
	    // Set orientasi kertas jadi LANDSCAPE
	    $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
	    // Set judul file excel nya
	    $excel->getActiveSheet(0)->setTitle("COA");
	    $excel->setActiveSheetIndex(0);
	    // Proses file excel
	    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	    header('Content-Disposition: attachment; filename="Chart of account.xlsx"'); // Set nama file excel nya
	    header('Cache-Control: max-age=0');
	    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
	    $write->save('php://output');
	}


}
