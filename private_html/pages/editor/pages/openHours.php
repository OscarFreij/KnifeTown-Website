<?php
if (!isset($_SESSION['username'])) {
    http_response_code(401);
}
else
{
    ?>

    <div class="container">
        <div class="row my-3">
            <span class="fs-1 text-center text">
                Öppettider
            </span>
        </div>
        <div class="row my-3">
            <span class="fs-3 text-center text">
                Redigera öppettider (Standard)
            </span>
            <span class="text-center text">
                Nedan rader är normala öppettider (Måndag - Söndag)
            </span>
            <table>
                GO BRRRRRRRRRR
            </table>
        </div>
        <div class="row my-3">
            <span class="fs-3 text-center text">
                Redigera öppettider (Speciella)
            </span>
            <span class="text-center text">
                Nedan rader är speciella öppettider (Högtider och liknande)
            </span>
            <table>
                GO BRRRRRRRRRR
            </table>
        </div>
    </div>

    <?php
}
?>