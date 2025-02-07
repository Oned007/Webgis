<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('AsramaModel','Model');
		$this->load->model('ProvinsiModel');
		$this->load->model('JenisAsramaModel');
	}
	
	public function index()
	{
		$datacontent['title']='Halaman Beranda';
		$datacontent['datatable'] = $this->Model->get_all();
		$data['content']=$this->load->view('user/homepage',$datacontent,TRUE);
		$data['js']=$this->load->view('admin/mappoint/js/mapsjs',$datacontent,TRUE);
		$data['title']='Selamat Datang di Beranda';
		$this->load->view('user/layouts/html',$data);
	}
	public function detail($id)
	{
		$asrama = $this->Model->get_by_id($id);
		$datacontent['asrama'] = $asrama;
		$datacontent['id']=$id;
		$datacontent['title']='Detail asrama';
		$datacontent['datatable'] = $this->Model->get_by_id($id);
		$datacontent['fotos'] = explode(',', $asrama->foto_asrama);
		$data['content']=$this->load->view('user/detail',$datacontent,TRUE);
		$data['title']=$datacontent['title'];
		$this->load->view('user/layouts/html',$data);
	}


}
