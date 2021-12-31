<?php
defined('BASEPATH') OR die('No direct script access allowed!');

class Pengajuan_model extends CI_Model
{
  public function get_all()
  {
    $result = $this->db->get('pengajuan');
    return $result->result();
  }
  public function get_stat()
  {
    $result = $this->db->get('status');
    return $result->result();
  }

  public function jumlahnunggu()
  {
    $this->db->select('*');
    $this->db->from('pengajuan');
    $this->db->where('Status', 'menunggu');
    
    return $this->db->get()->num_rows();
  }

  public function jumlahterima()
  {
    $this->db->select('*');
    $this->db->from('pengajuan');
    $this->db->where('Status', 'Diterima');
    
    return $this->db->get()->num_rows();
  }
  public function jumlahtolak()
  {
    $this->db->select('*');
    $this->db->from('pengajuan');
    $this->db->where('Status', 'Ditolak');
    
    return $this->db->get()->num_rows();
  }
  public function jumlahbln()
  {
    $this->db->select('*');
    $this->db->from('pengajuan');
    $this->db->where('Bulan', 'Oktober');
    
    return $this->db->get()->num_rows();
  }
  public function jumlahopd()
  {
    $this->db->select('*');
    $this->db->from('pengajuan');
    $this->db->where('opd', 'Dinas Sosial');
    
    return $this->db->get()->num_rows();
  }

  public function total()
  {
    $this->db->select('*');
    $this->db->from('pengajuan');
    
    return $this->db->get()->num_rows();
  }

  public function hapus_data($where, $table)
  {
    $this->db->where($where);
    $this->db->delete($table);
  }

  public function find($nip)
    {
        $this->db->where('nip', $nip);
        $result = $this->db->get('pengajuan');
        return $result->result();
    }
}
