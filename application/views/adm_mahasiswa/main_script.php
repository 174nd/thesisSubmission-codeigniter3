<script>
  $(function() {
    $(".select2").select2({
      width: "100%",
      theme: 'bootstrap4',
    });

    var table_mahasiswa = $('#table_mahasiswa').DataTable({
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
          "set_tables": "SELECT * FROM mahasiswa JOIN prodi USING(id_prodi)",
          'query': true
        },
        "type": "POST"
      },
      "columns": [{
        'className': "align-middle",
        "data": "nm_mahasiswa",
      }, {
        'className': "align-middle text-center",
        "data": "nm_prodi",
        "width": "110px",
      }, {
        'className': "align-middle text-center",
        "data": "id_mahasiswa",
        "width": "10px",
        "render": function(data, type, row, meta) {
          return '<div class="btn-group"><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#data-mahasiswa" id_mahasiswa="' + data + '"><i class="fa fa-eye"></i></button></div>';
        }
      }],
    });
    $('#table_mahasiswa_filter').hide();
    $('#field_mahasiswa').keyup(function() {
      table_mahasiswa.columns($('#column_mahasiswa').val()).search(this.value).draw();
    });


    table_mahasiswa.on('click', 'button[data-target="#data-mahasiswa"]', function() {
      $('#data-mahasiswa .overlay').removeClass('invisible');
      let id_mahasiswa = $(this).attr('id_mahasiswa');
      $.ajax({
        type: "POST",
        "url": "<?= base_url('adm_mahasiswa/get_data') ?>",
        dataType: "JSON",
        data: {
          'set': 'get_mahasiswa',
          'id_mahasiswa': id_mahasiswa,
        },
        success: function(data) {
          if (data['status'] == 'done') {
            $('#data-mahasiswa #nim_mahasiswa span').html(data['nim_mahasiswa']);
            $('#data-mahasiswa #nm_mahasiswa span').html(data['nm_mahasiswa']);
            $('#data-mahasiswa #email_mahasiswa span').html(data['email_mahasiswa']);
            $('#data-mahasiswa #nm_prodi span').html(data['nm_prodi']);
            $('#data-mahasiswa #no_telp span').html(data['no_telp']);

            $('#data-mahasiswa .set-button .set-update').attr('href', '<?= base_url('adm_mahasiswa/update/') ?>' + id_mahasiswa);
            $('#data-mahasiswa .set-button .set-delete').unbind().click(function() {
              $('#mahasiswa-delete #id_mahasiswa').val(id_mahasiswa);
              $('#mahasiswa-delete').modal('show');
            });

            $('#data-mahasiswa .overlay').addClass('invisible');
          }
        },
        error: function(request, status, error) {
          console.log(request.responseText);
        }
      });
    });
  });
</script>