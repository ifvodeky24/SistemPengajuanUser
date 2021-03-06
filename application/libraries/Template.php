<?php
defined('BASEPATH') OR die('No direct script access allowed!');

class Template 
{
    public function load($template, $page, $data = [], $return = FALSE)
    {
        date_default_timezone_set('Asia/Jakarta');
        $CI =& get_instance();
        $page_data['content'] = $CI->load->view($page, $data, TRUE);
        return $CI->load->view($template, $page_data, $return);
    }

    public function count_user()
    {
        $this->ci->load->model('Karyawan_model');
        return $this->ci->Karyawan_model->get()->num_rows();
    }
}

