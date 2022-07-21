<li class="list-group-item row" id="category<?=$categoryId?>">
    <input class="col-sm-8 col-12" type="text" name="category<?=$categoryId?>name" id="category<?=$categoryId?>name" value="<?=$categoryName?>">    
    <span class="col-sm-2 col-12"></span>
    <button class="col-sm-2 col-12 btn btn-danger" onclick="removeCategory(<?=$categoryId?>);">Ta bort</button>
</li>