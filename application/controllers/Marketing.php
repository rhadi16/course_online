<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Marketing extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Marketing_model');
        $this->load->library('form_validation');

        is_logged_in();
        cek_siswa();
        time_login();
    }

    public function index()
    {
        $data['account'] = $this->db->get_where('accounts', ['email' => $this->session->userdata('email')])->row_array();
        $data['profile'] = $this->db->get_where('profile', ['id' => $this->session->userdata('id')])->row_array();
        $data['marketing'] = $this->db->get_where('marketing', ['id' => $this->session->userdata('id')])->row_array();

        $data['judul'] = "Home";

        $this->load->view('templates/marketing_header', $data);
        $this->load->view('marketing/index');
        $this->load->view('templates/marketing_footer');
    }
    public function edit()
    {
        $data['csrf'] = csrf();
        $data['account'] = $this->db->get_where('accounts', ['email' => $this->session->userdata('email')])->row_array();
        $data['profile'] = $this->db->get_where('profile', ['id' => $this->session->userdata('id')])->row_array();

        $data['judul'] = "My Profile";

        if ($this->input->post('email') == $data['account']['email']) {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim', array('required' => 'Email Harus Diisi', 'valid_email' => 'Isi Email Denga Format yang Benar'));
        } else {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|is_unique[accounts.email]', array('required' => 'Email Harus Diisi', 'valid_email' => 'Isi Email Denga Format yang Benar', 'is_unique' => 'Email Telah Digunakan'));
        }

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', array('required' => 'Nama Harus Diisi'));
        $this->form_validation->set_rules('asal', 'Asal Kota', 'required|trim', array('required' => 'Asal Kota Harus Diisi'));
        $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required|trim', array('required' => 'Nomor HP Harus Diisi'));
        $this->form_validation->set_rules('tglahir', 'Tanggal Lahir', 'required|trim', array('required' => 'Tanggal Lahir Harus Diisi'));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/marketing_header', $data);
            $this->load->view('marketing/edit', $data);
            $this->load->view('templates/marketing_footer');
        } else {
            $this->Marketing_model->editProfile($data['profile']['image']);

            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Profile Telah Diubah.</div>');
            redirect('marketing/edit');
        }
    }
    public function settingpassword()
    {
        $data['csrf'] = csrf();
        $data['account'] = $this->db->get_where('accounts', ['email' => $this->session->userdata('email')])->row_array();
        $data['profile'] = $this->db->get_where('profile', ['id' => $this->session->userdata('id')])->row_array();

        $data['judul'] = "Setting Password";

        $this->form_validation->set_rules('password_lama', 'Password Sekarang', 'required|trim', array('required' => 'Password Harus Diisi'));
        $this->form_validation->set_rules('password_baru1', 'Password Baru', 'required|trim|min_length[8]|matches[password_baru2]', array('required' => 'Password Harus Diisi', 'min_length' => 'Panjang Password Harus Lebih 8 Karakter', 'matches' => 'Password Baru Tidak Sama Repeat Password'));
        $this->form_validation->set_rules('password_baru2', 'Repeat Password Baru', 'required|trim', array('required' => 'Repeat Password Baru Harus Diisi'));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/marketing_header', $data);
            $this->load->view('marketing/settingpassword', $data);
            $this->load->view('templates/marketing_footer');
        } else {
            $password_lama = $this->input->post('password_lama');
            $password_baru = $this->input->post('password_baru1');

            if (!password_verify($password_lama, $data['account']['password'])) {
                $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Password yang Dimasukkan Salah!</div>');
                redirect('marketing/settingpassword');
            } else {
                if ($password_lama == $password_baru) {
                    $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Password yang Baru Tidak Boleh Sama dengan Password Lama!</div>');
                    redirect('marketing/settingpassword');
                } else {
                    // password ok
                    $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);

                    $this->Marketing_model->settingpassword($password_hash);

                    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Password Telah Diubah.</div>');
                    redirect('marketing/settingpassword');
                }
            }
        }
    }
    public function santri()
    {
        $data['csrf'] = csrf();
        $data['account'] = $this->db->get_where('accounts', ['email' => $this->session->userdata('email')])->row_array();
        $data['profile'] = $this->db->get_where('profile', ['id' => $this->session->userdata('id')])->row_array();

        $data['judul'] = "Kelola Santri";
        $data['santri'] = $this->Marketing_model->listSantri();

        $this->load->view('templates/marketing_header', $data);
        $this->load->view('marketing/santri', $data);
        $this->load->view('templates/marketing_footer');
    }
    public function tambah_santri()
    {
        $data['csrf'] = csrf();
        $data['account'] = $this->db->get_where('accounts', ['email' => $this->session->userdata('email')])->row_array();
        $data['profile'] = $this->db->get_where('profile', ['id' => $this->session->userdata('id')])->row_array();

        $data['judul'] = "Kelola Santri";

        $this->form_validation->set_rules('id', 'ID', 'required|is_unique[santri.id]', array('required' => 'ID Harus Diisi', 'is_unique' => 'ID Sudah Digunakan'));
        $this->form_validation->set_rules('nama', 'Nama', 'required', array('required' => 'Nama Harus Diisi'));
        $this->form_validation->set_rules('jkl', 'Jenis Kelamin', 'required|callback_check_jkl');
        $this->form_validation->set_message('check_jkl', 'Jenis Kelamin Harus Diisi');
        $this->form_validation->set_rules('asal', 'Asal Kota', 'required', array('required' => 'Asal Kota Harus Diisi'));
        $this->form_validation->set_rules('tglahir', 'Tanggal Lahir', 'required', array('required' => 'Tanggal Lahir Harus Diisi'));
        $this->form_validation->set_rules('alamat', 'Alamat', 'required', array('required' => 'Alamat Harus Diisi'));
        $this->form_validation->set_rules('hafalan', 'Hafalan Al-Qur\'an', 'required', array('required' => 'Hafalan Al-Qur\'an Harus Diisi'));
        $this->form_validation->set_rules('kemampuan_ngaji', 'Kemampuan Mengaji', 'required|callback_check_kemampuanngaji');
        $this->form_validation->set_message('check_kemampuanngaji', 'Kemampuan Mengaji Harus Diisi');
        $this->form_validation->set_rules('kemampuan_bahasa', 'Kemampuan Bahasa', 'required', array('required' => 'Kemampuan Bahasa Harus Diisi'));
        $this->form_validation->set_rules('ustadz-dzah', 'Ustadz/Ustadzah', 'required', array('required' => 'Ustadz/Ustadzah Harus Diisi'));
        $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required', array('required' => 'Nomor HP Harus Diisi'));
        $this->form_validation->set_rules('program', 'Program', 'required|callback_check_program');
        $this->form_validation->set_message('check_program', 'Program Harus Diisi');
        $this->form_validation->set_rules('wkt_bljr', 'Waktu Belajar yang Diharapkan', 'required', array('required' => 'Waktu Belajar yang Diharapkan Harus Diisi'));
        $this->form_validation->set_rules('wkt_luang', 'Waktu Luang', 'required', array('required' => 'Waktu Luang Harus Diisi'));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/marketing_header', $data);
            $this->load->view('marketing/tambah_santri', $data);
            $this->load->view('templates/marketing_footer');
        } else {
            $this->Marketing_model->tambahSantri();
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Santri Berhasil Dihapus.</div>');
            redirect('marketing/santri');
        }
    }
    public function edit_santri($id)
    {
        $data['csrf'] = csrf();
        $data['account'] = $this->db->get_where('accounts', ['email' => $this->session->userdata('email')])->row_array();
        $data['profile'] = $this->db->get_where('profile', ['id' => $this->session->userdata('id')])->row_array();

        $data['judul'] = "Kelola Santri";
        $data['detail'] = $this->Marketing_model->DetailSantri($id);

        if ($this->input->post('id') == $data['detail']['id']) {
            $this->form_validation->set_rules('id', 'ID', 'required|trim', array('required' => 'ID Harus Diisi'));
        } else {
            $this->form_validation->set_rules('id', 'ID', 'required|is_unique[santri.id]|trim', array('required' => 'ID Harus Diisi', 'is_unique' => 'ID Sudah Digunakan'));
        }

        $this->form_validation->set_rules('nama', 'Nama', 'required', array('required' => 'Nama Harus Diisi'));
        $this->form_validation->set_rules('jkl', 'Jenis Kelamin', 'required|callback_check_jkl');
        $this->form_validation->set_message('check_jkl', 'Jenis Kelamin Harus Diisi');
        $this->form_validation->set_rules('asal', 'Asal Kota', 'required', array('required' => 'Asal Kota Harus Diisi'));
        $this->form_validation->set_rules('tglahir', 'Tanggal Lahir', 'required', array('required' => 'Tanggal Lahir Harus Diisi'));
        $this->form_validation->set_rules('alamat', 'Alamat', 'required', array('required' => 'Alamat Harus Diisi'));
        $this->form_validation->set_rules('hafalan', 'Hafalan Al-Qur\'an', 'required', array('required' => 'Hafalan Al-Qur\'an Harus Diisi'));
        $this->form_validation->set_rules('kemampuan_ngaji', 'Kemampuan Mengaji', 'required|callback_check_kemampuanngaji');
        $this->form_validation->set_message('check_kemampuanngaji', 'Kemampuan Mengaji Harus Diisi');
        $this->form_validation->set_rules('kemampuan_bahasa', 'Kemampuan Bahasa', 'required', array('required' => 'Kemampuan Bahasa Harus Diisi'));
        $this->form_validation->set_rules('ustadz-dzah', 'Ustadz/Ustadzah', 'required', array('required' => 'Ustadz/Ustadzah Harus Diisi'));
        $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required', array('required' => 'Nomor HP Harus Diisi'));
        $this->form_validation->set_rules('program', 'Program', 'required|callback_check_program');
        $this->form_validation->set_message('check_program', 'Program Harus Diisi');
        $this->form_validation->set_rules('wkt_bljr', 'Waktu Belajar yang Diharapkan', 'required', array('required' => 'Waktu Belajar yang Diharapkan Harus Diisi'));
        $this->form_validation->set_rules('wkt_luang', 'Waktu Luang', 'required', array('required' => 'Waktu Luang Harus Diisi'));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/marketing_header', $data);
            $this->load->view('marketing/edit_santri', $data);
            $this->load->view('templates/marketing_footer');
        } else {
            $this->Marketing_model->editSantri();
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Santri Berhasil Diubah.</div>');
            redirect('marketing/santri');
        }
    }

    function check_jkl($post_string)
    {
        return $post_string == '0' ? FALSE : TRUE;
    }
    function check_kemampuanngaji($post_string)
    {
        return $post_string == '0' ? FALSE : TRUE;
    }
    function check_program($post_string)
    {
        return $post_string == '0' ? FALSE : TRUE;
    }
}
