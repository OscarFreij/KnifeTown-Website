<div class="accordion-item">
    <h2 class="accordion-header" id="MenuAccordionHeading<?=$category['id']?>">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#MenuAccordion<?=$category['id']?>" aria-expanded="false" aria-controls="MenuAccordion<?=$category['id']?>">
            <?=$category['name']?>
        </button>
    </h2>
    <div id="MenuAccordion<?=$category['id']?>" class="accordion-collapse collapse" aria-labelledby="MenuAccordionHeading<?=$category['id']?>">
        <div class="accordion-body">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <!-- Items to be placed here -->
                <?php
                $items = $this->container->functions()->getCategoryItems($category['id']);

                if (count($items) > 0)
                {
                    for ($j=0; $j < count($items); $j++) { 
                        $item = $items[$j];
                        $this->container->functions()->createCategoryItem($item);
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>