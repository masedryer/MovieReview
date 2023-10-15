
<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "c203_moviereviewdb";

$link = mysqli_connect($host,$user,$pass,$db);

if(isset($_POST["submit"])) {
    $username = $_POST['Username'];
    $dob = $_POST['dob'];
    $password = $_POST['Password'];
    $cfmPassword = $_POST['cfmPassword'];
    $email = $_POST['Email'];
    $name = $_POST['Name'];
    $duplicate = mysqli_query($link, "SELECT * FROM users WHERE username = '$username' OR email = '$email'");





  /*  if(mysqli_num_rows($duplicate)){
        echo "<script> alert('Username or Email had already taken');</script>";
    }
    else{
        if($password === $cfmPassword){
            $query = "INSERT INTO users(username,password,name,dob,email) VALUES ('$username','$password','$name','$dob','$email')";
            mysqli_query($link,$query) or die(mysqli_error($link));;
            echo "<script>alert('Registration Successful'); </script>";
        }
        else{
            echo"<script>alert('Password and Confirm Password does not match');</script>";
        }
    } */

}


?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
        <link rel="stylesheet" href="stylesheet/signUp.css" />
        <style>
            .error{
                color: red;
            }
        </style>
    </head>
    <body>


    <form action="doRegister.php" method="POST">
        <div class="container">
            <fleidset>

                <h1>Create Account</h1>
                <label for="username">Username</label>
                <br>
                <input id="username" name="Username" type="text" placeholder="Enter Username" required  autofocus>
                <br><br>
                <label for="password">Password</label>
                <br><input id="password" name="Password" type="password" placeholder="Enter Password"  minlength="10" required>



                <br>
                <br>
                <label for="full-name">Name</label>
                <br>
                <input id="full-name" name="Name" type="text" placeholder="Enter your full name" required >
                <br>
                <br>


                <label for="dob">DOB</label>
                <br>
                <input id="dob" name="dob" type="date"  placeholder="today" required autofocus>


                <br><br>
                <label for="email">Email</label>
                <br>
                <input id="email" name="Email" type="text" placeholder="masedryer@gmail.com" required >
                <br><br>
                <input type="submit" value="Register"/>


            </fleidset>

            <div  class="divider">
                <hr>
                <h4>Already have an account</h4><a class="loginlink" href="login.php">Login</a>

            </div>

        </div>



        <br>



    </form>


    </body>
</html>
