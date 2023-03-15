<script>
  $(function() {
    $(".select2").select2({
      width: "100%",
      theme: 'bootstrap4',
    });

    var table_konsentrasi = $('#table_konsentrasi').DataTable({
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
          "set_tables": "SELECT * FROM konsentrasi JOIN prodi USING(id_prodi)",
          'query': true
        },
        "type": "POST"
      },
      "columns": [{
        'className': "align-middle",
        "data": "nm_konsentrasi",
      }, {
        'className': "align-middle text-center",
        "data": "nm_prodi",
        "width": "110px",
      }, {
        'className': "align-middle text-center",
        "data": "id_konsentrasi",
        "width": "10px",
        "render": function(data, type, row, meta) {
          return '<div class="btn-group"><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#data-konsentrasi" id_konsentrasi="' + data + '"><i class="fa fa-eye"></i></button></div>';
        }
      }],
    });
    $('#table_konsentrasi_filter').hide();
    $('#field_konsentrasi').keyup(function() {
      table_konsentrasi.columns($('#column_konsentrasi').val()).search(this.value).draw();
    });


    table_konsentrasi.on('click', 'button[data-target="#data-konsentrasi"]', function() {
      $('#data-konsentrasi .overlay').removeClass('invisible');
      let id_konsentrasi = $(this).attr('id_konsentrasi');
      $.ajax({
        type: "POST",
        "url": "<?= base_url('konsentrasi/get_data') ?>",
        dataType: "JSON",
        data: {
          'set': 'get_konsentrasi',
          'id_konsentrasi': id_konsentrasi,
        },
        success: function(data) {
          if (data['status'] == 'done') {
            $('#data-konsentrasi #nm_konsentrasi span').html(data['nm_konsentrasi']);
            $('#data-konsentrasi #nm_prodi span').html(data['nm_prodi']);

            $('#data-konsentrasi .set-button .set-update').attr('href', '<?= base_url('konsentrasi/update/') ?>' + id_konsentrasi);
            $('#data-konsentrasi .set-button .set-delete').unbind().click(function() {
              $('#konsentrasi-delete #id_konsentrasi').val(id_konsentrasi);
              $('#konsentrasi-delete').modal('show');
            });

            $('#data-konsentrasi .overlay').addClass('invisible');
          }
        },
        error: function(request, status, error) {
          console.log(request.responseText);
        }
      });
    });
  });
</script>