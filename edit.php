<?php
//session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db = "c203_moviereviewdb";

$link = mysqli_connect($host, $user, $pass, $db);



$reviewID = $_POST['reviewID'];

$queryReview = "SELECT  reviews.*, movies.movieTitle, users.username 
                FROM reviews
                INNER JOIN users ON reviews.userID = users.userId
                 INNER JOIN movies ON reviews.movieID = movies.movieId
                 WHERE reviewId=$reviewID";

$result = mysqli_query($link,$queryReview);

$rowReview = mysqli_fetch_array($result);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $movieTitle = $row['movieTitle'];
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
<h1><?php echo $rowReview['movieTitle'] ?> , <?php echo $rowReview['username'] ?> </h1>
<form method="post" action="doEdit.php">

    <input type="hidden" name="reviewId" value="<?php echo $rowReview['reviewId'] ?>">

    <label>Editable Review:</label>
    <textarea rows="5" cols="30"
              name="review"><?php echo $rowReview['review'] ?>
            </textarea>

    <label>Editable Rating:</label>
    <input type="number" name="rating" min="1" max="5" value="<?php echo $rowReview['rating'] ?>"/>
    <br/><br/>

    <input type="hidden" name="datePosted" value="<?php echo date('Y-m-d'); ?>">


    <input type="hidden" name="id" value="<?php echo $rowReview['reviewId'] ?>"/>
    <input type="submit" value="Update Item"/>
</form>



