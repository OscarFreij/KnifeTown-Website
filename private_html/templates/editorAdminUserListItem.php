<li class="list-group-item list-group-item row" id="user<?=$user['id']?>">
    <span class="col-sm-2 col-12" text><?=$user['username']?></span>
    <input type="password" class="col-sm-2 col-12"></input>
    <div class="col-sm-2 col-12" style="align-self: center;">
        <div class="col-1 form-check form-switch form-check-inline" style="margin-right: 0;">
            <?php
                if ($user['superAdmin'])
                {
                    ?>
                    <input class="form-check-input" type="checkbox" id="user<?=$user['superAdmin']?>superAdmin" autocomplete="off" name="user<?=$user['superAdmin']?>superAdmin" checked>
                    <?php
                }
                else
                {
                    ?>
                    <input class="form-check-input" type="checkbox" id="user<?=$user['superAdmin']?>superAdmin" autocomplete="off" name="user<?=$user['superAdmin']?>superAdmin">
                    <?php
                }
            ?>
        </div>
    </div>
    <div class="col-sm-2 col-12" style="align-self: center;">
        <div class="col-1 form-check form-switch form-check-inline" style="margin-right: 0;">
            <?php
                if ($user['enabled'])
                {
                    ?>
                    <input class="form-check-input" type="checkbox" id="user<?=$user['id']?>enabled" autocomplete="off" name="user<?=$user['enabled']?>enabled" checked>
                    <?php
                }
                else
                {
                    ?>
                    <input class="form-check-input" type="checkbox" id="user<?=$user['id']?>enabled" autocomplete="off" name="user<?=$user['enabled']?>enabled">
                    <?php
                }
            ?>
        </div>
    </div>
    <span class="col-sm-2 col-12"></span>
    <button class="col-sm-2 col-12 btn btn-danger" onclick="removeUser(user<?=$user['id']?>)">Ta bort</button>
</li>