<div class="container">
<div class="row my-3">
        <span class="fs-1 text-center text">
            Menu Builder
        </span>
    </div>
    <div class="row my-3">
        <span class="fs-3 text-center text">
            <?php
            echo("Menu Name: ".$container->functions()->getMenuName($_GET['menuId'])."<br>");
            ?>
        </span>
    </div>
<?php
if (!isset($_SESSION['username'])) {
    http_response_code(401);
} else {

    

    

foreach ($container->functions()->getAllMenuCategoryRelationRecords($_GET['menuId']) as $key => $dataArray) {
    $categoryData = $container->functions()->getCategory($dataArray['categoryId'])[0];
    ?>
    <div class="row mb-3" id="<?=$dataArray['id']?>">
    <span class="fs-3 text-center text"><?=$categoryData['name']?></span>
    <div class="col-md-12">
        <label for="category<?=$dataArray['id']?>loadOrder" class="form-label">Ordning:</label>
        <input type="text" class="form-control" id="category<?=$dataArray['id']?>loadOrder" value="<?=$dataArray['loadOrder']?>">
    </div>
    <div class="col-md-12">
        <button class="col-12 btn btn-danger" style="height:100%;" onclick="removeItem(<?=$menuId?>);">Ta bort</button>
    </div>   

        <ul id="" class="list-group text-center mt-2">
            <li class="list-group-item list-group-item-secondary row">
                <span class="col-sm-4 col-12">Namn</span>
                <span class="col-sm-2 col-12">Ordning</span>
                <span class="col-sm-2 col-12">Visa i panel</span>
                <span class="col-sm-2 col-12"></span>
            </li>
        <?php
    
    foreach ($container->functions()->getAllMenuCategoryItemRelationRecords($dataArray['id']) as $key => $categoryItemData) {
        $item = $container->functions()->getMenuItem($categoryItemData['itemId'])[0];

        ?>

        <li class="list-group-item row" id="categoryItem<?=$categoryItemData['itemId']?>">
            <span class="col-sm-4 col-12" id="categoryItem<?=$categoryItemData['itemId']?>name"><?=$item['name']?></span>
            <input class="col-sm-2 col-12" type="number" name="categoryItem<?=$categoryItemData['loadOrder']?>loadOrder" id="menu<?=$menuId?>loadOrder" value="<?=$categoryItemData['loadOrder']?>">    
            <div class="col-sm-2 col-12" style="align-self: center;">
                <div class="col-1 form-check form-switch form-check-inline">
                    <?php
                        if ($categoryItemData['enabled'])
                        {
                            ?>
                            <input class="form-check-input" type="checkbox" id="item<?=$categoryItemData['enabled']?>enabled" autocomplete="off" name="menu<?=$menuId?>enabled" checked>
                            <?php
                        }
                        else
                        {
                            ?>
                            <input class="form-check-input" type="checkbox" id="item<?=$categoryItemData['enabled']?>enabled" autocomplete="off" name="menu<?=$menuId?>enabled">
                            <?php
                        }
                    ?>
                </div>
            </div>
            <span class="col-sm-2 col-12"></span>
            <button class="col-sm-2 col-12 btn btn-danger" onclick="removeItem(<?=$menuId?>);">Ta bort</button>
        </li>

        <?php

        
    }

    ?>
    </ul>
        <button type="button" class="btn btn-primary mt-3 mb-2 col-12" data-bs-toggle="modal" data-bs-target="#addObjecModal">
            Lägg till objekt
        </button>
        <button type="button" onClick="saveCategory();" class="btn btn-success mb-3 col-12">
            Spara ändringar
        </button>
    </div>
    <?php
    }
?>
<?php
}
?>
    <div>
        <button type="button" class="btn btn-primary mt-3 mb-2 col-12" data-bs-toggle="modal" data-bs-target="#addObjecModal">
            Lägg till kategori
        </button>
        <button type="button" onClick="saveCategory();" class="btn btn-success mb-3 col-12">
            Spara ändringar
        </button>
    </div>
</div>