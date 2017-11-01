<!DOCTYPE html>
<?php
  session_start();
  if(!isset($_SESSION['CurrentUser'])){
    header("Location: index.php");
  }
  $connect = mysqli_connect("localhost","root","Tfdsa65432","loginpractice");

  //verify if user has admin access
  $username = $_SESSION['CurrentUser'];
  $sql = "SELECT * FROM users WHERE username = '$username'";
  $res = mysqli_query($connect,$sql);
  $count = mysqli_num_rows($res);
  if($count ==1){
    $r = mysqli_fetch_assoc($res);
    $admin = $r['admin'];

    if($admin != 'YES'){
      //if does not have admin access redirect
      header("Location:verified.php");
    }
  }
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

    <title>Add Title</title>

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

      <form class="form-signin" action="http://localhost/Project2/add-title.php" method="POST" enctype="multipart/form-data">
        <h2 class="form-signin-heading">add a title</h2>
        <label class="sr-only">Movie name</label>
        <input type="text"  name="title" class="form-control" placeholder="Movie Name" required autofocus>
        <label class="sr-only">Movie Description</label>
        <input type="text" name="description" class="form-control" placeholder="Movie Description" required>
        <label class="sr-only">File link</label>
        <input type="text" name="link" class="form-control" placeholder="Video Link" required>

        <label class="sr-only">select image to upload:</label><h3 class="form-signin-heading">select image to upload </h3>
        <input type="file" name="img" id="img" class="form-control" required>

        <label class="sr-only">Rating</label>
        <h3 class="form-signin-heading">default rating</h3>
        <select name="rating" style="width:100%;" name="rating" required>
          <option value="1">1 Star</<option>
          <option value="2">2 Star</<option>
          <option value="3">3 Star</<option>
          <option value="4">4 Star</<option>
          <option value="5">5 Star</<option>
        </select>
        <div class="radio" style="letter-spacing:1px"><h3 class="form-signin-heading">genre</h3>
          <label><input type="radio" name="genre" value='Action' checked="checked">Action</label>
          <label><input type="radio" name="genre" value='Horror'>Horror</label>
          <label><input type="radio" name="genre" value='Documentary'>Documentary</label>
          <label><input type="radio" name="genre" value='Comedy'>Comedy</label>
          <label><input type="radio" name="genre" value='Adventure'>Adventure</label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Register">Submit</button>
        <label style="float:right;">
          <p>not ready? return <a href="verified.php">home</a></p>
        </label>
      </form>

    </div> <!-- /container -->

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="ie10-viewport-bug-workaround.js"></script>
  </body>
</html>




<?php
  //submit = true
  if(isset($_POST['submit'])){
    //input data
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $rating = $_POST['rating'];
    $des= $_POST['description'];
    $link = $_POST['link'];

    //image upload data
    $target_dir = "Photos/";
    $target_file = $target_dir. basename($_FILES["img"]["name"]);
    $uploadok = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    //check to see if image is a actual image
    $check = getimagesize($_FILES["img"]["tmp_name"]);
    if($check !== FALSE){
      //is an image
      $uploadok = 1;
    }else{
      $uploadok = 0;
    }

    //check to see if file already exists
    if(file_exists($target_file)){
      $uploadok = 0;
    }

    //check to see correct file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"){
      $uploadok = 0;
    }

    //upload if possible
    if($uploadok == 0){
      echo "Sorry file could not be upload, issues with the image";
    }else{
      if(move_uploaded_file($_FILES['img']['tmp_name'],$target_file)){
        //file has succesfully been moved
      }else{
        echo "Sorry, there was an error uploading your file.";
      }
    }

    // add links to database
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $query = "INSERT INTO movies (title,img,rating,description,genre,link) VALUES ('$title','$target_file','$rating','$des','$genre','$link')";

    if($connect->query($query) == true){
      echo "<p style='text-align:center; color:red'>Registration Succesful</p>";
      echo "<p style='text-align:center; color:red'>Return <a href='verified.php'>Home</a></p>";
    }else{
      echo "<p style='text-align:center; color:red;'>Movie could not be added to the database!</p>";

    }
  }

}
?>
