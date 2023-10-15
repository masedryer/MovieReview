<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "c203_moviereviewdb";

$link = mysqli_connect($host, $user, $pass, $db);

$movieID = $_GET['movie_id'];
$reviewID = $_POST['reviewID'];

$queryReview = "SELECT reviews.*, users.username
    FROM reviews
    INNER JOIN users ON reviews.userID = users.userID
    WHERE reviews.reviewId = $reviewID";


$result2 = mysqli_query($link, $queryReview);

$link = mysqli_connect($host, $user, $pass, $db);
if (mysqli_num_rows($result2) > 0) {
    $row = mysqli_fetch_assoc($result2);
    $review = $row['review'];
    $name = $row['username'];
    $rating = $row['rating'];
    $date = $row['datePosted'];
    $reviewID = $row['reviewId'];
}


    if (isset($_SESSION['username']) && isset($_POST['reviewID'])) {
        // Get the reviewID from the form
        $reviewID = $_POST['reviewID'];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Confirmation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="stylesheet/navbar.css">
</head>
<body class="backgroundMain">
<div>
    <?php include 'Navbar.php'; ?>
</div>
<h1>Confirm Deletion</h1>
<p>Are you sure you want to delete this review?</p>
<p><?php echo $row['review']; ?></p>
<p><?php echo $row['rating']; ?></p>
<p><?php echo $row['datePosted']; ?></p>
<form method="post" action="doDelete.php">
    <input type="hidden" name="reviewID" value="<?php echo $reviewID; ?>"/>
    <button type="submit" class="btn btn-danger">Yes, Delete</button>
    <a href="Reviews.php?movie_id={movieID}" class="btn btn-secondary">Cancel</a>
</form>
</body>
</html>
