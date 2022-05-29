<?php

class functions
{
    private $container;

    public function __construct(container $container)
    {
        $this->container = $container;    
    }
   
    public function getCategories()
    {
        return $this->container->db()->constructResultQuerry('SELECT * FROM `menuCategory` WHERE 1 ORDER BY displayOrder ASC;');
    }

    public function getCategoryItems(int $categoryId)
    {
        return $this->container->db()->constructResultQuerry('SELECT * FROM `menuItems` WHERE `menuCategoryId` = '.$categoryId.' ORDER BY displayOrder ASC;');
    }

    public function createCategory(array $category)
    {
        require "../private_html/templates/menuCategory.php";
    }

    public function createCategoryItem(array $item)
    {
        require "../private_html/templates/menuCategoryItem.php";
    }

    public function createCategoryAccordion()
    {
        $categories = $this->getCategories();

        for ($i=0; $i < count($categories); $i++) { 
            $this->createCategory($categories[$i]);
        }
    }
}
?>