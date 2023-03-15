<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
  public function getData()
  {
    if ($this->input->post('set') == 'start-dashboard_admin') {
      $hasil = $this->db->query("SELECT 
      (SELECT COUNT(id_dosen) FROM dosen) AS dosen, 
      (SELECT COUNT(id_mahasiswa) FROM mahasiswa) AS mahasiswa, 
      (SELECT COUNT(id_pengajuan) FROM pengajuan) AS pengajuan, 
      (SELECT COUNT(id_pengajuan) FROM pengajuan WHERE stt_pengajuan='terima') AS diterima")->row_array();
    }
    ///////
    else if ($this->input->post('set') == 'start-data_pengajuan') {
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
      $this->db->join('pengajuan', 'id_pengajuan');
      $this->db->join('konsentrasi', 'id_konsentrasi');
      $this->db->join('prodi', 'id_prodi');
      $this->db->select('judul.*, pimpinan.*, prodi.id_fakultas');
      $judul = $this->db->get_where('judul', ['judul.id_judul' => $id_judul])->row_array();

      $jurnal = $this->db->get_where('jurnal', ['id_judul' => $id_judul])->result_array();


      $this->db->order_by('nm_dosen', 'asc');
      $this->db->select('dosen.id_dosen AS id, dosen.nm_dosen AS text');
      $dosen = $this->db->get_where('dosen', ['id_fakultas' => $judul['id_fakultas']])->result_array();
      $hasil = [
        'judul'  => $judul,
        'jurnal' => $jurnal,
        'dosen'  => $dosen,
        'status' => 'done',
      ];
    } else if ($this->input->post('set') == 'save-tolak_pengajuan') {
      $id_pengajuan = $this->input->post('id_pengajuan');
      $ket_pengajuan = $this->input->post('ket_pengajuan');

      if ($this->db->update('pengajuan', [
        'stt_pengajuan'  => 'tolak',
        'tgl_pengecekan' => date('Y-m-d'),
        'ket_pengajuan'  => $ket_pengajuan,
      ], ['id_pengajuan' => $id_pengajuan])) {
        $this->db->join('mahasiswa', 'id_mahasiswa');
        $pengajuan = $this->db->get_where('pengajuan', ['id_pengajuan' => $id_pengajuan])->row_array();
        // $hasil['status'] = $this->kirimEmail(
        //   $pengajuan['email_mahasiswa'],
        //   'Hasil Pengajuan Judul Skripsi | Universitas Ibnu Sina',
        //   'Pengajuan Judul Skripsi Anda Ditolak karena alasan sebagai berikut :\r\n' . $ket_pengajuan
        // ) ? 'done' : 'none';
        $hasil['status'] = 'done';
      } else {
        $hasil['status'] = 'none';
      };
    } else if ($this->input->post('set') == 'save-terima_judul') {
      $id_pengajuan = $this->input->post('id_pengajuan');
      $id_judul     = $this->input->post('id_judul');
      $nm_judul     = $this->input->post('nm_judul');
      $pemb_1       = $this->input->post('pemb_1');
      $pemb_2       = $this->input->post('pemb_2');
      $tahun = date('Y');

      $this->db->join('konsentrasi', 'id_konsentrasi');
      $this->db->join('prodi', 'id_prodi');
      $this->db->join('fakultas', 'id_fakultas');
      $this->db->select('fakultas.form_fakultas');
      $fakultas = $this->db->get_where("pengajuan", ['id_pengajuan' => $id_pengajuan])->row_array();

      $get_no = $this->db->query("SELECT COALESCE(SUBSTRING(MAX(no_sk),1,3),0) AS hasil FROM pengajuan WHERE no_sk LIKE '%$fakultas[form_fakultas]%' AND YEAR(tgl_pengecekan)='$tahun'")->row_array();
      function getRomawi($bln)
      {
        switch ($bln) {
          case 1:
            return "I";
            break;
          case 2:
            return "II";
            break;
          case 3:
            return "III";
            break;
          case 4:
            return "IV";
            break;
          case 5:
            return "V";
            break;
          case 6:
            return "VI";
            break;
          case 7:
            return "VII";
            break;
          case 8:
            return "VIII";
            break;
          case 9:
            return "IX";
            break;
          case 10:
            return "X";
            break;
          case 11:
            return "XI";
            break;
          case 12:
            return "XII";
            break;
        }
      }

      $no_sk = str_pad((int) $get_no['hasil'] + 1, 3, "0", STR_PAD_LEFT) . "/" . $fakultas['form_fakultas'] . "/" . getRomawi(date('n')) . '/' . $tahun;


      if ($this->db->update('pengajuan', [
        'id_judul'       => $id_judul,
        'nm_judul'       => $nm_judul,
        'pemb_1'         => $pemb_1,
        'pemb_2'         => $pemb_2,
        'no_sk'          => $no_sk,
        'tgl_pengecekan' => date('Y-m-d'),
        'stt_pengajuan'  => 'terima',
      ], ['id_pengajuan' => $id_pengajuan])) {
        // $this->db->join('mahasiswa', 'id_mahasiswa');
        // $pengajuan = $this->db->get_where('pengajuan', ['id_pengajuan' => $id_pengajuan])->row_array();
        // $hasil['status'] = $this->kirimEmail(
        //   $pengajuan['email_mahasiswa'],
        //   'Hasil Pengajuan Judul Skripsi | Universitas Ibnu Sina',
        //   'Pengajuan Judul Skripsi Anda Diterima Dengan Judul "' . $nm_judul . '"'
        // ) ? 'done' : 'none';
        $hasil['get_no'] = $no_sk;
        $hasil['status'] = 'done';
      } else {
        $hasil['status'] = 'none';
      };
    }
    ///////
    else if ($this->input->post('set') == 'start-cari_pengajuan') {
      $bulan = set_date($this->input->post('bln_pengajuan'), 'F Y', '%m');
      $tahun = set_date($this->input->post('bln_pengajuan'), 'F Y', '%Y');

      $this->db->join('mahasiswa', 'id_mahasiswa');
      $where = "stt_pengajuan!='input' AND ((MONTH(tgl_pengajuan)='$bulan' AND YEAR(tgl_pengajuan)='$tahun') OR (MONTH(tgl_pengecekan)='$bulan' AND YEAR(tgl_pengecekan)='$tahun'))";
      $hasil = [
        'pengajuan' => $this->db->get_where('pengajuan', $where)->result_array(),
        // 'query' => $this->db->last_query(),
        'status'    => 'done'
      ];
    } else if ($this->input->post('set') == 'start-detail_pengajuan') {
      $id_pengajuan = $this->input->post('id_pengajuan');

      $this->db->join('mahasiswa', 'id_mahasiswa');
      $this->db->join('prodi', 'id_prodi');
      $this->db->join('fakultas', 'id_fakultas');
      $this->db->join('konsentrasi', 'id_konsentrasi');
      $this->db->order_by('nm_mahasiswa', 'asc');
      $this->db->select('*, COALESCE((SELECT nm_dosen FROM dosen WHERE dosen.id_dosen=pengajuan.pemb_1),"-") AS nm_pemb1, COALESCE((SELECT nm_dosen FROM dosen WHERE dosen.id_dosen=pengajuan.pemb_2),"-") AS nm_pemb2');
      $mahasiswa = $this->db->get_where('pengajuan', ['id_pengajuan' => $id_pengajuan])->row_array();
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
    }
    ///////
    else if ($this->input->post('set') == 'save-update_panduan_dosen') {
      if ($_FILES['file_pdosen']['name']) {
        $config['allowed_types'] = 'pdf|rar|zip';
        $config['upload_path'] = './uploads/panduan/';
        $config['max_size']     = '2048';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file_pdosen')) {
          $panduan = $this->db->get_where("panduan", ['id_panduan' => 2])->row_array();
          if (file_exists(FCPATH . 'uploads/panduan/' . $panduan['file_panduan']) ? unlink(FCPATH . 'uploads/panduan/' . $panduan['file_panduan']) : true && $this->db->update('panduan', ['file_panduan' => $this->upload->data('file_name')], ['id_panduan' => 2])) {
            $hasil = [
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
    } else if ($this->input->post('set') == 'save-update_panduan_mahasiswa') {
      if ($_FILES['file_pmahasiswa']['name']) {
        $config['allowed_types'] = 'pdf|rar|zip';
        $config['upload_path'] = './uploads/panduan/';
        $config['max_size']     = '2048';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file_pmahasiswa')) {
          $panduan = $this->db->get_where("panduan", ['id_panduan' => 1])->row_array();
          if (file_exists(FCPATH . 'uploads/panduan/' . $panduan['file_panduan']) ? unlink(FCPATH . 'uploads/panduan/' . $panduan['file_panduan']) : true && $this->db->update('panduan', ['file_panduan' => $this->upload->data('file_name')], ['id_panduan' => 1])) {
            $hasil = [
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
    }
    ////
    else {
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


  private function kirimEmail($email, $subject, $message)
  {
    $this->load->library('email', [
      // 'mailtype'    => 'html',
      // 'charset'     => 'utf-8',
      // 'protocol'    => 'smtp',
      // 'smtp_host'   => 'smtp.gmail.com',
      // 'smtp_user'   => 'sample@uis.ac.id',
      // 'smtp_pass'   => '11ramos91',
      // 'smtp_crypto' => 'ssl',
      // 'smtp_port'   => 465,
      // 'crlf'        => "\r\n",
      // 'newline'     => "\r\n"


      'protocol' => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_port' => 465,
      'smtp_user'   => 'sample@uis.ac.id',
      'smtp_pass'   => '11ramos91',
      'mailtype' => 'html',
      'charset' => 'iso-8859-1',
      'wordwrap' => TRUE
    ]);

    // $this->email->from('no-reply@uis.ac.id', 'Universitas Ibnu Sina');
    // $this->email->to($email);
    // $this->email->subject($subject);
    // $this->email->message($message);


    $this->email->set_newline("\r\n");
    $this->email->from('no-reply@uis.ac.id', 'Universitas Ibnu Sina');
    $this->email->to($email);
    $this->email->subject($subject);
    $this->email->message($message);
    return $this->email->send();
  }
}
