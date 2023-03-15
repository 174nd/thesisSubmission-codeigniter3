<script>
  $(function() {
    $(".select2").select2({
      width: "100%",
      theme: 'bootstrap4',
    });

    var table_prodi = $('#table_prodi').DataTable({
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
          "set_tables": "SELECT * FROM prodi JOIN fakultas USING(id_fakultas)",
          'query': true
        },
        "type": "POST"
      },
      "columns": [{
        'className': "align-middle",
        "data": "nm_prodi",
      }, {
        'className': "align-middle text-center",
        "data": "nm_fakultas",
        "width": "110px",
      }, {
        'className': "align-middle text-center",
        "data": "id_prodi",
        "width": "10px",
        "render": function(data, type, row, meta) {
          return '<div class="btn-group"><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#data-prodi" id_prodi="' + data + '"><i class="fa fa-eye"></i></button></div>';
        }
      }],
    });
    $('#table_prodi_filter').hide();
    $('#field_prodi').keyup(function() {
      table_prodi.columns($('#column_prodi').val()).search(this.value).draw();
    });


    table_prodi.on('click', 'button[data-target="#data-prodi"]', function() {
      $('#data-prodi .overlay').removeClass('invisible');
      let id_prodi = $(this).attr('id_prodi');
      $.ajax({
        type: "POST",
        "url": "<?= base_url('prodi/get_data') ?>",
        dataType: "JSON",
        data: {
          'set': 'get_prodi',
          'id_prodi': id_prodi,
        },
        success: function(data) {
          if (data['status'] == 'done') {
            $('#data-prodi #nm_prodi span').html(data['nm_prodi']);
            $('#data-prodi #nm_fakultas span').html(data['nm_fakultas']);

            $('#data-prodi .set-button .set-update').attr('href', '<?= base_url('prodi/update/') ?>' + id_prodi);
            $('#data-prodi .set-button .set-delete').unbind().click(function() {
              $('#prodi-delete #id_prodi').val(id_prodi);
              $('#prodi-delete').modal('show');
            });

            $('#data-prodi .overlay').addClass('invisible');
          }
        },
        error: function(request, status, error) {
          console.log(request.responseText);
        }
      });
    });
  });
</script>