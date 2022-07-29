<div class="modal fade" id="addUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="mb-3 row">
                        <label for="inputUsername" class="col-sm-4 col-form-label">Användarnamn</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputUsername" autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-4 col-form-label">Lösenord</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="inputPassword" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Avbryt</button>
                    <button type="button" onClick="addUser();" class="btn btn-success">Spara och ladda om</button>
                </div>
            </div>
        </div>
    </div>
</div>