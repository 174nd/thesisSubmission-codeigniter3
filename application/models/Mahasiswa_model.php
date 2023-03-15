<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model
{
  public function getData()
  {
    if ($this->input->post('set') == 'start-dashboard_mahasiswa') {
      $id_user = $this->session->userdata('id_user');

      $this->db->select("id_mahasiswa, IF(
        EXISTS(SELECT 1 FROM pengajuan WHERE pengajuan.id_mahasiswa=mahasiswa.id_mahasiswa AND stt_pengajuan='input'),'input',
          IF(EXISTS(SELECT 1 FROM pengajuan WHERE pengajuan.id_mahasiswa=mahasiswa.id_mahasiswa AND stt_pengajuan='proses'),'proses',
            IF(EXISTS(SELECT 1 FROM pengajuan WHERE pengajuan.id_mahasiswa=mahasiswa.id_mahasiswa AND stt_pengajuan='terima'),'terima',
              IF(EXISTS(SELECT 1 FROM pengajuan WHERE pengajuan.id_mahasiswa=mahasiswa.id_mahasiswa AND stt_pengajuan='tolak'),'tolak',
              'none')
            )
          )
        ) AS stt_mahasiswa");
      $data = $this->db->get_where("mahasiswa", ['id_user' => $id_user])->row_array();

      if ($data['stt_mahasiswa'] == 'terima') {
        $cek = $this->db->get_where("pengajuan", ['stt_pengajuan' => 'terima', 'id_mahasiswa' => $data['id_mahasiswa']])->row_array();
        $isian = $cek['nm_judul'];
      } else if ($data['stt_mahasiswa'] == 'tolak') {
        $cek = $this->db->get_where("pengajuan", ['stt_pengajuan' => 'tolak', 'id_mahasiswa' => $data['id_mahasiswa']])->row_array();
        $isian = $cek['ket_pengajuan'];
      }

      $this->db->join('mahasiswa', 'id_mahasiswa');
      $this->db->select('id_pengajuan, tgl_pengajuan, stt_pengajuan, id_judul');
      $pengajuan = $this->db->get_where("pengajuan", "(stt_pengajuan='terima' OR stt_pengajuan='tolak') AND id_user='$id_user'")->result_array();
      foreach ($pengajuan as $k1 => $v1) {
        $isi = "<ul>";
        $this->db->select('id_judul, nm_judul');
        $judul = $this->db->get_where("judul", ['id_pengajuan' => $v1['id_pengajuan']])->result_array();
        foreach ($judul as $v2) $isi .= $v1['id_judul'] == $v2['id_judul'] ? "<li class='font-weight-bold'>$v2[nm_judul]</li>" : "<li>$v2[nm_judul]</li>";
        $pengajuan[$k1]['judul'] = $isi . "</ul>";
      }



      $hasil = [
        'stt_mahasiswa' => $data['stt_mahasiswa'],
        'isian'         => $isian ?? null,
        'pengajuan'     => $pengajuan,
        'status'        => 'done',
      ];
    } else if ($this->input->post('set') == 'start-pilih_konsentrasi') {
      $id_user = $this->session->userdata('id_user');

      $this->db->join('mahasiswa', 'id_prodi');
      $this->db->select('konsentrasi.id_konsentrasi AS id, konsentrasi.nm_konsentrasi AS text');
      $this->db->order_by('nm_konsentrasi', 'asc');
      $hasil = [
        'konsentrasi' => $this->db->get_where("konsentrasi", ['id_user' => $id_user])->result_array(),
        'status'      => 'done',
      ];
    } else if ($this->input->post('set') == 'save-simpan_konsentrasi') {
      $id_pengajuan = getAutoIncrement('pengajuan');
      $id_user = $this->session->userdata('id_user');
      $id_konsentrasi = $this->input->post('id_konsentrasi');

      $mahasiswa = $this->db->get_where("mahasiswa", ['id_user' => $id_user])->row_array();

      if ($this->db->insert('pengajuan', [
        'id_mahasiswa'   => $mahasiswa['id_mahasiswa'],
        'id_konsentrasi' => $id_konsentrasi,
        'stt_pengajuan'  => 'input',
      ])) {
        $hasil = [
          'id_pengajuan' => $id_pengajuan,
          'status'       => 'done',
        ];
      } else {
        $hasil['status'] = 'none';
      };
    } else if ($this->input->post('set') == 'save-ubah_konsentrasi') {
      $id_user = $this->session->userdata('id_user');
      $id_konsentrasi = $this->input->post('id_konsentrasi');

      $mahasiswa = $this->db->get_where("mahasiswa", ['id_user' => $id_user])->row_array();

      if ($this->db->update('pengajuan', ['id_konsentrasi' => $id_konsentrasi], ['stt_pengajuan' => 'input', 'id_mahasiswa' => $mahasiswa['id_mahasiswa']])) {
        $hasil = [
          'status'       => 'done',
        ];
      } else {
        $hasil['status'] = 'none';
      };
    } else if ($this->input->post('set') == 'start-input_pengajuan') {
      $id_user = $this->session->userdata('id_user');

      $this->db->join('mahasiswa', 'id_mahasiswa');
      $this->db->join('prodi', 'id_prodi');
      $this->db->join('fakultas', 'id_fakultas');
      $this->db->join('konsentrasi', 'id_konsentrasi');
      // $this->db->select('konsentrasi.id_konsentrasi AS id, konsentrasi.nm_konsentrasi AS text');
      $this->db->order_by('nm_mahasiswa', 'asc');
      $mahasiswa = $this->db->get_where("pengajuan", ['stt_pengajuan' => 'input', 'id_user' => $id_user])->row_array();



      // $judul['stt_judul'] = $judul['stt_judul'] == 1 ? true : false;

      $hasil = [
        'mahasiswa' => $mahasiswa,
        'judul'     => $this->getJudul($mahasiswa['id_pengajuan']),
        'status'    => 'done',
      ];
    } else if ($this->input->post('set') == 'start-ajukan_judul') {


      $this->db->select('pimpinan.id_pimpinan AS id, pimpinan.unsur_pimpinan AS text');
      $this->db->order_by('unsur_pimpinan', 'asc');
      $hasil = [
        'pimpinan' => $this->db->get_where("pimpinan")->result_array(),
        'status'   => 'done',
      ];
    } else if ($this->input->post('set') == 'save-simpan_judul') {
      $id_user = $this->session->userdata('id_user');

      $this->db->select('pengajuan.id_pengajuan');
      $this->db->join('mahasiswa', 'id_mahasiswa');
      $pengajuan = $this->db->get_where("pengajuan", ['stt_pengajuan' => 'input', 'id_user' => $id_user])->row_array();


      if ($this->db->insert('judul', [
        'id_pengajuan'    => $pengajuan['id_pengajuan'],
        'nm_judul'        => $this->input->post('nm_judul'),
        'id_pimpinan'     => $this->input->post('id_pimpinan'),
        'nm_perusahaan'   => $this->input->post('nm_perusahaan'),
        'latar_belakang'  => $this->input->post('latar_belakang'),
        'gambaran_judul'  => $this->input->post('gambaran_judul'),
        'kelebihan_judul' => $this->input->post('kelebihan_judul'),
      ])) {
        $hasil = [
          'judul'  => $this->getJudul($pengajuan['id_pengajuan']),
          'status' => 'done',
        ];
      } else {
        $hasil['status'] = 'none';
      };
    } else if ($this->input->post('set') == 'save-hapus_jurnal') {
      $id_jurnal = $this->input->post('id_jurnal');
      $this->db->join('judul', 'id_judul');
      $data = $this->db->get_where('jurnal', ['id_jurnal' => $id_jurnal])->row_array();


      if (unlink(FCPATH . 'uploads/jurnal/' . $data['file_jurnal']) && $this->db->delete('jurnal', ['id_jurnal' => $id_jurnal])) {
        $jurnal = $this->db->get_where('jurnal', ['id_judul' => $data['id_judul']])->result_array();
        $hasil = [
          'judul'  => $this->getJudul($data['id_pengajuan']),
          'jurnal' => $jurnal,
          'status' => 'done',
        ];
      } else {
        $hasil['status'] = 'none';
      };
    } else if ($this->input->post('set') == 'start-data_judul') {
      $id_judul = $this->input->post('id_judul');

      $this->db->join('pimpinan', 'id_pimpinan');
      $judul = $this->db->get_where('judul', ['id_judul' => $id_judul])->row_array();



      $jurnal = $this->db->get_where('jurnal', ['id_judul' => $id_judul])->result_array();
      $hasil = [
        'judul'  => $judul,
        'jurnal' => $jurnal,
        'status' => 'done',
      ];
    } else if ($this->input->post('set') == 'start-ubah_judul') {
      $id_judul = $this->input->post('id_judul');


      $judul = $this->db->get_where('judul', ['id_judul' => $id_judul])->row_array();

      $this->db->order_by('unsur_pimpinan', 'asc');
      $this->db->select('pimpinan.id_pimpinan AS id, pimpinan.unsur_pimpinan AS text');
      $pimpinan = $this->db->get_where("pimpinan")->result_array();

      $hasil = [
        'judul'    => $judul,
        'pimpinan' => $pimpinan,
        'status'   => 'done',
      ];
    } else if ($this->input->post('set') == 'save-ubah_judul') {
      $id_judul = $this->input->post('id_judul');

      $judul = $this->db->get_where("judul", ['id_judul' => $id_judul])->row_array();

      if ($this->db->update('judul', [
        'nm_judul'        => $this->input->post('nm_judul'),
        'id_pimpinan'     => $this->input->post('id_pimpinan'),
        'nm_perusahaan'   => $this->input->post('nm_perusahaan'),
        'latar_belakang'  => $this->input->post('latar_belakang'),
        'gambaran_judul'  => $this->input->post('gambaran_judul'),
        'kelebihan_judul' => $this->input->post('kelebihan_judul'),
      ], ['id_judul' => $id_judul])) {
        $hasil = [
          'judul'  => $this->getJudul($judul['id_pengajuan']),
          'status' => 'done',
        ];
      } else {
        $hasil['status'] = 'none';
      };
    } else if ($this->input->post('set') == 'save-hapus_judul') {
      $id_judul = $this->input->post('id_judul');
      $judul = $this->db->get_where('judul', ['id_judul' => $id_judul])->row_array();
      $jurnal = $this->db->get_where('jurnal', ['id_judul' => $id_judul])->result_array();

      $query = true;
      foreach ($jurnal as $r) {
        $query .= unlink(FCPATH . 'uploads/jurnal/' . $r['file_jurnal']) && $this->db->delete('jurnal', ['id_jurnal' => $r['id_jurnal']]);
      }

      if ($this->db->delete('judul', ['id_judul' => $id_judul]) && $query) {
        $hasil = [
          'judul'  => $this->getJudul($judul['id_pengajuan']),
          'status' => 'done',
        ];
      } else {
        $hasil['status'] = 'none';
      };
    } else if ($this->input->post('set') == 'save-tambah_jurnal') {
      $id_judul = $this->input->post('id_judul');

      if ($_FILES['file_jurnal']['name']) {
        $config['allowed_types'] = 'pdf';
        $config['upload_path'] = './uploads/jurnal/';
        $config['max_size']     = '2048';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file_jurnal')) {
          if ($this->db->insert('jurnal', ['id_judul' => $id_judul, 'file_jurnal' => $this->upload->data('file_name')])) {
            $data = $this->db->get_where('judul', ['id_judul' => $id_judul])->row_array();
            $jurnal = $this->db->get_where('jurnal', ['id_judul' => $id_judul])->result_array();
            $hasil = [
              'judul'  => $this->getJudul($data['id_pengajuan']),
              'jurnal' => $jurnal,
              'status' => 'done',
            ];
          } else {
            $hasil['status'] = 'Data Gagal di Eksekusi! Ada kesalahan pada query, Silahkan cek lagi!';
          };
        } else {
          $hasil['status'] = strip_tags($this->upload->display_errors());
        }
      } else {
        $hasil['status'] = 'Data Gagal di Eksekusi! Ada kesalahan pada query, Silahkan cek lagi!';
      }
    } else if ($this->input->post('set') == 'save-hapus_jurnal') {
      $id_jurnal = $this->input->post('id_jurnal');
      $this->db->join('judul', 'id_judul');
      $data = $this->db->get_where('jurnal', ['id_jurnal' => $id_jurnal])->row_array();


      if (unlink(FCPATH . 'uploads/jurnal/' . $data['file_jurnal']) && $this->db->delete('jurnal', ['id_jurnal' => $id_jurnal])) {
        $jurnal = $this->db->get_where('jurnal', ['id_judul' => $data['id_judul']])->result_array();
        $hasil = [
          'judul'  => $this->getJudul($data['id_pengajuan']),
          'jurnal' => $jurnal,
          'status' => 'done',
        ];
      } else {
        $hasil['status'] = 'none';
      };
    } else if ($this->input->post('set') == 'save-simpan_pengajuan') {
      $id_user = $this->session->userdata('id_user');

      $this->db->select('pengajuan.id_pengajuan');
      $this->db->join('mahasiswa', 'id_mahasiswa');
      $pengajuan = $this->db->get_where("pengajuan", ['stt_pengajuan' => 'input', 'id_user' => $id_user])->row_array();


      if ($this->db->update('pengajuan', [
        'tgl_pengajuan' => date('Y-m-d'),
        'stt_pengajuan' => 'proses',
      ], ['id_pengajuan' => $pengajuan['id_pengajuan']])) {
        $hasil = [
          'status' => 'done',
        ];
      } else {
        $hasil['status'] = 'none';
      };
    } else if ($this->input->post('set') == 'start-data_pengajuan') {
      $id_pengajuan = $this->input->post('id_pengajuan');
      $id_user = $this->session->userdata('id_user');

      $set = isset($id_pengajuan) ? ['id_pengajuan' => $id_pengajuan] : ['stt_pengajuan' => 'proses', 'id_user' => $id_user];

      $this->db->join('mahasiswa', 'id_mahasiswa');
      $this->db->join('prodi', 'id_prodi');
      $this->db->join('fakultas', 'id_fakultas');
      $this->db->join('konsentrasi', 'id_konsentrasi');
      $this->db->order_by('nm_mahasiswa', 'asc');
      $this->db->select('*, COALESCE((SELECT nm_dosen FROM dosen WHERE dosen.id_dosen=pengajuan.pemb_1),"-") AS nm_pemb1, COALESCE((SELECT nm_dosen FROM dosen WHERE dosen.id_dosen=pengajuan.pemb_2),"-") AS nm_pemb2');
      $mahasiswa = $this->db->get_where('pengajuan', $set)->row_array();
      $hasil = [
        'mahasiswa' => $mahasiswa,
        'judul'     => $this->getJudul($mahasiswa['id_pengajuan']),
        'status'    => 'done',
      ];
    } else if ($this->input->post('set') == 'start-detail_judul') {
      $id_judul = $this->input->post('id_judul');

      $this->db->join('pimpinan', 'id_pimpinan');
      $judul = $this->db->get_where('judul', ['id_judul' => $id_judul])->row_array();



      $jurnal = $this->db->get_where('jurnal', ['id_judul' => $id_judul])->result_array();
      $hasil = [
        'judul'  => $judul,
        'jurnal' => $jurnal,
        'status' => 'done',
      ];
    } else {
      $hasil['status'] = 'none';
    }


    echo json_encode($hasil);
  }


  private function getJudul($id_pengajuan)
  {
    $this->db->select('*, IF(COALESCE((SELECT COUNT(id_judul) FROM jurnal WHERE jurnal.id_judul=judul.id_judul))>= 3,1,0) AS stt_judul');
    $judul = $this->db->get_where("judul", ['id_pengajuan' => $id_pengajuan])->result_array();
    foreach ($judul as $key => $value) $judul[$key]['stt_judul'] = $value['stt_judul'] == 1 ? true : false;
    return $judul;
  }
}
