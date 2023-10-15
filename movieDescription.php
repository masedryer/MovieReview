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

<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "c203_moviereviewdb";

$link = mysqli_connect($host, $user, $pass, $db);

//session_start();

//$userID = $_SESSION['user_id'];
//$reviewID = $_SESSION['review_id'];

$movieID = $_GET['movie_id'];

$queryMovie = "SELECT * FROM movies WHERE movieId = $movieID";

$queryReview = "SELECT reviews.*, users.username
          FROM reviews
          INNER JOIN users ON reviews.userID = users.userID
          WHERE reviews.movieID = $movieID";

/*$userID = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$reviewID = isset($_SESSION['review_id']) ? $_SESSION['review_id'] : null;

if ($movieID && $reviewID && $userID) {
    $queryReviews = "SELECT reviews.*,users.username,movies.movieTitle FROM reviews
                    INNER JOIN users ON reviews.userID = users.userID 
                    INNER JOIN movies ON reviews.movieId = movies.movieId 
                    WHERE reviews.reviewId= $reviewID  AND reviews.movieId = $movieID AND reviews.userId = $userID"; */


    $result = mysqli_query($link, $queryMovie);
   $result2 = mysqli_query($link, $queryReview);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $movieTitle = $row['movieTitle'];
        $movieDescription = $row['synopsis'];
        $movieGenre = $row['movieGenre'];
        $time = $row['runningTime'];
        $language = $row['language'];
        $director = $row["director"];
        $cast = $row["cast"];
        $pictures = $row['picture'];
    }


   if (mysqli_num_rows($result2) > 0) {
        $row = mysqli_fetch_assoc($result2);
        $review = $row['review'];
        $name = $row['username'];
        $rating = $row['rating'];
        $date = $row['datePosted'];


    }
   else{
       $empty = "There is no reviews as of yet.";
   }

    ?>

<div class="container">
    <div class="card mb-4">
        <div class="card h-100">
            <div class="descTitle">

                <h1><?php echo $movieTitle; ?></h1>
                <p><?php echo $movieGenre; ?>. <?php echo $time; ?></p>
                <img class="card-img-top imageResize" src="images/<?php echo $pictures; ?>" alt="Card image">
            </div>
            <div class="desc">
                <p><?php echo $movieDescription; ?></p>
                <hr>
                <p>Director: <?php echo $director; ?></p>
                <hr>
                <p>Cast: <?php echo $cast; ?></p>
                <hr>
                <p>Language: <?php echo $language; ?></p>
            </div>
        </div>

        <div class="review">
            <h1>Reviews</h1>
            <div class ="rev_section">
            <?php if (mysqli_num_rows($result2) > 0): ?>
                <?php
                mysqli_data_seek($result2, 0);
                /*while */($row = mysqli_fetch_assoc($result2))/*:*/ ?>
                    <?php
                    $review = $row['review'];
                    $name = $row['username'];
                    $rating = $row['rating'];
                    $date = $row['datePosted'];
                    ?>

                <div class="review-header">
                <p class="username"> <?php echo $name; ?>
                <p class="rating">Rating: <?php echo $rating; ?>/5</p>
            </div>
                    <p><?php echo $review; ?></p>
                <a class="see-more" href="reviews.php?movie_id=<?php echo $movieID ?>">See more reviews</a>




            <?php else: ?>
                <p>There are no reviews</p>
                <a class="see-more" href="reviews.php?movie_id=<?php echo $movieID ?>">See more reviews</a>
            <?php endif; ?>
        </div>
        </div>
    </div>
</div>









