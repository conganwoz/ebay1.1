<?php
session_start();
$userName = $_SESSION["username"];
$password = $_SESSION["password"];
$id = $_SESSION["productId"];
$startNum = $_GET['starNum'];


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
          $query = "SELECT * FROM rating WHERE userId='$userId' AND productId='$id'";
          $result = mysqli_query($conn,$query);
          if(mysqli_affected_rows($conn) > 0){
            $query = "UPDATE rating SET starNum='$startNum' WHERE userId='$userId' AND productId='$id'";
            echo "OK1";
          }else {
            $query = "INSERT INTO rating (userId, productId, starNum) VALUES ('$userId', '$id','$startNum')";
            $result = mysqli_query($conn,$query);
            echo "OK2";
          }
          

          mysqli_close($conn);

      }else {
        echo "ERROR";
        mysqli_free_result($result);
        mysqli_close($conn);
    }
?>