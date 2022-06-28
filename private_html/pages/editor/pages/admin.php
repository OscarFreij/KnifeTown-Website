<?php
if (!isset($_SESSION['username']) && !isset($_SESSION['superAdmin'])) {
    http_response_code(401);
}
else
{
    
}
?>