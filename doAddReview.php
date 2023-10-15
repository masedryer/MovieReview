<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db = "c203_moviereviewdb";

$link = mysqli_connect($host, $user, $pass, $db);

if (!isset($_SESSION['username'])) {
    header("location: homePage.php");
    exit;
}

$user = $_SESSION['user_id'];

if (!empty($_POST['review']) && !empty($_POST['rating'])) {
    $movieReview = $_POST['review'];
    $movieRating = $_POST['rating'];
    $movieID = $_POST['movieID'];
    $reviewDate = $_POST['datePosted'];

    $sql = "INSERT INTO reviews (userId, review, rating, movieId, datePosted) 
            VALUES ('$user', '$movieReview', $movieRating, '$movieID', '$reviewDate')";

    $status = mysqli_query($link, $sql);

    if ($status) {
        $message = "Review posted successfully.";
    } else {
        $message = "Review post failed.";
    }
} else {
    $message = "All Review details have to be provided.";
}

mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="stylesheet/navbar.css">
</head>
<body class="backgroundMain">
<div>
    <?php include 'Navbar.php'; ?>
</div>
<h1><?php echo $message; ?></h1>
</body>
</html>
