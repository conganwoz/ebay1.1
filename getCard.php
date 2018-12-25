<?php
session_start();
if(ISSET($_SESSION["username"])){
  $userName = $_SESSION["username"];
  $password = $_SESSION["password"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Giỏ hàng</title>
    <style>
    .header{
        width: 100%;
        height: 10vh;
        background-image: linear-gradient(145deg, #349aed 50%, #34d8ed 100%);
    }
    </style>
</head>
<body>
<div class="header">
<span style="color: #fff;margin-top: 50%;font-size: 200%;">Shopdee</span>
</div>
    <div class='container'>
    <br>
    <br>
    <br>
    <h2>Giỏ hàng</h2>
    <?php
    $conn = mysqli_connect('localhost','root','123456','shopdee');
    mysqli_set_charset($conn,'UTF8');
    if(mysqli_connect_errno()){
    echo 'Failed to conect to MySql '.mysqli_connect_errno();
    }
    $query = "SELECT cart.linkProduct FROM user,cart WHERE user.userName='$userName' AND user.password='$password' AND user.id=cart.userId";
    $result = mysqli_query($conn,$query);
    if(mysqli_affected_rows($conn) > 0){
        $posts = mysqli_fetch_all($result,MYSQLI_ASSOC);
        $printHtml = "<table class='table'><thead class='thead-dark'><tr><th scope='col'>No</th><th scope='col'>Link chia sẻ</th><th scope='col'>mua</th></tr></thead><tbody>";
        $i = 1;
        foreach($posts as $post){
            $link = $post['linkProduct'];
            $printHtml .= "<tr><th scope='row'>".$i."</th><td>".$link."</td><td><a class='btn btn-success' href='$link'>Mua</a></td></tr>";
            $i++;
        }
        $printHtml .= "</tbody></table>";
        print $printHtml;

    }else {
        print "<h3>Không có sản phẩm nào trong giỏ hàng</h3>";
    }
    ?>
    </div>
</body>
</html>