<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asrama extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('AsramaModel','Model');
		$this->load->model('ProvinsiModel');
		$this->load->model('JenisAsramaModel');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header('Expires: session');

        // Cek apakah pengguna sudah login, jika tidak redirect ke halaman login
        if (!$this->session->userdata('logged')) {
            $this->session->set_flashdata('info', '<div class="alert alert-danger">Silakan login terlebih dahulu!</div>');
            redirect('admin/auth');
        }
	}

	public function index()
	{
		$datacontent['url']='admin/asrama';
		$datacontent['title']='Halaman asrama';
		$datacontent['datatable']=$this->Model->get();
		$data['content']=$this->load->view('admin/asrama/asramaView',$datacontent,TRUE);
		$data['js']=$this->load->view('admin/asrama/asramaViewJs',$datacontent,TRUE);
		$data['title']=$datacontent['title'];
		$this->load->view('admin/layout/html',$data);
	}
	public function form($parameter='',$id='')
	{
		$datacontent['url']='admin/asrama';
		$datacontent['parameter']=$parameter;
		$datacontent['id']=$id;
		$datacontent['title']='Form asrama';
		$data['content']=$this->load->view('admin/asrama/form',$datacontent,TRUE);
		$data['title']=$datacontent['title'];
		$this->load->view('admin/layout/html',$data);
	}
	public function simpan()
	{
		if($this->input->post()){
			$data=[
				'id_asrama'=>$this->input->post('id_asrama'),
				'nama_asrama'=>$this->input->post('nama_asrama'),
				'alamat_asrama'=>$this->input->post('alamat_asrama'),
				'id_provinsi'=>$this->input->post('id_provinsi'),
				'foto_asrama'=>$this->input->post('foto_asrama'),
				'telephone'=>$this->input->post('telephone'),
				'id_jenis'=>$this->input->post('id_jenis'),
				'deskripsi'=>$this->input->post('deskripsi'),
				'fasilitas'=>$this->input->post('fasilitas'),
				'jumlah_kamar'=>$this->input->post('jumlah_kamar'),
				'harga_sewa'=>$this->input->post('harga_sewa'),
				'latt_asrama'=>$this->input->post('latt_asrama'),
				'long_asrama'=>$this->input->post('long_asrama'),	
			];
						// upload
						$upload_path = FCPATH . 'admin/foto_asrama/';

						// Pastikan folder ada
						if (!is_dir($upload_path)) {
							mkdir($upload_path, 0777, true);
						}
						
						foreach ($_FILES['foto_asrama']['tmp_name'] as $key => $tmp_name) {
							$file_name = time() . '_' . $_FILES['foto_asrama']['name'][$key];
							$file_tmp = $_FILES['foto_asrama']['tmp_name'][$key];
							$destination = $upload_path . $file_name;
						
							if (move_uploaded_file($file_tmp, $destination)) {
								$foto_names[] = $file_name;
							} else {
								$info = '<div class="alert alert-danger alert-dismissible">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									<h4><i class="icon fa fa-ban"></i> Error!</h4> Gagal mengunggah file: ' . $_FILES['foto_asrama']['name'][$key] . ' </div>';
								$this->session->set_flashdata('info', $info);
								redirect('admin/asrama');
								exit();
							}
						}
						
						// Jika berhasil, simpan data nama file ke database
						$data['foto_asrama'] = implode(',', $foto_names);
						// Simpan data lain...
						
			// upload
			if($_POST['parameter']=="tambah"){
				$this->Model->insert($data);
			}
			else{
				$this->Model->update($data,['id_asrama'=>$this->input->post('id_asrama')]);
			}

		}
		redirect('admin/asrama');
	}

	public function hapus($id=''){
		$this->db->where('id_asrama',$id);
		$get=$this->Model->get()->row();
		$this->Model->delete(["id_asrama"=>$id]);
		redirect('admin/asrama');
	}
	public function datatable(){
		header('Content-Type: application/json');
		$url = 'admin/asrama';
		$kolom =['nama_asrama','alamat_asrama','nama_provinsi','telephone','latt_asrama','long_asrama'];

		if ( $this->input->get('sSearch')){
			$this->db->group_start();
			for ( $i=0 ; $i<count($kolom) ; $i++ )
			{
		    	$this->db->or_like($kolom[$i],$this->input->get('sSearch',TRUE));
			}
			$this->db->group_end();
		}
		//order
		if ( $this->input->get('iSortCol_0') ){
			for ( $i=0 ; $i<intval( $this->input->get('iSortingCols',TRUE) ) ; $i++ )
			{
			    if ( $this->input->get( 'bSortable_'.intval($_GET['iSortCol_'.$i]),TRUE) == "true" )
			    {
			        $this->db->order_by($kolom[intval( $this->input->get('iSortCol_'.$i,TRUE))],$this->input->get('sSortDir_'.$i,TRUE) );
			    }
			}
		}

      	if($this->input->get('iDisplayLength',TRUE)!="-1"){
	        $this->db->limit($this->input->get('iDisplayLength',TRUE),$this->input->get('iDisplayStart'));
		}

		$dataTable = $this->Model->get();
		$iTotalDisplayRecords=$this->Model->get()->num_rows();
		$iTotalRecords=$dataTable->num_rows();
		$output = [
		  "sEcho" => intval($this->input->get('sEcho')),
		  "iTotalRecords" => $iTotalRecords,
		  "iTotalDisplayRecords" => $iTotalDisplayRecords,
		  "aaData" => array()
		];
		$no=1;
		foreach ($dataTable->result() as $row) {
			
			$r = null;
			$r[] = $no++;
			$r[] = $row->nama_asrama;
			$r[] = $row->alamat_asrama;
			$r[] = $row->nama_provinsi;
			$r[] = $row->telephone;
			$r[] = $row->latt_asrama;
			$r[] = $row->long_asrama;
			$r[] = '<div class="btn-group">
								<a href="'.site_url($url.'/form/ubah/'.$row->id_asrama).'" class="btn btn-info"><i class="fa fa-edit"></i> Ubah</a>
								<a href="'.site_url($url.'/hapus/'.$row->id_asrama).'" class="btn btn-danger" onclick="return confirm(\'Hapus data?\')"><i class="fa fa-trash"></i> Hapus</a>
							</div>';
			$output['aaData'][] = $r;				
		}
		echo json_encode($output,JSON_PRETTY_PRINT);

	}	
}
