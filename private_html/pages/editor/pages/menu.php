<?php
if (!isset($_SESSION['username'])) {
    http_response_code(401);
} else {
?>

    <div class="container text-light">
        <div class="row my-3">
            <span class="fs-1 text-center text">
                Meny
            </span>
        </div>
        <div class="row my-3">
            <span class="fs-3 text-center text">
                Redigera menyer
            </span>
        </div>
        <div class="row mb-3" id="menuList">
            <ul id="listMenu" class="list-group text-center mt-2">
                <li class="list-group-item list-group-item-secondary row">
                    <span class="col-sm-4 col-12">Namn</span>
                    <span class="col-sm-2 col-12">Ordning</span>
                    <span class="col-sm-2 col-12">Visa i panel</span>
                    <span class="col-sm-2 col-6"></span>
                    <span class="col-sm-2 col-6"></span>
                </li>
                <?php
                $container->functions()->getAllMenus();
                ?>
            </ul>
            <button type="button" class="btn btn-primary mt-3 mb-2 col-12" data-bs-toggle="modal" data-bs-target="#createMenuModal">
                Lägg till ny meny
            </button>
            <button type="button" onClick="saveMenus();" class="btn btn-success mb-3 col-12">
                Spara ändringar
            </button>
        </div>
        <div class="row my-3">
            <span class="fs-3 text-center text">
                Redigera Kategorier
            </span>
        </div>
        <div class="row mb-3" id="categoryList">
            <ul id="listCategory" class="list-group text-center mt-2">
                <li class="list-group-item list-group-item-secondary row">
                    <span class="col-sm-8 col-12">Namn</span>
                    <span class="col-sm-2 col-12"></span>
                    <span class="col-sm-2 col-12"></span>
                </li>
                <?php
                $container->functions()->getAllCategories();
                ?>
            </ul>
            <button type="button" class="btn btn-primary mt-3 mb-2 col-12" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
                Lägg till ny kategori
            </button>
            <button type="button" onClick="saveCategories();" class="btn btn-success mb-3 col-12">
                Spara ändringar
            </button>
        </div>
        <div class="row my-3">
            <span class="fs-3 text-center text">
                Redigera Objekt
            </span>
        </div>
        <div class="row row-cols-1 mb-3 row-cols-md-3 g-4" id="listItem">
            <?php
            $container->functions()->getAllMenuItems();
            ?>
        </div>
        <button type="button" class="btn btn-primary mt-3 mb-2 col-12" data-bs-toggle="modal" data-bs-target="#createMenuItemModal">
            Lägg till nytt objekt
        </button>
        <button type="button" onClick="saveItems();" class="btn btn-success mb-3 col-12">
            Spara ändringar
        </button>
        <div class="col-12 mb-3" id="itemList"></div>
    </div>
<?php
    require "../private_html/pages/editor/modules/menuModals.php";
}
?>