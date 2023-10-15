<?php
$movieID = $_GET['movie_id'];

$movieName = urldecode($_GET['movie_title']);

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
<div class="addRev">
    <div class="addEv2">
<h1>Add Review</h1>
<?php if (isset($_SESSION['username'])) { ?>

    <form id="postForm" method="post" action="doAddReview.php">
        <input type="hidden" name="movieID" value="<?php echo $movieID; ?>">

        <label>Movie Title:</label>
        <p class="mTitle"><?php echo $movieName ?></p>
        <label for="addReview">Review:</label>
        <br>
        <textarea id="addReview" name="review" rows="5" cols="30" required></textarea>
        <br>
        <label for="rating">Rating:</label>
        <br>
         <input type="number" name="rating" min="1" max="5" id="rating" required/>
        <br>
    </div>
        <input class="btn btn-light custom-review " type="submit" value="Post" />
        <input type="hidden" name="datePosted" value="<?php echo date('Y-m-d'); ?>">

    </form>

</div>
</body>

<?php }else{
    header("location: homePage.php");
}?>



