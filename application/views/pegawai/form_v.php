<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalForm" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <form method="post" enctype="multipart/form-data" action="<?= BASE_PATH ?>/pegawai/insert">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="id" name="id">
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Foto</label>   
            <div class="col-sm-8">
             <div class="custom-file">
               <label for="foto" class="custom-file-label">Pilih foto...</label>   
               <input class="custom-file-input" type="file" id="foto" name="foto">
            </div>
            <div class="tampil-foto mt-2"></div>
           </div>
          </div>

          <div class="form-group row">
            <label for="nama_pegawai" class="col-sm-3 col-form-label">Nama Pegawai</label>   
            <div class="col-sm-8">   
             <input class="form-control" type="text" id="nama_pegawai" name="nama_pegawai">
           </div> 
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
           <div class="col-sm-8">   
              <div class="custom-control custom-radio custom-control-inline">
                <input class="custom-control-input" type="radio" id="jkl" name="jk" value="L"> 
                <label class="custom-control-label" for="jkl">Laki-laki</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input class="custom-control-input" type="radio" id="jkp" name="jk" value="P"> 
                <label class="custom-control-label" for="jkp">Perempuan</label>
              </div> 
           </div>
          </div>

          <div class="form-group row">
            <label for="tanggal" class="col-sm-3 col-form-label">Tanggal Lahir</label>   
            <div class="col-sm-8">   
              <input class="form-control" type="date" id="tanggal" name="tanggal">
           </div>
          </div>

          <div class="form-group row">
            <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label> 
            <div class="col-sm-8">
              <select class="custom-select" id="jabatan" name="jabatan">
                <option value="">--Pilih--</option>
                <?php foreach ($data as $j) : ?>
                <option value="<?= $j['jabatan_id']; ?>"><?= $j['name']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>   
            <div class="col-sm-8">
              <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
           </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
          <button type="reset" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times-circle"></i> Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>