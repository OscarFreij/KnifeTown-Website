<?php
if (!isset($_SESSION['username'])) {
    http_response_code(401);
}
else
{
    ?>

    <div class="container">
        <div class="row my-3 col-12">
            <span class="fs-1 text-center text">
                Generel Information
            </span>
        </div>
        <div class="row my-3 col-12">
            <span class="fs-3 text-center text">
                Om oss text
            </span>
            <span class="text-center text">
                Nedan fällt inehåller vad som ska visas på sidan "Om Oss".
            </span>
            <textarea class="form-control my-1" name="content" id="content" cols="30" rows="15">
                <?php
                $container->functions()->getCustomPageContent('contentAbout');
                ?>
            </textarea>
        </div>
        <div class="row my-3 col-12">
            <div class="col-12">
                <button type="button" onClick="sendQuerry('contentAbout');" class="btn btn-success mb-3 col-12">
                    Spara ändringar
                </button>
            </div>
        </div>
    </div>

    <?php
}
?>