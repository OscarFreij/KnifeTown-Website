<?php
if (isset($_SESSION['username'])) {
    header('Location: ?page=edit&editorPage=general');
}
?>

<div id="login-container" class="container pt-5 px-5">
    <div class="mb-5 row position-relative">
    <!--Banner position-->
    <span class="w-100 fs-1 text text-center">Editor</span>
    </div>
    <div class="mb-3 row">
        <label for="username" class="col-sm-2 col-form-label">Username</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="username" value="">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="password" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="password">
        </div>
    </div>
    <div class="mb-3 row">
        <button type="button" class="btn btn-primary" onclick="sendSigninQuerry()">Sign In</button>
    </div>
</div>

<script src="static/js/login.js"></script>

