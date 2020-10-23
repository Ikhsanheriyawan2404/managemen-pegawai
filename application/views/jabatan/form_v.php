<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalForm" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
    	<form method="post" action="<?= BASE_PATH ?>/jabatan/insert">

      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="hidden" id="id" name="id">

      <div class="form-group row">
        <label for="name" class="col-sm-4 col-form-label">Nama Jabatan</label>   
        <div class="col-sm-6">
          <input class="form-control" id="inputForm" type="text" id="name" name="name" required>
        </div> 
      </div>

        </div>
        <div class="modal-footer">
        	<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i></button>
    		<button type="reset" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times-circle"></i></button>
        </div>

      </form>
    </div>
  </div>
</div>