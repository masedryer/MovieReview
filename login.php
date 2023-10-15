<?php
session_start();
$host = "localhost";
$user = "root";
$pass = "";
$db = "c203_moviereviewdb";

$link = mysqli_connect($host, $user, $pass, $db);



// Check if the form is submitted
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username' AND password = SHA1('$password')";
    $result = mysqli_query($link, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);


        $_SESSION['login_success'] = true;

        // Store user information in the session
        $_SESSION['username'] = $user['username'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['dob'] = $user['dob'];
        $_SESSION['email'] = $user['email'];
         $_SESSION['user_id'] = $user['userId'];




        header("Location: homePage.php");
        exit();
    } else {
        $error = "Invalid username or password";
        header("Location: homepage.php#loginModal?error=" . urlencode($error)."#errorLoginModal");
        exit();
    }
}

?>
