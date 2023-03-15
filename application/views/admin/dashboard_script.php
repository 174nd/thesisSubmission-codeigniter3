<!-- page script -->
<script>
  $(function() {

    function setDashboardAdmin() {
      table_spengajuan.ajax.reload();
      $.ajax({
        type: "POST",
        url: "<?= base_url('admin/get_data') ?>",
        dataType: "JSON",
        data: {
          'set': 'start-dashboard_admin',
        },
        success: function(data) {
          $('.small-box.mahasiswa h3').html(data['mahasiswa'] + ' <sup style="font-size: 20px">Orang</sup>');
          $('.small-box.dosen h3').html(data['dosen'] + ' <sup style="font-size: 20px">Orang</sup>');
          $('.small-box.pengajuan h3').html(data['pengajuan'] + ' <sup style="font-size: 20px">Pengajuan</sup>');
          $('.small-box.diterima h3').html(data['diterima'] + ' <sup style="font-size: 20px">Pengajuan</sup>');
        },
        error: function(request, status, error) {
          console.log(request.responseText);
        }
      });
    }

    var table_spengajuan = $('#table_spengajuan').DataTable({
      'paging': true,
      'lengthChange': false,
      "pageLength": 10,
      'info': true,
      "order": [
        [0, " desc"]
      ],
      'searching': true,
      'ordering': true,
      'autoWidth': false,
      "language": {
        "paginate": {
          "previous": "<",
          "next": ">"
        }
      },

      "processing": true,
      "serverSide": true,
      "ajax": {
        "url": "<?= base_url('ajax/getTables') ?>",
        "data": {
          "set_tables": 'SELECT * FROM pengajuan JOIN mahasiswa USING(id_mahasiswa) WHERE stt_pengajuan="proses"',
          'query': true
        },
        "type": "POST"
      },
      "columns": [{
        'className': "align-middle text-center",
        "data": "tgl_pengajuan",
        "width": "50px",
      }, {
        'className': "align-middle",
        "data": "nm_mahasiswa",
      }, {
        'className': "align-middle text-center",
        "data": "id_pengajuan",
        "width": "10px",
        "render": function(data, type, row, meta) {
          return '<div class="btn-group"><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#data-pengajuan" id_pengajuan="' + data + '"><i class="fa fa-eye"></i></button></div>';
        }
      }],
    });
    $('#table_spengajuan_filter').hide();
    $('#field_spengajuan').keyup(function() {
      table_spengajuan.columns($('#column_spengajuan').val()).search(this.value).draw();
    });

    table_spengajuan.on('click', 'button[data-target="#data-pengajuan"]', function() {
      $('#data-pengajuan').find('.overlay').removeClass('invisible');
      let id_pengajuan = $(this).attr('id_pengajuan');
      $.ajax({
        type: "POST",
        url: "<?= base_url('admin/get_data') ?>",
        dataType: "JSON",
        data: {
          'set': 'start-data_pengajuan',
          'id_pengajuan': id_pengajuan,
        },
        success: function(data) {
          console.log(data);
          if (data['status'] == 'done') {
            let mahasiswa = data['mahasiswa'];
            $('#data-pengajuan #nm_mahasiswa span').html(mahasiswa['nm_mahasiswa']);
            $('#data-pengajuan #nim_mahasiswa span').html(mahasiswa['nim_mahasiswa']);
            $('#data-pengajuan #nm_prodi span').html(mahasiswa['nm_prodi']);
            $('#data-pengajuan #nm_fakultas span').html(mahasiswa['nm_fakultas']);
            $('#data-pengajuan #nm_konsentrasi span').html(mahasiswa['nm_konsentrasi']);
            $('#data-pengajuan #no_telp span').html(mahasiswa['no_telp']);
            $('#data-pengajuan #tgl_pengajuan span').html(tanggal_indo(mahasiswa['tgl_pengajuan']));
            $('#data-pengajuan #stt_pengajuan span').html(mahasiswa['stt_pengajuan']);

            $('#data-pengajuan table tbody').html('');
            $(data['judul']).each(function(index, r1) {
              let isi_table = `
                <tr>
                  <td class='align-middle'>${r1['nm_judul']}</td>
                  <td class='align-middle text-center' style="width: 10px;">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#data-judul" id_judul="${r1['id_judul']}">
                      <i class="fa fa-eye"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              `;
              $('#data-pengajuan table tbody').append(isi_table);
            });


            $('#tolak-pengajuan #id_pengajuan').val(mahasiswa['id_pengajuan']);

            $('#data-pengajuan').find('.overlay').addClass('invisible');
          }
        },
        error: function(request, status, error) {
          console.log(request.responseText);
        }
      });
    });

    $('#data-pengajuan #id_judul p').click(function() {
      $('#data-judul').modal('show').find('.overlay').removeClass('invisible');
      let id_judul = $(this).attr('id_judul');
      let nm_judul = $(this).html();
      console.log(nm_judul);
      $.ajax({
        type: "POST",
        url: "<?= base_url('admin/get_data') ?>",
        dataType: "JSON",
        data: {
          'set': 'start-detail_judul',
          'id_judul': id_judul,
        },
        success: function(data) {
          console.log(data);
          if (data['status'] == 'done') {
            let judul = data['judul'];

            $('#data-judul #nm_judul p').html(nm_judul);
            $('#data-judul #unsur_perusahaan p').html(judul['unsur_pimpinan'] + ' - ' + judul['nm_perusahaan']);
            $('#data-judul #latar_belakang p').html(judul['latar_belakang']);
            $('#data-judul #gambaran_judul p').html(judul['gambaran_judul']);
            $('#data-judul #kelebihan_judul p').html(judul['kelebihan_judul']);


            $('#data-judul table tbody').html('');
            $(data['jurnal']).each(function(index, r1) {
              let isi_table = `
                <tr>
                  <td class='align-middle text-center'><a href="<?= base_url('uploads/jurnal/') ?>${r1['file_jurnal']}" target="_blank">${r1['file_jurnal']}</a></td>
                </tr>
              `;
              $('#data-judul table tbody').append(isi_table);
            });

            $('#data-judul').find('.overlay').addClass('invisible');
          } else {
            toastr.error('Data Gagal di Eksekusi! Ada kesalahan pada query, Silahkan cek lagi!');
          }
        },
        error: function(request, status, error) {
          console.log(request.responseText);
        }
      });
    });

    $('#data-pengajuan table tbody').on('click', 'button[data-target="#data-judul"]', function() {
      $('#data-judul .overlay').removeClass('invisible');
      let id_judul = $(this).attr('id_judul');
      $.ajax({
        type: "POST",
        url: "<?= base_url('admin/get_data') ?>",
        dataType: "JSON",
        data: {
          'set': 'start-detail_judul',
          'id_judul': id_judul,
        },
        success: function(data) {
          console.log(data);
          if (data['status'] == 'done') {
            let judul = data['judul'];

            $('#data-judul #nm_judul p').html(judul['nm_judul']);
            $('#data-judul #unsur_perusahaan p').html(judul['unsur_pimpinan'] + ' - ' + judul['nm_perusahaan']);
            $('#data-judul #latar_belakang p').html(judul['latar_belakang']);
            $('#data-judul #gambaran_judul p').html(judul['gambaran_judul']);
            $('#data-judul #kelebihan_judul p').html(judul['kelebihan_judul']);

            $('#data-judul table tbody').html('');
            $(data['jurnal']).each(function(index, r1) {
              let isi_table = `
                <tr>
                  <td class='align-middle text-center'><a href="<?= base_url('uploads/jurnal/') ?>${r1['file_jurnal']}" target="_blank">${r1['file_jurnal']}</a></td>
                </tr>
              `;
              $('#data-judul table tbody').append(isi_table);
            });



            $('#terima-judul #id_pengajuan').val(judul['id_pengajuan']);
            $('#terima-judul #id_judul').val(judul['id_judul']);
            $('#terima-judul #nm_judul').val(judul['nm_judul']);
            $('#terima-judul #pemb_1').empty().select2({
              data: data['dosen'],
              width: "100%",
              theme: 'bootstrap4',
            });
            $('#terima-judul #pemb_2').empty().select2({
              data: data['dosen'],
              width: "100%",
              theme: 'bootstrap4',
            });

            $('#data-judul').find('.overlay').addClass('invisible');
          } else {
            toastr.error('Data Gagal di Eksekusi! Ada kesalahan pada query, Silahkan cek lagi!');
          }
        },
        error: function(request, status, error) {
          console.log(request.responseText);
        }
      });
    });

    $('#tolak-pengajuan #simpan-penolakan').click(function() {
      let id_pengajuan = $('#tolak-pengajuan #id_pengajuan');
      let ket_pengajuan = $('#tolak-pengajuan #ket_pengajuan');
      if (id_pengajuan.val() == '' || ket_pengajuan.val() == '') {
        toastr.warning('Lengkapi Data Terlebih Dahulu!');
      } else {
        $('#tolak-pengajuan').find('.overlay').removeClass('invisible');
        $.ajax({
          type: "POST",
          url: "<?= base_url('admin/get_data') ?>",
          dataType: "JSON",
          data: {
            'set': 'save-tolak_pengajuan',
            'id_pengajuan': id_pengajuan.val(),
            'ket_pengajuan': ket_pengajuan.val(),
          },
          success: function(data) {
            console.log(data);
            if (data['status'] == 'done') {
              id_pengajuan.val('');
              ket_pengajuan.val('');
              setDashboardAdmin();
              toastr.success('Pengajuan Berhasil Di Tolak!');
              $('#data-pengajuan').modal('hide');
              $('#tolak-pengajuan').modal('hide').find('.overlay').addClass('invisible');
            } else {
              toastr.error('Data Gagal di Eksekusi! Ada kesalahan pada query, Silahkan cek lagi!');
            }
          },
          error: function(request, status, error) {
            console.log(request.responseText);
          }
        });
      }
    });

    $('#terima-judul #simpan-pengajuan').click(function() {
      let id_pengajuan = $('#terima-judul #id_pengajuan');
      let id_judul = $('#terima-judul #id_judul');
      let nm_judul = $('#terima-judul #nm_judul');
      let pemb_1 = $('#terima-judul #pemb_1');
      let pemb_2 = $('#terima-judul #pemb_2');
      console.log(id_pengajuan.val());
      console.log(id_judul.val());
      console.log(nm_judul.val());
      console.log(pemb_1.val());
      console.log(pemb_2.val());

      if (id_pengajuan.val() == '' || id_judul.val() == '' || nm_judul.val() == '' || pemb_1.val() == '' || pemb_2.val() == '' || (pemb_1.val() == pemb_2.val())) {
        toastr.warning('Lengkapi Data Terlebih Dahulu!');
      } else {
        $('#terima-judul').find('.overlay').removeClass('invisible');
        $.ajax({
          type: "POST",
          url: "<?= base_url('admin/get_data') ?>",
          dataType: "JSON",
          data: {
            'set': 'save-terima_judul',
            'id_pengajuan': id_pengajuan.val(),
            'id_judul': id_judul.val(),
            'nm_judul': nm_judul.val(),
            'pemb_1': pemb_1.val(),
            'pemb_2': pemb_2.val(),
          },
          success: function(data) {
            console.log(data);
            if (data['status'] == 'done') {
              id_pengajuan.val('');
              id_judul.val('');
              nm_judul.val('');
              pemb_1.val('');
              pemb_2.val('');
              setDashboardAdmin();
              toastr.success('Pengajuan Berhasil Di Simpan!');
              $('#data-pengajuan').modal('hide');
              $('#data-judul').modal('hide');
              $('#terima-judul').modal('hide').find('.overlay').addClass('invisible');
            } else {
              toastr.error('Data Gagal di Eksekusi! Ada kesalahan pada query, Silahkan cek lagi!');
            }
          },
          error: function(request, status, error) {
            console.log(request.responseText);
          }
        });
      }
    });


    $("#bln_pengajuan").datepicker({
      autoclose: true,
      useCurrent: true,
      format: "MM yyyy",
      viewMode: "months",
      minViewMode: "months",
      endDate: Infinity,
      orientation: "bottom",
    });

    let table_dpengajuan = $('#table_dpengajuan').DataTable({
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
        [0, "asc"]
      ],
    });
    $('#table_dpengajuan_filter').hide();
    $('#field_dpengajuan').keyup(function() {
      table_dpengajuan.columns($('#column_dpengajuan').val()).search(this.value).draw();
    });

    $('#cari-pengajuan #mulai-cari').click(function() {
      let bln_pengajuan = $('#cari-pengajuan #bln_pengajuan');
      if (bln_pengajuan.val() == '') {
        toastr.warning('Lengkapi Data Terlebih Dahulu!');
      } else {
        $('#histori-pengajuan').modal('show').find('.overlay').removeClass('invisible');
        $.ajax({
          type: "POST",
          url: "<?= base_url('admin/get_data') ?>",
          dataType: "JSON",
          data: {
            'set': 'start-cari_pengajuan',
            'bln_pengajuan': bln_pengajuan.val(),
          },
          success: function(data) {
            // console.log(data);
            if (data['status'] == 'done') {
              table_dpengajuan.clear().draw();
              $(data['pengajuan']).each(function(index, r1) {
                console.log(r1);
                let hasil_button = `
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-primary" id_pengajuan="${r1['id_pengajuan']}" data-toggle="modal" data-target="#detail-pengajuan">
                    <i class="fa fa-eye"></i>
                  </button>
                </div>`;
                table_dpengajuan.row.add([r1['tgl_pengajuan'], r1['tgl_pengecekan'], r1['nm_mahasiswa'], r1['stt_pengajuan'], hasil_button]).draw().node();
              });
            } else {
              toastr.error('Data Gagal di Eksekusi! Ada kesalahan pada query, Silahkan cek lagi!');
            }
            $('#histori-pengajuan').modal('hide').find('.overlay').addClass('invisible');
          },
          error: function(request, status, error) {
            console.log(request.responseText);
          }
        });
      }
    });

    table_dpengajuan.on('click', 'button[data-target="#detail-pengajuan"]', function() {
      $('#detail-pengajuan').find('.overlay').removeClass('invisible');
      let id_pengajuan = $(this).attr('id_pengajuan');
      $.ajax({
        type: "POST",
        url: "<?= base_url('admin/get_data') ?>",
        dataType: "JSON",
        data: {
          'set': 'start-detail_pengajuan',
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

            if (mahasiswa['stt_pengajuan'] == 'proses') {
              $('#detail-pengajuan #tgl_pengecekan').addClass('d-none');
              $('#detail-pengajuan #ket_pengajuan').addClass('d-none');
              $('#detail-pengajuan #id_judul').addClass('d-none');
              $('#detail-pengajuan #pemb_1').addClass('d-none');
              $('#detail-pengajuan #pemb_2').addClass('d-none');
            } else if (mahasiswa['stt_pengajuan'] == 'tolak') {
              $('#detail-pengajuan #tgl_pengecekan').removeClass('d-none').find('span').html(tanggal_indo(mahasiswa['tgl_pengecekan']));
              $('#detail-pengajuan #ket_pengajuan').removeClass('d-none').find('p').html(mahasiswa['ket_pengajuan']);
              $('#detail-pengajuan #id_judul').addClass('d-none');
              $('#detail-pengajuan #pemb_1').addClass('d-none');
              $('#detail-pengajuan #pemb_2').addClass('d-none');
            } else {
              $('#detail-pengajuan #tgl_pengecekan').removeClass('d-none').find('span').html(tanggal_indo(mahasiswa['tgl_pengecekan']));
              $('#detail-pengajuan #ket_pengajuan').addClass('d-none');
              $('#detail-pengajuan #id_judul').removeClass('d-none').find('p').attr('id_judul', mahasiswa['id_judul']).html(mahasiswa['nm_judul']);
              $('#detail-pengajuan #pemb_1').removeClass('d-none').find('span').html(mahasiswa['nm_pemb1']);
              $('#detail-pengajuan #pemb_2').removeClass('d-none').find('span').html(mahasiswa['nm_pemb2']);
            }

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
        url: "<?= base_url('admin/get_data') ?>",
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
        url: "<?= base_url('admin/get_data') ?>",
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




    $('#update-panduan-dosen #simpan-panduan').click(function() {
      let file_pdosen = $('#update-panduan-dosen #file_pdosen')[0].files;
      if (file_pdosen.length <= 0) {
        toastr.warning('Lengkapi Data Terlebih Dahulu!');
      } else {
        $('#update-panduan-dosen').find('.overlay').removeClass('invisible');
        var formData = new FormData();
        formData.append('set', 'save-update_panduan_dosen');
        formData.append('file_pdosen', file_pdosen[0]);
        $.ajax({
          type: "POST",
          url: "<?= base_url('admin/get_data') ?>",
          dataType: "JSON",
          data: formData,
          contentType: false,
          cache: false,
          processData: false,
          success: function(data) {
            if (data['status'] == 'done') {
              $('#update-panduan-dosen form')[0].reset();
              toastr.success('Panduan Dosen Berhasil Diubah!');
              $('#update-panduan-dosen').modal('hide').find('.overlay').addClass('invisible');
            } else {
              toastr.error(data['status']);
            }
          },
          error: function(request, status, error) {
            console.log(request.responseText);
          }
        });
      }
    });

    $('#update-panduan-mahasiswa #simpan-panduan').click(function() {
      let file_pmahasiswa = $('#update-panduan-mahasiswa #file_pmahasiswa')[0].files;
      if (file_pmahasiswa.length <= 0) {
        toastr.warning('Lengkapi Data Terlebih Dahulu!');
      } else {
        $('#update-panduan-mahasiswa').find('.overlay').removeClass('invisible');
        var formData = new FormData();
        formData.append('set', 'save-update_panduan_mahasiswa');
        formData.append('file_pmahasiswa', file_pmahasiswa[0]);
        $.ajax({
          type: "POST",
          url: "<?= base_url('admin/get_data') ?>",
          dataType: "JSON",
          data: formData,
          contentType: false,
          cache: false,
          processData: false,
          success: function(data) {
            if (data['status'] == 'done') {
              $('#update-panduan-mahasiswa form')[0].reset();
              toastr.success('Panduan Mahasiswa Berhasil Diubah!');
              $('#update-panduan-mahasiswa').modal('hide').find('.overlay').addClass('invisible');
            } else {
              toastr.error(data['status']);
            }
          },
          error: function(request, status, error) {
            console.log(request.responseText);
          }
        });
      }
    });


    setDashboardAdmin();

  });
</script>