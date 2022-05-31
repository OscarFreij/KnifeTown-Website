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

    public function getCurrentOpeningState()
    {
        $data = $this->container->db()->constructResultQuerry('SELECT * FROM `openingHours` WHERE `day` = '.date("N").';')[0];
        $isPre = false;
        $isOpen = false;
        $isPost = false;

        if (isset($data['openTime']) && isset($data['closeTime']))
        {
            $date1 = DateTime::createFromFormat('H:i:s', date('H:i:s'));
            $date2 = DateTime::createFromFormat('H:i:s', $data['openTime']);
            $date3 = DateTime::createFromFormat('H:i:s', $data['closeTime']);
            if ($date1 > $date2 && $date1 < $date3)
            {
                $isOpen = true;
            }
            else if ($date1 < $date2)
            {
                $isPre = true;
            }
            else if ($date1 > $date3)
            {
                $isPost = true;
            }
    
            if ($isOpen)
            {
                echo("Open between: ".$data['openTime']." -> ".$data['closeTime']);
            }
            else if ($isPre)
            {
                echo("Opens at: ".$data['openTime']);
            }
            else if ($isPost)
            {
                echo("Closed for today");
            }
        }
        else
        {
            echo("Closed for today");
        }
    }

    public function getOpeningStates()
    {
        $data = $this->container->db()->constructResultQuerry('SELECT * FROM `openingHours` WHERE `specialDate` IS NULL ORDER BY `day` ASC;');

        if (isset($data))
        {
            for ($j=0; $j < count($data); $j++) { 
                $row = $data[$j];

                $dayDiff = $row['day'] - date('N');
                $timeSpanString = "CLOSED";

                if (isset($row['openTime']) && isset($row['closeTime']))
                {
                    $timeSpanString = $row['openTime']." -> ".$row['closeTime'];
                }
                
                if (date('N') == $row['day'])
                {
                    ?>
                    <li>
                        <span class="dropdown-item d-flex justify-content-between gap-3">
                            <span>
                                <?=date('l').": "?>
                            </span>
                            <span>
                                <?=$timeSpanString?>
                            </span>
                        </span>
                    </li>
                    <?php
                }
                else
                {
                    ?>
                    <li>
                        <span class="dropdown-item d-flex justify-content-between gap-3">
                            <span>
                                <?=date('l', strtotime($dayDiff." day")).": "?>
                            </span>
                            <span>
                                <?=$timeSpanString?>
                            </span>
                        </span>
                    </li>
                    <?php
                }
            }   
        }
    }
}
?>