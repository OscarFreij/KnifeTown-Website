<?php

    require_once "../private_html/container.php";
    $container = new container();


    if (isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['message']) && isset($_POST['type']))

    $container->functions()->sendFormEmail(array("email"=>$_POST['email'], "phone"=>$_POST['phone'], "msg"=>$_POST['message'], "type"=>$_POST['type']));
?>