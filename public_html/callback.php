<?php

    require_once "../private_html/container.php";
    $container = new container();

    $container->functions()->prepMail(array("email"=>"otg020313@gmail.com", "phone"=>"0709556425", "msg"=>"Hej detta är ett testmeddelande!"));
?>