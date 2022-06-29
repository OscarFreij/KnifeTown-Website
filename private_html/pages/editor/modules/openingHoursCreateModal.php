<!-- Modal -->
<div class="modal fade" id="openingHoursCreateSpecialModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="openingHoursCreateSpecialModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="openingHoursCreateSpecialModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container">
        <div class="mb-3 row">
            <label for="inputName" class="col-sm-4 col-form-label">Namn</label>
            <div class="col-sm-8">
            <input type="text" class="form-control" id="inputName">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputOpenTime" class="col-sm-4 col-form-label">Öppning</label>
            <div class="col-sm-8">
            <input type="time" class="form-control" id="inputOpenTime">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputCloseTime" class="col-sm-4 col-form-label">Stängning</label>
            <div class="col-sm-8">
            <input type="time" class="form-control" id="inputCloseTime">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputDate" class="col-sm-4 col-form-label">Datum</label>
            <div class="col-sm-8">
            <input type="date" class="form-control" id="inputDate">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputShowDate" class="col-sm-4 col-form-label">Visa i panel</label>
            <div class="col-sm-8">
            <input type="date" class="form-control" id="inputShowDate">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputNoShowDate" class="col-sm-4 col-form-label">Dölj i panel</label>
            <div class="col-sm-8">
            <input type="date" class="form-control" id="inputNoShowDate">
            </div>
        </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Avbryt</button>
        <button type="button" onClick="createSpecial();" class="btn btn-success">Spara och ladda om</button>
      </div>
    </div>
  </div>
</div>