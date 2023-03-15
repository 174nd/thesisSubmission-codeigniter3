<script>
  $(function() {

    function setDashboardMahasiswa() {
      let pilih_konsentrasi = $('.card.pilih_konsentrasi');
      let input_pengajuan = $('.card.input_pengajuan');
      let data_pengajuan = $('.card.data_pengajuan');
      let cetak_sk = $('.card.cetak_sk');


      let status_none = $('.alert.status_none');
      let status_terima = $('.alert.status_terima');
      let status_proses = $('.alert.status_proses');
      let status_tolak = $('.alert.status_tolak');

      pilih_konsentrasi.addClass('d-none');
      input_pengajuan.addClass('d-none');
      data_pengajuan.addClass('d-none');
      cetak_sk.addClass('d-none');

      status_none.addClass('d-none');
      status_terima.addClass('d-none');
      status_proses.addClass('d-none');
      status_tolak.addClass('d-none');
      $.ajax({
        type: "POST",
        url: "<?= base_url('mahasiswa/get_data') ?>",
        dataType: "JSON",
        data: {
          'set': 'start-dashboard_mahasiswa',
        },
        success: function(data) {
          console.log(data);
          let hasil = data['stt_mahasiswa'];
          if (hasil == 'input') {
            status_none.removeClass('d-none');
            input_pengajuan.removeClass('d-none');
          } else if (hasil == 'proses') {
            status_proses.removeClass('d-none');
            data_pengajuan.removeClass('d-none');
          } else if (hasil == 'terima') {
            status_terima.removeClass('d-none');
            cetak_sk.removeClass('d-none');
            $('.alert.status_terima p').html(data['isian']);
          } else if (hasil == 'tolak') {
            status_tolak.removeClass('d-none');
            pilih_konsentrasi.removeClass('d-none');
            $('.alert.status_tolak p').html(data['isian']);
          } else {
            status_none.removeClass('d-none');
            pilih_konsentrasi.removeClass('d-none');
          }


          table_hpengajuan.clear().draw();
          $(data['pengajuan']).each(function(index, r1) {
            let hasil_button = `
            <div class="btn-group">
              <button type="button" class="btn btn-sm btn-primary" id_pengajuan="${r1['id_pengajuan']}" data-toggle="modal" data-target="#data-pengajuan">
                <i class="fa fa-eye"></i>
              </button>
            </div>`;
            table_hpengajuan.row.add([r1['tgl_pengajuan'], r1['judul'], r1['stt_pengajuan'], hasil_button]).draw().node();
          });
        },
        error: function(request, status, error) {
          console.log(request.responseText);
        }
      });
    }

    function resetTableInputPengajuan(judul) {
      $('#input-pengajuan table tbody').html('');
      let btn_ajukan = judul.length < 3 ? false : true;
      let stt_ajukan = false;
      if (judul.length > 0) {
        if (judul.length < 3) stt_ajukan = true;
        $(judul).each(function(index, r1) {
          if (!r1['stt_judul']) stt_ajukan = true;
          let isi_table = `
            <tr>
              <td class='align-middle'>${r1['nm_judul']}</td>
              <td class='align-middle text-center' style="width: 50px;">${r1['stt_judul'] ? 'Y':'N'}</td>
              <td class='align-middle text-center' style="width: 10px;">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#data-judul" id_judul="${r1['id_judul']}">
                  <i class="fa fa-eye"></i>
                  </button>
                </div>
              </td>
            </tr>
          `;
          $('#input-pengajuan table tbody').append(isi_table);
        });
      } else {
        stt_ajukan = true;
        $('#input-pengajuan table tbody').append(`
          <tr>
            <td class='align-middle text-center' colspan="3">Belum ada pengajuan Judul!</td>
          </tr>
        `);
      }


      $('#input-pengajuan button[data-target="#ajukan-judul"]').attr('disabled', btn_ajukan);
      $('#input-pengajuan button[data-target="#konfirmasi-pengajuan"]').attr('disabled', stt_ajukan);
    }

    function resetTableDataJudul(jurnal, judul = null) {
      $('#data-judul table tbody').html('');
      if (jurnal.length > 0) {
        $(jurnal).each(function(index, r1) {
          let isi_table = `
            <tr>
              <td class='align-middle text-center'><a href="<?= base_url('uploads/jurnal/') ?>${r1['file_jurnal']}" target="_blank">${r1['file_jurnal']}</a></td>
              <td class='align-middle text-center' style="width: 10px;">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapus-jurnal" onclick="$('#hapus-jurnal #id_jurnal').val(${r1['id_jurnal']})" >
                  <i class="fa fa-trash-alt"></i>
                  </button>
                </div>
              </td>
            </tr>
          `;
          $('#data-judul table tbody').append(isi_table);
        });
      } else {
        $('#data-judul table tbody').append(`
          <tr>
            <td class='align-middle text-center' colspan="2">Belum ada Jurnal!</td>
          </tr>
        `);
      }
      if (judul != null) resetTableInputPengajuan(judul);
    }

    $('button[data-target="#pilih-konsentrasi"]').click(function() {
      $('#pilih-konsentrasi').find('.overlay').removeClass('invisible');
      $.ajax({
        type: "POST",
        url: "<?= base_url('mahasiswa/get_data') ?>",
        dataType: "JSON",
        data: {
          'set': 'start-pilih_konsentrasi',
        },
        success: function(data) {
          console.log(data);
          if (data['status'] == 'done') {
            $('#pilih-konsentrasi #id_konsentrasi').empty().select2({
              data: data['konsentrasi'],
              width: "100%",
              theme: 'bootstrap4',
            });
            $('#pilih-konsentrasi').find('.overlay').addClass('invisible');
          }
        },
        error: function(request, status, error) {
          console.log(request.responseText);
        }
      });
    });

    $('#pilih-konsentrasi #simpan-konsentrasi').click(function() {
      $('#pilih-konsentrasi').find('.overlay').removeClass('invisible');
      let id_konsentrasi = $('#pilih-konsentrasi #id_konsentrasi').val();
      $.ajax({
        type: "POST",
        url: "<?= base_url('mahasiswa/get_data') ?>",
        dataType: "JSON",
        data: {
          'set': 'save-simpan_konsentrasi',
          'id_konsentrasi': id_konsentrasi,
        },
        success: function(data) {
          console.log(data);
          if (data['status'] == 'done') {
            setDashboardMahasiswa();
            toastr.success('Konsentrasi Berhasil Di Tambah!');
            $('button[data-target="#input-pengajuan"]').trigger('click');
            $('#pilih-konsentrasi').modal('hide').find('.overlay').addClass('invisible');
          } else {
            toastr.error('Data Gagal di Eksekusi! Ada kesalahan pada query, Silahkan cek lagi!');
          }
        },
        error: function(request, status, error) {
          console.log(request.responseText);
        }
      });
    });

    $('button[data-target="#ubah-konsentrasi"]').click(function() {
      $('#ubah-konsentrasi').find('.overlay').removeClass('invisible');
      $.ajax({
        type: "POST",
        url: "<?= base_url('mahasiswa/get_data') ?>",
        dataType: "JSON",
        data: {
          'set': 'start-pilih_konsentrasi',
        },
        success: function(data) {
          console.log(data);
          if (data['status'] == 'done') {
            $('#ubah-konsentrasi #id_konsentrasi').empty().select2({
              data: data['konsentrasi'],
              width: "100%",
              theme: 'bootstrap4',
            });
            $('#ubah-konsentrasi').find('.overlay').addClass('invisible');
          }
        },
        error: function(request, status, error) {
          console.log(request.responseText);
        }
      });
    });

    $('#ubah-konsentrasi #simpan-konsentrasi').click(function() {
      $('#ubah-konsentrasi').find('.overlay').removeClass('invisible');
      let id_konsentrasi = $('#ubah-konsentrasi #id_konsentrasi').val();
      $.ajax({
        type: "POST",
        url: "<?= base_url('mahasiswa/get_data') ?>",
        dataType: "JSON",
        data: {
          'set': 'save-ubah_konsentrasi',
          'id_konsentrasi': id_konsentrasi,
        },
        success: function(data) {
          console.log(data);
          if (data['status'] == 'done') {
            toastr.success('Konsentrasi Berhasil Di Ubah!');
            $('#input-pengajuan').modal('hide');
            $('#ubah-konsentrasi').modal('hide').find('.overlay').addClass('invisible');
          } else {
            toastr.error('Data Gagal di Eksekusi! Ada kesalahan pada query, Silahkan cek lagi!');
          }
        },
        error: function(request, status, error) {
          console.log(request.responseText);
        }
      });
    });

    $('button[data-target="#input-pengajuan"]').click(function() {
      $('#input-pengajuan').find('.overlay').removeClass('invisible');
      $.ajax({
        type: "POST",
        url: "<?= base_url('mahasiswa/get_data') ?>",
        dataType: "JSON",
        data: {
          'set': 'start-input_pengajuan',
        },
        success: function(data) {
          console.log(data);
          if (data['status'] == 'done') {
            let mahasiswa = data['mahasiswa'];
            $('#input-pengajuan #nm_mahasiswa span').html(mahasiswa['nm_mahasiswa']);
            $('#input-pengajuan #nim_mahasiswa span').html(mahasiswa['nim_mahasiswa']);
            $('#input-pengajuan #nm_prodi span').html(mahasiswa['nm_prodi']);
            $('#input-pengajuan #nm_fakultas span').html(mahasiswa['nm_fakultas']);
            $('#input-pengajuan #nm_konsentrasi span').html(mahasiswa['nm_konsentrasi']);
            $('#input-pengajuan #no_telp span').html(mahasiswa['no_telp']);

            resetTableInputPengajuan(data['judul']);

            // $('#ajukan-judul #id_pengajuan').val(mahasiswa['id_pengajuan']);


            $('#input-pengajuan').find('.overlay').addClass('invisible');
          }
        },
        error: function(request, status, error) {
          console.log(request.responseText);
        }
      });
    });

    $('button[data-target="#ajukan-judul"]').click(function() {
      $('#ajukan-judul').find('.overlay').removeClass('invisible');
      $.ajax({
        type: "POST",
        url: "<?= base_url('mahasiswa/get_data') ?>",
        dataType: "JSON",
        data: {
          'set': 'start-ajukan_judul',
        },
        success: function(data) {
          console.log(data);
          if (data['status'] == 'done') {
            $('#ajukan-judul #id_pimpinan').empty().select2({
              data: data['pimpinan'],
              width: "100%",
              theme: 'bootstrap4',
            });
            $('#ajukan-judul').find('.overlay').addClass('invisible');
          }
        },
        error: function(request, status, error) {
          console.log(request.responseText);
        }
      });
    });

    $('#ajukan-judul #simpan-judul').click(function() {
      // let id_pengajuan = $('#ajukan-judul #id_pengajuan');
      let nm_judul = $('#ajukan-judul #nm_judul');
      let id_pimpinan = $('#ajukan-judul #id_pimpinan');
      let nm_perusahaan = $('#ajukan-judul #nm_perusahaan');
      let latar_belakang = $('#ajukan-judul #latar_belakang');
      let gambaran_judul = $('#ajukan-judul #gambaran_judul');
      let kelebihan_judul = $('#ajukan-judul #kelebihan_judul');
      if (nm_judul.val() == '' || id_pimpinan.val() == '' || nm_perusahaan.val() == '' || latar_belakang.val() == '' || gambaran_judul.val() == '' || kelebihan_judul.val() == '') {
        toastr.warning('Lengkapi Data Terlebih Dahulu!');
      } else {
        $('#ajukan-judul').find('.overlay').removeClass('invisible');
        $.ajax({
          type: "POST",
          url: "<?= base_url('mahasiswa/get_data') ?>",
          dataType: "JSON",
          data: {
            'set': 'save-simpan_judul',
            // 'id_pengajuan': id_pengajuan.val(),
            'nm_judul': nm_judul.val(),
            'id_pimpinan': id_pimpinan.val(),
            'nm_perusahaan': nm_perusahaan.val(),
            'latar_belakang': latar_belakang.val(),
            'gambaran_judul': gambaran_judul.val(),
            'kelebihan_judul': kelebihan_judul.val(),
          },
          success: function(data) {
            console.log(data);
            if (data['status'] == 'done') {
              resetTableInputPengajuan(data['judul']);


              // id_pengajuan.val('');
              nm_judul.val('');
              id_pimpinan.val('');
              nm_perusahaan.val('');
              latar_belakang.val('');
              gambaran_judul.val('');
              kelebihan_judul.val('');
              toastr.success('Judul Berhasil Di Tambah!');
              $('#ajukan-judul').modal('hide').find('.overlay').addClass('invisible');
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

    $('#input-pengajuan table tbody').on('click', 'button[data-target="#data-judul"]', function() {
      $('#data-judul .overlay').removeClass('invisible');
      let id_judul = $(this).attr('id_judul');
      $.ajax({
        type: "POST",
        url: "<?= base_url('mahasiswa/get_data') ?>",
        dataType: "JSON",
        data: {
          'set': 'start-data_judul',
          'id_judul': id_judul,
        },
        success: function(data) {
          console.log(data);
          if (data['status'] == 'done') {
            let judul = data['judul'];
            resetTableDataJudul(data['jurnal']);

            $('#data-judul #nm_judul p').html(judul['nm_judul']);
            $('#data-judul #unsur_perusahaan p').html(judul['unsur_pimpinan'] + ' - ' + judul['nm_perusahaan']);
            $('#data-judul #latar_belakang p').html(judul['latar_belakang']);
            $('#data-judul #gambaran_judul p').html(judul['gambaran_judul']);
            $('#data-judul #kelebihan_judul p').html(judul['kelebihan_judul']);


            $('#data-judul button[data-target="#ubah-judul"]').attr('id_judul', judul['id_judul']);
            $('#hapus-judul #id_judul').val(judul['id_judul']);

            $('#tambah-jurnal #id_judul').val(judul['id_judul']);


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

    $('button[data-target="#ubah-judul"]').click(function() {
      $('#ubah-judul').find('.overlay').removeClass('invisible');
      let id_judul = $(this).attr('id_judul');
      $.ajax({
        type: "POST",
        url: "<?= base_url('mahasiswa/get_data') ?>",
        dataType: "JSON",
        data: {
          'set': 'start-ubah_judul',
          'id_judul': id_judul,
        },
        success: function(data) {
          console.log(data);
          if (data['status'] == 'done') {
            $('#ubah-judul #id_pimpinan').empty().select2({
              data: data['pimpinan'],
              width: "100%",
              theme: 'bootstrap4',
            });

            let judul = data['judul'];
            $('#ubah-judul #id_judul').val(judul['id_judul']);
            $('#ubah-judul #nm_judul').val(judul['nm_judul']);
            $('#ubah-judul #id_pimpinan').val(judul['id_pimpinan']).trigger('change.select2');
            $('#ubah-judul #nm_perusahaan').val(judul['nm_perusahaan']);
            $('#ubah-judul #latar_belakang').val(judul['latar_belakang']);
            $('#ubah-judul #gambaran_judul').val(judul['gambaran_judul']);
            $('#ubah-judul #kelebihan_judul').val(judul['kelebihan_judul']);


            $('#ubah-judul').find('.overlay').addClass('invisible');
          }
        },
        error: function(request, status, error) {
          console.log(request.responseText);
        }
      });
    });

    $('#ubah-judul #simpan-judul').click(function() {
      let id_judul = $('#ubah-judul #id_judul');
      let nm_judul = $('#ubah-judul #nm_judul');
      let id_pimpinan = $('#ubah-judul #id_pimpinan');
      let nm_perusahaan = $('#ubah-judul #nm_perusahaan');
      let latar_belakang = $('#ubah-judul #latar_belakang');
      let gambaran_judul = $('#ubah-judul #gambaran_judul');
      let kelebihan_judul = $('#ubah-judul #kelebihan_judul');
      if (id_judul.val() == '' || nm_judul.val() == '' || id_pimpinan.val() == '' || nm_perusahaan.val() == '' || latar_belakang.val() == '' || gambaran_judul.val() == '' || kelebihan_judul.val() == '') {
        toastr.warning('Lengkapi Data Terlebih Dahulu!');
      } else {
        $('#ubah-judul').find('.overlay').removeClass('invisible');
        $.ajax({
          type: "POST",
          url: "<?= base_url('mahasiswa/get_data') ?>",
          dataType: "JSON",
          data: {
            'set': 'save-ubah_judul',
            'id_judul': id_judul.val(),
            'nm_judul': nm_judul.val(),
            'id_pimpinan': id_pimpinan.val(),
            'nm_perusahaan': nm_perusahaan.val(),
            'latar_belakang': latar_belakang.val(),
            'gambaran_judul': gambaran_judul.val(),
            'kelebihan_judul': kelebihan_judul.val(),
          },
          success: function(data) {
            console.log(data);
            if (data['status'] == 'done') {
              resetTableInputPengajuan(data['judul']);

              id_judul.val('');
              nm_judul.val('');
              id_pimpinan.val('');
              nm_perusahaan.val('');
              latar_belakang.val('');
              gambaran_judul.val('');
              kelebihan_judul.val('');
              toastr.success('Judul Berhasil Di Ubah!');

              $('#data-judul').modal('hide');
              $('#ubah-judul').modal('hide').find('.overlay').addClass('invisible');
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

    $('#hapus-judul #konfirmasi-hapus').click(function() {
      let id_judul = $('#hapus-judul #id_judul');
      if (id_judul.val() == '') {
        toastr.warning('Lengkapi Data Terlebih Dahulu!');
      } else {
        $('#hapus-judul').find('.overlay').removeClass('invisible');
        $.ajax({
          type: "POST",
          url: "<?= base_url('mahasiswa/get_data') ?>",
          dataType: "JSON",
          data: {
            'set': 'save-hapus_judul',
            'id_judul': id_judul.val(),
          },
          success: function(data) {
            console.log(data);
            if (data['status'] == 'done') {
              resetTableInputPengajuan(data['judul']);

              toastr.success('Judul Berhasil Dihapus!');
              $('#data-judul').modal('hide');
              $('#hapus-judul').modal('hide').find('.overlay').addClass('invisible');
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

    $('#tambah-jurnal #simpan-jurnal').click(function() {
      let id_judul = $('#tambah-jurnal #id_judul');
      let file_jurnal = $('#tambah-jurnal #file_jurnal')[0].files;
      if (id_judul.val() == '' || file_jurnal.length <= 0) {
        toastr.warning('Lengkapi Data Terlebih Dahulu!');
      } else {
        $('#hapus-jurnal').find('.overlay').removeClass('invisible');
        var formData = new FormData();
        formData.append('set', 'save-tambah_jurnal');
        formData.append('id_judul', id_judul.val());
        formData.append('file_jurnal', file_jurnal[0]);
        $.ajax({
          type: "POST",
          url: "<?= base_url('mahasiswa/get_data') ?>",
          dataType: "JSON",
          data: formData,
          contentType: false,
          cache: false,
          processData: false,
          success: function(data) {
            console.log(data);
            if (data['status'] == 'done') {
              resetTableDataJudul(data['jurnal'], data['judul']);
              $('#tambah-jurnal form')[0].reset();
              toastr.success('Jurnal Berhasil Disimpan!');
              // $('#tambah-jurnal').find('.overlay').addClass('invisible');
              $('#tambah-jurnal').modal('hide').find('.overlay').addClass('invisible');
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

    $('#hapus-jurnal #konfirmasi-hapus').click(function() {
      let id_jurnal = $('#hapus-jurnal #id_jurnal');
      if (id_jurnal.val() == '') {
        toastr.warning('Lengkapi Data Terlebih Dahulu!');
      } else {
        $('#hapus-jurnal').find('.overlay').removeClass('invisible');
        $.ajax({
          type: "POST",
          url: "<?= base_url('mahasiswa/get_data') ?>",
          dataType: "JSON",
          data: {
            'set': 'save-hapus_jurnal',
            'id_jurnal': id_jurnal.val(),
          },
          success: function(data) {
            console.log(data);
            if (data['status'] == 'done') {
              resetTableDataJudul(data['jurnal'], data['judul']);

              toastr.success('Jurnal Berhasil Dihapus!');
              $('#hapus-jurnal').modal('hide').find('.overlay').addClass('invisible');
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

    $('#konfirmasi-pengajuan #simpan-konfirmasi').click(function() {
      $('#konfirmasi-pengajuan').modal('hide');
      $('#input-pengajuan').find('.overlay').removeClass('invisible');
      $.ajax({
        type: "POST",
        url: "<?= base_url('mahasiswa/get_data') ?>",
        dataType: "JSON",
        data: {
          'set': 'save-simpan_pengajuan',
        },
        success: function(data) {
          console.log(data);
          if (data['status'] == 'done') {
            setDashboardMahasiswa();
            toastr.success('Pengajuan Berhasil Di Simpan!');
            $('#input-pengajuan').modal('hide').find('.overlay').addClass('invisible');
          } else {
            toastr.error('Data Gagal di Eksekusi! Ada kesalahan pada query, Silahkan cek lagi!');
          }
        },
        error: function(request, status, error) {
          console.log(request.responseText);
        }
      });
    });



    $('button[data-target="#data-pengajuan"]').click(function() {
      $('#data-pengajuan').find('.overlay').removeClass('invisible');
      $.ajax({
        type: "POST",
        url: "<?= base_url('mahasiswa/get_data') ?>",
        dataType: "JSON",
        data: {
          'set': 'start-data_pengajuan',
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

            if (mahasiswa['stt_pengajuan'] == 'proses') {
              $('#data-pengajuan #tgl_pengecekan').addClass('d-none');
              $('#data-pengajuan #ket_pengajuan').addClass('d-none');
              $('#data-pengajuan #id_judul').addClass('d-none');
              $('#data-pengajuan #pemb_1').addClass('d-none');
              $('#data-pengajuan #pemb_2').addClass('d-none');
            } else if (mahasiswa['stt_pengajuan'] == 'tolak') {
              $('#data-pengajuan #tgl_pengecekan').removeClass('d-none').find('span').html(tanggal_indo(mahasiswa['tgl_pengecekan']));
              $('#data-pengajuan #ket_pengajuan').removeClass('d-none').find('p').html(mahasiswa['ket_pengajuan']);
              $('#data-pengajuan #id_judul').addClass('d-none');
              $('#data-pengajuan #pemb_1').addClass('d-none');
              $('#data-pengajuan #pemb_2').addClass('d-none');
            } else {
              $('#data-pengajuan #tgl_pengecekan').removeClass('d-none').find('span').html(tanggal_indo(mahasiswa['tgl_pengecekan']));
              $('#data-pengajuan #ket_pengajuan').addClass('d-none');
              $('#data-pengajuan #id_judul').removeClass('d-none').find('p').attr('id_judul', mahasiswa['id_judul']).html(mahasiswa['nm_judul']);
              $('#data-pengajuan #pemb_1').removeClass('d-none').find('span').html(mahasiswa['nm_pemb1']);
              $('#data-pengajuan #pemb_2').removeClass('d-none').find('span').html(mahasiswa['nm_pemb2']);
            }

            $('#data-pengajuan table tbody').html('');
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
              $('#data-pengajuan table tbody').append(isi_table);
            });

            $('#data-pengajuan').find('.overlay').addClass('invisible');
          }
        },
        error: function(request, status, error) {
          console.log(request.responseText);
        }
      });
    });

    $('#data-pengajuan #id_judul p').click(function() {
      $('#detail-judul').modal('show').find('.overlay').removeClass('invisible');
      let id_judul = $(this).attr('id_judul');
      let nm_judul = $(this).html();
      console.log(nm_judul);
      $.ajax({
        type: "POST",
        url: "<?= base_url('mahasiswa/get_data') ?>",
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

    $('#data-pengajuan table tbody').on('click', 'button[data-target="#detail-judul"]', function() {
      $('#detail-judul .overlay').removeClass('invisible');
      let id_judul = $(this).attr('id_judul');
      $.ajax({
        type: "POST",
        url: "<?= base_url('mahasiswa/get_data') ?>",
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


    table_hpengajuan.on('click', 'button[data-target="#data-pengajuan"]', function() {
      $('#data-pengajuan').find('.overlay').removeClass('invisible');
      let id_pengajuan = $(this).attr('id_pengajuan');
      $.ajax({
        type: "POST",
        url: "<?= base_url('mahasiswa/get_data') ?>",
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

            if (mahasiswa['stt_pengajuan'] == 'proses') {
              $('#data-pengajuan #tgl_pengecekan').addClass('d-none');
              $('#data-pengajuan #ket_pengajuan').addClass('d-none');
              $('#data-pengajuan #id_judul').addClass('d-none');
              $('#data-pengajuan #pemb_1').addClass('d-none');
              $('#data-pengajuan #pemb_2').addClass('d-none');
            } else if (mahasiswa['stt_pengajuan'] == 'tolak') {
              $('#data-pengajuan #tgl_pengecekan').removeClass('d-none').find('span').html(tanggal_indo(mahasiswa['tgl_pengecekan']));
              $('#data-pengajuan #ket_pengajuan').removeClass('d-none').find('p').html(mahasiswa['ket_pengajuan']);
              $('#data-pengajuan #id_judul').addClass('d-none');
              $('#data-pengajuan #pemb_1').addClass('d-none');
              $('#data-pengajuan #pemb_2').addClass('d-none');
            } else {
              $('#data-pengajuan #tgl_pengecekan').removeClass('d-none').find('span').html(tanggal_indo(mahasiswa['tgl_pengecekan']));
              $('#data-pengajuan #ket_pengajuan').addClass('d-none');
              $('#data-pengajuan #id_judul').removeClass('d-none').find('p').attr('id_judul', mahasiswa['id_judul']).html(mahasiswa['nm_judul']);
              $('#data-pengajuan #pemb_1').removeClass('d-none').find('span').html(mahasiswa['nm_pemb1']);
              $('#data-pengajuan #pemb_2').removeClass('d-none').find('span').html(mahasiswa['nm_pemb2']);
            }

            $('#data-pengajuan table tbody').html('');
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
              $('#data-pengajuan table tbody').append(isi_table);
            });

            $('#data-pengajuan').find('.overlay').addClass('invisible');
          }
        },
        error: function(request, status, error) {
          console.log(request.responseText);
        }
      });
    });


    setDashboardMahasiswa();
  });
</script>