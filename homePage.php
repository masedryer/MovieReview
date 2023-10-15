<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="stylesheet/navbar.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="script.js"></script>

    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
</head>
<body class ="backgroundMain">
<div>
    <?php include 'Navbar.php'; ?>
</div>

<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "c203_moviereviewdb";



$link = mysqli_connect($host,$user,$pass,$db);

$users = "SELECT * FROM movies";
$review ="SELECT * FROM reviews";
$result = mysqli_query($link,$users);
$result1 = mysqli_query($link,$review);

$movieNav =  array(
    "John Wick: Chapter 4" => "JohnWickNav.jpg",
    "My Puppy" => "mypuppynav.jpg",
    "Suzume" => "suzumenav.jpg",
    "Avatar: The Way Of Water" => "avatarnav.jpg",
    "Mummies" => "mummiesnav.jpg"
)
?>
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <?php
        $index = 0;
        foreach ($movieNav as $movieTitle => $imageFileName) {
            $activeClass = $index === 0 ? 'active' : '';
            echo '<li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="' . $index . '" class="' . $activeClass . '"></li>';
            $index++;
        }
        ?>
    </ol>
    <div class="carousel-inner">
        <?php
        $index = 0;
        foreach ($movieNav as $movieTitle => $imageFileName) {
            $activeClass = $index === 0 ? 'active' : '';
            echo '<div class="carousel-item ' . $activeClass . '">
              <img src="images/' . $imageFileName . '" class="d-block w-100" alt="Movie Image">
              <div class="carousel-caption">
                <h5>' . $movieTitle . '</h5>
                <p>Additional information or caption for the movie</p>
              </div>
            </div>';
            $index++;
        }
        ?>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </a>
</div>

</body>
</html>
