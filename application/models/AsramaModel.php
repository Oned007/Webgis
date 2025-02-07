<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AsramaModel extends CI_Model{
	function get(){
		$data=$this->db->select('*')
					->from('asrama a')
					->join('provinsi b','a.id_provinsi=b.id_provinsi','LEFT')
					->join('jenis_asrama c','a.id_jenis=c.id_jenis','LEFT')
					->get();
		return $data;
	}
	function get_all(){
		$data=$this->db->select('*')
					->from('asrama a')
					->join('provinsi b','a.id_provinsi=b.id_provinsi','LEFT')
					->join('jenis_asrama c','a.id_jenis=c.id_jenis','LEFT')
					->get();
					return $data->result();
	}
	function get_by_id($id_asrama){
		$data = $this->db->select('*')
					->from('asrama a')
					->join('provinsi b', 'a.id_provinsi = b.id_provinsi', 'LEFT')
					->join('jenis_asrama c', 'a.id_jenis = c.id_jenis', 'LEFT')
					->where('a.id_asrama', $id_asrama)
					->get();
		return $data->row();
	}
	function insert($data=array()){
		$this->db->insert('asrama',$data);
		$info='<div class="alert alert-success alert-dismissible">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	            <h4><i class="icon fa fa-check"></i> Sukses!</h4> Data Sukses Ditambah </div>';
	    $this->session->set_flashdata('info',$info);
	}
	function insert_batch($data=array()){
		$this->db->insert_batch('asrama',$data);
		$info='<div class="alert alert-success alert-dismissible">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	            <h4><i class="icon fa fa-check"></i> Sukses!</h4> Data Sukses Ditambah </div>';
	    $this->session->set_flashdata('info',$info);
	}
	function update($data=array(),$where=array()){
		foreach ($where as $key => $value) {
			$this->db->where($key,$value);
		}
		$this->db->update('asrama',$data);
		$info='<div class="alert alert-success alert-dismissible">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                <h4><i class="icon fa fa-check"></i> Sukses!</h4> Data Sukses diubah </div>';
	    $this->session->set_flashdata('info',$info);
	}
	function delete($where=array()){
		foreach ($where as $key => $value) {
			$this->db->where($key,$value);
		}
		$this->db->delete('asrama');
		$info='<div class="alert alert-success alert-dismissible">
	            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	            <h4><i class="icon fa fa-check"></i> Sukses!</h4> Data Sukses dihapus </div>';
	    $this->session->set_flashdata('info',$info);
	}
	    // Method untuk mengambil jumlah total asrama
		public function get_total_asrama()
	{
			return $this->db->count_all('asrama');
	}
	
		// Method untuk mengambil jumlah asrama berdasarkan provinsi
		public function get_asrama_by_provinsi()
	{
			$this->db->select('provinsi.nama_provinsi, COUNT(asrama.id_asrama) as total');
			$this->db->from('asrama');
			$this->db->join('provinsi', 'provinsi.id_provinsi = asrama.id_provinsi', 'left');
			$this->db->group_by('provinsi.id_provinsi');
			return $this->db->get()->result_array();
	}
}
