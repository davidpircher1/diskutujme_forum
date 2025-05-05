<header>
  <div class="navigation py-3">
    <nav class="navbar navbar-expand-lg bg-transparent navbar-dark container">
      <div class="container-fluid p-0">
        <a class="navbar-brand" href="index"><img src="img/logo.svg" height="90" width="auto"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-link" href="index.php">Home</a>
            <a class="nav-link" href="profile.php">Profile</a>
            <?php
              $val = new validation;
              if($val->is_log("username")) {
                //the user is logged in
                echo '<a class="nav-link" href="index.php?logout=true">Log Out</a>';
              } else {
                echo '<a class="nav-link" href="login.php">Log In</a>';
              }
            ?>
          </div>
        </div>
      </div>
    </nav>
  </div>
  <div class="header-presentation">
    <div class="h-100 container">
      <div class="h-100 row justify-content-center align-items-center">
        <form class="col-lg-4 col-md-6 col-8">
          <h1 class="text-white mb-4">Search...</h1>
            <div class="input-group mb-3">
              <div class="input-group-text"><i class="icofont-search-2"></i></div>
              <input type="search" class="form-control me-2" placeholder="What are you looking for?" aria-label="Vyhľadávanie" aria-describedby="basic-addon2" id="search">
              <button class="btn btn-primary" type="button" id="button-addon2">Search</button>
            </div>
          </form>       
      </div>     
    </div>
  </div>
</header>
<div class="container p-0">
<main class="row justify-content-center align-items-center">