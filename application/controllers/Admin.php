<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->library('form_validation');
        $this->load->library('pagination');

        is_logged_in();
        cek_admin();
        time_login();
    }

    public function index()
    {
        $data['account'] = $this->db->get_where('accounts', ['email' => $this->session->userdata('email')])->row_array();
        $data['profile'] = $this->db->get_where('profile', ['id' => $this->session->userdata('id')])->row_array();

        $data['judul'] = "Home";

        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/index');
        $this->load->view('templates/admin_footer');
    }
    // start of manage guru
    public function mentor()
    {
        $data['csrf'] = csrf();
        $data['account'] = $this->db->get_where('accounts', ['email' => $this->session->userdata('email')])->row_array();
        $data['profile'] = $this->db->get_where('profile', ['id' => $this->session->userdata('id')])->row_array();
        $data['judul'] = "Kelola Mentor";

        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }
        $config['base_url'] = base_url() . 'admin/mentor';

        $this->db->select('*, profile.id id_mentor');
        $this->db->from('profile');
        $this->db->join('role', 'role.id = profile.role_id', 'left');
        $this->db->join('accounts', 'accounts.id = profile.id', 'left');
        $this->db->where('profile.id !=', 1234);
        $this->db->where('profile.role_id =', 2);
        $this->db->like('nama', $data['keyword']);

        $config['total_rows'] = $this->db->count_all_results();
        $config['per_page'] = 8;
        $from = $this->uri->segment(3);

        $data['mentor'] =  $this->Admin_model->getAllMentor($config['per_page'], $from, $data['keyword']);

        $this->pagination->initialize($config);

        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/mentor', $data);
        $this->load->view('templates/admin_footer');
    }
    public function tambah_mentor()
    {
        $data['csrf'] = csrf();
        $data['account'] = $this->db->get_where('accounts', ['email' => $this->session->userdata('email')])->row_array();
        $data['profile'] = $this->db->get_where('profile', ['id' => $this->session->userdata('id')])->row_array();
        $data['mapel'] = $this->db->get('ref_mapel')->result_array();
        $data['judul'] = "Kelola Mentor";

        $this->form_validation->set_rules('id', 'ID', 'required|is_unique[accounts.id]|trim', array('required' => 'ID Harus Diisi', 'is_unique' => 'ID Telah Digunakan'));
        $this->form_validation->set_rules('nama', 'Nama', 'required', array('required' => 'Nama Harus Diisi'));
        $this->form_validation->set_rules('asal', 'Asal', 'required', array('required' => 'Asal Kota Harus Diisi'));
        $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required', array('required' => 'Nomor HP Harus Diisi'));
        $this->form_validation->set_rules('tglahir', 'Tanggal Lahir', 'required', array('required' => 'Tanggal Lahir Harus Diisi'));
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|is_unique[accounts.email]', array('required' => 'Email Harus Diisi', 'valid_email' => 'Isi Email Denga Format yang Benar', 'is_unique' => 'Email Telah Digunakan'));
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]|matches[password2]', array('required' => 'Password Harus Diisi', 'min_length' => 'Password Harus Lebih 8 Karakter', 'matches' => 'Password Tidak Sama Repeat Password'));
        $this->form_validation->set_rules('password2', 'Repeat Password', 'required', array('required' => 'Repeat Password Harus Diisi'));

        if ($this->form_validation->run() == FALSE) {
            $data['input'] = array(
                'id' => $this->input->post('id'),
                'nama' => $this->input->post('nama'),
                'asal' => $this->input->post('asal'),
                'no_hp' => $this->input->post('no_hp'),
                'tglahir' => $this->input->post('tglahir'),
                'email' => $this->input->post('email')
            );

            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/tambah_mentor', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $this->Admin_model->tambahMentor();
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Mentor Berhasil Ditambahkan.</div>');
            redirect('admin/mentor');
        }
    }
    public function edit_mentor($id)
    {
        $data['csrf'] = csrf();
        $data['account'] = $this->db->get_where('accounts', ['email' => $this->session->userdata('email')])->row_array();
        $data['profile'] = $this->db->get_where('profile', ['id' => $this->session->userdata('id')])->row_array();
        $data['mapel'] = $this->db->get('ref_mapel')->result_array();
        $data['judul'] = "Kelola Mentor";

        $data['detail'] = $this->Admin_model->detailMentor($id);

        if ($this->input->post('id') == $id) {
            $this->form_validation->set_rules('id', 'ID', 'required|trim', array('required' => 'ID Harus Diisi'));
        } else {
            $this->form_validation->set_rules('id', 'ID', 'required|trim|is_unique[accounts.id]', array('required' => 'ID Harus Diisi', 'is_unique' => 'ID Telah Digunakan'));
        }

        if ($this->input->post('email') == $data['detail']['email']) {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim', array('required' => 'Email Harus Diisi', 'valid_email' => 'Isi Email Denga Format yang Benar'));
        } else {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|is_unique[accounts.email]', array('required' => 'Email Harus Diisi', 'valid_email' => 'Isi Email Denga Format yang Benar', 'is_unique' => 'Email Telah Digunakan'));
        }

        $this->form_validation->set_rules('nama', 'Nama', 'required', array('required' => 'Nama Harus Diisi'));
        $this->form_validation->set_rules('asal', 'Asal', 'required', array('required' => 'Asal Kota Harus Diisi'));
        $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required', array('required' => 'Nomor HP Harus Diisi'));
        $this->form_validation->set_rules('tglahir', 'Tanggal Lahir', 'required', array('required' => 'Tanggal Lahir Harus Diisi'));
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]|matches[password2]', array('required' => 'Password Harus Diisi', 'min_length' => 'Password Harus Lebih 8 Karakter', 'matches' => 'Password Tidak Sama Repeat Password'));
        $this->form_validation->set_rules('password2', 'Repeat Password', 'trim');

        if ($data['detail']) {
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates/admin_header', $data);
                $this->load->view('admin/edit_mentor', $data);
                $this->load->view('templates/admin_footer');
            } else {
                $this->Admin_model->editMentor();
                $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Mentor Berhasil Diubah.</div>');
                redirect('admin/mentor');
            }
        } else {
            redirect('admin/mentor');
        }
    }
    public function hapus_mentor($id)
    {
        $this->Admin_model->hapusDataMentor($id);
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Mentor Berhasil Dihapus.</div>');
        redirect('admin/mentor');
    }
    // end of manage guru

    // start of manage mata pelajaran
    public function mapel()
    {
        $data['csrf'] = csrf();
        $data['account'] = $this->db->get_where('accounts', ['email' => $this->session->userdata('email')])->row_array();
        $data['profile'] = $this->db->get_where('profile', ['id' => $this->session->userdata('id')])->row_array();
        $data['mapel'] =  $this->Admin_model->getAllMapel();

        $data['judul'] = "Kelola Mata Pelajaran";

        $this->form_validation->set_rules('nama_mapel', 'Nama Mata Pelajaran', 'required', array('required' => 'Nama Mata Pelajaran Harus Diisi'));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/mapel', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $this->Admin_model->tambahMapel();
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Mata Pelajaran Berhasil Ditambah.</div>');
            redirect('admin/mapel');
        }
    }
    public function editMapel()
    {
        $data['account'] = $this->db->get_where('accounts', ['email' => $this->session->userdata('email')])->row_array();
        $data['profile'] = $this->db->get_where('profile', ['id' => $this->session->userdata('id')])->row_array();
        $data['mapel'] =  $this->Admin_model->getAllMapel();

        $data['judul'] = "Kelola Mata Pelajaran";

        $this->form_validation->set_rules('nama_mapel', 'Nama Mata Pelajaran', 'required', array('required' => 'Nama Mata Pelajaran Harus Diisi'));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/mapel', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $this->Admin_model->editMapel();
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Mata Pelajaran Berhasil Diubah.</div>');
            redirect('admin/mapel');
        }
    }
    public function hapusMapel($id)
    {
        $this->Admin_model->hapusMapel($id);
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Mata Pelajaran Berhasil Dihapus.</div>');
        redirect('admin/mapel');
    }
    // end of manage mata pelajaran

    // start of manage marketing
    public function marketing()
    {
        $data['csrf'] = csrf();
        $data['account'] = $this->db->get_where('accounts', ['email' => $this->session->userdata('email')])->row_array();
        $data['profile'] = $this->db->get_where('profile', ['id' => $this->session->userdata('id')])->row_array();

        $data['judul'] = "Kelola Marketing";
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }
        $config['base_url'] = base_url() . 'admin/marketing';

        $this->db->select('*, profile.id id_marketing');
        $this->db->from('profile');
        $this->db->join('role', 'role.id = profile.role_id', 'left');
        $this->db->join('accounts', 'accounts.id = profile.id', 'left');
        $this->db->where('profile.id !=', 1234);
        $this->db->where('profile.role_id =', 3);
        $this->db->like('nama', $data['keyword']);

        $config['total_rows'] = $this->db->count_all_results();
        $config['per_page'] = 3;
        $from = $this->uri->segment(3);

        $data['marketing'] =  $this->Admin_model->getAllMarketing($config['per_page'], $from, $data['keyword']);

        $this->pagination->initialize($config);

        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/marketing');
        $this->load->view('templates/admin_footer');
    }
    public function tambah_marketing()
    {
        $data['csrf'] = csrf();
        $data['account'] = $this->db->get_where('accounts', ['email' => $this->session->userdata('email')])->row_array();
        $data['profile'] = $this->db->get_where('profile', ['id' => $this->session->userdata('id')])->row_array();
        $data['judul'] = "Kelola Marketing";

        $this->form_validation->set_rules('id', 'ID', 'required|is_unique[accounts.id]|trim', array('required' => 'ID Harus Diisi', 'is_unique' => 'ID Telah Digunakan'));
        $this->form_validation->set_rules('nama', 'Nama', 'required', array('required' => 'Nama Harus Diisi'));
        $this->form_validation->set_rules('asal', 'Asal', 'required', array('required' => 'Asal Kota Harus Diisi'));
        $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required', array('required' => 'Nomor HP Harus Diisi'));
        $this->form_validation->set_rules('tglahir', 'Tanggal Lahir', 'required', array('required' => 'Tanggal Lahir Harus Diisi'));
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|is_unique[accounts.email]', array('required' => 'Email Harus Diisi', 'valid_email' => 'Isi Email Denga Format yang Benar', 'is_unique' => 'Email Telah Digunakan'));
        $this->form_validation->set_rules('status', 'Status', 'required|callback_check_status');
        $this->form_validation->set_message('check_status', 'Status Harus Diisi');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]|matches[password2]', array('required' => 'Password Harus Diisi', 'min_length' => 'Password Harus Lebih 8 Karakter', 'matches' => 'Password Tidak Sama Repeat Password'));
        $this->form_validation->set_rules('password2', 'Repeat Password', 'required', array('required' => 'Repeat Password Harus Diisi'));

        if ($this->form_validation->run() == FALSE) {
            $data['input'] = array(
                'id' => $this->input->post('id'),
                'nama' => $this->input->post('nama'),
                'asal' => $this->input->post('asal'),
                'no_hp' => $this->input->post('no_hp'),
                'tglahir' => $this->input->post('tglahir'),
                'email' => $this->input->post('email')
            );

            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/tambah_marketing', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $this->Admin_model->tambahMarketing();
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Marketing Berhasil Ditambahkan.</div>');
            redirect('admin/marketing');
        }
    }
    function check_status($post_string)
    {
        return $post_string == '0' ? FALSE : TRUE;
    }
    public function edit_marketing($id)
    {
        $data['csrf'] = csrf();
        $data['account'] = $this->db->get_where('accounts', ['email' => $this->session->userdata('email')])->row_array();
        $data['profile'] = $this->db->get_where('profile', ['id' => $this->session->userdata('id')])->row_array();
        $data['judul'] = "Kelola Marketing";

        $data['detail'] = $this->Admin_model->detailMarketing($id);
        $data['stat_detail'] = $this->Admin_model->statusMarketing($data['detail']['id_marketing']);

        if ($this->input->post('id') == $id) {
            $this->form_validation->set_rules('id', 'ID', 'required|trim', array('required' => 'ID Harus Diisi'));
        } else {
            $this->form_validation->set_rules('id', 'ID', 'required|trim|is_unique[accounts.id]', array('required' => 'ID Harus Diisi', 'is_unique' => 'ID Telah Digunakan'));
        }

        if ($this->input->post('email') == $data['detail']['email']) {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim', array('required' => 'Email Harus Diisi', 'valid_email' => 'Isi Email Denga Format yang Benar'));
        } else {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|is_unique[accounts.email]', array('required' => 'Email Harus Diisi', 'valid_email' => 'Isi Email Denga Format yang Benar', 'is_unique' => 'Email Telah Digunakan'));
        }
        $this->form_validation->set_rules('status', 'Status', 'required|callback_check_status_edit');
        $this->form_validation->set_message('check_status_edit', 'Status Harus Diisi');

        $this->form_validation->set_rules('nama', 'Nama', 'required', array('required' => 'Nama Harus Diisi'));
        $this->form_validation->set_rules('asal', 'Asal', 'required', array('required' => 'Asal Kota Harus Diisi'));
        $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required', array('required' => 'Nomor HP Harus Diisi'));
        $this->form_validation->set_rules('tglahir', 'Tanggal Lahir', 'required', array('required' => 'Tanggal Lahir Harus Diisi'));
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]|matches[password2]', array('required' => 'Password Harus Diisi', 'min_length' => 'Password Harus Lebih 8 Karakter', 'matches' => 'Password Tidak Sama Repeat Password'));
        $this->form_validation->set_rules('password2', 'Repeat Password', 'trim');

        if ($data['detail']) {
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates/admin_header', $data);
                $this->load->view('admin/edit_marketing', $data);
                $this->load->view('templates/admin_footer');
            } else {
                $this->Admin_model->editMarketing();
                $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Marketing Berhasil Diubah.</div>');
                redirect('admin/marketing');
            }
        } else {
            redirect('admin/marketing');
        }
    }
    function check_status_edit($post_string)
    {
        return $post_string == '0' ? FALSE : TRUE;
    }
    public function hapus_marketing($id)
    {
        $this->Admin_model->hapusDataMarketing($id);
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Marketing Berhasil Dihapus.</div>');
        redirect('admin/marketing');
    }
    // end of manage marketing

    // start of manage class
    public function jadwal_kelas()
    {
        $data['csrf'] = csrf();
        $data['account'] = $this->db->get_where('accounts', ['email' => $this->session->userdata('email')])->row_array();
        $data['profile'] = $this->db->get_where('profile', ['id' => $this->session->userdata('id')])->row_array();
        $data['mapel'] = $this->db->get('ref_mapel')->result_array();

        $data['hari'] = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Ahad'];

        $data['judul'] = "Kelola Jadwal Kelas";

        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        $data['kelases'] =  $this->Admin_model->getKelas();
        $data['kelas'] =  $this->Admin_model->getDetailKelas($data['keyword']);

        $this->form_validation->set_rules('nama_kls', 'Nama Kelas', 'required', array('required' => 'Nama Kelas Harus Diisi'));
        $this->form_validation->set_rules('id_mapel', 'Mapel', 'required|callback_check_mapel');
        $this->form_validation->set_message('check_mapel', 'Mata Pelajaran Harus Diisi');
        $this->form_validation->set_rules('hari', 'Hari', 'required|callback_check_hari');
        $this->form_validation->set_message('check_hari', 'Hari Harus Diisi');
        $this->form_validation->set_rules('jam_masuk', 'Jam Masuk', 'required', array('required' => 'Jam Masuk Harus Diisi'));
        $this->form_validation->set_rules('jam_keluar', 'Jam Keluar', 'required', array('required' => 'Jam Keluar Harus Diisi'));
        $this->form_validation->set_rules('id_mentor', 'Mentor', 'required|callback_check_mentor');
        $this->form_validation->set_message('check_mentor', 'Mentor Harus Diisi');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/jadwal_kelas', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $this->Admin_model->tambahJadwal();
        }
    }
    public function tambah_kelas()
    {
        $data['csrf'] = csrf();
        $data['account'] = $this->db->get_where('accounts', ['email' => $this->session->userdata('email')])->row_array();
        $data['profile'] = $this->db->get_where('profile', ['id' => $this->session->userdata('id')])->row_array();
        $data['mapel'] = $this->db->get('ref_mapel')->result_array();

        $data['judul'] = "Kelola Jadwal Kelas";

        $this->form_validation->set_rules('nama_kls', 'Nama Kelas', 'required|is_unique[jadwal.nama_kls]', array('required' => 'Nama Kelas Harus Diisi', 'is_unique' => 'Nama Kelas Sudah Ada'));
        $this->form_validation->set_rules('id_mapel', 'Mapel', 'required|callback_check_mapel');
        $this->form_validation->set_message('check_mapel', 'Mata Pelajaran Harus Diisi');
        $this->form_validation->set_rules('hari', 'Hari', 'required|callback_check_hari');
        $this->form_validation->set_message('check_hari', 'Hari Harus Diisi');
        $this->form_validation->set_rules('jam_masuk', 'Jam Masuk', 'required', array('required' => 'Jam Masuk Harus Diisi'));
        $this->form_validation->set_rules('jam_keluar', 'Jam Keluar', 'required', array('required' => 'Jam Keluar Harus Diisi'));
        $this->form_validation->set_rules('id_mentor', 'Mentor', 'required|callback_check_mentor');
        $this->form_validation->set_message('check_mentor', 'Mentor Harus Diisi');

        if ($this->form_validation->run() == FALSE) {
            $data['input'] = array(
                'nama_kls' => $this->input->post('nama_kls'),
                'hari' => $this->input->post('hari'),
                'jam_masuk' => $this->input->post('jam_masuk'),
                'jam_keluar' => $this->input->post('jam_keluar')
            );

            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/tambah_kelas', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $this->Admin_model->tambahKelas();
        }
    }
    function check_hari($post_string)
    {
        return $post_string == '0' ? FALSE : TRUE;
    }
    function check_mapel($post_string)
    {
        return $post_string == '0' ? FALSE : TRUE;
    }
    function check_mentor($post_string)
    {
        return $post_string == '0' ? FALSE : TRUE;
    }
    public function mentorDetail()
    {
        $postData = $this->input->post('mapel');
        $data['data'] = $this->Admin_model->mentorDetail($postData);
        $data['valC'] = $this->security->get_csrf_hash();

        echo json_encode($data);
    }
    public function hapus_jadwal($id)
    {
        $this->Admin_model->hapusDataJadwal($id);
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Jadwal Berhasil Dihapus.</div>');
        redirect('admin/jadwal_kelas');
    }
    public function hapus_kelas($nama_kls)
    {
        $this->Admin_model->hapusDataKelas($nama_kls);
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Kelas Berhasil Dihapus.</div>');
        redirect('admin/jadwal_kelas');
    }
    // end of manage class

    // start manage santri
    public function santri()
    {
        $data['csrf'] = csrf();
        $data['account'] = $this->db->get_where('accounts', ['email' => $this->session->userdata('email')])->row_array();
        $data['profile'] = $this->db->get_where('profile', ['id' => $this->session->userdata('id')])->row_array();
        $data['kelas'] =  $this->Admin_model->getDetailKelas();

        $data['judul'] = "Kelola Santri";
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }
        $config['base_url'] = base_url() . 'admin/santri';

        $this->db->select('*');
        $this->db->from('santri');
        $this->db->where('nama_kls !=', null);
        $this->db->like('nama', $data['keyword']);
        $this->db->or_like('program', $data['keyword']);

        $config['total_rows'] = $this->db->count_all_results();
        $config['per_page'] = 8;
        $from = $this->uri->segment(3);

        $data['santri'] =  $this->Admin_model->getAllSantri($config['per_page'], $from, $data['keyword']);
        // die(print_r($data['santri']));

        $this->pagination->initialize($config);

        $this->form_validation->set_rules('nama_kls', 'Nama Kelas', 'required', array('required' => 'Nama Kelas Harus Diisi'));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/santri');
            $this->load->view('templates/admin_footer');
        } else {
            $this->Admin_model->editKelasSantriBaru();
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Kelas Berhasil Diubah.</div>');
            redirect('admin/santri');
        }
    }
    public function santri_baru()
    {
        $data['csrf'] = csrf();
        $data['account'] = $this->db->get_where('accounts', ['email' => $this->session->userdata('email')])->row_array();
        $data['profile'] = $this->db->get_where('profile', ['id' => $this->session->userdata('id')])->row_array();
        $data['kelas'] =  $this->Admin_model->getDetailKelas();

        $data['judul'] = "Kelola Santri";
        $data['judul2'] = "Kelola Santri Baru";
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }
        $config['base_url'] = base_url() . 'admin/santri_baru';

        $this->db->select('*');
        $this->db->from('santri');
        $this->db->where('nama_kls =', null);
        $this->db->like('nama', $data['keyword']);
        $this->db->or_like('program', $data['keyword']);

        $config['total_rows'] = $this->db->count_all_results();
        $config['per_page'] = 8;
        $from = $this->uri->segment(3);

        $data['santri'] =  $this->Admin_model->getAllSantriBaru($config['per_page'], $from, $data['keyword']);
        // die(print_r($data['santri']));

        $this->pagination->initialize($config);

        $this->form_validation->set_rules('nama_kls', 'Nama Kelas', 'required', array('required' => 'Nama Kelas Harus Diisi'));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/santri');
            $this->load->view('templates/admin_footer');
        } else {
            $this->Admin_model->editKelasSantriBaru();
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Kelas Berhasil Ditambahkan.</div>');
            redirect('admin/santri_baru');
        }
    }
}
