<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <meta http-equiv="Content-Language" content="sv" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Knifetown Burgers</title>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-BPBXRY2LJ6"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag(
            'config',
            'G-BPBXRY2LJ6',
            {
                'page_location' : location.href
            });
    </script>

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
                <?php
                }
            }
        }
        
    }
    
    ?>

</head>