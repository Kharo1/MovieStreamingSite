<!DOCTYPE html>
<?php
  session_start();
  require_once('connect.php');

  if(!isset($_SESSION['CurrentUser'])){
    header("Location: index.php");
  }else{
    if(isset($_GET['submit'])){

      $title = mysqli_real_escape_string($connection,$_GET['title']);
      $sql = "SELECT * FROM movies WHERE title = '$title'";
      $res = mysqli_query($connection,$sql);
      $count = mysqli_num_rows($res);

      if($count == 1){
        $r = mysqli_fetch_assoc($res);
        $description = $r['description'];
        $rating = $r['rating'];
        $poster = $r['img'];
        $link = $r['link'];
      }else{
        echo "could not find movie";
      }


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

    <title>Movie Binger</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="ie-emulation-modes-warning.js"></script>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <!--rating javascript -->
    <script>
    var rated=0;

    function test(){
      if(rated ==0){
        var rating1 =5;
        var title1 = document.getElementById("title").value;
        $.get('rating.php', {rating: rating1,title:title1});
        rated++;
    }else{
        alert("You already rated!");
      }
    }
    function test2(){
      if(rated ==0){
      var rating1 =4;
      var title1 = document.getElementById("title").value;
      $.get('rating.php', {rating: rating1,title:title1});
      rated++;
    }else{
      alert("You already rated!");
      }
    }
    function test3(){
      if(rated ==0){
        var rating1 =3;
        var title1 = document.getElementById("title").value;
        $.get('rating.php', {rating: rating1,title:title1});
        rated++;
      }else{
        alert("You already rated!");
      }
    }
    function test4(){
      if(rated ==0){
        var rating1 =2;
        var title1 = document.getElementById("title").value;
        $.get('rating.php', {rating: rating1,title:title1});
        rated++;
    }else{
        alert("You already rated!");
      }
    }
    function test5(){
      if(rated ==0){
        var rating1 =1;
        var title1 = document.getElementById("title").value;
        $.get('rating.php', {rating: rating1,title:title1});
        rated++;
    }else{
        alert("You already rated!");
    }
  }

    </script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="carousel.css" rel="stylesheet">
    <link href="rating.css" rel="stylesheet">
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
                    <li><a href="add-title.php">Add a title</a></li>
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


      <iframe width="1080" height="608" src="<?php  echo $link; ?>" frameborder="0" allowfullscreen></iframe>


      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading"><?php  echo $title; ?><span class="text-muted">,</span></h2>
          <p class="lead"><?php  echo $description; ?></p>


 <fieldset class="rating">
        <input class="stars" type="radio" id="star5" name="rating" value="5"/>
        <label class = "full" for="star5"  title="Awesome - 5 stars" onclick="test()"></label>
        <input class="stars" type="radio" id="star4" name="rating" value="4" />
        <label class = "full" for="star4"  title="Good - 4 stars" onclick="test2()"></label>
        <input class="stars" type="radio" id="star3" name="rating" value="3" />
        <label class = "full" for="star3"  title="Meh - 3 stars" onclick="test3()"></label>
        <input class="stars" type="radio" id="star2" name="rating" value="2" />
        <label class = "full" for="star2"  title="Bad - 2 stars" onclick="test4()"></label>
        <input class="stars" type="radio" id="star1" name="rating" value="1" />
        <label class = "full" for="star1"  title="Not worth your time - 1 star" onclick="test5()"></label>
        <input type="hidden" name="title" id="title" value="<?php echo $title; ?>"/>

  </fieldset>

        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive center-block" src="<?php  echo $poster; ?>" alt="Generic placeholder image">
        </div>
      </div>




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
