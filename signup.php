<!DOCTYPE html>
<?php
  session_start();
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Sign Up</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
    function validateForm(){
      var x = document.forms["myForm"]["email"].value;
      var atpos = x.indexOf("@");
      var dotpos = x.lastIndexOf(".");
      if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
          alert("Not a valid e-mail address");
          return false;
        }
    }
    </script>
  </head>

  <body>

    <div class="container">

      <form class="form-signin" action="http://localhost/Project2/signup.php" method="POST" onsubmit="return validateForm()" name="myForm">
        <h2 class="form-signin-heading">Please sign up</h2>
        <label class="sr-only">User Name</label>
        <input type="text"  name="user" class="form-control" placeholder="User Name" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Password" required>

        <label class="sr-only">Name</label>
        <input type="text"  name="name" class="form-control" placeholder="Name" required >
        <label class="sr-only">Email</label>
        <input type="text"  name="email" class="form-control" placeholder="Email" required >

        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Register">Sign Up</button>
        <label style="float:right;">
          <p>Already Have an account?<a href="signin.php">Sign in</a></p>
        </label>
      </form>

    </div> <!-- /container -->

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="ie10-viewport-bug-workaround.js"></script>
  </body>
</html>




<?php
//connect to server and select database
$connect = new mysqli("localhost","root","Tfdsa65432","loginpractice");

if(isset($_SESSION['CurrentUser'])){
  echo "Logged in";
  $_SESSION['loggedIn'] = TRUE;
  exit;
}else{

  if(isset($_POST['submit'])){
      $username = $_POST['user'];
      $password = $_POST['password'];
      $name = $_POST['name'];
      $email = $_POST['email'];
      $usernameTaken = 0;

      $sql = "SELECT * FROM users WHERE username = '$username'";
      $res = mysqli_query($connect,$sql)
            or die("Failed to query database" .mysqli_error());

      if(mysqli_num_rows($res)){
        $usernameTaken = 1;
      }

      if($_SERVER['REQUEST_METHOD'] == 'POST' && $usernameTaken == 0){

        $_SESSIONS['username'] = $name;
        $query = "INSERT INTO users (ID,username,password,Name,Email,admin) VALUES (DEFAULT,'$username','$password','$name','$email','NO')";

        if($connect->query($query) == true){
          echo "<p style='text-align:center; color:red'>Registration Succesful</p>";
          echo "<p style='text-align:center; color:red'>Return <a href='index.php'>Home</a></p>";
        }else{
          echo "<p style='text-align:center; color:red;'>User could not be added to the database!</p>";
        }
      }else{
      echo "<p style='text-align:center; color:red'>User name: ". $username." has already been taken</p>";
    }
  }
}
?>
