<?php
if (!isset($_SESSION['username'])) {
    http_response_code(401);
}
else
{
    var_dump($_SESSION);
}
?>