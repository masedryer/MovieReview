<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "c203_moviereviewdb";

$link = mysqli_connect($host, $user, $pass, $db);

if (isset($_GET['search_text'])) {
    $searchText = $_GET['search_text'];
    $query = "SELECT movieId, movieGenre, movieTitle, picture FROM movies WHERE movieTitle LIKE '%$searchText%'";
} else {
    $query = "SELECT movieId, movieGenre, movieTitle, picture FROM movies";
}

if (isset($_GET['sort'])) {
    $sortOption = $_GET['sort'];

    if ($sortOption === 'alphabet') {
        $query .= " ORDER BY movieTitle ASC";
    }
}

// Genre filter handling
if (isset($_GET['genre']) && !empty($_GET['genre'])) {
    $selectedGenre = $_GET['genre'];
    $query .= " WHERE movieGenre = '$selectedGenre'";
}

$result = mysqli_query($link, $query);

$genreQuery = "SELECT DISTINCT movieGenre FROM movies";
$genreResult = mysqli_query($link, $genreQuery);
$genres = [];
while ($genreRow = mysqli_fetch_assoc($genreResult)) {
    $genres[] = $genreRow["movieGenre"];
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="stylesheet/navbar.css">
</head>
<body class="backgroundMain">
<div>
    <?php include 'Navbar.php'; ?>
</div>

<div class="container mt-4">
    <form class="form-inline mb-2" method="GET">
        <label class="mr-2" for="sort">Sort By:</label>
        <select class="form-control mr-2" name="sort" id="sort">
            <option value="alphabet">Alphabet (A-Z)</option>
        </select>
        <button type="submit" class="btn btn-light">Sort</button>
    </form>

    <!-- Filter by Genre -->
    <form class="form-inline mb-2" method="GET">
        <label class="mr-2" for="genre">Filter By Genre:</label>
        <select class="form-control mr-2" name="genre" id="genre">
            <option value="">All</option>
            <?php foreach ($genres as $genre) : ?>
                <option value="<?php echo $genre; ?>"><?php echo $genre; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="btn btn-light">Apply</button>
    </form>
</div>
<div class="container">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
        <?php while ($movieRow = mysqli_fetch_assoc($result)) :
            $movieID = $movieRow["movieId"];

            $avgRatingQuery = "SELECT AVG(rating) AS averageRating FROM reviews WHERE movieID = $movieID";
            $averageRatingResult = mysqli_query($link,$avgRatingQuery);
            $avgRating = 0;

            if ($averageRatingResult && $averageRatingResult->num_rows > 0) {
                $averageRatingData = mysqli_fetch_assoc($averageRatingResult);
                $averageRating = $averageRatingData["averageRating"];
                $averageRating = round($averageRating, 1);
            }
            ?>

            <div class="card mb-4">
                <div class="card h-100">
                    <?php
                    $movieTitle = $movieRow["movieTitle"];
                    $imageFileName = $movieRow["picture"];
                    ?>
                    <a class="movieList" href="movieDescription.php?movie_id=<?php echo $movieID ?>">
                    <img class="card-img-top imageResize" src="images/<?php echo $imageFileName; ?>"
                         alt="Card image"></a>
                    <div class="card-body backgroundMain text-white">
                        <h4 class="card-title"><?php echo $movieTitle; ?></h4>
                        <p class="card-text"><?php echo $movieRow["movieGenre"]; ?></p>
                        <p class="card-text">Average Rating: <?php echo $averageRating; ?></p>
                        <a href="movieDescription.php?movie_id=<?php echo $movieID ?>" class="btn btn-light">See More</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
</body>
</html>

