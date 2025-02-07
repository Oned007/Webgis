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
}