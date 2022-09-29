<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mentor_model extends CI_model
{
    public function editProfile($old_image = '')
    {
        $data_mentor = array(
            'nama' => $this->input->post('nama', true),
            'asal' => $this->input->post('asal', true),
            'no_hp' => $this->input->post('no_hp', true),
            'tglahir' => $this->input->post('tglahir', true)
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
        $this->db->update('profile', $data_mentor);

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('accounts', ['email' => $this->input->post('email', true)]);
    }
    public function hapusMateri($materi)
    {
        $this->db->where('materi', $materi);
        $this->db->update('jadwal', [
            'materi' => null
        ]);
        unlink(FCPATH . 'assets/materi/' . $materi);
    }
    public function settingpassword($password_baru = null)
    {
        $this->db->set('password', $password_baru);
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('accounts');
    }
    public function listKls($id)
    {
        $this->db->distinct();
        $this->db->select('*');
        $this->db->where('id_mentor =', $id);
        $this->db->group_by("nama_kls");

        return $this->db->get('jadwal')->result_array();
    }
    public function jadwalMentor($nama_kls = '', $hari = '', $id_mentor = '')
    {
        $this->db->select('*, jadwal.id id_kls');
        $this->db->join('ref_mapel', 'ref_mapel.id = jadwal.id_mapel', 'left');
        $this->db->join('profile', 'profile.id = jadwal.id_mentor', 'left');
        $this->db->where('nama_kls =', $nama_kls);
        $this->db->where('hari =', $hari);
        $this->db->where('id_mentor =', $id_mentor);
        $this->db->order_by('jam_masuk', 'ASC');

        return $this->db->get('jadwal')->result_array();
    }
    public function editJadwal()
    {
        // cek jika ada file yang akan diupload
        $upload_file = $_FILES['materi']['name'];

        if ($upload_file) {
            $config['allowed_types'] = 'gif|jpg|jpeg|png|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|pdf|txt|avi|mpeg|mp3|mp4|3gp';
            $config['max_size']     = '20000000';
            $config['upload_path'] = './assets/materi';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('materi')) {
                unlink(FCPATH . 'assets/materi/' . $this->input->post('materi'));
                $new_file = $this->upload->data('file_name');
                $this->db->set('materi', $new_file);
            } else {
                $this->upload->display_errors();
            }
        }

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('jadwal', [
            'link_kls' => $this->input->post('link_kls'),
            'link_meet' => $this->input->post('link_meet')
        ]);
    }
    public function listSantriDalamKls($nama_kls)
    {
        $this->db->select('*');
        $this->db->where('nama_kls =', $nama_kls);

        return $this->db->get('santri')->result_array();
    }
}
