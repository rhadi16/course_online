<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
        // marketing
        $data['jum_marketing'] = $this->db->get('marketing')->num_rows();
        $data['detJumMarketing'] = $this->Admin_model->detJumMarketing();
        // mentor
        $data['jum_mentor'] = $this->Admin_model->detJumMentor();
        $data['allMapel'] = $this->Admin_model->getAllMapel();
        // santri
        $data['jum_santri'] = $this->db->get('santri')->num_rows();
        $data['jum_santri_baru'] = $this->db->get_where('santri', ['nama_kls' => null])->num_rows();
        $data['jum_santri_lama'] = $this->db->get_where('santri', ['nama_kls !=' => null])->num_rows();

        $data['judul'] = "Home";

        $this->load->view('templates/admin_header', $data);
        $this->load->view('admin/index');
        $this->load->view('templates/admin_footer');
    }
    public function akun_baru()
    {
        $data['csrf'] = csrf();
        $data['account'] = $this->db->get_where('accounts', ['email' => $this->session->userdata('email')])->row_array();
        $data['profile'] = $this->db->get_where('profile', ['id' => $this->session->userdata('id')])->row_array();
        $data['akun_baru'] =  $this->Admin_model->getAllNewAkun();
        $data['lok_int'] =  $this->Admin_model->getAllLokInt();

        $data['judul'] = "Kelola Akun Baru";

        $this->form_validation->set_rules('id', 'ID', 'required|is_unique[accounts.id]|trim', array('required' => 'ID Harus Diisi', 'is_unique' => 'ID Telah Digunakan'));
        $this->form_validation->set_rules('nama', 'Nama', 'required', array('required' => 'Nama Harus Diisi'));
        $this->form_validation->set_rules('asal', 'Asal', 'required', array('required' => 'Asal Kota Harus Diisi'));
        $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required', array('required' => 'Nomor HP Harus Diisi'));
        $this->form_validation->set_rules('tglahir', 'Tanggal Lahir', 'required', array('required' => 'Tanggal Lahir Harus Diisi'));
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|is_unique[accounts.email]', array('required' => 'Email Harus Diisi', 'valid_email' => 'Isi Email Denga Format yang Benar', 'is_unique' => 'Email Telah Digunakan'));
        $this->form_validation->set_rules('lok_inter', 'Lokasi Mentoring', 'required|callback_check_lokint');
        $this->form_validation->set_message('check_lokint', 'Lokasi Mentoring Harus Diisi');
        $this->form_validation->set_rules('role_id', 'Role', 'required|callback_check_role');
        $this->form_validation->set_message('check_role', 'Role Harus Diisi');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/akun_baru', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $this->Admin_model->tambahAkun();
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Akun Baru Berhasil Ditambah.</div>');
            redirect('admin/akun_baru');
        }
    }
    function check_role($post_string)
    {
        return $post_string == '0' ? FALSE : TRUE;
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
        $this->db->join('lokasi_internasional', 'lokasi_internasional.id = profile.lok_inter', 'left');
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
        $data['lok_int'] =  $this->Admin_model->getAllLokInt();
        $data['judul'] = "Kelola Mentor";

        $this->form_validation->set_rules('id', 'ID', 'required|is_unique[accounts.id]|trim', array('required' => 'ID Harus Diisi', 'is_unique' => 'ID Telah Digunakan'));
        $this->form_validation->set_rules('nama', 'Nama', 'required', array('required' => 'Nama Harus Diisi'));
        $this->form_validation->set_rules('asal', 'Asal', 'required', array('required' => 'Asal Kota Harus Diisi'));
        $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required', array('required' => 'Nomor HP Harus Diisi'));
        $this->form_validation->set_rules('tglahir', 'Tanggal Lahir', 'required', array('required' => 'Tanggal Lahir Harus Diisi'));
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|is_unique[accounts.email]', array('required' => 'Email Harus Diisi', 'valid_email' => 'Isi Email Denga Format yang Benar', 'is_unique' => 'Email Telah Digunakan'));
        $this->form_validation->set_rules('lok_inter', 'Lokasi Mentoring', 'required|callback_check_lokint');
        $this->form_validation->set_message('check_lokint', 'Lokasi Mentoring Harus Diisi');
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
        $data['lok_int'] =  $this->Admin_model->getAllLokInt();
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
    // start of manage Lokasi Internasional
    public function lokasi_internasional()
    {
        $data['csrf'] = csrf();
        $data['account'] = $this->db->get_where('accounts', ['email' => $this->session->userdata('email')])->row_array();
        $data['profile'] = $this->db->get_where('profile', ['id' => $this->session->userdata('id')])->row_array();
        $data['lok_int'] =  $this->Admin_model->getAllLokInt();

        $data['judul'] = "Kelola Lokasi Internasional";

        $this->form_validation->set_rules('negara', 'Negara', 'required', array('required' => 'Negara Harus Diisi'));
        $this->form_validation->set_rules('provinsi', 'Provinsi', 'required', array('required' => 'Provinsi Harus Diisi'));
        $this->form_validation->set_rules('kota', 'Kota', 'required', array('required' => 'Kota Harus Diisi'));
        $this->form_validation->set_rules('alamat', 'Alamat', 'required', array('required' => 'Alamat Harus Diisi'));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/lok_int', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $this->Admin_model->tambahLokInt();
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Lokasi Baru Berhasil Ditambah.</div>');
            redirect('admin/lokasi_internasional');
        }
    }
    public function editLokInt()
    {
        $data['csrf'] = csrf();
        $data['account'] = $this->db->get_where('accounts', ['email' => $this->session->userdata('email')])->row_array();
        $data['profile'] = $this->db->get_where('profile', ['id' => $this->session->userdata('id')])->row_array();
        $data['lok_int'] =  $this->Admin_model->getAllLokInt();

        $data['judul'] = "Kelola Lokasi Internasional";

        $this->form_validation->set_rules('negara', 'Negara', 'required', array('required' => 'Negara Harus Diisi'));
        $this->form_validation->set_rules('provinsi', 'Provinsi', 'required', array('required' => 'Provinsi Harus Diisi'));
        $this->form_validation->set_rules('kota', 'Kota', 'required', array('required' => 'Kota Harus Diisi'));
        $this->form_validation->set_rules('alamat', 'Alamat', 'required', array('required' => 'Alamat Harus Diisi'));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('admin/lok_int', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $this->Admin_model->editLokInt();
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Lokasi Berhasil Diubah.</div>');
            redirect('admin/lokasi_internasional');
        }
    }
    public function hapusLokInt($id)
    {
        $this->Admin_model->hapusLokInt($id);
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Lokasi Berhasil Dihapus.</div>');
        redirect('admin/lokasi_internasional');
    }
    // end of manage Lokasi Internasional

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
        $this->db->join('lokasi_internasional', 'lokasi_internasional.id = profile.lok_inter', 'left');
        $this->db->where('profile.id !=', 1234);
        $this->db->where('profile.role_id =', 3);
        $this->db->like('nama', $data['keyword']);

        $config['total_rows'] = $this->db->count_all_results();
        $config['per_page'] = 8;
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
        $data['lok_int'] =  $this->Admin_model->getAllLokInt();
        $data['judul'] = "Kelola Marketing";

        $this->form_validation->set_rules('id', 'ID', 'required|is_unique[accounts.id]|trim', array('required' => 'ID Harus Diisi', 'is_unique' => 'ID Telah Digunakan'));
        $this->form_validation->set_rules('nama', 'Nama', 'required', array('required' => 'Nama Harus Diisi'));
        $this->form_validation->set_rules('asal', 'Asal', 'required', array('required' => 'Asal Kota Harus Diisi'));
        $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required', array('required' => 'Nomor HP Harus Diisi'));
        $this->form_validation->set_rules('tglahir', 'Tanggal Lahir', 'required', array('required' => 'Tanggal Lahir Harus Diisi'));
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|is_unique[accounts.email]', array('required' => 'Email Harus Diisi', 'valid_email' => 'Isi Email Denga Format yang Benar', 'is_unique' => 'Email Telah Digunakan'));
        $this->form_validation->set_rules('lok_inter', 'Lokasi Mentoring', 'required|callback_check_lokint');
        $this->form_validation->set_message('check_lokint', 'Lokasi Mentoring Harus Diisi');
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

        $data['lok_int'] =  $this->Admin_model->getAllLokInt();
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
        $this->form_validation->set_rules('lok_inter', 'Lokasi Mentoring', 'required|callback_check_lokint');
        $this->form_validation->set_message('check_lokint', 'Lokasi Mentoring Harus Diisi');
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
    function check_lokint($post_string)
    {
        return $post_string == '0' ? FALSE : TRUE;
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

            $data['keyword2'] = $this->input->post('keyword2');
            $this->session->set_userdata('keyword2', $data['keyword2']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
            $data['keyword2'] = $this->session->userdata('keyword2');
        }

        $data['kelases'] =  $this->Admin_model->getKelas();
        $data['kelas'] =  $this->Admin_model->getDetailKelas($data['keyword'], $data['keyword2']);

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
        $this->form_validation->set_rules('program', 'Program', 'required|callback_check_program');
        $this->form_validation->set_message('check_program', 'Program Harus Diisi');

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
    function check_program($post_string)
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
        $this->form_validation->set_rules('program', 'Program', 'required|callback_check_program1');
        $this->form_validation->set_message('check_program1', 'Program Harus Diisi');

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
        $this->form_validation->set_rules('program', 'Program', 'required|callback_check_program1');
        $this->form_validation->set_message('check_program1', 'Program Harus Diisi');
        if (empty($_FILES['bukti_byr']['name'])) {
            $this->form_validation->set_rules('bukti_byr', 'Bukti Bayar', 'required', array('required' => 'Bukti Bayar Harus Diisi'));
        }

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
    function check_program1($post_string)
    {
        return $post_string == '0' ? FALSE : TRUE;
    }
    public function hapus_santri($id)
    {
        $this->Admin_model->hapusDataSantri($id);
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Santri Berhasil Dihapus.</div>');
        redirect('admin/santri');
    }
    // end manage santri

    // export
    public function export_excel_mentor()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = [
            'font' => ['bold' => true], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        $sheet->setCellValue('A1', "DATA MENTOR"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $sheet->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
        $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
        // Buat header tabel nya pada baris ke 3
        $sheet->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $sheet->setCellValue('B3', "ID"); // Set kolom B3 dengan tulisan "NIS"
        $sheet->setCellValue('C3', "NAMA"); // Set kolom C3 dengan tulisan "NAMA"
        $sheet->setCellValue('D3', "TEMPAT, TANGGAL LAHIR"); // Set kolom D3 dengan tulisan "TEMPAT, TANGGAL LAHIR"
        $sheet->setCellValue('E3', "NOMOR HP"); // Set kolom E3 dengan tulisan "NOMOR HP"
        $sheet->setCellValue('F3', "ROLE"); // Set kolom F3 dengan tulisan "ROLE"
        $sheet->setCellValue('G3', "MATA PELAJARAN"); // Set kolom F3 dengan tulisan "MATA PELAJARAN"
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);
        $sheet->getStyle('G3')->applyFromArray($style_col);
        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $mentor =  $this->Admin_model->getAllMentorExport();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($mentor as $data) { // Lakukan looping pada variabel siswa
            $mapel = '';
            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, $data->id);
            $sheet->setCellValue('C' . $numrow, $data->nama);
            $sheet->setCellValue('D' . $numrow, $data->asal . ', ' . date_indo($data->tglahir));
            $sheet->setCellValue('E' . $numrow, $data->no_hp);
            $sheet->setCellValue('F' . $numrow, $data->role);
            $mMentor = $this->Admin_model->mapelMentor($data->id_mentor);
            foreach ($mMentor as $mm) :
                $mapel .= $mm['nama_mapel'] . ', ';
            endforeach;
            $sheet->setCellValue('G' . $numrow, $mapel);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
        $sheet->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $sheet->getColumnDimension('D')->setWidth(30); // Set width kolom D
        $sheet->getColumnDimension('E')->setWidth(30); // Set width kolom E
        $sheet->getColumnDimension('F')->setWidth(30); // Set width kolom F
        $sheet->getColumnDimension('G')->setWidth(50); // Set width kolom G

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $sheet->setTitle("Daftar Mentor");
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Data Mentor.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
    public function export_excel_marketing()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = [
            'font' => ['bold' => true], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        $sheet->setCellValue('A1', "DATA MARKETING"); // Set kolom A1 dengan tulisan "DATA MARKETING"
        $sheet->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
        $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
        // Buat header tabel nya pada baris ke 3
        $sheet->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $sheet->setCellValue('B3', "ID"); // Set kolom B3 dengan tulisan "NIS"
        $sheet->setCellValue('C3', "NAMA"); // Set kolom C3 dengan tulisan "NAMA"
        $sheet->setCellValue('D3', "TEMPAT, TANGGAL LAHIR"); // Set kolom D3 dengan tulisan "TEMPAT, TANGGAL LAHIR"
        $sheet->setCellValue('E3', "NOMOR HP"); // Set kolom E3 dengan tulisan "NOMOR HP"
        $sheet->setCellValue('F3', "ROLE"); // Set kolom F3 dengan tulisan "ROLE"
        $sheet->setCellValue('G3', "STATUS"); // Set kolom F3 dengan tulisan "STATUS"
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);
        $sheet->getStyle('G3')->applyFromArray($style_col);
        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $marketing =  $this->Admin_model->getAllMarketingExport();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($marketing as $data) { // Lakukan looping pada variabel marketing
            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, $data->id_marketing);
            $sheet->setCellValue('C' . $numrow, $data->nama);
            $sheet->setCellValue('D' . $numrow, $data->asal . ', ' . date_indo($data->tglahir));
            $sheet->setCellValue('E' . $numrow, $data->no_hp);
            $sheet->setCellValue('F' . $numrow, $data->role);
            $smarketing = $this->Admin_model->statusMarketing($data->id_marketing);
            $sheet->setCellValue('G' . $numrow, $smarketing[0]['status']);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
        $sheet->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $sheet->getColumnDimension('D')->setWidth(30); // Set width kolom D
        $sheet->getColumnDimension('E')->setWidth(30); // Set width kolom E
        $sheet->getColumnDimension('F')->setWidth(30); // Set width kolom F
        $sheet->getColumnDimension('G')->setWidth(25); // Set width kolom G

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $sheet->setTitle("Daftar Mentor");
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Data Marketing.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
    public function export_excel_santri()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = [
            'font' => ['bold' => true], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        // Santri Lama
        $sheet->setCellValue('A1', "DATA SANTRI LAMA"); // Set kolom A1 dengan tulisan "DATA SANTRI"
        $sheet->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
        $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
        // Buat header tabel nya pada baris ke 3
        $sheet->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $sheet->setCellValue('B3', "ID"); // Set kolom B3 dengan tulisan "NIS"
        $sheet->setCellValue('C3', "NAMA"); // Set kolom C3 dengan tulisan "NAMA"
        $sheet->setCellValue('D3', "TEMPAT, TANGGAL LAHIR"); // Set kolom D3 dengan tulisan "TEMPAT, TANGGAL LAHIR"
        $sheet->setCellValue('E3', "NOMOR HP"); // Set kolom E3 dengan tulisan "NOMOR HP"
        $sheet->setCellValue('F3', "JENIS KELAMIN"); // Set kolom F3 dengan tulisan "JENIS KELAMIN"
        $sheet->setCellValue('G3', "PROGRAM"); // Set kolom G3 dengan tulisan "PROGRAM"
        $sheet->setCellValue('H3', "NAMA KELAS"); // Set kolom H3 dengan tulisan "NAMA KELAS"
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);
        $sheet->getStyle('G3')->applyFromArray($style_col);
        $sheet->getStyle('H3')->applyFromArray($style_col);
        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $santri_lama =  $this->Admin_model->getAllSantriExport();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($santri_lama as $data) { // Lakukan looping pada variabel marketing
            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, $data->id);
            $sheet->setCellValue('C' . $numrow, $data->nama);
            $sheet->setCellValue('D' . $numrow, $data->asal . ', ' . date_indo($data->tglahir));
            $sheet->setCellValue('E' . $numrow, $data->no_hp);
            $jkl = ($data->jkl == "L") ? "Laki - laki" : "Perempuan";
            $sheet->setCellValue('F' . $numrow, $jkl);
            $sheet->setCellValue('G' . $numrow, $data->program);
            $sheet->setCellValue('H' . $numrow, $data->nama_kls);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('H' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Santri Baru
        $sheet->setCellValue('A' . ($no + 4), "DATA SANTRI BARU"); // Set kolom A1 dengan tulisan "DATA SANTRI"
        $sheet->mergeCells('A' . ($no + 4) . ':E' . ($no + 4)); // Set Merge Cell pada kolom A1 sampai E1
        $sheet->getStyle('A' . ($no + 4))->getFont()->setBold(true); // Set bold kolom A1
        // Buat header tabel nya pada baris ke 3
        $sheet->setCellValue('A' . ($no + 5), "NO"); // Set kolom A3 dengan tulisan "NO"
        $sheet->setCellValue('B' . ($no + 5), "ID"); // Set kolom B3 dengan tulisan "NIS"
        $sheet->setCellValue('C' . ($no + 5), "NAMA"); // Set kolom C3 dengan tulisan "NAMA"
        $sheet->setCellValue('D' . ($no + 5), "TEMPAT, TANGGAL LAHIR"); // Set kolom D3 dengan tulisan "TEMPAT, TANGGAL LAHIR"
        $sheet->setCellValue('E' . ($no + 5), "NOMOR HP"); // Set kolom E3 dengan tulisan "NOMOR HP"
        $sheet->setCellValue('F' . ($no + 5), "JENIS KELAMIN"); // Set kolom F3 dengan tulisan "JENIS KELAMIN"
        $sheet->setCellValue('G' . ($no + 5), "PROGRAM"); // Set kolom G3 dengan tulisan "PROGRAM"
        $sheet->setCellValue('H' . ($no + 5), "NAMA KELAS"); // Set kolom H3 dengan tulisan "NAMA KELAS"
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A' . ($no + 5))->applyFromArray($style_col);
        $sheet->getStyle('B' . ($no + 5))->applyFromArray($style_col);
        $sheet->getStyle('C' . ($no + 5))->applyFromArray($style_col);
        $sheet->getStyle('D' . ($no + 5))->applyFromArray($style_col);
        $sheet->getStyle('E' . ($no + 5))->applyFromArray($style_col);
        $sheet->getStyle('F' . ($no + 5))->applyFromArray($style_col);
        $sheet->getStyle('G' . ($no + 5))->applyFromArray($style_col);
        $sheet->getStyle('H' . ($no + 5))->applyFromArray($style_col);
        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $santri_baru =  $this->Admin_model->getAllSantriBaruExport();
        $noo = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = $no + 6; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($santri_baru as $data) { // Lakukan looping pada variabel marketing
            $sheet->setCellValue('A' . $numrow, $noo);
            $sheet->setCellValue('B' . $numrow, $data->id);
            $sheet->setCellValue('C' . $numrow, $data->nama);
            $sheet->setCellValue('D' . $numrow, $data->asal . ', ' . date_indo($data->tglahir));
            $sheet->setCellValue('E' . $numrow, $data->no_hp);
            $jkl = ($data->jkl == "L") ? "Laki - laki" : "Perempuan";
            $sheet->setCellValue('F' . $numrow, $jkl);
            $sheet->setCellValue('G' . $numrow, $data->program);
            $sheet->setCellValue('H' . $numrow, $data->nama_kls);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('H' . $numrow)->applyFromArray($style_row);

            $noo++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
        $sheet->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $sheet->getColumnDimension('D')->setWidth(30); // Set width kolom D
        $sheet->getColumnDimension('E')->setWidth(30); // Set width kolom E
        $sheet->getColumnDimension('F')->setWidth(30); // Set width kolom F
        $sheet->getColumnDimension('G')->setWidth(25); // Set width kolom G
        $sheet->getColumnDimension('H')->setWidth(25); // Set width kolom G

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $sheet->setTitle("Daftar Mentor");
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Data Santri.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
