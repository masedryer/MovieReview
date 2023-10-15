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
<body class ="background">
<div>
    <?php include 'NavBar.php'; ?>
</div>
</body>
<?php
$message = "";
$passWord = $_POST['Password'];

/*$passWordHash = password_hash($passWord,PASSWORD_DEFAULT);
$duplicate = mysqli_query($link, "SELECT * FROM users WHERE username = '$userName' OR email = '$email'");*/




    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "c203_moviereviewdb";

    $link = mysqli_connect($host, $user, $pass, $db);

    $userName = $_POST['Username'];
    $email = $_POST['Email'];

    $checkDuplicateQuery = "SELECT * FROM users WHERE username = '$userName' OR email = '$email'";
    $duplicateResult = mysqli_query($link, $checkDuplicateQuery);

    if (mysqli_num_rows($duplicateResult) > 0) {
        $message = "<b>Username or email already exists in the database. Please choose a different username or email.</b>";
    } else {
        $nameOk = $_POST['Name'];
        $dobOk = $_POST['dob'];
        $emailOk = $_POST['Email'];
        $userNameOk = $_POST['Username'];
        $passWordOk = $_POST['Password'];


        $query = "INSERT INTO users (username, password, name, dob, email)
                VALUES ('$userNameOk', SHA1('$passWordOk'), '$nameOk', '$dobOk', '$emailOk')";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));

        if ($result) {
            $message = "<b>You have successfully registered!</b>";
        } else {
            $message = "<b>Registration failed! Please try again.</b>";
        }
    }

    mysqli_close($link);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<h1><?php echo $message; ?></h1>
<a href="userSignUp.php">Go back to registration page</a>
</body>
</html>
