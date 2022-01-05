<?php
defined('BASEPATH') OR die('No direct script access allowed!');

class Jam extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
        redirect_if_level_not('Manager');
        $this->load->model('Jam_model', 'jam');
        $this->load->model('Pengajuan_model', 'pengajuan');
        $this->load->model('Karyawan_model', 'karyawan');
        
    }

    public function index()
    {
        $data['opd'] = $this->jam->get_all();
        $data['stat'] = $this->pengajuan->get_stat();
        $data['pengajuan'] = $this->pengajuan->get_all();
        $data['menunggu'] = $this->pengajuan->jumlahnunggu();
        $data['terima'] = $this->pengajuan->jumlahterima();
        $data['tolak'] = $this->pengajuan->jumlahtolak();
        $data['totalbln'] = $this->pengajuan->jumlahbln();
        $data['totalopd'] = $this->pengajuan->jumlahopd();
        $data['total'] = $this->pengajuan->total();
        
        return $this->template->load('template', 'jam', $data);
    }

    public function update()
    {
        $post = $this->input->post();
        $data = [
            'start' => $post['start'],
            'finish' => $post['finish']
        ];

        $result = $this->jam->update_data($post['id_jam'], $data);
        if ($result) {
            $response = [
                'status' => 'success',
                'message' => 'Jam Kerja telah diubah!',
                'data' => $this->jam->find($post['id_jam'])
            ];
        } else {
            $reponse = [
                'status' => 'error',
                'message' => 'Jam Kerja gagal diubah!'
            ];
        }

        return $this->response_json($response);
    }

    public function response_json($response)
    {
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function editstat()
    {
        $this->form_validation->set_rules('stat', 'Status', 'required');

        if($this->form_validation->run() == false){
            redirect('dashboard');
        }else{
            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            $nip = $this->input->post('nip');
            $OPD = $this->input->post('OPD');
            $no_hp = $this->input->post('no_hp');
            $email = $this->input->post('email');
            $deskripsi = $this->input->post('deskripsi');
            $surat = $this->input->post('surat');
            $tgl_pengajuan = $this->input->post('tgl_pengajuan');
            $Status = $this->input->post('stat');
            $Bulan = $this->input->post('Bulan');
            $data = array(
                'id' => $id,
                'nama' => $nama,
                'nip' => $nip,
                'OPD' => $OPD,
                'no_hp' => $no_hp,
                'email' => $email,
                'deskripsi' => $deskripsi,
                'surat' => $surat,
                'tgl_pengajuan' => $tgl_pengajuan,
                'Status' => $Status,
                'Bulan' => $Bulan
            );

            $this->db->where('id', $id);
            $this->db->update('pengajuan', $data);

            $untuk = $email;
            $judul = "Laporan Pengajuan";
            $isi = "Pengajuan telah ".$Status;
            $header = "From: K1dd13";

            var_dump(mail($untuk, $judul, $isi, $header));

            if(mail($untuk, $judul, $isi, $header)) { redirect('jam?send=Berhasil'); }
            else { redirect('jam?send=Gagal'); }

            $this->send_notif($email, $Status);

            redirect('jam');
        }
    }

    public function send_notif($mail, $stats)
    {
        $config = array(
            'mailtype'  => 'text',
            'charset'   => 'iso-8859-1',
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => 'w.kuliah654@gmail.com',
            'smtp_pass' => 'qwerty22.',
            'smtp_port' => 587
        );

        $this->load->library('email', $config);

        $this->email->initialize($config);

        $this->email->from('w.kuliah654@gmail.com');
        $this->email->to($mail);
        // $this->email->cc('another@another-example.com');
        // $this->email->bcc('them@their-example.com');

        $this->email->subject('Laporan Pengajuan');
        $this->email->message('Pengajuan telah '.$stats);
        $this->email->send();

        // if($this->email->send()) { redirect('jam?send=Berhasil'); }
        // else { redirect('jam?send=Gagal'); }
    }

	public function export_pdf_admin()
	{
		$data = $this->detail_data_absen();
		$this->load->view('print_pengajuan_admin', $data);
	}

	private function detail_data_absen()
	{
		$data['pengajuan'] = $this->pengajuan->get_all();

		return $data;
	}
}



/* End of File: d:\Ampps\www\project\absen-pegawai\application\controllers\Jam.php */
