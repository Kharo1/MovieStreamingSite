<!DOCTYPE html>
<?php
  session_start();
  $connect = mysqli_connect("localhost","root","Tfdsa65432","loginpractice");

  if(!isset($_SESSION['CurrentUser'])){
    header("Location: index.php");
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

    <title>Movie Binger: Adventure</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="carousel.css" rel="stylesheet">
  </head>
<!-- NAVBAR
================================================== -->
  <body>
    <div class="navbar-wrapper">
      <div class="container">

        <nav class="navbar navbar-inverse navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="verified.php">Movie Binger</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li><a class="active" href="verified.php">Home</a></li>
                <li class="active"><?php
                  if(isset($_SESSION['CurrentUser'])){
                    echo "<a href=\"\">Welcome, " . $_SESSION['CurrentUser']. "</a>";
                  }else{
                    echo "<a href= \" http://localhost/Project2/signin.php\">Login </a> ";
                  }
                  ?></li>
                <li><?php
                  if(isset($_SESSION['CurrentUser'])){
                    echo "<a href= \" http://localhost/Project2/logout.php \">Logout</a>";
                  }else{
                    echo "<a href= \"signup.php \">Register</a>";
                  }
                  ?></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Genres <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="featured.php">Featured</a></li>
                    <li><a href="action.php">Action</a></li>
                    <li><a href="horror.php">Horror</a></li>
                    <li><a href="documentary.php">Documentary</a></li>
                    <li><a href="comedy.php">Comedy</a></li>
                    <li><a href="adventure.php">Adventure</a></li>
                    <li role="separator" class="divider"></li>
                    <li class="dropdown-header">Other</li>
                    <li><a href="#">Contact Us</a></li>
                    <?php
                      $username = $_SESSION['CurrentUser'];
                      $sql = "SELECT * FROM users WHERE username = '$username'";
                      $res = mysqli_query($connect,$sql);
                      $count = mysqli_num_rows($res);
                      if($count ==1){
                        $r = mysqli_fetch_assoc($res);
                        $admin = $r['admin'];

                        if($admin == 'YES'){
                          echo "<li><a href='add-title.php'>Add a title</a></li>";
                        }
                      }
                     ?>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>

      </div>
    </div>


    <div class="container marketing">
      <br><br><br><br><br><br><br>
      <div class="row">

        <?php
        $query = "SELECT * FROM movies WHERE genre = 'Adventure' ORDER BY title ASC";
        $result = mysqli_query($connect,$query);
        if(mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_array($result)){
         ?>

         <div class="col-lg-4">
           <form method="GET" action="player.php">
            <a href="player.php?title=<?php echo urlencode($row['title']);?>&submit=">
           <img src="<?php echo $row["img"]; ?>"  alt="Generic placeholder image" width="140" height="220">
           </a>
           <h2><?php echo $row["title"]; ?></h2>
           <?php
           if($row["rating"] == 5){
            echo "<img src='Photos/5-star.png'  alt='Generic placeholder image' height='50'>";
           }else if ($row["rating"] == 4){
             echo "<img src='Photos/4-star.png'  alt='Generic placeholder image' height='50'>";
           }else if($row["rating"] == 3){
             echo "<img src='Photos/3-star.png'  alt='Generic placeholder image' height='50'>";
           }else if($row["rating"] == 2){
             echo "<img src='Photos/2-star.png'  alt='Generic placeholder image' height='50'>";
           }else{
             echo "<img src='Photos/1-star.png'  alt='Generic placeholder image' height='50'>";
           }
            ?>
           <p><?php echo $row["description"]; ?></p>
           <input type="hidden" name="title" value="<?php echo $row["title"]; ?>"/>
           <p><button class="btn btn-default" name="submit" type="submit">Watch &raquo;</button></p>
         </form>
         </div><!-- /.col-lg-4 -->
        <?php
          }
        }else{
          echo "Unavailable titles :(";
        }
         ?>

      </div><!-- /.row -->



      <hr class="featurette-divider">


      <!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; 2016 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="jquery.min.js"><\/script>')</script>
    <script src="bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
