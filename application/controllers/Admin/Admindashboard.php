<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admindashboard extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->logged!==true){
	      redirect('admin/auth');
	    }
	}

	public function index()
	{
		$datacontent['title']='Halaman Beranda';
		$data['content']=$this->load->view('admin/dashboardView',$datacontent,TRUE);
		$data['title']='Selamat Datang di Beranda';
		$this->load->view('admin/layout/html',$data);
	}
}
