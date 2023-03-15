<script>
  $(function() {

    function setDashboardDosen() {
      $.ajax({
        type: "POST",
        url: "<?= base_url('dosen/get_data') ?>",
        dataType: "JSON",
        data: {
          'set': 'start-dashboard_dosen',
        },
        success: function(data) {
          console.log(data);
          let judul = ' <sup style="font-size: 20px">Judul</sup>';
          $('.small-box.total h3').html((parseInt(data['total_1']) + parseInt(data['total_2'])) + judul);
          $('.small-box.pertama h3').html(data['total_1'] + judul);
          $('.small-box.kedua h3').html(data['total_2'] + judul);


          table_hpengajuan.clear().draw();
          $(data['pengajuan']).each(function(index, r1) {
            let hasil_button = `
            <div class="btn-group">
              <button type="button" class="btn btn-sm btn-primary" id_pengajuan="${r1['id_pengajuan']}" data-toggle="modal" data-target="#detail-pengajuan">
                <i class="fa fa-eye"></i>
              </button>
            </div>`;
            table_hpengajuan.row.add([r1['tgl_pengecekan'], r1['nm_judul'], r1['pembimbing'], hasil_button]).draw().node();
          });
        },
        error: function(request, status, error) {
          console.log(request.responseText);
        }
      });
    }



    let table_hpengajuan = $('#table_hpengajuan').DataTable({
      'paging': true,
      'lengthChange': false,
      "pageLength": 10,
      'info': true,
      'searching': true,
      'ordering': true,
      'autoWidth': false,
      "language": {
        "paginate": {
          "previous": "<",
          "next": ">"
        }
      },
      "columns": [{
        'className': "align-middle text-center",
        "width": "50px",
      }, {
        'className': "align-middle",
      }, {
        'className': "align-middle text-center",
        "width": "50px",
      }, {
        'className': "align-middle text-center",
        "width": "30px",
      }, ],
      "order": [
        [0, "desc"]
      ],
    });
    $('#table_hpengajuan_filter').hide();
    $('#field_hpengajuan').keyup(function() {
      table_hpengajuan.columns($('#column_hpengajuan').val()).search(this.value).draw();
    });


    table_hpengajuan.on('click', 'button[data-target="#detail-pengajuan"]', function() {
      $('#detail-pengajuan').find('.overlay').removeClass('invisible');
      let id_pengajuan = $(this).attr('id_pengajuan');
      $.ajax({
        type: "POST",
        url: "<?= base_url('dosen/get_data') ?>",
        dataType: "JSON",
        data: {
          'set': 'start-data_pengajuan',
          'id_pengajuan': id_pengajuan,
        },
        success: function(data) {
          console.log(data);
          if (data['status'] == 'done') {
            let mahasiswa = data['mahasiswa'];
            $('#detail-pengajuan #nm_mahasiswa span').html(mahasiswa['nm_mahasiswa']);
            $('#detail-pengajuan #nim_mahasiswa span').html(mahasiswa['nim_mahasiswa']);
            $('#detail-pengajuan #nm_prodi span').html(mahasiswa['nm_prodi']);
            $('#detail-pengajuan #nm_fakultas span').html(mahasiswa['nm_fakultas']);
            $('#detail-pengajuan #nm_konsentrasi span').html(mahasiswa['nm_konsentrasi']);
            $('#detail-pengajuan #no_telp span').html(mahasiswa['no_telp']);
            $('#detail-pengajuan #tgl_pengajuan span').html(tanggal_indo(mahasiswa['tgl_pengajuan']));
            $('#detail-pengajuan #stt_pengajuan span').html(mahasiswa['stt_pengajuan']);

            $('#detail-pengajuan #tgl_pengecekan span').html(tanggal_indo(mahasiswa['tgl_pengecekan']));
            $('#detail-pengajuan #id_judul p').attr('id_judul', mahasiswa['id_judul']).html(mahasiswa['nm_judul']);
            $('#detail-pengajuan #pemb_1 span').html(mahasiswa['nm_pemb1']);
            $('#detail-pengajuan #pemb_2 span').html(mahasiswa['nm_pemb2']);

            $('#detail-pengajuan table tbody').html('');
            $(data['judul']).each(function(index, r1) {
              let isi_table = `
                <tr>
                  <td class='align-middle'>${r1['nm_judul']}</td>
                  <td class='align-middle text-center' style="width: 10px;">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#detail-judul" id_judul="${r1['id_judul']}">
                      <i class="fa fa-eye"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              `;
              $('#detail-pengajuan table tbody').append(isi_table);
            });

            $('#detail-pengajuan').find('.overlay').addClass('invisible');
          }
        },
        error: function(request, status, error) {
          console.log(request.responseText);
        }
      });
    });

    $('#detail-pengajuan #id_judul p').click(function() {
      $('#detail-judul').modal('show').find('.overlay').removeClass('invisible');
      let id_judul = $(this).attr('id_judul');
      let nm_judul = $(this).html();
      console.log(nm_judul);
      $.ajax({
        type: "POST",
        url: "<?= base_url('dosen/get_data') ?>",
        dataType: "JSON",
        data: {
          'set': 'start-detail_judul',
          'id_judul': id_judul,
        },
        success: function(data) {
          console.log(data);
          if (data['status'] == 'done') {
            let judul = data['judul'];

            $('#detail-judul #nm_judul p').html(nm_judul);
            $('#detail-judul #unsur_perusahaan p').html(judul['unsur_pimpinan'] + ' - ' + judul['nm_perusahaan']);
            $('#detail-judul #latar_belakang p').html(judul['latar_belakang']);
            $('#detail-judul #gambaran_judul p').html(judul['gambaran_judul']);
            $('#detail-judul #kelebihan_judul p').html(judul['kelebihan_judul']);


            $('#detail-judul table tbody').html('');
            $(data['jurnal']).each(function(index, r1) {
              let isi_table = `
                <tr>
                  <td class='align-middle text-center'><a href="<?= base_url('uploads/jurnal/') ?>${r1['file_jurnal']}" target="_blank">${r1['file_jurnal']}</a></td>
                </tr>
              `;
              $('#detail-judul table tbody').append(isi_table);
            });

            $('#detail-judul').find('.overlay').addClass('invisible');
          } else {
            toastr.error('Data Gagal di Eksekusi! Ada kesalahan pada query, Silahkan cek lagi!');
          }
        },
        error: function(request, status, error) {
          console.log(request.responseText);
        }
      });
    });

    $('#detail-pengajuan table tbody').on('click', 'button[data-target="#detail-judul"]', function() {
      $('#detail-judul .overlay').removeClass('invisible');
      let id_judul = $(this).attr('id_judul');
      $.ajax({
        type: "POST",
        url: "<?= base_url('dosen/get_data') ?>",
        dataType: "JSON",
        data: {
          'set': 'start-detail_judul',
          'id_judul': id_judul,
        },
        success: function(data) {
          console.log(data);
          if (data['status'] == 'done') {
            let judul = data['judul'];

            $('#detail-judul #nm_judul p').html(judul['nm_judul']);
            $('#detail-judul #unsur_perusahaan p').html(judul['unsur_pimpinan'] + ' - ' + judul['nm_perusahaan']);
            $('#detail-judul #latar_belakang p').html(judul['latar_belakang']);
            $('#detail-judul #gambaran_judul p').html(judul['gambaran_judul']);
            $('#detail-judul #kelebihan_judul p').html(judul['kelebihan_judul']);

            $('#detail-judul table tbody').html('');
            $(data['jurnal']).each(function(index, r1) {
              let isi_table = `
                <tr>
                  <td class='align-middle text-center'><a href="<?= base_url('uploads/jurnal/') ?>${r1['file_jurnal']}" target="_blank">${r1['file_jurnal']}</a></td>
                </tr>
              `;
              $('#detail-judul table tbody').append(isi_table);
            });

            $('#detail-judul').find('.overlay').addClass('invisible');
          } else {
            toastr.error('Data Gagal di Eksekusi! Ada kesalahan pada query, Silahkan cek lagi!');
          }
        },
        error: function(request, status, error) {
          console.log(request.responseText);
        }
      });
    });


    setDashboardDosen();
  });
</script>