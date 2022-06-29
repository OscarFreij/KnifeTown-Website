<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
require_once "../private_html/container.php";
if (!isset($container))
{
    $container = new container();
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
                    $success = $container->functions()->setOpeningStatesStandard(json_decode(($_POST['data'])));
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
                    $success = $container->functions()->setOpeningStatesSpecial(json_decode(($_POST['data'])));
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
                    $success = $container->functions()->createOpeningStatesSpecial(json_decode(($_POST['data'])));
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