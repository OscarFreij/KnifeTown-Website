<?php
if (isset($_GET['editorPage']))
{
    switch ($_GET['editorPage'])
    {
        case 'login':
            require "../private_html/pages/editor/pages/login.php";
            break;
        case 'logout':
            $container->functions()->logout();
            break;
        case 'menu':
            require_once "../private_html/pages/editor/modules/navbar.php";
            require "../private_html/pages/editor/pages/menu.php";
            break;
        case 'general':
            require_once "../private_html/pages/editor/modules/navbar.php";
            require "../private_html/pages/editor/pages/general.php";
            break;
        case 'admin':
            require_once "../private_html/pages/editor/modules/navbar.php";
            require "../private_html/pages/editor/pages/admin.php";
            break;
        default:
            http_response_code(404);
            break;
    }
}
else
{
    require "../private_html/pages/editor/pages/login.php";
}

if (http_response_code() != 200)
{
    switch (http_response_code()) {
        case 400:
            require "../private_html/pages/error/400.php";
            break;

        case 401:
            require "../private_html/pages/error/401.php";
            break;

        case 404:
            require "../private_html/pages/error/404.php";
            break;

        case 500:
            require "../private_html/pages/error/500.php";
            break;
        
        default:
            error_log("index recived http response code: ".http_response_code());
            break;
    }
    
}

?>