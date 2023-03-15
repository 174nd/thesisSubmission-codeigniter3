<script>
  $(function() {
    var table_pimpinan = $('#table_pimpinan').DataTable({
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
          "set_tables": "pimpinan",
        },
        "type": "POST"
      },
      "columns": [{
        'className': "align-middle",
        "data": "unsur_pimpinan",
      }, {
        'className': "align-middle text-center",
        "data": "id_pimpinan",
        "width": "10px",
        "render": function(data, type, row, meta) {
          return '<div class="btn-group"><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#data-pimpinan" id_pimpinan="' + data + '"><i class="fa fa-eye"></i></button></div>';
        }
      }],
    });
    $('#table_pimpinan_filter').hide();
    $('#field_pimpinan').keyup(function() {
      table_pimpinan.columns($('#column_pimpinan').val()).search(this.value).draw();
    });


    table_pimpinan.on('click', 'button[data-target="#data-pimpinan"]', function() {
      $('#data-pimpinan .overlay').removeClass('invisible');
      let id_pimpinan = $(this).attr('id_pimpinan');
      $.ajax({
        type: "POST",
        "url": "<?= base_url('pimpinan/get_data') ?>",
        dataType: "JSON",
        data: {
          'set': 'get_pimpinan',
          'id_pimpinan': id_pimpinan,
        },
        success: function(data) {
          if (data['status'] == 'done') {
            $('#data-pimpinan #unsur_pimpinan span').html(data['unsur_pimpinan']);

            $('#data-pimpinan .set-button .set-update').attr('href', '<?= base_url('pimpinan/update/') ?>' + id_pimpinan);
            $('#data-pimpinan .set-button .set-delete').unbind().click(function() {
              $('#pimpinan-delete #id_pimpinan').val(id_pimpinan);
              $('#pimpinan-delete').modal('show');
            });

            $('#data-pimpinan .overlay').addClass('invisible');
          }
        },
        error: function(request, status, error) {
          console.log(request.responseText);
        }
      });
    });
  });
</script>