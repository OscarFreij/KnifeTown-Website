<?php
if (!isset($_SESSION['username']) && !isset($_SESSION['superAdmin'])) {
    http_response_code(401);
}
else if ($_SESSION['superAdmin'] == 0)
{
    http_response_code(401);
}
else
{
    ?>
    <div class="container">
        <div class="row my-3">
            <span class="fs-1 text-center text">
                Admin
            </span>
        </div>
        <div class="row mb-3" id="userList">
            <ul id="listMenu" class="list-group text-center mt-2">
                <li class="list-group-item list-group-item-secondary row">
                    <span class="col-sm-2 col-12">Användarnamn</span>
                    <span class="col-sm-2 col-12">Nytt lösenord</span>
                    <span class="col-sm-2 col-12">Super Admin</span>
                    <span class="col-sm-2 col-6">Aktiv</span>
                    <span class="col-sm-2 col-12"></span>
                    <span class="col-sm-2 col-12"></span>
                </li>
                
                <?php

                $users = $container->functions()->getAllUsers();

                for ($i=0; $i < count($users); $i++) { 
                    $user = $users[$i];
                    include "../private_html/templates/editorAdminUserListItem.php";
                }
                ?>
            </ul>
            <button type="button" class="btn btn-primary mt-3 mb-2 col-12" data-bs-toggle="modal" data-bs-target="#addUserModal">
            Lägg till Användare
            </button>
            <button type="button" onClick="updateUsers();" class="btn btn-success mb-3 col-12">
            Spara ändringar
            </button>
        </div>
    </div>
    
<?php
    require "../private_html/pages/editor/modules/adminModals.php";
}
?>