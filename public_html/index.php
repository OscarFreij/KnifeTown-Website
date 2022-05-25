<!DOCTYPE html>
<html lang="en">
<?php
include_once "../private_html/modules/head.php";
?>
<body class="d-flex flex-column min-vh-100">
    <?php
    include_once "../private_html/modules/banner.php";
    include_once "../private_html/modules/navbar.php";
    
    if (!isset($_GET['page']))
    {
        if (file_exists("../private_html/pages/".$_GET['page'].".php"))
        {
            require_once "../private_html/pages/".$_GET['page'].".php";
        }
        else
        {
            require_once "../private_html/pages/error/404.php";
        }
    }
    else
    {
        require_once "../private_html/pages/home.php";
    }
    
    include_once "../private_html/modules/footer.php";
    require_once "../private_html/modules/postload.php";
    ?>
</body>
</html>