<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_model
{
    public function getAllNewAkun()
    {
        return $this->db->get('new_akun')->result_array();
    }
    public function tambahAkun()
    {
        $account = array(
            'id' => $this->input->post('id', true),
            'email' => $this->input->post('email', true),
            'password' => $this->input->post('password', true),
            'is_active' => 1,
            'date_created' => date("Y-m-d H:i:s")
        );

        $data_profile = array(
            'id' => $this->input->post('id', true),
            'nama' => $this->input->post('nama', true),
            'asal' => $this->input->post('asal', true),
            'no_hp' => $this->input->post('no_hp', true),
            'tglahir' => $this->input->post('tglahir', true),
            'image' => $this->input->post('image', true),
            'role_id' => $this->input->post('role_id', true),
            'lok_inter' => $this->input->post('lok_inter', true)
        );

        if ($this->input->post('role_id', true) == 3) {
            $this->db->insert('marketing', ['id' => $this->input->post('id', true)]);
        }

        $this->db->insert('profile', $data_profile);
        $this->db->insert('accounts', $account);

        $this->db->where('id', $this->input->post('id_akun_baru', true));
        $this->db->delete('new_akun');
    }
    // start of mentor Models
    public function getAllMentor($number, $offset, $keyword = null)
    {
        $this->db->select('*, profile.id id_mentor');
        $this->db->where('profile.id !=', 1234);
        $this->db->where('profile.role_id =', 2);
        $this->db->join('role', 'role.id = profile.role_id', 'left');
        $this->db->join('accounts', 'accounts.id = profile.id', 'left');
        $this->db->join('lokasi_internasional', 'lokasi_internasional.id = profile.lok_inter', 'left');
        if ($keyword) {
            $this->db->like('nama', $keyword);
        }

        return $this->db->get('profile', $number, $offset)->result_array();
    }
    public function getAllMentorExport()
    {
        $this->db->select('*, profile.id id_mentor');
        $this->db->where('profile.id !=', 1234);
        $this->db->where('profile.role_id =', 2);
        $this->db->join('role', 'role.id = profile.role_id', 'left');
        $this->db->join('accounts', 'accounts.id = profile.id', 'left');

        return $this->db->get('profile')->result();
    }
    public function tambahMentor()
    {
        $account = array(
            'id' => $this->input->post('id', true),
            'email' => $this->input->post('email', true),
            'password' => password_hash($this->input->post('password', true), PASSWORD_DEFAULT),
            'is_active' => 1,
            'date_created' => date("Y-m-d H:i:s")
        );

        $data_mentor = array(
            'id' => $this->input->post('id', true),
            'nama' => $this->input->post('nama', true),
            'asal' => $this->input->post('asal', true),
            'no_hp' => $this->input->post('no_hp', true),
            'tglahir' => $this->input->post('tglahir', true),
            'image' => 'not.jpg',
            'role_id' => 2,
            'lok_inter' => $this->input->post('lok_inter', true)
        );

        $jum_mapel = $this->input->post('mapel', true);
        for ($i = 0; $i < count($jum_mapel); $i++) {
            $mapel_mentor = array(
                'id' => $this->input->post('id', true),
                'mapel' => $this->input->post('mapel', true)[$i]
            );
            $this->db->insert('mentor', $mapel_mentor);
        }

        $this->db->insert('profile', $data_mentor);
        $this->db->insert('accounts', $account);
    }
    public function editMentor()
    {
        $dt_lama = $this->db->get_where('accounts', ['id' => $this->input->post('id_lama', true)])->row_array();

        if ($this->input->post('password', true) == "") {
            $password = $dt_lama['password'];
        } else {
            $password = password_hash($this->input->post('password', true), PASSWORD_DEFAULT);
        }

        $account = array(
            'id' => $this->input->post('id', true),
            'email' => $this->input->post('email', true),
            'password' => $password,
            'is_active' => 1
        );

        $data_mentor = array(
            'id' => $this->input->post('id', true),
            'nama' => $this->input->post('nama', true),
            'asal' => $this->input->post('asal', true),
            'no_hp' => $this->input->post('no_hp', true),
            'tglahir' => $this->input->post('tglahir', true),
            'lok_inter' => $this->input->post('lok_inter', true)
        );

        $this->db->where('id', $this->input->post('id_lama', true));
        $this->db->delete('mentor');

        $jum_mapel = $this->input->post('mapel', true);
        for ($i = 0; $i < count($jum_mapel); $i++) {
            $mapel_mentor = array(
                'id' => $this->input->post('id', true),
                'mapel' => $this->input->post('mapel', true)[$i]
            );
            $this->db->insert('mentor', $mapel_mentor);
        }

        $this->db->where('id', $this->input->post('id_lama'));
        $this->db->update('profile', $data_mentor);

        $this->db->where('id', $this->input->post('id_lama'));
        $this->db->update('accounts', $account);
    }
    public function mapelMentor($id)
    {
        $this->db->select('*');
        $this->db->where('a.id', $id);

        $this->db->join('ref_mapel b', 'b.id = a.mapel', 'left');
        return $this->db->get('mentor a')->result_array();
    }
    public function kelasMentor($id_mentor)
    {
        $this->db->select('*, a.id id_jadwal');
        $this->db->where('a.id_mentor', $id_mentor);

        $this->db->join('ref_mapel b', 'b.id = a.id_mapel', 'left');
        return $this->db->get('jadwal a')->result_array();
    }
    public function detailMapelMentor($id, $mapel)
    {
        return $this->db->get_where('mentor', ['id' => $id, 'mapel' => $mapel])->result_array();
    }
    public function detailMentor($id)
    {
        $this->db->select('*, profile.id id_mentor');
        $this->db->where('profile.id =', $id);
        $this->db->where('profile.role_id =', 2);
        $this->db->join('role', 'role.id = profile.role_id', 'left');
        $this->db->join('accounts', 'accounts.id = profile.id', 'left');

        return $this->db->get('profile')->row_array();
    }
    public function hapusDataMentor($id)
    {
        $data = $this->db->get_where('profile', ['id' => $id])->row_array();
        if ($data['image'] != 'not.jpg') {
            unlink(FCPATH . 'assets/img-profile/' . $data['image']);
        }

        $this->db->where('id', $id);
        $this->db->delete('accounts');

        $this->db->where('id', $id);
        $this->db->delete('mentor');

        $this->db->where('id', $id);
        $this->db->delete('profile');

        $this->db->where('id_mentor', $id);
        $this->db->delete('jadwal');
    }
    public function detJumMentor()
    {
        $this->db->distinct();
        $this->db->select('id');
        $this->db->group_by("id");

        return $this->db->get('mentor')->num_rows();
    }
    public function detJumMentorMapel($mapel)
    {
        $this->db->select('count(mapel) jum_mapel');
        $this->db->where("mapel =", $mapel);

        return $this->db->get('mentor')->row_array();
    }
    // end of mentor Model

    // start of mapel model
    public function getAllMapel()
    {
        return $this->db->get('ref_mapel')->result_array();
    }
    public function tambahMapel()
    {
        $this->db->insert('ref_mapel', ['nama_mapel' => $this->input->post('nama_mapel')]);
    }
    public function editMapel()
    {
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('ref_mapel', ['nama_mapel' => $this->input->post('nama_mapel')]);
    }
    public function hapusMapel($id)
    {
        $this->db->where('mapel', $id);
        $this->db->delete('guru');

        $this->db->where('id', $id);
        $this->db->delete('ref_mapel');
    }
    // end mapel model
    // start of mapel model
    public function getAllLokInt()
    {
        return $this->db->get('lokasi_internasional')->result_array();
    }
    public function tambahLokInt()
    {
        $data_lok = array(
            'negara' => $this->input->post('negara', true),
            'provinsi' => $this->input->post('provinsi', true),
            'kota' => $this->input->post('kota', true),
            'alamat' => $this->input->post('alamat', true)
        );

        $this->db->insert('lokasi_internasional', $data_lok);
    }
    public function editLokInt()
    {
        $data_lok = array(
            'negara' => $this->input->post('negara', true),
            'provinsi' => $this->input->post('provinsi', true),
            'kota' => $this->input->post('kota', true),
            'alamat' => $this->input->post('alamat', true)
        );

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('lokasi_internasional', $data_lok);
    }
    public function hapusLokInt($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('lokasi_internasional');
    }
    // end mapel model

    // start marketing model
    public function getAllMarketing($number, $offset, $keyword = null)
    {
        $this->db->select('*, profile.id id_marketing');
        $this->db->where('profile.id !=', 1234);
        $this->db->where('profile.role_id =', 3);
        $this->db->join('role', 'role.id = profile.role_id', 'left');
        $this->db->join('accounts', 'accounts.id = profile.id', 'left');
        $this->db->join('lokasi_internasional', 'lokasi_internasional.id = profile.lok_inter', 'left');
        if ($keyword) {
            $this->db->like('nama', $keyword);
        }

        return $this->db->get('profile', $number, $offset)->result_array();
    }
    public function getAllMarketingExport()
    {
        $this->db->select('*, profile.id id_marketing');
        $this->db->where('profile.id !=', 1234);
        $this->db->where('profile.role_id =', 3);
        $this->db->join('role', 'role.id = profile.role_id', 'left');
        $this->db->join('accounts', 'accounts.id = profile.id', 'left');

        return $this->db->get('profile')->result();
    }
    public function tambahMarketing()
    {
        $account = array(
            'id' => $this->input->post('id', true),
            'email' => $this->input->post('email', true),
            'password' => password_hash($this->input->post('password', true), PASSWORD_DEFAULT),
            'is_active' => 1,
            'date_created' => date("Y-m-d H:i:s")
        );

        $data_marketing = array(
            'id' => $this->input->post('id', true),
            'nama' => $this->input->post('nama', true),
            'asal' => $this->input->post('asal', true),
            'no_hp' => $this->input->post('no_hp', true),
            'tglahir' => $this->input->post('tglahir', true),
            'image' => 'not.jpg',
            'role_id' => 3,
            'lok_inter' => $this->input->post('lok_inter', true)
        );

        $stat_marketing = array(
            'id' => $this->input->post('id', true),
            'status' => $this->input->post('status', true)
        );

        $this->db->insert('profile', $data_marketing);
        $this->db->insert('accounts', $account);
        $this->db->insert('marketing', $stat_marketing);
    }
    public function detailMarketing($id)
    {
        $this->db->select('*, profile.id id_marketing');
        $this->db->where('profile.id =', $id);
        $this->db->where('profile.role_id =', 3);
        $this->db->join('role', 'role.id = profile.role_id', 'left');
        $this->db->join('accounts', 'accounts.id = profile.id', 'left');

        return $this->db->get('profile')->row_array();
    }
    public function editMarketing()
    {
        $dt_lama = $this->db->get_where('accounts', ['id' => $this->input->post('id_lama', true)])->row_array();

        if ($this->input->post('password', true) == "") {
            $password = $dt_lama['password'];
        } else {
            $password = password_hash($this->input->post('password', true), PASSWORD_DEFAULT);
        }

        $account = array(
            'id' => $this->input->post('id', true),
            'email' => $this->input->post('email', true),
            'password' => $password,
            'is_active' => 1
        );

        $data_marketing = array(
            'id' => $this->input->post('id', true),
            'nama' => $this->input->post('nama', true),
            'asal' => $this->input->post('asal', true),
            'no_hp' => $this->input->post('no_hp', true),
            'tglahir' => $this->input->post('tglahir', true),
            'lok_inter' => $this->input->post('lok_inter', true)
        );

        $stat_marketing = array(
            'id' => $this->input->post('id', true),
            'status' => $this->input->post('status', true)
        );

        $this->db->where('id', $this->input->post('id_lama'));
        $this->db->update('profile', $data_marketing);

        $this->db->where('id', $this->input->post('id_lama'));
        $this->db->update('accounts', $account);

        $this->db->where('id', $this->input->post('id_lama'));
        $this->db->update('marketing', $stat_marketing);
    }
    public function hapusDataMarketing($id)
    {
        $data = $this->db->get_where('profile', ['id' => $id])->row_array();
        if ($data['image'] != 'not.jpg') {
            unlink(FCPATH . 'assets/img-profile/' . $data['image']);
        }

        $this->db->where('id', $id);
        $this->db->delete('accounts');

        $this->db->where('id', $id);
        $this->db->delete('profile');

        $this->db->where('id', $id);
        $this->db->delete('marketing');
    }
    public function statusMarketing($id_marketing)
    {
        $this->db->select('*');
        $this->db->where('a.id', $id_marketing);

        return $this->db->get('marketing a')->result_array();
    }
    public function detJumMarketing()
    {
        $this->db->distinct();
        $this->db->select('count(status) jum_status, status');
        $this->db->group_by("status");

        return $this->db->get('marketing')->result_array();
    }
    // end marketing model

    // start jadwal model
    public function getKelas()
    {
        $this->db->distinct();
        $this->db->select('nama_kls');
        $this->db->group_by("nama_kls");

        return $this->db->get('jadwal')->result_array();
    }
    public function getDetailKelas($keyword = null, $keyword2 = null)
    {
        $this->db->distinct();
        $this->db->select('*');
        $this->db->group_by("nama_kls");
        if ($keyword || $keyword2) {
            $this->db->like('nama_kls', $keyword);
            $this->db->like('program', $keyword2);
        }

        return $this->db->get('jadwal')->result_array();
    }
    public function getDetailJadwal($nama_kls = '', $hari = '')
    {
        $this->db->select('*, jadwal.id id_kls');
        $this->db->join('ref_mapel', 'ref_mapel.id = jadwal.id_mapel', 'left');
        $this->db->join('profile', 'profile.id = jadwal.id_mentor', 'left');
        $this->db->where('nama_kls =', $nama_kls);
        $this->db->where('hari =', $hari);
        $this->db->order_by('jam_masuk', 'ASC');

        return $this->db->get('jadwal')->result_array();
    }
    public function mentorDetail($id_mapel = 0)
    {
        $this->db->distinct();
        $this->db->select('*');
        $this->db->join('profile', 'profile.id = mentor.id', 'left');
        $this->db->where('mapel =', $id_mapel);
        $this->db->group_by("mentor.id");

        return $this->db->get('mentor')->result_array();
    }
    public function tambahKelas()
    {
        $cek_jadwal = $this->db->get_where('jadwal', ['hari' => $this->input->post('hari', true), 'jam_masuk' => $this->input->post('jam_masuk', true), 'jam_keluar' => $this->input->post('jam_keluar', true), 'id_mentor' => $this->input->post('id_mentor', true)])->row_array();

        if (!$cek_jadwal) {
            $kelas = array(
                'nama_kls' => $this->input->post('nama_kls', true),
                'id_mapel' => $this->input->post('id_mapel', true),
                'hari' => $this->input->post('hari', true),
                'jam_masuk' => $this->input->post('jam_masuk', true),
                'jam_keluar' => $this->input->post('jam_keluar', true),
                'id_mentor' => $this->input->post('id_mentor', true),
                'program' => $this->input->post('program', true)
            );

            $this->db->insert('jadwal', $kelas);
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Kelas Berhasil Ditambahkan.</div>');
            redirect('admin/jadwal_kelas');
        } else {
            $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Jadwal Mata Pelajaran Tersebut Sudah Ada.</div>');
            redirect('admin/tambah_kelas');
        }
    }
    public function tambahJadwal()
    {
        $cek_jadwal = $this->db->get_where('jadwal', ['hari' => $this->input->post('hari', true), 'jam_masuk' => $this->input->post('jam_masuk', true), 'jam_keluar' => $this->input->post('jam_keluar', true), 'id_mentor' => $this->input->post('id_mentor', true)])->row_array();

        if (!$cek_jadwal) {
            $cek_jadwal2 = $this->db->get_where('jadwal', ['hari' => $this->input->post('hari', true), 'jam_masuk' => $this->input->post('jam_masuk', true), 'jam_keluar' => $this->input->post('jam_keluar', true)])->row_array();

            if (!$cek_jadwal2) {
                $kelas = array(
                    'nama_kls' => $this->input->post('nama_kls', true),
                    'id_mapel' => $this->input->post('id_mapel', true),
                    'hari' => $this->input->post('hari', true),
                    'jam_masuk' => $this->input->post('jam_masuk', true),
                    'jam_keluar' => $this->input->post('jam_keluar', true),
                    'id_mentor' => $this->input->post('id_mentor', true),
                    'program' => $this->input->post('program', true)
                );

                $this->db->insert('jadwal', $kelas);
                $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Jadwal Mata Pelajaran Berhasil Ditambah.</div>');
                redirect('admin/jadwal_kelas');
            } else {
                $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Jam Pelajaran Tersebut Sudah Ada.</div>');
                redirect('admin/jadwal_kelas');
            }
        } else {
            $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Jadwal Mata Pelajaran Tersebut Sudah Ada.</div>');
            redirect('admin/jadwal_kelas');
        }
    }
    public function hapusDataJadwal($id)
    {
        $det_materi = $this->db->get_where('jadwal', ['id' => $id])->row_array();

        unlink(FCPATH . 'assets/materi/' . $det_materi['materi']);

        $this->db->where('id', $id);
        $this->db->delete('jadwal');
    }
    public function hapusDataKelas($nama_kls)
    {
        $this->db->where('nama_kls', $nama_kls);
        $this->db->delete('jadwal');
    }
    // end jadwal model

    // start santri model
    public function getAllSantri($number, $offset, $keyword = null)
    {
        $this->db->select('*');
        $this->db->where('nama_kls !=', null);
        if ($keyword) {
            $this->db->like('nama', $keyword);
            $this->db->or_like('program', $keyword);
        }

        return $this->db->get('santri', $number, $offset)->result_array();
    }
    public function getAllSantriExport()
    {
        $this->db->select('*');
        $this->db->where('nama_kls !=', null);

        return $this->db->get('santri')->result();
    }
    public function getAllSantriBaru($number, $offset, $keyword = null)
    {
        $this->db->select('*');
        $this->db->where('nama_kls =', null);
        if ($keyword) {
            $this->db->like('nama', $keyword);
            $this->db->or_like('program', $keyword);
        }

        return $this->db->get('santri', $number, $offset)->result_array();
    }
    public function getAllSantriBaruExport()
    {
        $this->db->select('*');
        $this->db->where('nama_kls =', null);

        return $this->db->get('santri')->result();
    }
    public function editKelasSantriBaru()
    {
        $edit_santri = array(
            'nama_kls' => $this->input->post('nama_kls', true),
            'program' => $this->input->post('program', true)
        );

        // cek jika ada gambar yang akan diupload
        $upload_image = $_FILES['bukti_byr']['name'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']     = '30000';
            $config['upload_path'] = './assets/bukti-byr';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('bukti_byr')) {
                unlink(FCPATH . 'assets/bukti-byr/' . $this->input->post('bukti_byr_lama', true));
                $new_image = $this->upload->data('file_name');
                $this->db->set('bukti_byr', $new_image);
            } else {
                $this->upload->display_errors();
            }
        }

        $this->db->where('id', $this->input->post('id', true));
        $this->db->update('santri', $edit_santri);
    }
    public function hapusDataSantri($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('santri');
    }
}
