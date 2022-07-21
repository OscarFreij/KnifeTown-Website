<div class="row mb-3">
    <span class="fs-3 text-center text mb-2">
        <?=$menu['name']?>
    </span>
    <div class="accordion" id="MenuAccordionPanels<?=$menu['id']?>">
        <?php
        $categoryRelationRecords = $this->container->functions()->getMenuCategoryRelationRecords($menu['id']);
        if (count($categoryRelationRecords) > 0)
        {
            for ($j=0; $j < count($categoryRelationRecords); $j++) { 
                $crr = $categoryRelationRecords[$j];
                $category = $this->container->functions()->getCategory($crr['categoryId'])[0];
                $this->container->functions()->displayCategoryAccordion($category, $crr['id'], $menu['id']);
            }
            
        }
        
        ?>
    </div>
</div>