<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark navbar-second">
    <div class="container-fluid">
        <a class="navbar-brand w-50" href="/?page=edit"><span class="fs-4 text">Editor</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse w-100" id="navbarNavAltMarkup">
            <ul class="navbar-nav w-100 justify-content-evenly">
                <li class="nav-item text">
                    <a class="nav-link <?php echo ($_GET['editorPage'] == 'general') ? 'active' : ''; ?>" href="?page=edit&editorPage=general">Generell Info</a>
                </li>
                <li class="nav-item text">
                    <a class="nav-link <?php echo ($_GET['editorPage'] == 'menu') ? 'active' : ''; ?>" href="?page=edit&editorPage=menu">Meny</a>
                </li>
                <li class="nav-item text">
                    <a class="nav-link <?php echo ($_GET['editorPage'] == 'openHours') ? 'active' : ''; ?>" href="?page=edit&editorPage=openHours">Öppettider</a>
                </li>
                <?php
                if (isset($_SESSION['superAdmin']) && $_SESSION['superAdmin'] == 1)
                {
                    ?>
                    <li class="nav-item text">
                        <a class="nav-link <?php echo ($_GET['editorPage'] == 'admin') ? 'active' : ''; ?>" href="?page=edit&editorPage=admin">Konton</a>
                    </li>
                    <?php
                }
                ?>

            </ul>
            <ul class="navbar-nav w-100 justify-content-end">
                <span class="navbar-text text">
                    Signed in as <span class="fw-bold"><?=$_SESSION['username']?></span>
                </span>    
                <li class="nav-item text">
                    <a class="nav-link" href="?page=edit&editorPage=logout">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>