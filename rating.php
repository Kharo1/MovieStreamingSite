<?php
  require_once('connect.php');

    $title = $_GET['title'];
    $submitted_rating = $_GET['rating'];

    $sql = "SELECT * FROM movies WHERE title ='$title'";
    $res = mysqli_query($connection,$sql);
    $count = mysqli_num_rows($res);

    if ($count == 1){
        $r = mysqli_fetch_assoc($res);
        $original_rating= $r['rating'];

        $new_rating = ($original_rating + $submitted_rating) / 2;

        $final_rating= round($new_rating);

        $sql = "UPDATE movies SET rating = '$final_rating' WHERE title = '$title'";
        $do = mysqli_query($connection,$sql);
    }else{
      echo "Failed to locate title :(";
    }


 ?>
