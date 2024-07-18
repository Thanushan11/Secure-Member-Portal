<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="logout.php">Secure Member Portal</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <?php
        // Determine current page
        $current_page = basename($_SERVER['PHP_SELF']);
        
        if ($current_page == 'index.php') {
          // Show Login and SignUp buttons
          ?>
          <a class="btn btn-outline-success mx-2" type="button" href="login.php">LogIn</a>
          <a class="btn btn-outline-primary mx-2" type="button" href="signup.php">SignUp</a>
          <?php
        } elseif ($current_page == 'login.php') {
          // Show SignUp and Logout buttons
          ?>
          <a class="btn btn-outline-primary mx-2" type="button" href="signup.php">SignUp</a>
          <?php
        } elseif ($current_page == 'signup.php') {
          // Show Login and Logout buttons
          ?>
          <a class="btn btn-outline-success mx-2" type="button" href="login.php">LogIn</a>
          <?php
        }
        elseif($current_page == 'protected-home.php' || $current_page == 'account.php' ||$current_page == 'profile.php' ||$current_page == 'holiday.php') {
          // Show SignUp and Logout buttons
          ?>
          <a class="btn btn-outline-primary mx-2" type="button" href="logout.php">Logout</a>
          <?php
        }
        ?>
        

      </form>
    </div>
  </div>
</nav>
