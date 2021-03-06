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
    <link rel="icon" href="../../favicon.ic">

    <title>Movie Binger</title>

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
                    <li><a href="featured.php">All</a></li>
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


    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img class="first-slide" src="Photos/movies-banner.jpg" alt="First slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Movies Binger</h1>
              <p>Watch latest and classical movies online for free. Various genres: action,animation,comedy,thriller, etc. Without downloading and registration requirements!</p>
              <p><a class="btn btn-lg btn-primary" href="verified.php" role="button">Welcome!</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img class="second-slide" src="Photos/horror-banner.png" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Horror Films</h1>
              <p>Unsettling films designed to frighten and panic, cause dread and alarm, and to invoke our hidden worst fears, often in a terrifying, shocking finale, while captivating and entertaining us at the same time in a cathartic experience.</p>
              <p><a class="btn btn-lg btn-primary" href="horror.php" role="button">Browse Horror</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img class="third-slide" src="Photos/feature-banner.jpg" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Featured Films</h1>
              <p>Ant-Man is the name of several fictional superheroes appearing in books published by Marvel Comics. Created by Stan Lee, Larry Lieber and Jack Kirby, Ant-Man's first appearance was in Tales to Astonish #27 (January 1962). </p>
              <p><a class="btn btn-lg btn-primary" href="featured.php" role="button">Browse Featured</a></p>
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarouse" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div><!-- /.carousel -->


    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

      <!-- Three columns of text below the carousel -->
      <div class="row">
        <div class="col-lg-4">
          <a href="horror.php">
          <img class="img-circle" src="Photos/Your-next.jpg" alt="Generic placeholder image" width="140" height="140">
          </a>
          <h2>Horror</h2>
          <p>Unsettling films designed to frighten and panic, cause dread and alarm, and to invoke our hidden worst fears, often in a terrifying, shocking finale, while captivating and entertaining us at the same time in a cathartic experience.</p>
          <p><a class="btn btn-default" href="horror.php" role="button">Explore &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <a href="action.php">
          <img class="img-circle" src="Photos/Expendables.jpg" alt="Generic placeholder image" width="140" height="140">
          </a>
          <h2>Action</h2>
          <p>Protagonist or protagonists end up in a series of challenges that typically include violence, extended fighting and frantic chases. Action films feature a resourceful hero struggling against incredible odds, which include life-threatening situations.</p>
          <p><a class="btn btn-default" href="action.php" role="button">Explore &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <a href="documentary.php">
          <img class="img-circle" src="Photos/Cowspiracy.jpg" alt="Generic placeholder image" width="140" height="140">
          </a>
          <h2>Documentary</h2>
          <p>A nonfictional motion picture intended to document some aspect of reality, primarily for the purposes of instruction, education, or maintaining a historical record.Such films were originally shot on film stock but now include video.</p>
          <p><a class="btn btn-default" href="documentary.php" role="button">Explore &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->


      <!-- START THE FEATURETTES -->

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">First featurette. <span class="text-muted">It'll blow your mind.</span></h2>
          <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
        </div>
        <div class="col-md-5">
          <a href="player.php?title=Avatar&submit=">
          <img class="featurette-image img-responsive center-block" src="Photos/Avatar.jpg" alt="Generic placeholder image">
          </a>
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7 col-md-push-5">
          <h2 class="featurette-heading">Oh yeah,  if that's good. <span class="text-muted">Check this one out.</span></h2>
          <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
        </div>
        <div class="col-md-5 col-md-pull-7">
          <a href="player.php?title=Moonlight&submit=">
          <img class="featurette-image img-responsive center-block" src="Photos/Moonlight.jpg" alt="Generic placeholder image">
          </a>
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
          <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
        </div>
        <div class="col-md-5">
          <a href="player.php?title=Checkers&submit=">
          <img class="featurette-image img-responsive center-block" src="Photos/Checkers.jpg" alt="Generic placeholder image">
          </a>
        </div>
      </div>

      <hr class="featurette-divider">

      <!-- /END THE FEATURETTES -->


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
