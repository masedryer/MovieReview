<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "c203_moviereviewdb";

$link = mysqli_connect($host, $user, $pass, $db);

//session_start();

//$userID = $_SESSION['user_id'];
//$reviewID = $_SESSION['review_id'];

$reviewID = $_POST['reviewID'];

$queryDelete = "DELETE FROM reviews WHERE reviewId=$reviewID";
$status = mysqli_query($link,$queryDelete) or die(mysqli_error($link));

if($status){
    $message = "Item has been deleted.";
}else{
    $message = "item delete failed.";
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
<h1><?php echo $message?></h1>
</body>

