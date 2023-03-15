<script>
  $(function() {
    $(".select2").select2({
      width: "100%",
      theme: 'bootstrap4',
    });

    var table_user = $('#table_user').DataTable({
      'paging': true,
      'lengthChange': false,
      "pageLength": 10,
      'info': true,
      "order": [
        [0, "asc"]
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
          "set_tables": `SELECT user.id_user, user.username, IF(akses='mahasiswa', (SELECT nm_mahasiswa FROM mahasiswa WHERE mahasiswa.id_user=user.id_user LIMIT 1), IF(akses='dosen', (SELECT nm_dosen FROM dosen WHERE dosen.id_user=user.id_user LIMIT 1), user.nm_user)) nama_user FROM user`,
          'query': true
        },
        "type": "POST"
      },
      "columns": [{
        'className': "align-middle",
        "data": "nama_user",
      }, {
        'className': "align-middle text-center",
        "data": "username",
        "width": "110px",
      }, {
        'className': "align-middle text-center",
        "data": "id_user",
        "width": "10px",
        "render": function(data, type, row, meta) {
          return '<div class="btn-group"><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#data-user" id_user="' + data + '"><i class="fa fa-eye"></i></button></div>';
        }
      }],
    });
    $('#table_user_filter').hide();
    $('#field_user').keyup(function() {
      table_user.columns($('#column_user').val()).search(this.value).draw();
    });

    table_user.on('click', 'button[data-target="#data-user"]', function() {
      $('#data-user .overlay').removeClass('invisible');
      let id_user = $(this).attr('id_user');
      $.ajax({
        type: "POST",
        "url": "<?= base_url('user/get_data') ?>",
        dataType: "JSON",
        data: {
          'set': 'get_user',
          'id_user': id_user,
        },
        success: function(data) {
          if (data['status'] == 'done') {
            $('#data-user #nama_user span').html(data['nama_user']);
            $('#data-user #username span').html(data['username']);
            $('#data-user #password span').html(data['password']);
            $('#data-user #akses span').html(data['akses']);

            $('#data-user .set-button .set-update').attr('href', '<?= base_url('user/update/') ?>' + id_user);
            $('#data-user .set-button .set-delete').unbind().click(function() {
              $('#user-delete #id_user').val(id_user);
              $('#user-delete').modal('show');
            });

            $('#data-user .overlay').addClass('invisible');
          }
        },
        error: function(request, status, error) {
          console.log(request.responseText);
        }
      });
    });




    $('#form-utama #akses').on('change', function() {
      let akses = $(this).val();
      let nm_user = $('#form-utama #nm_user').closest('.col-md-8.mb-2');
      let id_dosen = $('#form-utama #id_dosen').closest('.col-md-8.mb-2');
      let id_mahasiswa = $('#form-utama #id_mahasiswa').closest('.col-md-8.mb-2');
      if (akses == 'admin') {
        nm_user.removeClass('d-none');
        id_dosen.addClass('d-none');
        id_mahasiswa.addClass('d-none');
      } else if (akses == 'dosen') {
        nm_user.addClass('d-none');
        id_dosen.removeClass('d-none');
        id_mahasiswa.addClass('d-none');
      } else {
        nm_user.addClass('d-none');
        id_dosen.addClass('d-none');
        id_mahasiswa.removeClass('d-none');
      }
    });

    $('#form-utama #akses').trigger('change');


  });
</script>