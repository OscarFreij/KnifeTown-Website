<!-- Modal -->
<div class="modal fade" id="addCategoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCategoryModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="mb-3 row">
            <label for="inputNameCategory" class="col-sm-4 col-form-label">Kategori namn</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="inputNameCategory" list="categoryDataList" placeholder="Type to search..." autocomplete="off">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Avbryt</button>
          <button type="button" onClick="addCategory();" class="btn btn-success">Spara och ladda om</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addObjectModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addObjectModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addObjectModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="mb-3 row">
            <label for="inputNameObject" class="col-sm-4 col-form-label">Objekt namn</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="inputNameObject" list="itemDataList" placeholder="Type to search..." autocomplete="off">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Avbryt</button>
          <button type="button" onClick="addItem();" class="btn btn-success">Spara och ladda om</button>
        </div>
      </div>
    </div>
  </div>
</div>