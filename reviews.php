<?php
//session_start();
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
    $reviewID = $row['reviewId'];


}
else{
    $empty = "There is no reviews as of yet.";
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
<div class="reviewCon">
<h1 class="reviewTitle"><?php echo $movieTitle; ?></h1>
<hr class="hrReview" >
<table class="table table-dark table-striped">
    <thead>
    <tr>
        <th>Review</th>
        <th>Rating</th>
        <th>Date Posted</th>
        <th>Username</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>    </thead>
    <tbody>
    <?php
    mysqli_data_seek($result2, 0);
    while ($row = mysqli_fetch_assoc($result2)):
        ?>
        <tr>
            <td><?php echo $row['review']; ?></td>
            <td><?php echo $row['rating']; ?></td>
            <td><?php echo $row['datePosted']; ?></td>
            <td><?php echo $row['username']; ?></td>

            <?php
            if (isset($_SESSION['username'])) {
                if ($_SESSION['username'] == $row['username']) {
                    ?>

                    <td>
                        <form method="post" action="edit.php">
                            <input type="hidden" name="reviewID" value="<?php echo $row['reviewId']; ?>"/>
                            <button type="submit" class="btn btn-light">Edit</button>
                        </form>
                    </td>

                    <td>
                        <form method="post" action="deleteConfirmation.php">
                            <input type="hidden" name="reviewID" id="reviewID" value="<?php echo $row['reviewId']; ?>"/>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>

                    <?php
                } else {
                    echo "<td></td>";
                    echo "<td></td>";
                }
            } else {
                echo "<td></td>";
                echo "<td></td>";
            }
            ?>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>


<div class="addReview">
<?php
if (!isset($_SESSION['username'])) {
    echo "<p>Please login to add reviews</p>";
}else{?>
    <a class="see-more" href="addReview.php?movie_id=<?php echo $movieID ?>&movie_title=<?php echo urlencode($movieTitle) ?>">Click here to add Review</a>
<?php }
?>
</div>
</div>

</body>
</html>