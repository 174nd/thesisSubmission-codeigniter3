<script>
  $(function() {
    $(".select2").select2({
      width: "100%",
      theme: 'bootstrap4',
    });

    var table_dosen = $('#table_dosen').DataTable({
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
          "set_tables": "SELECT * FROM dosen JOIN fakultas USING(id_fakultas)",
          'query': true
        },
        "type": "POST"
      },
      "columns": [{
        'className': "align-middle",
        "data": "nm_dosen",
      }, {
        'className': "align-middle text-center",
        "data": "nm_fakultas",
        "width": "110px",
      }, {
        'className': "align-middle text-center",
        "data": "id_dosen",
        "width": "10px",
        "render": function(data, type, row, meta) {
          return '<div class="btn-group"><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#data-dosen" id_dosen="' + data + '"><i class="fa fa-eye"></i></button></div>';
        }
      }],
    });
    $('#table_dosen_filter').hide();
    $('#field_dosen').keyup(function() {
      table_dosen.columns($('#column_dosen').val()).search(this.value).draw();
    });


    table_dosen.on('click', 'button[data-target="#data-dosen"]', function() {
      $('#data-dosen .overlay').removeClass('invisible');
      let id_dosen = $(this).attr('id_dosen');
      $.ajax({
        type: "POST",
        "url": "<?= base_url('adm_dosen/get_data') ?>",
        dataType: "JSON",
        data: {
          'set': 'get_dosen',
          'id_dosen': id_dosen,
        },
        success: function(data) {
          if (data['status'] == 'done') {
            $('#data-dosen #nidn_dosen span').html(data['nidn_dosen']);
            $('#data-dosen #nm_dosen span').html(data['nm_dosen']);
            $('#data-dosen #nm_fakultas span').html(data['nm_fakultas']);
            $('#data-dosen #no_telp span').html(data['no_telp']);

            $('#data-dosen .set-button .set-update').attr('href', '<?= base_url('adm_dosen/update/') ?>' + id_dosen);
            $('#data-dosen .set-button .set-delete').unbind().click(function() {
              $('#dosen-delete #id_dosen').val(id_dosen);
              $('#dosen-delete').modal('show');
            });

            $('#data-dosen .overlay').addClass('invisible');
          }
        },
        error: function(request, status, error) {
          console.log(request.responseText);
        }
      });
    });
  });
</script>