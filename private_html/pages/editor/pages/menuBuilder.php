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

?>

<datalist id="categoryDataList">
<?php
    foreach ($container->functions()->getAllCategories2() as $key => $categoryData) {
        $outputCategory = $categoryData['name']." - ".$categoryData['id'];
        ?>
            <option value="<?=$outputCategory?>"></option>
        <?php
    }
?>
</datalist>
<datalist id="itemDataList">
<?php
    
    foreach ($container->functions()->getAllMenuItems2() as $key => $itemData) {
        $outputItem = $itemData['name']." - ".$itemData['id'];
        ?>
            <option value="<?=$outputItem?>"></option>
        <?php
    }
?>
</datalist>
<?php  

foreach ($container->functions()->getAllMenuCategoryRelationRecords($_GET['menuId']) as $key => $dataArray) {
    $categoryData = $container->functions()->getCategory($dataArray['categoryId'])[0];
    ?>
    <div class="row mb-3" id="category<?=$dataArray['id']?>">
    <span class="fs-3 text-center text"><?=$categoryData['name']?></span>
    <div class="col-md-12 mb-2 no-padding-w">
        <label for="category<?=$dataArray['id']?>loadOrder" class="form-label">Ordning:</label>
        <input type="number" class="form-control" id="category<?=$dataArray['id']?>loadOrder" value="<?=$dataArray['loadOrder']?>">
    </div>
    <div class="col-md-12 no-padding-w">
        <button class="col-12 btn btn-danger" style="height:100%;" onclick="removeCategory(category<?=$dataArray['id']?>);">Ta bort</button>
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

        <li class="list-group-item row" id="categoryItem<?=$categoryItemData['id']?>">
            <span class="col-sm-4 col-12" id="categoryItem<?=$categoryItemData['id']?>name"><?=$item['name']?></span>
            <input class="col-sm-2 col-12" type="number" name="categoryItem<?=$categoryItemData['id']?>loadOrder" id="categoryItem<?=$categoryItemData['id']?>loadOrder" value="<?=$categoryItemData['loadOrder']?>">    
            <div class="col-sm-2 col-12" style="align-self: center;">
                <div class="col-1 form-check form-switch form-check-inline">
                    <?php
                        if ($categoryItemData['enabled'])
                        {
                            ?>
                            <input class="form-check-input" type="checkbox" id="categoryItem<?=$categoryItemData['id']?>enabled" autocomplete="off" name="categoryItem<?=$categoryItemData['enabled']?>enabled" checked>
                            <?php
                        }
                        else
                        {
                            ?>
                            <input class="form-check-input" type="checkbox" id="categoryItem<?=$categoryItemData['id']?>enabled" autocomplete="off" name="categoryItem<?=$categoryItemData['enabled']?>enabled">
                            <?php
                        }
                    ?>
                </div>
            </div>
            <span class="col-sm-2 col-12"></span>
            <button class="col-sm-2 col-12 btn btn-danger" onclick="removeItem(categoryItem<?=$categoryItemData['id']?>);">Ta bort</button>
        </li>

        <?php

        
    }

    ?>
    </ul>
        <button type="button" class="btn btn-primary mt-3 mb-2 col-12" onClick="addItemPre(<?=$dataArray['id']?>);" data-bs-toggle="modal" data-bs-target="#addObjectModal">
            Lägg till objekt
        </button>
        <button type="button" onClick="saveCategory(category<?=$dataArray['id']?>);" class="btn btn-success mb-3 col-12">
            Spara ändringar
        </button>
    </div>
    <?php
    }
?>
    <div class="row no-padding-w">
        <button type="button" class="btn btn-primary mt-3 mb-2 col-12" onclick="clearCategoryModal();" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
            Lägg till kategori
        </button>
    </div>
    <div class="row my-3" id="errorBox"></div>
<?php
    require "../private_html/pages/editor/modules/menuBuilderModals.php";
}
?>
    
</div>
