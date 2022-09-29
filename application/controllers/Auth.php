<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        is_logged_out();
        $data['csrf'] = csrf();
        $data['judul'] = "Login";

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim', array('required' => 'Email Harus Diisi', 'valid_email' => 'Isi Email dengan Format yang Benar'));
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]', array('required' => 'Password Harus Diisi', 'min_length' => 'Password Harus Lebih dari 8 Karakter'));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            $this->Auth_model->login();
        }
    }
    public function registrasi()
    {
        is_logged_out();
        $data['csrf'] = csrf();
        $data['judul'] = "Registration";
        $data['lok_int'] =  $this->Auth_model->getAllLokInt();

        $this->form_validation->set_rules('nama', 'Nama', 'required', array('required' => 'Nama Harus Diisi'));
        $this->form_validation->set_rules('asal', 'Asal', 'required', array('required' => 'Asal Harus Diisi'));
        $this->form_validation->set_rules('tglahir', 'Tanggal Lahir', 'required', array('required' => 'Tanggal Lahir Harus Diisi'));
        $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required', array('required' => 'Nomor HP Harus Diisi'));
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|is_unique[accounts.email]', array('required' => 'Email Harus Diisi', 'valid_email' => 'Isi Email Dengan Format yang Benar', 'is_unique' => 'Email Telah Digunakan'));
        $this->form_validation->set_rules('lok_inter', 'Lokasi Mentoring', 'required|callback_check_lokint');
        $this->form_validation->set_message('check_lokint', 'Lokasi Mentoring Harus Diisi');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]|matches[repeat_password]', array('required' => 'Password Harus Diisi', 'min_length' => 'Password Harus Lebih 8 Karakter', 'matches' => 'Password Tidak Sama Repeat Password'));
        $this->form_validation->set_rules('repeat_password', 'Repeat Password', 'required|trim|min_length[8]', array('required' => 'Repeat Password Harus Diisi', 'min_length' => 'Repeat Password Harus Lebih 8 Karakter'));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registrasi');
            $this->load->view('templates/auth_footer');
        } else {
            $this->Auth_model->registration();

            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Anda Telah Melakukan Registrasi. Silahkan Tunggu Admin Untuk Aktivasi Akun Anda</div>');
            redirect('auth');
        }
    }
    function check_lokint($post_string)
    {
        return $post_string == '0' ? FALSE : TRUE;
    }
    public function logout()
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->unset_userdata('expired');
        delete_cookie('remember_me');

        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Anda Telah Logout.</div>');
        redirect('auth');
    }
}
