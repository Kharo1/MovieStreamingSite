<!DOCTYPE html>
<?php
  session_start();
  require_once('connect.php');
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

      <form class="form-signin" action="http://localhost/Project2/forgotpassword.php" method="POST">
        <h2 class="form-signin-heading">forgot password</h2>
        <p>When you fill in your registered email address, you will be sent instructions on how to reset your password.</p>
        <label class="sr-only">Email</label>
        <input type="text"  name="email" class="form-control" placeholder="Email" required autofocus>
        <p><button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Recover">Recover Password</button></p>
        <p>already have an account?<a href="signin.php"> login in here
        </a></p>
        <p>new user?<a href="signup.php"> create an account
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

  if(isset($_POST['submit']) & !empty($_POST)){
    $email = mysqli_real_escape_string($connection,$_POST['email']);
    $sql = "SELECT * FROM users WHERE Email = '$email'";
    $res = mysqli_query($connection,$sql);
    $count = mysqli_num_rows($res);
    if($count ==1){
      $r = mysqli_fetch_assoc($res);
      $password = $r['password'];
      $to = $r['Email'];
      $subject = "Recovered Password: Movie Binger";
      $message = "Please use this password to login". $password;
      $headers = "From: moviebinger@noreply.com";

      if(mail($to,$subject,$message,$headers)){
          echo "Sent email to user with password";
      }else{
        echo "Failed to recover password, try again";
      }

    }
    else{
      "Email not found.";
    }

  }
}
?>
