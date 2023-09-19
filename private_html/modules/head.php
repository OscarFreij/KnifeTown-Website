<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <meta http-equiv="Content-Language" content="sv" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
    if (isset($_GET['page']))
    {
        switch ($_GET['page']) {
            case 'home':
                $titleExt = "";
                break;
            case 'menu':
                $titleExt = " - Meny";
                break;
            case 'about':
                $titleExt = " - Om oss";
                break;
            case 'findus':
                $titleExt = " - Hitta oss";
                break;
            case 'contact':
                $titleExt = " - Kontakt";
                break;
        }
    }
    ?>
    <title>Knifetown Burgers<?=$titleExt?></title>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-WRVQ8PTZ');</script>
    <!-- End Google Tag Manager -->

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="static/css/master.css">

    <?php
    if (isset($_GET['page']))
    {
        if (file_exists("static/css/".$_GET['page'].".css"))
        {
            ?>
        <link rel="stylesheet" href="static/css/<?=$_GET['page']?>.css">
        <?php
        }

        if ($_GET['page'] == "edit")
        {
            if(isset($_GET['editorPage']))
            {
                if (file_exists("static/css/edit".$_GET['editorPage'].".css"))
                {
                    ?>
                <link rel="stylesheet" href="static/css/edit<?=$_GET['editorPage']?>.css">
                <meta name="robots" content="noindex">
                <?php
                }
            }
        }
        
    }
    
    ?>

</head>