<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "c203_moviereviewdb";

$link = mysqli_connect($host, $user, $pass, $db);

$username = $_POST['username'];
$name = $_POST['name'];
$email = $_POST['email'];
$dob = $_POST['dob'];
$id = $_POST['id'];
$password = $_POST['Password'];


$msg = "";

$queryUpdate = "UPDATE users
                SET username='$username', 
                    name='$name',
                    email = '$email',
                    dob = '$dob' ,
                password = SHA1('$password') 
                 WHERE userId = '$id'";

$resultUpdate = mysqli_query($link, $queryUpdate)
or die(mysqli_error($link));


if ($resultUpdate) {
    $msg = "Profile successfully updated";
} else {
    $msg = "Profile not updated";
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
