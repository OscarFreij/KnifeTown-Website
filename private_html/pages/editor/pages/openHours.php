<?php
if (!isset($_SESSION['username'])) {
    http_response_code(401);
}
else
{
    ?>

    <div class="container text-light">
        <div class="row my-3">
            <span class="fs-1 text-center text">
                Öppettider
            </span>
        </div>
        <div class="row my-3" id="openingHoursStandardList">
            <span class="fs-3 text-center text col-12">
                Redigera öppettider (Standard)
            </span>
            <span class="text-center text col-12">
                Nedan rader är normala öppettider (Måndag - Söndag)
            </span>
            <ul id="listStandard" class="list-group text-center mt-2">
                <li class="list-group-item list-group-item-secondary row">
                    <span class="col-sm-4 col-12">Dag</span>
                    <span class="col-sm-4 col-6">Öppning</span>
                    <span class="col-sm-4 col-6">Stängning</span>
                </li>
                <?php
                $container->functions()->displayEditorOpeningStatesStandard();
                ?>
            </ul>
            <button type="button" onClick="saveStandard();" class="btn btn-success my-3 col-12">
                Spara ändringar
            </button>
        </div>
        <div class="row my-3" id="openingHoursSpecialList">
            <span class="fs-3 text-center text">
                Redigera öppettider (Speciella)
            </span>
            <span class="text-center text">
                Nedan rader är speciella öppettider (Högtider och liknande)
            </span>
            <ul id="listSpecial" class="list-group text-center mt-2">
                <li class="list-group-item list-group-item-secondary row">
                    <span class="col-sm-3 col-12">Namn</span>
                    <span class="col-sm-1 col-12">Öppning</span>
                    <span class="col-sm-1 col-12">Stängning</span>
                    <span class="col-sm-2 col-12">Datum</span>
                    <span class="col-sm-2 col-12">Visa i panel</span>
                    <span class="col-sm-2 col-12">Dölj i panel</span>
                    <span class="col-sm-1 col-12">&nbsp;</span>
                </li>
                <?php
                    $container->functions()->displayEditorOpeningStatesSpecial();
                ?>
            </ul>
            <button type="button" class="btn btn-primary mt-3 mb-2 col-12" data-bs-toggle="modal" data-bs-target="#openingHoursCreateSpecialModal">
                Lägg till ny dag
            </button>
            <button type="button" onClick="saveSpecial();" class="btn btn-success mb-3 col-12">
                Spara ändringar
            </button>
        </div>
        
    </div>

    <?php
    require "../private_html/pages/editor/modules/openingHoursCreateModal.php";
}
?>