<?php
defined('BASEPATH') OR die('No direct script access allowed!');

class Jam_model extends CI_Model
{
    public function get_all()
    {
        $result = $this->db->get('opd');
        return $result->result();
    }

    public function find($id)
    {
        $this->db->where('id_opd', $id);
        $result = $this->db->get('opd');
        return $result->row();
    }

    public function update_data($id, $data)
    {
        $this->db->where('id_opd', $id);
        $result = $this->db->update('opd', $data);
        return $result;
    }
    public function editstat($id, $data)
    {
        $this->db->where('id', $id);
        $result = $this->db->update('pengajuan', $data);
        return $result;
    }
}



/* End of File: d:\Ampps\www\project\absen-pegawai\application\controllers\Jam_model.php */