<div class="accordion-item">
    <h2 class="accordion-header" id="MenuAccordionHeading<?=$category['id']?>-<?=$menuId?>">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#MenuAccordion<?=$category['id']?>-<?=$menuId?>" aria-expanded="false" aria-controls="MenuAccordion<?=$category['id']?>">
            <?=$category['name']?>
        </button>
    </h2>
    <div id="MenuAccordion<?=$category['id']?>-<?=$menuId?>" class="accordion-collapse collapse" aria-labelledby="MenuAccordionHeading<?=$category['id']?>-<?=$menuId?>">
        <div class="accordion-body">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <!-- Items to be placed here -->
                <?php
                $cirr = $this->container->functions()->getMenuCategoryItemRelationRecords($crrId);
                if (count($cirr) > 0)
                {
                    for ($k=0; $k < count($cirr); $k++) { 
                        $item = $this->container->functions()->getMenuItem($cirr[$k]['itemId'])[0];
                        $this->container->functions()->displayCategoryItem($item);
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>