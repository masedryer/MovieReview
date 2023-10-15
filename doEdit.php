<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db = "c203_moviereviewdb";

$link = mysqli_connect($host, $user, $pass, $db);

$id = $_POST['reviewId'];
$review = $_POST['review'];
$rating = $_POST['rating'];
$datePosted = $_POST['datePosted'];

$msg = "";

$queryUpdate = "UPDATE reviews
                SET review='$review', 
                    rating='$rating',
                    datePosted = '$datePosted'
                 WHERE reviewId = '$id'";

$resultUpdate = mysqli_query($link, $queryUpdate)
or die(mysqli_error($link));


if ($resultUpdate) {
    $msg = "record successfully updated";
} else {
    $msg = "record not updated";
}
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
<h1><?php echo $msg?></h1>
</body>
