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

    <title>Sign In</title>

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
  </head>

  <body>

    <div class="container">

      <form class="form-signin" action="http://localhost/Project2/signin.php" method="POST">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label class="sr-only">User Name</label>
        <input type="text"  name="user" class="form-control" placeholder="User Name" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
          <label style="float:right;">
            <p><a href="forgotpassword.php">Forgot Password</a></p>
          </label>
        </div>
        <p><button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Login">Sign in</button></p>
        <p><a href="signup.php">
          <button class="btn btn-lg btn-primary btn-block" type="button">Register</button>
        </a></p>
      </form>

    </div> <!-- /container -->

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="ie10-viewport-bug-workaround.js"></script>
  </body>
</html>

<?php
//connect to server and select database
mysql_connect("localhost","root","Tfdsa65432");
mysql_select_db("loginpractice");

if(isset($_SESSION['CurrentUser'])){
  echo "Logged in";
  $_SESSION['loggedIn'] = TRUE;
  exit;
}else{

  if(isset($_POST['submit'])){
      $username = $_POST['user'];
      $password = $_POST['password'];

  //Prevent mysql injection
  $username= stripcslashes($username);
  $password= stripcslashes($password);
  $username= mysql_real_escape_string($username);
  $password= mysql_real_escape_string($password);

  //Query database
  $query = mysql_query("SELECT * FROM users WHERE username = '$username' AND password = '$password'")
                or die("Failed to query database" .mysqli_error());

  $row = mysql_fetch_array($query);

  if($row['username'] == $username && $row['password'] == $password){
    echo "<p>Login success!! Welcome ". $row['username']."</p>";
    $_SESSION['CurrentUser'] = $username;
    $_SESSION['loggedIn'] = TRUE;

    header("Location: verified.php");
  }else{
      $_SESSION['loggedIn'] = FALSE;
    echo "<p style='text-align:center; color:red;'>Failed to login. :( <br> Try Again :)</p>";

  }
}
}
?>
