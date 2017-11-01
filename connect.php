<?php
$connection = mysqli_connect('localhost','root','Tfdsa65432');
if(!$connection){
  die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection,'loginpractice');

if(!$select_db){
  die("Database selection Failed". mysqli_error($connection));
}

?>
