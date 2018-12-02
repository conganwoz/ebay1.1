<?php
session_start();
if(ISSET($_SESSION["username"])){
  $userName = $_SESSION["username"];
  $password = $_SESSION["password"];

}
$linkProduct = $_GET['productLink'];
$conn = mysqli_connect('localhost','root','123456','shopdee');
mysqli_set_charset($conn,'UTF8');
if(mysqli_connect_errno()){
    echo 'Failed to conect to MySql '.mysqli_connect_errno();
}



$query = "SELECT id FROM user WHERE userName='$userName' AND password='$password'";
        $result = mysqli_query($conn,$query);
        if(mysqli_affected_rows($conn) > 0){
          $posts = mysqli_fetch_all($result,MYSQLI_ASSOC);
          $userId = $posts[0]['id'];
          
          //echo "<script type='text/javascript'>alert('$productId');</script>";
          $query = "INSERT INTO cart (userId, linkProduct) VALUES ('$userId', '$linkProduct')";
          $result = mysqli_query($conn,$query);
          if(mysqli_affected_rows($conn) > 0){
              echo "OK";
          }else {
              echo "internal error";
          }
          //mysqli_free_result($result);
          mysqli_close($conn);
      }else {
          echo "auth error";
      }

?>