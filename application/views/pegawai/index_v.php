<!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <div class="d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Pegawai</h6>
        <a class="btn btn-primary btn-sm text-white" onclick="addForm()"><i class="fa fa-user-plus"></i> Tambah</a>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Foto</th>
              <th>Nama Pegawai</th>
              <th>Jenis Kelamin</th>
              <th>Tanggal Lahir</th>
              <th>Jabatan</th>
              <th>Keterangan</th>
              <th class="text-center" width="60"><i class="fa fa-cogs"></i></th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
    </div>
  </div>

  <?php include "../application/views/pegawai/form_v.php";?>

  <script type="text/javascript">
    let table, save_method;
    $(function () {
      table = $('.table').DataTable({
        "processing" : true,
        "ajax" : {
          "url" : "<?= BASE_PATH ?>/pegawai/data",
          "type" : "POST"
        }
      });

      $('#modalForm form').on('submit', function(e) {
        if (!e.isDefaultPrevented()) {
          if (save_method == "add") {
            url = "<?= BASE_PATH ?>/pegawai/insert";
          } else {
            url = "<?= BASE_PATH ?>/pegawai/update";
          }

          $.ajax({
            url : url,
            type : "POST",
            dataType: "JSON",
            data : new FormData($("#modalForm form")[0]),
            async: false,
            processData: false,
            contentType: false,
            success : function(data) {
              if (data.success == true) {
                $('#modalForm').modal('hide');
                table.ajax.reload(null, false);
              } else {
                alert(data.msg);
              }
            },
            error : function() {
              alert("tidak dapat menyimpan data!");
            }
          });
          return false;
        }
      });

    });

    function addForm()
    {
      save_method = 'add';
      $('#modalForm').modal('show');
      $('#modalForm form')[0].reset();                
      $('#modalTitle').text('Tambah Pegawai');
      $('.tampil-foto').html("");
    }

    function editForm(id)
    {
      save_method = 'edit';
      $('#modalForm form')[0].reset();
      $.ajax({
        url : "<?= BASE_PATH ?>/pegawai/edit/"+id,
        type : "GET",
        dataType : "JSON",
        success : function(data) {
          $('#modalForm').modal('show');
          $('#modalTitle').text('Edit Pegawai');

          $('#id').val(data.pegawai_id);
          $('.tampil-foto').html("<img class='img-thumbnail' src='<?= BASE_PATH ?>/images/"+data.foto+"' width='150'>");
          $('#nama_pegawai').val(data.nama_pegawai);

          if (data.jenis_kelamin == 'L') {
            $('#jkl').attr('checked', true);
          } else {
            $('#jkp').attr('checked', true);
          }

          $('#tanggal').val(data.tgl_lahir);
          $('#jabatan').val(data.jabatan_id);
          $('#keterangan').val(data.keterangan);
        },
        error : function() {
          alert('Tidak dapat menampilkan data!');
        }
      });
    }

    function deleteData(id, foto)
    {
      if (confirm('Apakah yakin ingin menghapus data?')) {
        $.ajax({
          url : "<?= BASE_PATH ?>/pegawai/delete/"+id+"/"+foto,
          type : "GET",
          success : function(data){
            table.ajax.reload();
          },
          error : function(){
           alert("Tidak dapat menghapus data!");
          }
        });
      }
    }

  </script>