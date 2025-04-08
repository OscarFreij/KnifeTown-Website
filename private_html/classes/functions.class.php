<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;
//Alias the League Google OAuth2 provider class
use League\OAuth2\Client\Provider\Google;

//Load Composer's autoloader
require '../private_html/vendor/autoload.php';

class functions
{
    private $container;

    public function __construct(container $container)
    {
        $this->container = $container;    
    }
   
    #region Menu Items & Categories
    public function getMenus($enabled = 1)
    {
        $menues = $this->container->db()->constructResultQuerry('SELECT * FROM `menus` WHERE `enabled` = '.$enabled.' ORDER BY `loadOrder` ASC;');
        
        if (count($menues) > 0)
        {
            for ($i=0; $i < count($menues); $i++) { 
                $menu = $menues[$i];
                $this->displayMenu($menu);
            }
        }
    }

    public function getAllMenus()
    {
        $menues = $this->container->db()->constructResultQuerry('SELECT * FROM `menus` WHERE 1 ORDER BY `loadOrder` ASC;');
        
        if (count($menues) > 0)
        {
            for ($i=0; $i < count($menues); $i++) { 
                $menu = $menues[$i];
                $this->displayMenu2($menu);
            }
        }
    }

    public function getMenuName($id)
    {
        $menu = $this->container->db()->constructResultQuerry('SELECT `name` FROM `menus` WHERE `id` = '.$id.';');
        
        if (count($menu) > 0)
        {
            return $menu[0]['name'];
        }
        else
        {
            return false;
        }
    }
    
    public function createMenu(array $data)
    {
        $success = false;
        error_log(print_r($data,true));
        for ($i=0; $i < count($data); $i++) { 
            $element = $data[$i];

            $success = $this->container->db()->constructQuerry('INSERT INTO `menus`(`name`, `loadOrder`, `enabled`) VALUES ('.$this->container->db()->quote($element->name).', '.$this->container->db()->quote($element->loadOrder).', '.$this->container->db()->quote($element->enabled).');');
            if (!$success)
            {
                return false;
            }
        }
        return true;
    }

    public function setMenus(array $data)
    {
        $success = false;
        error_log(print_r($data,true));
        for ($i=0; $i < count($data); $i++) { 
            $element = $data[$i];
            $success = $this->container->db()->constructQuerry('UPDATE `menus` SET `name`='.$this->container->db()->quote($element->name).',`loadOrder`='.$this->container->db()->quote($element->loadOrder).',`enabled`='.$this->container->db()->quote($element->enabled).' WHERE `id` = '.$element->id.';');
            if (!$success)
            {
                return false;
            }
        }
        return true;
        
    }

    public function removeMenu($id)
    {
        return $this->container->db()->constructQuerry('DELETE FROM `menus` WHERE `id` = '.$id.';');
    }

    public function createCategory(array $data)
    {
        $success = false;
        error_log(print_r($data,true));
        for ($i=0; $i < count($data); $i++) { 
            $element = $data[$i];

            $success = $this->container->db()->constructQuerry('INSERT INTO `menuCategory`(`name`) VALUES ('.$this->container->db()->quote($element->name).');');
            if (!$success)
            {
                return false;
            }
        }
        return true;
    }

    public function setCategories(array $data)
    {
        $success = false;
        error_log(print_r($data,true));
        for ($i=0; $i < count($data); $i++) { 
            $element = $data[$i];
            $success = $this->container->db()->constructQuerry('UPDATE `menuCategory` SET `name`='.$this->container->db()->quote($element->name).' WHERE `id` = '.$element->id.';');
            if (!$success)
            {
                return false;
            }
        }
        return true;
        
    }


    public function removeCategory($id)
    {
        return $this->container->db()->constructQuerry('DELETE FROM `menuCategory` WHERE `id` = '.$id.';');
    }


    public function createMenuItem(array $data)
    {
        $success = false;
        error_log(print_r($data,true));
        for ($i=0; $i < count($data); $i++) { 
            $element = $data[$i];

            $hasImage = true;

            if ($element->imageData == "")
            {
                $hasImage = false;
            }
            else
            {
                $hasImage = true;
            }


            
            if (!$hasImage)
            {
                $success = $this->container->db()->constructQuerry('INSERT INTO `menuItems` (`name`, `description`, `price`) VALUES ('.$this->container->db()->quote($element->name).','.$this->container->db()->quote($element->description).','.$this->container->db()->quote($element->price).');');
            }
            else
            {
                $success = $this->container->db()->constructQuerry('INSERT INTO `menuItems` (`name`, `description`, `imageData`, `price`) VALUES ('.$this->container->db()->quote($element->name).','.$this->container->db()->quote($element->description).','.$this->container->db()->quote($element->imageData).','.$this->container->db()->quote($element->price).');');
            }
            if (!$success)
            {
                return false;
            }
        }
        return true;
    }

    public function setMenuItems(array $data)
    {
        $success = false;
        error_log(print_r($data,true));
        for ($i=0; $i < count($data); $i++) { 
            $element = $data[$i];

            $hasImage = true;

            if ($element->imageData == "")
            {
                $hasImage = false;
            }
            else
            {
                $hasImage = true;
            }


            
            if (!$hasImage)
            {
                $success = $this->container->db()->constructQuerry('UPDATE `menuItems` SET `name`='.$this->container->db()->quote($element->name).',`description`='.$this->container->db()->quote($element->description).',`price`='.$this->container->db()->quote($element->price).' WHERE `id` = '.$element->id.';');
            }
            else
            {
                $success = $this->container->db()->constructQuerry('UPDATE `menuItems` SET `name`='.$this->container->db()->quote($element->name).',`description`='.$this->container->db()->quote($element->description).',`imageData`='.$this->container->db()->quote($element->imageData).',`price`='.$this->container->db()->quote($element->price).' WHERE `id` = '.$element->id.';');
            }
            if (!$success)
            {
                return false;
            }
        }
        return true;
        
    }

    public function removeMenuItem($id)
    {
        return $this->container->db()->constructQuerry('DELETE FROM `menuItems` WHERE `id` = '.$id.';');
    }

    public function getMenuCategoryRelationRecords(int $id, int $enabled = 1)
    {
        return $this->container->db()->constructResultQuerry('SELECT * FROM `menuCategoryRelations` WHERE `menuId` = '.$id.' ORDER BY  `loadOrder` ASC;');
    }

    public function getAllMenuCategoryRelationRecords(int $id)
    {
        return $this->getMenuCategoryRelationRecords($id);
    }

    public function getMenuCategoryItemRelationRecords(int $id, int $enabled = 1)
    {
        return $this->container->db()->constructResultQuerry('SELECT * FROM `menuCategoryItemRelations` WHERE `enabled` = '.$enabled.' AND `categoryRelationRecordId` = '.$id.' ORDER BY  `loadOrder` ASC;');
    }

    public function setMenuCategoryItemRelationRecords(array $data)
    {
        $success = false;
        error_log(print_r($data,true));
        
        $element = $data[0];
        $success = $this->container->db()->constructQuerry('UPDATE `menuCategoryRelations` SET `loadOrder`='.$this->container->db()->quote($element->loadOrder).' WHERE `id` = '.$element->id.';');

        if (!$success)
        {
            return false;
        }

        for ($i=1; $i < count($data); $i++) { 
            $element = $data[$i];
            $success = $this->container->db()->constructQuerry('UPDATE `menuCategoryItemRelations` SET `loadOrder`='.$this->container->db()->quote($element->loadOrder).',`enabled`='.$this->container->db()->quote($element->enabled).' WHERE `id` = '.$element->id.';');
            if (!$success)
            {
                return false;
            }
        }
        return true;
    }

    public function addMenuCategoryItemRelationRecords(array $data)
    {
        $success = false;
        error_log(print_r($data,true));
        
        $element = $data[0];
        $success = $this->container->db()->constructQuerry('INSERT INTO `menuCategoryItemRelations`(`categoryRelationRecordId`, `itemId`) VALUES ('.$this->container->db()->quote($element->menuCategoryItemRelations).','.$this->container->db()->quote($element->itemId).');');

        if (!$success)
        {
            return false;
        }
        return true;
    }

    public function removeMenuCategoryItemRelationRecords($id)
    {
        return $this->container->db()->constructQuerry('DELETE FROM `menuCategoryItemRelations` WHERE `id` = '.$id.';');
    }

    public function addMenuCategoryRelationRecords(array $data)
    {
        $success = false;
        error_log(print_r($data,true));
        
        $element = $data[0];
        $success = $this->container->db()->constructQuerry('INSERT INTO `menuCategoryRelations`(`menuId`, `categoryId`) VALUES ('.$this->container->db()->quote($element->menuId).','.$this->container->db()->quote($element->categoryId).');');

        if (!$success)
        {
            return false;
        }
        return true;
    }

    public function removeMenuCategoryRelationRecords($id)
    {
        return $this->container->db()->constructQuerry('DELETE FROM `menuCategoryRelations` WHERE `id` = '.$id.';');
    }
    

    public function getAllMenuCategoryItemRelationRecords(int $id)
    {
        return $this->container->db()->constructResultQuerry('SELECT * FROM `menuCategoryItemRelations` WHERE `categoryRelationRecordId` = '.$id.' ORDER BY  `loadOrder` ASC;');
    }

    public function getCategory(int $id)
    {
        return $this->container->db()->constructResultQuerry('SELECT * FROM `menuCategory` WHERE `id` = '.$id.';');
    }

    public function getAllCategories()
    {
        $categories = $this->container->db()->constructResultQuerry('SELECT * FROM `menuCategory` WHERE 1 ORDER BY `name` ASC;');
        
        if (count($categories) > 0)
        {
            for ($i=0; $i < count($categories); $i++) { 
                $category = $categories[$i];
                $this->displayCategory2($category);
            }
        }
    }

    public function getAllCategories2()
    {
        $categories = $this->container->db()->constructResultQuerry('SELECT * FROM `menuCategory` WHERE 1 ORDER BY `name` ASC;');
        
        if (count($categories) > 0)
        {
            return $categories;
        }
        else
        {
            return false;
        }
    }

    public function getMenuItem(int $id)
    {
        return $this->container->db()->constructResultQuerry('SELECT * FROM `menuItems` WHERE `id` = '.$id.';');
    }

    public function getAllMenuItems()
    {
        $items = $this->container->db()->constructResultQuerry('SELECT * FROM `menuItems` WHERE 1 ORDER BY `id` ASC;');
        
        if (count($items) > 0)
        {
            for ($i=0; $i < count($items); $i++) { 
                $item = $items[$i];
                $this->displayCategoryItem2($item);
            }
        }
    }

    public function getAllMenuItems2()
    {
        $items = $this->container->db()->constructResultQuerry('SELECT * FROM `menuItems` WHERE 1 ORDER BY `id` ASC;');
        
        if (count($items) > 0)
        {
            return $items;
        }
        else
        {
            return false;
        }
    }

    public function displayMenu(array $menu)
    {
        require "../private_html/templates/menu.php";
    }

    public function displayMenu2(array $menu)
    {
        $menuId = $menu['id'];
        $menuName = $menu['name'];
        $menuLoadOrder = $menu['loadOrder'];
        $menuEnabled = $menu['enabled'];
        
        require "../private_html/templates/editorMenuListItem.php";
    }

    public function displayCategory2(array $category)
    {
        $categoryId = $category['id'];
        $categoryName = $category['name'];

        require "../private_html/templates/editorMenuCategoryListItem.php";
    }

    public function displayCategory(array $category, int $crrId, int $menuId)
    {
        require "../private_html/templates/menuCategory.php";
    }

    public function displayCategoryItem(array $item)
    {
        require "../private_html/templates/menuCategoryItem.php";
    }
    public function displayCategoryItem2(array $item)
    {
        require "../private_html/templates/editorMenuCategoryItemCard.php";
    }

    public function displayCategoryAccordion(array $category, int $crrId, int $menuId)
    {
        $this->displayCategory($category, $crrId, $menuId);
    }
    #endregion
    
    #region Opening Hours / State
    public function getCurrentOpeningState()
    {
        $data = $this->container->db()->constructResultQuerry('SELECT * FROM `openingHours` WHERE `day` = '.date("N").';')[0];
        $isPre = false;
        $isOpen = false;
        $isPost = false;


        $dataSpecial = $this->container->db()->constructResultQuerry('SELECT * FROM `openingHours` WHERE `specialDate` = CURDATE();');
        if (count($dataSpecial) > 0)
        {
            $data = $dataSpecial[0];
            $u1 = strtotime(date('Y-n-j')." ".$data['closeTime']);
            $u2 = strtotime(date('Y-n-j')." ".$data['openTime']);
            
            if (($u1 - $u2) <= 0)
            {
                $timeSpan = date_create(($data['specialDate']." ".$data['closeTime']))->modify('+1 day');
                $data['closeTime'] = date("Y-n-j H:i:s", date_timestamp_get($timeSpan));
            }
        }

        

        
        

        if (isset($data['openTime']) && isset($data['closeTime']))
        {
            $date1 = strtotime(date('H:i:s'));
            $date2 = strtotime($data['openTime']);
            $date3 = strtotime($data['closeTime']);
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
                echo("Öppen mellan: ".date('H:i', $date2)." -> ".date('H:i', $date3));
            }
            else if ($isPre)
            {
                echo("Öppnar vid: ".date('H:i', $date2));
            }
            else if ($isPost)
            {
                echo("Stängd för idag");
            }
        }
        else
        {
            echo("Stängd för idag");
        }
    }

    public function getOpeningStates()
    {
        $data = $this->container->db()->constructResultQuerry('SELECT * FROM `openingHours` WHERE `specialDate` IS NULL ORDER BY `day` ASC;');
        $data2 = $this->container->db()->constructResultQuerry('SELECT * FROM `openingHours` WHERE `specialDate` IS NOT NULL AND `specialViewStart` <= CURDATE() AND `specialViewStop` >= CURDATE() ORDER BY `specialDate` ASC;');
        
        $todayIsSpecial = false;

        if (count($data2) > 0)
        {
            for ($j=0; $j < count($data2); $j++) { 
                $diff = strtotime(date('Y-n-j')) - strtotime($data2[$j]['specialDate']);
                if ($diff == 0)
                {
                    $todayIsSpecial = true;
                }
            }
        }


        $dayNameFormat = datefmt_create(
            'sv-SE',
            IntlDateFormatter::FULL,
            IntlDateFormatter::FULL,
            'Europe/Stockholm',
            IntlDateFormatter::GREGORIAN,
            'EEEE'
        );

        if (count($data) > 0)
        {
            for ($j=0; $j < count($data); $j++) { 
                $row = $data[$j];

                $dayDiff = $row['day'] - date('N');
                $timeSpanString = "Stängt";

                if (isset($row['openTime']) && isset($row['closeTime']))
                {
                    $timeSpanString = substr($row['openTime'],0,-3)." -> ".substr($row['closeTime'],0,-3);
                }
                
                if (date('N') == $row['day'] && !$todayIsSpecial)
                {
                    ?>
                    <li>
                        <span class="dropdown-item bg-success d-flex justify-content-between gap-3">
                            <span>
                                <?=ucfirst(datefmt_format($dayNameFormat,date('U'))).": "?>
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
                                <?=ucfirst(datefmt_format($dayNameFormat, strtotime($dayDiff." day"))).": "?>
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

        $this->getSpecialOpeningStates();
    }

    public function getSpecialOpeningStates()
    {
        
        
        $data = $this->container->db()->constructResultQuerry('SELECT * FROM `openingHours` WHERE `specialDate` IS NOT NULL AND `specialViewStart` <= CURDATE() AND `specialViewStop` >= CURDATE() ORDER BY `specialDate` ASC;');

        if (count($data) > 0)
        {
        
            ?>
            <li><hr class="dropdown-divider"></li>
            <?php            

            for ($j=0; $j < count($data); $j++) { 
                $row = $data[$j];

                $timeSpanString = "Stängt";

                if (isset($row['openTime']) && isset($row['closeTime']))
                {
                    $timeSpanString = substr($row['openTime'],0,-3)." -> ".substr($row['closeTime'],0,-3);
                }
                

                $diff = strtotime(date('Y-n-j')) - strtotime($row['specialDate']);
                if ($diff == 0)
                {
                    ?>
                    <li>
                        <span class="dropdown-item bg-success d-flex justify-content-between gap-3">
                            <span>
                                <?=$row['specialName'].": "?>
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
                                <?=$row['specialName'].": "?>
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

    public function getOpeningStatesStandardData()
    {
        return $data = $this->container->db()->constructResultQuerry('SELECT * FROM `openingHours` WHERE `specialDate`IS NULL');
    }

    public function getOpeningStatesSpecialData()
    {
        return $data = $this->container->db()->constructResultQuerry('SELECT * FROM `openingHours` WHERE `specialDate`IS NOT NULL');
    }

    public function displayEditorOpeningStatesStandard()
    {
        $data = $this->getOpeningStatesStandardData();
        $dayNameFormat = datefmt_create(
            'sv-SE',
            IntlDateFormatter::FULL,
            IntlDateFormatter::FULL,
            'Europe/Stockholm',
            IntlDateFormatter::GREGORIAN,
            'EEEE'
        );

        for ($j=0; $j < count($data); $j++) { 
            $row = $data[$j];

            $dayDiff = $row['day'] - date('N');
            $rowId = $row['id'];
            $dayName = ucfirst(datefmt_format($dayNameFormat, strtotime($dayDiff." day")));
            $openTime = $row['openTime'];
            $closeTime = $row['closeTime'];
            
            require "../private_html/templates/editorOpeningHoursListItemStandard.php";
        }
    }

    public function displayEditorOpeningStatesSpecial()
    {
        $data = $this->getOpeningStatesSpecialData();
        for ($j=0; $j < count($data); $j++) { 
            $row = $data[$j];

            $rowId = $row['id'];
            $dayName = $row['specialName'];
            $openTime = $row['openTime'];
            $closeTime = $row['closeTime'];
            $date = $row['specialDate'];
            $viewStartDate = $row['specialViewStart'];
            $viewStopDate = $row['specialViewStop'];
            
            require "../private_html/templates/editorOpeningHoursListItemSpecial.php";
        }
    }

    public function setOpeningStatesStandard(array $data)
    {
        $success = false;
        error_log(print_r($data,true));
        for ($i=0; $i < count($data); $i++) { 
            $element = $data[$i];

            $closedOnThisDay = false;

            if ($element->startTime == "")
            {
                $closedOnThisDay = true;
            }
            else
            {
                $element->startTime = $this->container->db()->quote($element->startTime);
            }


            if ($element->stopTime == "")
            {
                $closedOnThisDay = true;
            }
            else
            {
                $element->stopTime = $this->container->db()->quote($element->stopTime);
            }


            error_log('UPDATE `openingHours` SET `openTime`='.$element->startTime.',`closeTime`='.$element->stopTime.' WHERE `id` = '.$element->id.';');
            if ($closedOnThisDay)
            {
                $success = $this->container->db()->constructQuerry('UPDATE `openingHours` SET `openTime`=NULL,`closeTime`=NULL WHERE `id` = '.$element->id.';');
            }
            else
            {
                $success = $this->container->db()->constructQuerry('UPDATE `openingHours` SET `openTime`='.$element->startTime.',`closeTime`='.$element->stopTime.' WHERE `id` = '.$element->id.';');
            }
            if (!$success)
            {
                return false;
            }
        }
        return true;
        
    }

    public function setOpeningStatesSpecial(array $data)
    {
        $success = false;
        error_log(print_r($data,true));
        for ($i=0; $i < count($data); $i++) { 
            $element = $data[$i];

            $closedOnThisDay = false;

            if ($element->startTime == "")
            {
                $closedOnThisDay = true;
            }

            if ($element->stopTime == "")
            {
                $closedOnThisDay = true;
            }

            error_log('UPDATE `openingHours` SET `openTime`='.$this->container->db()->quote($element->startTime).',`closeTime`='.$this->container->db()->quote($element->stopTime).',`specialName`='.$this->container->db()->quote($element->name).',`specialDate`='.$this->container->db()->quote($element->specialDate).',`specialViewStart`='.$this->container->db()->quote($element->specialViewStart).',`specialViewStop`='.$this->container->db()->quote($element->specialViewStop).' WHERE `id` = '.$this->container->db()->quote($element->id).';');
            if ($closedOnThisDay)
            {
                $success = $this->container->db()->constructQuerry('UPDATE `openingHours` SET `openTime`=NULL,`closeTime`=NULL,`specialName`='.$this->container->db()->quote($element->name).',`specialDate`='.$this->container->db()->quote($element->specialDate).',`specialViewStart`='.$this->container->db()->quote($element->specialViewStart).',`specialViewStop`='.$this->container->db()->quote($element->specialViewStop).' WHERE `id` = '.$this->container->db()->quote($element->id).';');
            }
            else
            {
                $success = $this->container->db()->constructQuerry('UPDATE `openingHours` SET `openTime`='.$this->container->db()->quote($element->startTime).',`closeTime`='.$this->container->db()->quote($element->stopTime).',`specialName`='.$this->container->db()->quote($element->name).',`specialDate`='.$this->container->db()->quote($element->specialDate).',`specialViewStart`='.$this->container->db()->quote($element->specialViewStart).',`specialViewStop`='.$this->container->db()->quote($element->specialViewStop).' WHERE `id` = '.$this->container->db()->quote($element->id).';');
            }
            if (!$success)
            {
                return false;
            }
        }
        return true;
    }

    public function createOpeningStatesSpecial(array $data)
    {
        $success = false;
        error_log(print_r($data,true));
        for ($i=0; $i < count($data); $i++) { 
            $element = $data[$i];

            $closedOnThisDay = false;

            if ($element->startTime == "")
            {
                $closedOnThisDay = true;
            }


            if ($element->stopTime == "")
            {
                $closedOnThisDay = true;
            }

            if ($closedOnThisDay)
            {
                $success = $this->container->db()->constructQuerry('INSERT INTO `openingHours`(`specialDate`, `specialName`, `specialViewStart`, `specialViewStop`) VALUES ('.$this->container->db()->quote($element->specialDate).', '.$this->container->db()->quote($element->name).', '.$this->container->db()->quote($element->specialViewStart).', '.$this->container->db()->quote($element->specialViewStop).')');
            }
            else
            {
                $success = $this->container->db()->constructQuerry('INSERT INTO `openingHours`(`openTime`, `closeTime`, `specialDate`, `specialName`, `specialViewStart`, `specialViewStop`) VALUES ('.$this->container->db()->quote($element->startTime).', '.$this->container->db()->quote($element->stopTime).', '.$this->container->db()->quote($element->specialDate).', '.$this->container->db()->quote($element->name).', '.$this->container->db()->quote($element->specialViewStart).', '.$this->container->db()->quote($element->specialViewStop).')');
            }
            if (!$success)
            {
                return false;
            }
        }
        return true;
    }

    public function removeOpeningStatesSpecial(int $id)
    {
        $success = $this->container->db()->constructQuerry('DELETE FROM `openingHours` WHERE `id` = '.$id.';');
        return $success;
    }
    #endregion

    #region Custom Page Content
    public function getCustomPageContent(string $itemName)
    {
        $data = $this->container->db()->constructResultQuerry('SELECT `content` FROM `pageContent` WHERE `itemName` = '.$this->container->db()->quote($itemName).';');
        if (isset($data[0]))
        {
            echo($data[0]['content']);
        }
        else
        {
            echo("# No record for: ".$itemName. " exists #");
        }
    }

    public function setCustomPageContent(string $itemName, string $data)
    {
        $data = $this->container->db()->constructQuerry('UPDATE `pageContent` SET `content`='.$this->container->db()->quote($data).' WHERE `itemName` = '.$this->container->db()->quote($itemName).';');
        return $data;
    }
    #endregion

    #region Contact Form & Mail

    public function sendFormEmail(Array $data)
    {
        $credArray = $this->container->credentials()->getMailCredentials();
        $to = $data['email'];

        if ($data['type'] == 1)
        {
            $reciver = $credArray['emailReceivers'];    
        }
        else if ($data['type'] == 2)
        {
            $reciver = $credArray['technicalEmailReceivers'];
            //$reciver = "otg020313@gmail.com";
        }
        $phone = $data['phone'];
        #$msg = $data['msg'];

        if ($data['type'] == 1)
        {
            $subject = "Meddelande från knifetownburgers.se :-)";
        }
        else if ($data['type'] == 2)
        {
            $subject = "Tekniskt fel på knifetownburgers.se";
        }
        

        #TEMPORARY#

        $msg = "
        <html>
        <head>
        <title>HTML email</title>
        </head>
        <body>
        <p>
        Kontaktinformation: <a href='mailto:$to'>$to</a> :: <a href='tel:$phone'>$phone</a>
        </p>
        <p>
        ".htmlspecialchars($data['msg'], ENT_SUBSTITUTE)."
        </p>
        </body>
        </html>
        ";

        #TEMPORARY#

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try 
        {
            //Server settings
            $mail->SMTPDebug  = SMTP::DEBUG_OFF;                    //Enable verbose debug output
            $mail->isSMTP();                                        //Send using SMTP
            $mail->CharSet    = "UTF-8";                            //Set mail charset
            $mail->Host       = 'smtp.gmail.com';                   //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                               //Enable SMTP authentication
            #$mail->Username   = $credArray['username'];             //SMTP username
            #$mail->Password   = $credArray['password'];             //SMTP password
            $mail->AuthType = 'XOAUTH2';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;        //Enable implicit TLS encryption
            $mail->Port       = 465;                                //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            $email = $credArray['oauthUserEmail'];
            $clientId = $credArray['oauthClientId'];
            $clientSecret = $credArray['oauthClientSecret'];

            //Obtained by configuring and running get_oauth_token.php
            //after setting up an app in Google Developer Console.
            $refreshToken = $credArray['oauthRefreshToken'];

            //Create a new OAuth2 provider instance
            $provider = new Google(
                [
                    'clientId' => $clientId,
                    'clientSecret' => $clientSecret,
                ]
            );

            //Pass the OAuth provider instance to PHPMailer
            $mail->setOAuth(
                new OAuth(
                    [
                        'provider' => $provider,
                        'clientId' => $clientId,
                        'clientSecret' => $clientSecret,
                        'refreshToken' => $refreshToken,
                        'userName' => $email,
                    ]
                )
            );


            //Recipients
            $mail->setFrom($credArray['oauthUserEmail'], "Knifetownburgers ".substr($credArray['oauthUserEmail'], 0, strpos($credArray['oauthUserEmail'], '.') ));
            $mail->addAddress("$reciver");
            $mail->addReplyTo("$to");

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $msg;
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            error_log("Successfully sent email to $reciver");
        } catch (Exception $e) {
            error_log("sendEmail.php got an error -> Error: {$mail->ErrorInfo}");
        }
    }

    #endregion

    #region User Functions
    private function checkLogin(string $username, string $password)
    {
        $quotedUsername = $this->container->db()->quote($username);
        $result = $this->container->db()->constructResultQuerry("SELECT `password`, `enabled` FROM `users` WHERE `username` = $quotedUsername");

        if ($this->checkUserExists($username))
        {
            if ($result[0]['enabled'] == 1)
            {
                $hash = $result[0]['password'];
                return password_verify($password, $hash);
            }
            else
            {
                error_log("User ".$quotedUsername." tried to login but is disabled");
            }
        }
        else
        {
            error_log("Unknown user tried to login: ".$quotedUsername);
        }
        return false;
    }

    public function changePassword(string $username, string $passwordOld, string $passwordNew)
    {
        if ($this->checkLogin($username, $passwordOld))
        {
            $quotedUsername = $this->container->db()->quote($username);
            $quotedPasswordNewHASH = $this->container->db()->quote(password_hash($passwordNew, PASSWORD_DEFAULT));
            $success = $this->container->db()->constructQuerry("UPDATE `users` SET `password`=$quotedPasswordNewHASH WHERE `username` = $quotedUsername AND `enabled` = 1;");
        }
        else
        {
            $success = false;
        }
        
        return $success;
    }

    private function changePasswordForce(string $username, string $passwordNew)
    {
        //Warning. Access check needs to be done outside of this function!
        $success = false;
        
        $quotedUsername = $this->container->db()->quote($username);
        $quotedPasswordNewHASH = $this->container->db()->quote(password_hash($passwordNew, PASSWORD_DEFAULT));
        $success = $this->container->db()->constructQuerry("UPDATE `users` SET `password`=$quotedPasswordNewHASH WHERE `username` = $quotedUsername;");
        
        return $success;
    }

    public function createAccount(string $username, string $password)
    {
        if (!$this->checkUserExists($username))
        {
            $quotedUsername = $this->container->db()->quote($username);
            $quotedPasswordHASH = $this->container->db()->quote(password_hash($password, PASSWORD_DEFAULT));
            $success = $this->container->db()->constructQuerry("INSERT INTO `users` (`username`, `password`) VALUES ($quotedUsername, $quotedPasswordHASH)");
        }
        else
        {
            $success = false;
            error_log("Can not create user. User exists!");
        }
        
        return $success;
    }

    public function deleteAccount(string $username)
    {
        if ($this->checkUserExists($username))
        {
            $quotedUsername = $this->container->db()->quote($username);
            $success = $this->container->db()->constructQuerry("DELETE FROM `users` WHERE `username` = $quotedUsername");
        }
        else
        {
            $success = false;
        }
        
        return $success;
    }

    private function getUserData(string $username)
    {
        $quotedUsername = $this->container->db()->quote($username);
        return $this->container->db()->constructResultQuerry("SELECT `id`, `superAdmin`, `enabled` FROM `users` WHERE username = $quotedUsername;");
    }

    public function getAllUsers()
    {
        //Warning. Access check needs to be done outside of this function!
        return $this->container->db()->constructResultQuerry("SELECT `id`, `username`, `superAdmin`, `enabled` FROM `users` WHERE 1;");
    }

    private function checkUserExists(string $username)
    {
        $quotedUsername = $this->container->db()->quote($username);
        if (count($this->container->db()->constructResultQuerry("SELECT `id`, `enabled` FROM `users` WHERE username = $quotedUsername;")) != 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function toggleUserEnabled(string $username)
    {
        //Warning. Access check needs to be done outside of this function!
        $quotedUsername = $this->container->db()->quote($username);
        $result = $this->getUserData($username);

        if ($result[0]['enabled'] == 0)
        {
            $success = $this->container->db()->constructQuerry("UPDATE `users` SET `enabled` = 1 WHERE `username` = $quotedUsername;");
        }
        else
        {
            $success = $this->container->db()->constructQuerry("UPDATE `users` SET `enabled` = 0 WHERE `username` = $quotedUsername;");
        }
        return $success;
    }

    public function updateUsers(array $data)
    {
        //Warning. Access check needs to be done outside of this function!
        

        $success = false;
        for ($i=0; $i < count($data); $i++) { 
            $element = $data[$i];
            
            if ($element->password != "")
            {
                $this->changePasswordForce($element->username, $element->password);
            }
            
            $quotedUsername = $this->container->db()->quote($element->username);
            $quotedSuperAdmin = $this->container->db()->quote($element->superAdmin);
            $quotedEnabled = $this->container->db()->quote($element->enabled);
            $success = $this->container->db()->constructQuerry("UPDATE `users` SET `enabled` = $quotedEnabled, `superAdmin` = $quotedSuperAdmin WHERE `username` = $quotedUsername;");
            if (!$success)
            {
                return false;
            }
        }
        return $success;
    }

    public function login(string $username, string $password)
    {
        if ($this->checkLogin($username, $password))
        {
            $result = $this->getUserData($username);

            if (session_status() != PHP_SESSION_ACTIVE) {
                session_start();
            }
            $_SESSION['id'] = $result[0]['id'];
            $_SESSION['username'] = $username;
            $_SESSION['superAdmin'] = $result[0]['superAdmin'];
            error_log("UserLogin Successfull: ".$username);
            return true;
        }
        else
        {
            return false;
            error_log("UserLogin Failed: ".$username);
        }
    }

    public function logout()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        session_destroy();

        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        header("Location: http://$host$uri/", true);
    }
    #endregion

}
?>