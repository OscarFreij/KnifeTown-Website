<li class="list-group-item row" id="menu<?=$menuId?>">
    <input class="col-sm-4 col-12" type="text" name="menu<?=$menuId?>name" id="menu<?=$menuId?>name" value="<?=$menuName?>">    
    <input class="col-sm-2 col-12" type="number" name="menu<?=$menuId?>loadOrder" id="menu<?=$menuId?>loadOrder" value="<?=$menuLoadOrder?>">    
    <div class="col-sm-2 col-12" style="align-self: center;">
        <div class="col-1 form-check form-switch form-check-inline">
            <?php
                if ($menuEnabled)
                {
                    ?>
                    <input class="form-check-input" type="checkbox" id="menu<?=$menuId?>enabled" autocomplete="off" name="menu<?=$menuId?>enabled" checked>
                    <?php
                }
                else
                {
                    ?>
                    <input class="form-check-input" type="checkbox" id="menu<?=$menuId?>enabled" autocomplete="off" name="menu<?=$menuId?>enabled">
                    <?php
                }
            ?>
        </div>
    </div>
    <button class="col-sm-2 col-6 btn btn-warning">Redigera</button>
    <button class="col-sm-2 col-6 btn btn-danger" onclick="removeMenu(<?=$menuId?>);">Ta bort</button>
</li>