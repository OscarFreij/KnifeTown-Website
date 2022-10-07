<!-- Modal -->
<div class="modal fade" id="createMenuModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createMenuModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="mb-3 row">
            <label for="inputNameMenu" class="col-sm-4 col-form-label">Namn</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="inputNameMenu">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="inputOrderMenu" class="col-sm-4 col-form-label">Ordning</label>
            <div class="col-sm-8">
              <input type="number" class="form-control" id="inputOrderMenu">
            </div>
          </div>
          <div class="mb-3 row">
            <input type="checkbox" class="btn-check" id="inputEnabledMenu" autocomplete="off" onclick="ToggleEnabledTextModal();" checked>
            <label class="btn btn-outline-primary" for="inputEnabledMenu">Visa i panel</label><br>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Avbryt</button>
        <button type="button" onClick="createMenu();" class="btn btn-success">Spara och ladda om</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="createCategoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createCategoryModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="mb-3 row">
            <label for="inputNameCategory" class="col-sm-4 col-form-label">Namn</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="inputNameCategory">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Avbryt</button>
          <button type="button" onClick="createCategory();" class="btn btn-success">Spara och ladda om</button>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="createMenuItemModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createMenuItemModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createMenuItemModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container">
        <div class="mb-3 row">
                <label for="inputNameItem" class="col-sm-4 col-form-label">Namn</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="inputNameItem" value="">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputImageItem" class="col-sm-4 col-form-label">Bild</label>
                <div class="col-sm-8">
                    <input type="file" class="form-control" id="inputImageItem">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputDescriptionItem" class="col-sm-4 col-form-label">Beskrivning</label>
                <div class="col-sm-8">
                    <textarea class="form-control" id="inputDescriptionItem" rows="5"></textarea>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPriceItem" class="col-sm-4 col-form-label">Pris</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="inputPriceItem" value="0">
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Avbryt</button>
          <button type="button" onClick="createItem();" class="btn btn-success">Spara och ladda om</button>
        </div>
      </div>
    </div>
  </div>
</div>