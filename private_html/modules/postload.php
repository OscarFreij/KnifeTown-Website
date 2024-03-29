<div class="postload">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="static/js/navbar.js"></script>
    <script src="static/js/main.js"></script>
    <?php
    if (isset($_GET['page']))
    {
        if (file_exists("static/js/".$_GET['page'].".js"))
        {
            ?>
        <script src="static/js/<?=$_GET['page']?>.js"></script>
        <?php
        }

        if ($_GET['page'] == "edit")
        {
            if(isset($_GET['editorPage']))
            {
                if (file_exists("static/js/edit".$_GET['editorPage'].".js"))
                {
                    ?>
                <script src="static/js/edit<?=$_GET['editorPage']?>.js"></script>
                <?php
                }
            }
        }
        
    }
    
    ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WRVQ8PTZ"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
</div>