<?php
defined('BASEPATH') OR die('No direct script access allowed!');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Absensi_model', 'absensi');
        $this->load->model('Karyawan_model', 'karyawan');
        $this->load->model('Jam_model', 'jam');
        $this->load->model('Pengajuan_model', 'pengajuan');
    }

    public function index()
    {
        $data['karyawan'] = $this->karyawan->get_all();
        $data['user'] = $this->karyawan->jumlahUser();
        $data['menunggu'] = $this->pengajuan->jumlahnunggu();
        $data['terima'] = $this->pengajuan->jumlahterima();
        $data['tolak'] = $this->pengajuan->jumlahtolak();
        
        return $this->template->load('template', 'dashboard', $data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        session_destroy();
        redirect(base_url());
    }
}



/* End of File: d:\Ampps\www\project\absen-pegawai\application\controllers\Dashboard.php */