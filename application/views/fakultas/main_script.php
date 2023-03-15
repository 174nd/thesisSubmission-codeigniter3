<script>
  $(function() {
    var table_fakultas = $('#table_fakultas').DataTable({
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
          "set_tables": "fakultas",
        },
        "type": "POST"
      },
      "columns": [{
        'className': "align-middle",
        "data": "nm_fakultas",
      }, {
        'className': "align-middle text-center",
        "data": "form_fakultas",
        "width": "30px",
      }, {
        'className': "align-middle text-center",
        "data": "id_fakultas",
        "width": "10px",
        "render": function(data, type, row, meta) {
          return '<div class="btn-group"><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#data-fakultas" id_fakultas="' + data + '"><i class="fa fa-eye"></i></button></div>';
        }
      }],
    });
    $('#table_fakultas_filter').hide();
    $('#field_fakultas').keyup(function() {
      table_fakultas.columns($('#column_fakultas').val()).search(this.value).draw();
    });


    table_fakultas.on('click', 'button[data-target="#data-fakultas"]', function() {
      $('#data-fakultas .overlay').removeClass('invisible');
      let id_fakultas = $(this).attr('id_fakultas');
      $.ajax({
        type: "POST",
        "url": "<?= base_url('fakultas/get_data') ?>",
        dataType: "JSON",
        data: {
          'set': 'get_fakultas',
          'id_fakultas': id_fakultas,
        },
        success: function(data) {
          if (data['status'] == 'done') {
            $('#data-fakultas #nm_fakultas span').html(data['nm_fakultas']);
            $('#data-fakultas #form_fakultas span').html(data['form_fakultas']);

            $('#data-fakultas .set-button .set-update').attr('href', '<?= base_url('fakultas/update/') ?>' + id_fakultas);
            $('#data-fakultas .set-button .set-delete').unbind().click(function() {
              $('#fakultas-delete #id_fakultas').val(id_fakultas);
              $('#fakultas-delete').modal('show');
            });

            $('#data-fakultas .overlay').addClass('invisible');
          }
        },
        error: function(request, status, error) {
          console.log(request.responseText);
        }
      });
    });
  });
</script>