<!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <div class="d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Jabatan</h6>
        <a class="btn btn-primary btn-sm text-white" onclick="addForm()"><i class="fa fa-user-plus"></i></a>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Jabatan</th>
              <th class="text-center" width="60"><i class="fas fa-cogs"></i></th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
    </div>
  </div>

  <?php
   include "../application/views/jabatan/form_v.php";
  ?> 

  <script type="text/javascript">
    let table, save_method;
    $(function () {
      table = $('.table').DataTable({
        "processing" : true,
        "ajax" : {
          "url" : "<?= BASE_PATH; ?>/jabatan/data",
          "type" : "POST"
        }
      });

      $('#modalForm form').on('submit', function(e){
        if (!e.isDefaultPrevented()) {
          if (save_method == "add") {
            url = "<?= BASE_PATH ?>/jabatan/insert"
          } else {
            url = "<?= BASE_PATH ?>/jabatan/update";
          }

          $.ajax({
            url : url,
            type : "POST",
            data : $('#modalForm form').serialize(),
            success : function(data) {
               $('#modalForm').modal('hide');
               table.ajax.reload(null, false);
            },
            error : function() {
              alert("Tidak dapat menyimpan data!");
            }   
          });
          return false;
        }
      });

    });
    //Menampilkan form tambah data
    function addForm()
    {
      save_method = "add";
      $('#modalForm').modal('show');
      setTimeout(function() {
        $('#inputForm').focus();
      }, 1000);
      $('#modalForm form')[0].reset();                
      $('#modalTitle').text('Tambah Jabatan');
    }

    //Menampilkan form edit data
    function editForm(id)
    {
      save_method = "edit";
      $('#modalForm form')[0].reset();
      $.ajax({
        url : "<?= BASE_PATH ?>/jabatan/edit/"+id,
        type : "POST",
        dataType : "JSON",
        success : function(data) {
          $('#modalForm').modal('show');
          setTimeout(function() {
            $('#inputForm').focus();
          }, 1000);
          $('#modalTitle').text('Edit Jabatan');

          $('#id').val(data.jabatan_id);
          $('#name').val(data.name);
        },
        error : function() {
          alert("Tidak dapat menampilkan data!");
        }
      });
    }

    //Menghapus data dengan AJAX
    function deleteData(id)
    {
      Swal.fire({
        title: 'Apakah kamu yakin?',
        text: "Data ini akan terhapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url : "<?= BASE_PATH ?>/jabatan/delete/"+id,
            type : "POST",
            success : function(data) {
              Swal.fire(
                'Berhasil!',
                'Data berhasil dihapus.',
                'success'
              )
              table.ajax.reload();
            },
            error : function() {
             alert("Tidak dapat menghapus data!");
            }
          });
        }
      });
    }


  </script>