<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->logged!==true){
	      redirect('auth');
	    }
	    $this->load->model('ProvinsiModel');
	    $this->load->model('AsramaModel');
	}

	public function data($jenis='provinsi',$type='point',$id='')
	{
		header('Content-Type: application/json');
		$response=[];
		if($jenis=='provinsi'){
			$getProvinsi=$this->ProvinsiModel->get();
			foreach ($getProvinsi->result() as $row) {
				$data=null;
				$data['id_provinsi']=$row->id_provinsi;
				$data['nama_provinsi']=$row->nama_provinsi;
				$data['icon'] = 'https://unpkg.com/leaflet@1.7.1/dist/images/marker-icon.png';
        	
				$response[]=$data;
			}
			echo "var dataProvinsi=".json_encode($response,JSON_PRETTY_PRINT);
		}
		elseif($jenis=='asrama'){
			if($type=='point'){
				if($id!=''){
					$this->db->where('a.id_provinsi',$id);
				}
				$getAsrama=$this->AsramaModel->get();
				foreach ($getAsrama->result() as $row) {
					$data=null;
					$data['type']="Feature";
					$data['properties']=[
												"name"=>$row->nama_asrama,
												"lokasi"=>$row->alamat_asrama,
												"telephone"=>$row->telephone,
												//"asal"=>$row->asal_provinsi,
												"icon"=>('https://unpkg.com/leaflet@1.7.1/dist/images/marker-icon.png'),
												"popUp"=>"Lokasi : ".$row->alamat_asrama."<br>Telephone : ".$row->telephone
												];
					$data['geometry']=[
												"type" => "Point",
												"coordinates" => [$row->long_asrama,$row->latt_asrama ] 
												];	

					$response[]=$data;
				}
				echo json_encode($response,JSON_PRETTY_PRINT);	
			}			
		}
		
	}
}
