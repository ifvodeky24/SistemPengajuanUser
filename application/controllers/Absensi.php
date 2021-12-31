<?php
defined('BASEPATH') or die('No direct script access allowed!');

class Absensi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Absensi_model', 'absensi');
        $this->load->model('Karyawan_model', 'karyawan');
        $this->load->model('Jam_model', 'jam');
        $this->load->model('Pengajuan_model', 'pengajuan');
        $this->load->helper('Tanggal');
    }

    public function index()
    {
        if (is_level('Karyawan')) {
            return $this->detail_absensi();
        } else {
            return $this->list_karyawan();
        }
    }

    public function list_karyawan()
    {
        $data['karyawan'] = $this->karyawan->get_all();
        return $this->template->load(
            'template',
            'absensi/list_karyawan',
            $data
        );
    }

    public function detail_absensi()
    {
        $data = $this->detail_data_absen();
        $data['pengajuan'] = $this->pengajuan->get_all();
        return $this->template->load('template', 'absensi/detail', $data);
    }

    public function check_absen()
    {
        $id_user = $this->session->id_user;
        $nip = $this->session->nip;


        $now = date('H:i:s');
        $data['absen'] = $this->absensi
            ->absen_harian_user($this->session->id_user)
            ->num_rows();
        $data['jam'] = $this->jam->get_all();
        $data['nip'] = $this->session->nip;
        $data['karyawan'] = $this->karyawan->get_all();
        return $this->template->load('template', 'absensi/absen', $data);
    }

    public function absen()
    {
        if (@$this->uri->segment(3)) {
            $keterangan = ucfirst($this->uri->segment(3));
        } else {
            $absen_harian = $this->absensi
                ->absen_harian_user($this->session->id_user)
                ->num_rows();
            $keterangan =
                $absen_harian < 2 && $absen_harian < 1 ? 'Masuk' : 'Pulang';
        }

        $data = [
            'tgl' => date('Y-m-d'),
            'waktu' => date('H:i:s'),
            'keterangan' => $keterangan,
            'id_user' => $this->session->id_user,
        ];
        $result = $this->absensi->insert_data($data);
        if ($result) {
            $this->session->set_flashdata('response', [
                'status' => 'success',
                'message' => 'Absensi berhasil dicatat',
            ]);
        } else {
            $this->session->set_flashdata('response', [
                'status' => 'error',
                'message' => 'Absensi gagal dicatat',
            ]);
        }
        redirect('absensi/detail_absensi');
    }

    public function export_pdf()
    {
        $data = $this->detail_data_absen();
        $filename =
            'Pengajuan User ' .
            $data['karyawan']->nama .
            ' - ' .
            bulan($data['bulan']) .
            ' ' .
            $data['tahun'] .
            '.pdf';
        $this->load->view('absensi/print_pdf', $data);
    }

    private function detail_data_absen()
    {
        $id_user = @$this->uri->segment(3)
            ? $this->uri->segment(3)
            : $this->session->id_user;
        $bulan = @$this->input->get('bulan')
            ? $this->input->get('bulan')
            : date('m');
        $tahun = @$this->input->get('tahun')
            ? $this->input->get('tahun')
            : date('Y');

        $level = $this->session->level;
        $nip = $this->session->nip;
       

        $data['karyawan'] = $this->karyawan->find($id_user);
        $data['absen'] = $this->absensi->get_absen($id_user, $bulan, $tahun);
        $data['jam_kerja'] = (array) $this->jam->get_all();
        $data['all_bulan'] = bulan();

        if($level == 'Manager'){
            $data['pengajuan'] = $this->pengajuan->get_all();
        } else {
            $data['pengajuan'] = $this->pengajuan->find($nip);
        }
        
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['hari'] = hari_bulan($bulan, $tahun);

        return $data;
    }

    public function tambah_pengajuan()
    {
        $config['upload_path'] = './file/';
        $config['allowed_types'] = 'gif|jpg|png|pdf|docx';
        $config['max_size'] = 100000;
        $config['max_width'] = 100000;
        $config['max_height'] = 100000;

        $this->load->library('upload', $config);
        // initialize config, i don't why if without initialize the files no readed.
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('userfile')) {
            echo 'Gagal Upload';
        } else {
            // get data upload
            $surat = $this->upload->data();
            $surat = $surat['file_name'];
            $nip = $this->session->nip;
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $deskripsi = $this->input->post('deskripsi');
            $OPD = $this->input->post('OPD');
            $surat = $surat;
            $Status = 'Menunggu';

            $data = [
                'nip' => $nip,
                'nama' => $nama,
                'OPD' => $OPD,
                'email' => $email,
                'deskripsi' => $deskripsi,
                'surat' => $surat,
                'Status' => $Status,
            ];
            $this->db->insert('pengajuan', $data);
            redirect('absensi/detail_absensi');
        }
    }
}

/* End of File: d:\Ampps\www\project\absen-pegawai\application\controllers\Absensi.php */
