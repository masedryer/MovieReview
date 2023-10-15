



<!--<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width-device-width, initial scale=1.0">
  <title>Title</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <link rel="stylesheet" href="navbar.css">
</head>
-->
<?php




session_start();

$loginSuccess = isset($_SESSION['login_success']) && $_SESSION['login_success'];



if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: homePage.php');
    exit;
}
$showLoginModal = false;

if (isset($_GET['error'])) {
    $showLoginModal = true;
}
?>



?>





<nav class="navbar navbar-expand-sm background border-warning">
    <div class="container-fluid">
        <a class="navbar-brand" href="homePage.php">CybroSphere</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <i class="fas fa-bars custom-icon"></i>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav me-auto">
                <li class="nav-item px-2">
                    <a class="nav-link" href="movieList.php">Movie</a>
                </li>
            </ul>
            <form class="d-flex ms-auto" action="movieList.php" method="GET">
                <input class="form-control me-2" type="search" placeholder="Search Movies" aria-label="Search" name="search_text">
                <button class="btn btn-light" type="submit">Search</button>
            </form>
            <?php if (isset($_SESSION['username'])) : ?>

                <a class="link-opacity-100 custom-color" id="welcomeButton" type="button" data-bs-toggle="modal" data-bs-target="#welcomeModal">Welcome, <?php echo $_SESSION['username']; ?></a>
                <a class="btn btn-light custom-logout" href="Navbar.php?logout=true">Logout</a>
            <?php else : ?>
                <a class="btn btn-light custom-login" id="loginButton" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
            <?php endif; ?>

            <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="loginModalLabel">Login</h5>
                            <button type="button" class="btn-close btn-close-white custom-icon" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="login.php">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>

                                <button type="submit" class="btn btn-light custom-login">Login</button>
                                <hr>
                                <a class="have_not" href="userSignUp.php">Haven't Login? Register</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (isset($_SESSION['username'])) { ?>
            <div class="modal fade" id="welcomeModal" tabindex="-1" aria-labelledby="welcomeModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h1 class="modal-title" id="welcomeModalLabel">Welcome, <?php echo $_SESSION['username']; ?></h1>
                            <button type="button" class="btn-close btn-close-white custom-icon" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <p>Username: <?php echo $_SESSION['username']; ?></p>
                                <p>Name: <?php echo $_SESSION['name']; ?></p>
                                <p>Date of Birth: <?php echo $_SESSION['dob']; ?></p>
                                <p>Email: <?php echo $_SESSION['email']; ?></p>
                                <a href="editProfile.php"> Edit profile</a>
                            </div>
                        </div>
                        <?php }else{
                            ?>


                            <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true"<?php if ($showLoginModal) echo ' style="display: block"'; ?>>
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="errorModalLabel">Login</h5>
                                            <button type="button" class="btn-close btn-close-white custom-icon" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <form method="post" action="login.php">
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Username</label>
                                                    <input type="text" class="form-control" id="username" name="username" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input type="password" class="form-control" id="password" name="password" required>
                                                </div>
                                                <div class="error">
                                                    <p class="errorText">Your username or password is wrong</p>
                                                </div>

                                                <button type="submit" class="btn btn-light custom-login">Login</button>
                                                <hr>
                                                <a class="have_not" href="userSignUp.php">Haven't Login? Register</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>
                    </div>
                </div>
            </div>


        </div>
    </div>
</nav>

