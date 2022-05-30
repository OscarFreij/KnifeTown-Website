<nav class="navbar navbar-expand-xl sticky-top navbar-dark bg-dark">
<div class="container-fluid">
    <a class="navbar-brand w-50" href="/">Knifetown Burgers & Arepas</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse w-100" id="navbarText">
      <ul class="navbar-nav w-100 justify-content-evenly me-auto mb-2 mb-xl-0">
        <li class="nav-item">
          <a class="nav-link" href="?page=home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?page=menu">Menu</a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="?page=about">About&nbsp;Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?page=findus">Find&nbsp;Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?page=contact">Contact</a>
        </li>
      </ul>
      <ul class="navbar-nav w-100 justify-content-end">
	  	<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="currentOpeningHours" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php
              $container->functions()->getCurrentOpeningState();
            ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark" aria-labelledby="currentOpeningHours">
            <?php
              $container->functions()->getOpeningStates();
            ?>
          </ul>
        </li>
	    </ul>
    </div>
  </div>
</nav>