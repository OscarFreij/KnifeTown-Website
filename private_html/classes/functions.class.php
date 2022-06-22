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
                $this->createMenu($menu);
            }
        }
    }

    public function getMenuCategoryRelationRecords(int $id, int $enabled = 1)
    {
        return $this->container->db()->constructResultQuerry('SELECT * FROM `menuCategoryRelations` WHERE `enabled` = '.$enabled.' AND `menuId` = '.$id.' ORDER BY  `loadOrder` ASC;');
    }

    public function getMenuCategoryItemRelationRecords(int $id, int $enabled = 1)
    {
        return $this->container->db()->constructResultQuerry('SELECT * FROM `menuCategoryItemRelations` WHERE `enabled` = '.$enabled.' AND `categoryRelationRecordId` = '.$id.' ORDER BY  `loadOrder` ASC;');
    }

    public function getCategory(int $id)
    {
        return $this->container->db()->constructResultQuerry('SELECT * FROM `menuCategory` WHERE `id` = '.$id.';');
    }

    public function getMenuItem(int $id)
    {
        return $this->container->db()->constructResultQuerry('SELECT * FROM `menuItems` WHERE `id` = '.$id.';');
    }

    public function createMenu(array $menu)
    {
        require "../private_html/templates/menu.php";
    }

    public function createCategory(array $category, int $crrId, int $menuId)
    {
        require "../private_html/templates/menuCategory.php";
    }

    public function createCategoryItem(array $item)
    {
        require "../private_html/templates/menuCategoryItem.php";
    }

    public function createCategoryAccordion(array $category, int $crrId, int $menuId)
    {
        $this->createCategory($category, $crrId, $menuId);
    }
    #endregion
    
    #region Opening Hours / State
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
                echo("Öppen mellan: ".$data['openTime']." -> ".$data['closeTime']);
            }
            else if ($isPre)
            {
                echo("Öppnar vid: ".$data['openTime']);
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

        if (isset($data2))
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

        if (isset($data))
        {
            for ($j=0; $j < count($data); $j++) { 
                $row = $data[$j];

                $dayDiff = $row['day'] - date('N');
                $timeSpanString = "Stängt";

                if (isset($row['openTime']) && isset($row['closeTime']))
                {
                    $timeSpanString = $row['openTime']." -> ".$row['closeTime'];
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

        if (isset($data))
        {
        
            ?>
            <li><hr class="dropdown-divider"></li>
            <?php            

            for ($j=0; $j < count($data); $j++) { 
                $row = $data[$j];

                $timeSpanString = "Stängt";

                if (isset($row['openTime']) && isset($row['closeTime']))
                {
                    $timeSpanString = $row['openTime']." -> ".$row['closeTime'];
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
    #endregion

    #region Contact Form & Mail

    public function sendFormEmail(Array $data)
    {
        $credArray = $this->container->credentials()->getMailCredentials();
        $to = $data['email'];
        $reciver = $credArray['oauthUserEmail'];
        $phone = $data['phone'];
        #$msg = $data['msg'];

        $subject = "Meddelande från ".substr($credArray['oauthUserEmail'], 0, strpos($credArray['oauthUserEmail'], '.') ).".knifetownburgers.se :-)";

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
}
?>