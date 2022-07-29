<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
require_once "../private_html/container.php";
if (!isset($container))
{
    $container = new container();
}

if (isset($_POST['data']))
{
    $_POST['data'] = preg_replace('/[\x00-\x1F]/','', $_POST['data']);
}

if (isset($_POST['cba'])) //cba stands for CallBack Action
{
    switch ($_POST['cba']) {
        case 'login':
            if (isset($_POST['username']) && isset($_POST['password']))
            {
                $success = $container->functions()->login($_POST['username'], $_POST['password']);
                if ($success)
                {
                    http_response_code(202);
                }
                else
                {
                    http_response_code(401);
                }
            }
            break;
        case 'create_user':
            if (isset($_POST['data']))
            {
                if (isset($_SESSION['superAdmin']) && $_SESSION['superAdmin'] == 1)
                {
                    $username = json_decode($_POST['data'])[0]->username;
                    $password = json_decode($_POST['data'])[0]->password;
                    $success = $container->functions()->createAccount($username, $password);
                    if ($success)
                    {
                        http_response_code(201);
                    }
                    else
                    {
                        http_response_code(409);
                    }
                }
                else
                {
                    http_response_code(401);
                }
                
            }
            else
            {
                http_response_code(400);
            }
            break;

        case 'change_password_force':
            if (isset($_POST['username']) && isset($_POST['password']))
            {
                if (isset($_SESSION['superAdmin']) && $_SESSION['superAdmin'] == 1)
                {
                    $success = $container->functions()->createAccount($_POST['username'], $_POST['password']);
                    if ($success)
                    {
                        http_response_code(201);
                    }
                    else
                    {
                        http_response_code(409);
                    }
                }
                else
                {
                    http_response_code(401);
                }
                
            }
            else
            {
                http_response_code(400);
            }
            break;

        case 'delete_user':
            if (isset($_POST['data']))
            {
                if (isset($_SESSION['superAdmin']) && $_SESSION['superAdmin'] == 1)
                {
                    $username = json_decode($_POST['data'])[0]->username;
                    $success = $container->functions()->deleteAccount($username);
                    if ($success)
                    {
                        http_response_code(201);
                    }
                    else
                    {
                        http_response_code(409);
                    }
                }
                else
                {
                    http_response_code(401);
                }
                
            }
            else
            {
                http_response_code(400);
            }
            break;
        case 'update_users':
            if (isset($_POST['data']))
            {
                if (isset($_SESSION['superAdmin']) && $_SESSION['superAdmin'] == 1)
                {
                    $success = $container->functions()->updateUsers(json_decode($_POST['data']));
                    if ($success)
                    {
                        http_response_code(201);
                    }
                    else
                    {
                        http_response_code(409);
                    }
                }
                else
                {
                    http_response_code(401);
                }
                
            }
            else
            {
                http_response_code(400);
            }
            break;
        
        case 'set_content':
            if (isset($_SESSION['username']))
            {
                if (isset($_POST['itemName']) && isset($_POST['pageContent']))
                {
                    $success = $container->functions()->setCustomPageContent($_POST['itemName'], $_POST['pageContent']);
                    if ($success)
                    {
                        http_response_code(202);
                    }
                    else
                    {
                        http_response_code(409);
                    }
                }
                else
                {
                    http_response_code(400);
                }
                
            }
            else
            {
                http_response_code(401);
            }
            break;

        case 'set_openingHours_standard':
            if (isset($_SESSION['username']))
            {
                if (isset($_POST['data']))
                {
                    $success = $container->functions()->setOpeningStatesStandard(json_decode($_POST['data']));
                    if ($success)
                    {
                        http_response_code(202);
                    }
                    else
                    {
                        http_response_code(409);
                    }
                }
                else
                {
                    http_response_code(400);
                }
                
            }
            else
            {
                http_response_code(401);
            }
            break;

        case 'set_openingHours_special':
            if (isset($_SESSION['username']))
            {
                if (isset($_POST['data']))
                {
                    $success = $container->functions()->setOpeningStatesSpecial(json_decode($_POST['data']));
                    if ($success)
                    {
                        http_response_code(202);
                    }
                    else
                    {
                        http_response_code(409);
                    }
                }
                else
                {
                    http_response_code(400);
                }
                
            }
            else
            {
                http_response_code(401);
            }
            break;

        case 'create_openingHours_special':
            if (isset($_SESSION['username']))
            {
                if (isset($_POST['data']))
                {
                    $success = $container->functions()->createOpeningStatesSpecial(json_decode($_POST['data']));
                    if ($success)
                    {
                        http_response_code(202);
                    }
                    else
                    {
                        http_response_code(409);
                    }
                }
                else
                {
                    http_response_code(400);
                }
                
            }
            else
            {
                http_response_code(401);
            }
            break;

        case 'remove_openingHours_special':
            if (isset($_SESSION['username']))
            {
                error_log("POST DATA: ".$_POST['data']);
                if (isset($_POST['data']))
                {
                    $success = $container->functions()->removeOpeningStatesSpecial($_POST['data']);
                    if ($success)
                    {
                        http_response_code(202);
                    }
                    else
                    {
                        http_response_code(409);
                    }
                }
                else
                {
                    http_response_code(400);
                }
                
            }
            else
            {
                http_response_code(401);
            }
            break;


        case 'create_menu':
            if (isset($_SESSION['username']))
            {
                if (isset($_POST['data']))
                {
                    $success = $container->functions()->createMenu(json_decode($_POST['data']));
                    if ($success)
                    {
                        http_response_code(202);
                    }
                    else
                    {
                        http_response_code(409);
                    }
                }
                else
                {
                    http_response_code(400);
                }
                
            }
            else
            {
                http_response_code(401);
            }
            break;

        case 'set_menus':
            if (isset($_SESSION['username']))
            {
                if (isset($_POST['data']))
                {
                    $success = $container->functions()->setMenus(json_decode($_POST['data']));
                    if ($success)
                    {
                        http_response_code(202);
                    }
                    else
                    {
                        http_response_code(409);
                    }
                }
                else
                {
                    http_response_code(400);
                }
                
            }
            else
            {
                http_response_code(401);
            }
            break;

        case 'remove_menu':
            if (isset($_SESSION['username']))
            {
                error_log("POST DATA: ".$_POST['data']);
                if (isset($_POST['data']))
                {
                    $success = $container->functions()->removeMenu($_POST['data']);
                    if ($success)
                    {
                        http_response_code(202);
                    }
                    else
                    {
                        http_response_code(409);
                    }
                }
                else
                {
                    http_response_code(400);
                }
                
            }
            else
            {
                http_response_code(401);
            }
            break;

        case 'create_category':
            if (isset($_SESSION['username']))
            {
                if (isset($_POST['data']))
                {
                    $success = $container->functions()->createCategory(json_decode($_POST['data']));
                    if ($success)
                    {
                        http_response_code(202);
                    }
                    else
                    {
                        http_response_code(409);
                    }
                }
                else
                {
                    http_response_code(400);
                }
                
            }
            else
            {
                http_response_code(401);
            }
            break;
    
        case 'set_categories':
            if (isset($_SESSION['username']))
            {
                if (isset($_POST['data']))
                {
                    $success = $container->functions()->setCategories(json_decode($_POST['data']));
                    if ($success)
                    {
                        http_response_code(202);
                    }
                    else
                    {
                        http_response_code(409);
                    }
                }
                else
                {
                    http_response_code(400);
                }
                
            }
            else
            {
                http_response_code(401);
            }
            break;
        case 'remove_category':
            if (isset($_SESSION['username']))
            {
                error_log("POST DATA: ".$_POST['data']);
                if (isset($_POST['data']))
                {
                    $success = $container->functions()->removeCategory($_POST['data']);
                    if ($success)
                    {
                        http_response_code(202);
                    }
                    else
                    {
                        http_response_code(409);
                    }
                }
                else
                {
                    http_response_code(400);
                }
                
            }
            else
            {
                http_response_code(401);
            }
            break;
        case 'create_menuItem':
            if (isset($_SESSION['username']))
            {
                if (isset($_POST['data']))
                {
                    $success = $container->functions()->createMenuItem(json_decode($_POST['data']));
                    if ($success)
                    {
                        http_response_code(202);
                    }
                    else
                    {
                        http_response_code(409);
                    }
                }
                else
                {
                    http_response_code(400);
                }
                
            }
            else
            {
                http_response_code(401);
            }
            break;
        
        case 'set_menuItems':
            if (isset($_SESSION['username']))
            {
                if (isset($_POST['data']))
                {
                    error_log($_POST['data']);
                    $success = $container->functions()->setMenuItems(json_decode($_POST['data'],false,512,JSON_THROW_ON_ERROR));
                    if ($success)
                    {
                        http_response_code(202);
                    }
                    else
                    {
                        http_response_code(409);
                    }
                }
                else
                {
                    http_response_code(400);
                }
                
            }
            else
            {
                http_response_code(401);
            }
            break;

        case 'remove_menuItem':
            if (isset($_SESSION['username']))
            {
                error_log("POST DATA: ".$_POST['data']);
                if (isset($_POST['data']))
                {
                    $success = $container->functions()->removeMenuItem($_POST['data']);
                    if ($success)
                    {
                        http_response_code(202);
                    }
                    else
                    {
                        http_response_code(409);
                    }
                }
                else
                {
                    http_response_code(400);
                }
                
            }
            else
            {
                http_response_code(401);
            }
            break;
        case 'set_categoryRelationRecord':
            if (isset($_SESSION['username']))
            {
                error_log("POST DATA: ".$_POST['data']);
                if (isset($_POST['data']))
                {
                    $success = $container->functions()->setMenuCategoryItemRelationRecords(json_decode($_POST['data']));
                    if ($success)
                    {
                        http_response_code(202);
                    }
                    else
                    {
                        http_response_code(409);
                    }
                }
                else
                {
                    http_response_code(400);
                }
                
            }
            else
            {
                http_response_code(401);
            }
            break;

        case 'add_categoryRelationRecord':
            if (isset($_SESSION['username']))
            {
                error_log("POST DATA: ".$_POST['data']);
                if (isset($_POST['data']))
                {
                    $success = $container->functions()->addMenuCategoryRelationRecords(json_decode($_POST['data']));
                    if ($success)
                    {
                        http_response_code(202);
                    }
                    else
                    {
                        http_response_code(409);
                    }
                }
                else
                {
                    http_response_code(400);
                }
                
            }
            else
            {
                http_response_code(401);
            }
            break;

        case 'remove_categoryRelationRecord':
            if (isset($_SESSION['username']))
            {
                error_log("POST DATA: ".$_POST['data']);
                if (isset($_POST['data']))
                {
                    $success = $container->functions()->removeMenuCategoryRelationRecords($_POST['data']);
                    if ($success)
                    {
                        http_response_code(202);
                    }
                    else
                    {
                        http_response_code(409);
                    }
                }
                else
                {
                    http_response_code(400);
                }
                
            }
            else
            {
                http_response_code(401);
            }
            break;
            
        case 'add_categoryItemRelationRecord':
            if (isset($_SESSION['username']))
            {
                error_log("POST DATA: ".$_POST['data']);
                if (isset($_POST['data']))
                {
                    $success = $container->functions()->addMenuCategoryItemRelationRecords(json_decode($_POST['data']));
                    if ($success)
                    {
                        http_response_code(202);
                    }
                    else
                    {
                        http_response_code(409);
                    }
                }
                else
                {
                    http_response_code(400);
                }
                
            }
            else
            {
                http_response_code(401);
            }
            break;
        default:
            http_response_code(400);
            error_log('Unrecognized function to editorCallback');
            break;
    }
}
else
{
    http_response_code(400);
}