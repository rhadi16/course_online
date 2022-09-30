<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Marketing_model extends CI_model
{
    public function editProfile($old_image = '')
    {
        $data_marketing = array(
            'nama' => $this->input->post('nama', true),
            'asal' => $this->input->post('asal', true),
            'no_hp' => $this->input->post('no_hp', true),
            'tglahir' => $this->input->post('tglahir', true),
            'lok_inter' => $this->input->post('lok_inter', true)
        );
        // cek jika ada gambar yang akan diupload
        $upload_image = $_FILES['image']['name'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']     = '2000';
            $config['upload_path'] = './assets/img-profile';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                if ($old_image != 'not.jpg') {
                    unlink(FCPATH . 'assets/img-profile/' . $old_image);
                }
                $new_image = $this->upload->data('file_name');
                $this->db->set('image', $new_image);
            } else {
                $this->upload->display_errors();
            }
        }

        // set ulang session
        $dt_sess = array(
            'id' => $this->input->post('id', true),
            'email' => $this->input->post('email', true),
            'role_id' => $this->session->userdata('role_id'),
            'expired' => time() + 900
        );

        $this->session->set_userdata($dt_sess);

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('profile', $data_marketing);

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('accounts', ['email' => $this->input->post('email', true)]);
    }
    public function settingpassword($password_baru = null)
    {
        $this->db->set('password', $password_baru);
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('accounts');
    }
    public function listSantri()
    {
        return $this->db->get_where('santri', ['pa' => $this->session->userdata('id')])->result_array();
    }
    public function DetailSantri($id = '')
    {
        return $this->db->get_where('santri', ['id' => $id])->row_array();
    }
    public function tambahSantri()
    {
        $data_santri = array(
            'id' => $this->input->post('id', true),
            'nama' => $this->input->post('nama', true),
            'jkl' => $this->input->post('jkl', true),
            'asal' => $this->input->post('asal', true),
            'tglahir' => $this->input->post('tglahir', true),
            'alamat' => $this->input->post('alamat', true),
            'hafalan' => $this->input->post('hafalan', true),
            'kemampuan_ngaji' => htmlspecialchars($this->input->post('kemampuan_ngaji', true)),
            'kemampuan_bahasa' => $this->input->post('kemampuan_bahasa', true),
            'ustadz-dzah' => $this->input->post('ustadz-dzah', true),
            'no_hp' => $this->input->post('no_hp', true),
            'program' => $this->input->post('program', true),
            'wkt_bljr' => $this->input->post('wkt_bljr', true),
            'wkt_luang' => $this->input->post('wkt_luang', true),
            'pa' => $this->session->userdata('id')
        );

        $this->db->insert('santri', $data_santri);
    }
    public function editSantri()
    {
        $data_santri = array(
            'id' => $this->input->post('id', true),
            'nama' => $this->input->post('nama', true),
            'jkl' => $this->input->post('jkl', true),
            'asal' => $this->input->post('asal', true),
            'tglahir' => $this->input->post('tglahir', true),
            'alamat' => $this->input->post('alamat', true),
            'hafalan' => $this->input->post('hafalan', true),
            'kemampuan_ngaji' => htmlspecialchars($this->input->post('kemampuan_ngaji', true)),
            'kemampuan_bahasa' => $this->input->post('kemampuan_bahasa', true),
            'ustadz-dzah' => $this->input->post('ustadz-dzah', true),
            'no_hp' => $this->input->post('no_hp', true),
            'program' => $this->input->post('program', true),
            'wkt_bljr' => $this->input->post('wkt_bljr', true),
            'wkt_luang' => $this->input->post('wkt_luang', true),
            'pa' => $this->session->userdata('id')
        );

        $this->db->where('id', $this->input->post('id_lama'));
        $this->db->update('santri', $data_santri);
    }
    public function getAllLokInt()
    {
        return $this->db->get('lokasi_internasional')->result_array();
    }
}
