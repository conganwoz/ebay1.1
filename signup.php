<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <title>ShopDee | mainpage</title>
    <style>
    nav {
        padding: 15px;
        background-image: linear-gradient(145deg, #349aed 50%, #34d8ed 100%);
        margin-bottom: 5px;
    }
    h1 {
        text-align: center;
        color:#1979e8;
    }
    </style>
</head>
<body>
<nav class="navbar bg-gradient-info navbar-fixed-top">
  <div class="container-fluid row">
    <div class="navbar-header col-sm-2">
      <a class="navbar-brand" style="color:#fff;" href="#">ShopDee</a>
    </div>
    <form class="navbar-left col-sm-8" action="Browsing.php" id="formSearch" method="post" target="_self">
      <div class="form-group" style="width:70%;display:inline-block;">
        <input id="searchText" type="text" class="form-control" placeholder="Search" name="QueryString">
      </div>
      
      <input type="submit" class="btn btn-primary" name="FindIt" value="Tìm kiếm">
    </form>
    <ul class="nav navbar-nav navbar-right col-sm-2">
      <li><a href="./signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="./login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
  <hr style="background:#000;">
  <div class="row">
    <div class="container-fluid">
      <div class="col-sm-1 dropdown">
       <a class="dropdown-toggle" data-toggle="dropdown" style="color:#fff;" href="#">Điện tử
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="./category.php?id=15032">Cell Phones & Accessories</a></li>
          <li><a href="./category.php?id=139973">Video Games & Consoles</a></li>
          <li><a href="./category.php?id=58058">Computers/Tablets & Networking</a></li>
          <li><a href="./category.php?id=625">Cameras & Photo</a></li>
          <li><a href="./category.php?id=11232">DVDs & Movies</a></li>
        </ul>
      </div>


      <div class="col-sm-1 dropdown">
       <a class="dropdown-toggle" data-toggle="dropdown" style="color:#fff;" href="#">Thời trang
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="./category.php?id=11450">Jewelry & Watches</a></li>
          <li><a href="./category.php?id=4250">Men's Accessories</a></li>
          <li><a href="./category.php?id=4251">Women's Accessories</a></li>
          <li><a href="./category.php?id=15724">Women's Clothing</a></li>
        </ul>
    </div>


    <div class="col-sm-1 dropdown">
       <a class="dropdown-toggle" data-toggle="dropdown" style="color:#fff;" href="#">Khỏe và đẹp
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="./category.php?id=26395">Health & Beauty</a></li>
          <li><a href="./category.php?id=67588">Health Care</a></li>
          <li><a href="./category.php?id=31786">Makeup</a></li>
          <li><a href="./category.php?id=47945">Nail Care, Manicure & Pedicure</a></li>
          <li><a href="./category.php?id=31762">Shaving & Hair Removal</a></li>
        </ul>
    </div>


    <div class="col-sm-1 dropdown">
       <a class="dropdown-toggle" data-toggle="dropdown" style="color:#fff;" href="#">Động cơ
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="./category.php?id=6001">Cars & Trucks</a></li>
          <li><a href="./category.php?id=6024">Motorcycles</a></li>
          <li><a href="./category.php?id=6038">Other Vehicles & Trailers</a></li>
          <li><a href="./category.php?id=26429">Boats</a></li>
          <li><a href="./category.php?id=33743">Wheels, Tires & Parts</a></li>
          <li><a href="./category.php?id=84149">Scooter Parts</a></li>
          <li><a href="./category.php?id=7294">Cycling</a></li>
        </ul>
    </div>


    <div class="col-sm-1 dropdown">
       <a class="dropdown-toggle" data-toggle="dropdown" style="color:#fff;" href="#">Sưu tầm
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="./category.php?id=165195">Belts & Belt Buckles</a></li>
          <li><a href="./category.php?id=165196">Coasters</a></li>
          <li><a href="./category.php?id=35630">Hats & Caps</a></li>
          <li><a href="./category.php?id=95113">Lighting & Lamps</a></li>
          <li><a href="./category.php?id=165199">Posters, Prints & Paintings</a></li>
          <li><a href="./category.php?id=156198">Clothing 1950-1979</a></li>
          <li><a href="./category.php?id=156201">Clothing 1980-Now</a></li>
          <li><a href="./category.php?id=841">Shoes 1950-1979</a></li>
          <li><a href="./category.php?id=156202">Shoes 1980-Now</a></li>
          <li><a href="./category.php?id=260">Stamps</a></li>
        </ul>
    </div>


    <div class="col-sm-1 dropdown">
       <a class="dropdown-toggle" data-toggle="dropdown" style="color:#fff;" href="#">Thể thao
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="./category.php?id=64482">Sports Mem, Cards & Fan Shop</a></li>
          <li><a href="./category.php?id=27267">Basketball-NBA</a></li>
          <li><a href="./category.php?id=27283">Hockey-NHL</a></li>
          <li><a href="./category.php?id=888">Sporting Goods</a></li>
          <li><a href="./category.php?id=73980">Clothing, Shoes & Accessories</a></li>
          <li><a href="./category.php?id=179792">Martial Arts Weapons</a></li>
          <li><a href="./category.php?id=179775">Prot ective Gear</a></li>
          <li><a href="./category.php?id=179784">Training Equipment & Supplies</a></li>
          <li><a href="./category.php?id=15273">Fitness, Running & Yoga</a></li>
          <li><a href="./category.php?id=180091">Youth Clothing</a></li>
        </ul>
    </div>


    <div class="col-sm-1 dropdown">
       <a class="dropdown-toggle" data-toggle="dropdown" style="color:#fff;" href="#">Home & Garden
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="./category.php?id=26677">Bath</a></li>
          <li><a href="./category.php?id=20444">Bedding</a></li>
          <li><a href="./category.php?id=14308">Food & Beverages</a></li>
          <li><a href="./category.php?id=38173">Candy, Gum & Chocolate</a></li>
          <li><a href="./category.php?id=38178">Coffee</a></li>
          <li><a href="./category.php?id=179178">Snack Foods</a></li>
          <li><a href="./category.php?id=16086">Greeting Cards & Party Supply</a></li>
          <li><a href="./category.php?id=69197">Heating, Cooling & Air</a></li>
          <li><a href="./category.php?id=299">Household Supplies & Cleaning</a></li>
          <li><a href="./category.php?id=20620">Laundry Supplies</a></li>
          <li><a href="./category.php?id=20625">Kitchen, Dining & Bar</a></li>
          <li><a href="./category.php?id=3197">Furniture</a></li>
        </ul>
    </div>

    <div class="col-sm-1 dropdown">
       <a class="dropdown-toggle" data-toggle="dropdown" style="color:#fff;" href="#">Deals
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Page 1-1</a></li>
          <li><a href="#">Page 1-2</a></li>
          <li><a href="#">Page 1-3</a></li>
        </ul>
    </div>


    <div class="col-sm-1 dropdown">
       <a class="dropdown-toggle" data-toggle="dropdown" style="color:#fff;" href="#">Under $10
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Page 1-1</a></li>
          <li><a href="#">Page 1-2</a></li>
          <li><a href="#">Page 1-3</a></li>
        </ul>
    </div>

  </div>
  </div>
</nav>


<div class="container">
<h1>SignUp to Shopdee</h1>
<form class="form-horizontal" id="signUpForm" action="signup.php" style="margin-top:150px;" method='POST'>

    <div class="form-group">
      <label class="control-label col-sm-2" for="firstname">Tên:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="firstname" placeholder="nhập tên" name="firstname">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="midname">Bí danh:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="midname" placeholder="bí danh" name="midname">
      </div>
    </div>


    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Confirm Password:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" id="cfpwd" placeholder="Enter confirm password" name="cfpwd">
      </div>
    </div>


    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
      </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2" for="avatar">Avatar:</label>
        <div class="col-sm-10">
        <select class="form-control" id="avatar" name='avatar'>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
        </select>
        </div>
   </div>


    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
      <input type="submit" name="submit" value="Đăng nhập" class="submit">
      </div>
    </div>

  </form>

</div>
<?php
  if(ISSET($_POST["submit"])){
      if($_POST['firstname'] && $_POST['midname'] && $_POST['pwd'] && $_POST['cfpwd'] && $_POST['email'] && $_POST['avatar']){
        $conn = mysqli_connect('localhost','root','123456','shopdee');
        mysqli_set_charset($conn,'UTF8');
        if(mysqli_connect_errno()){
            echo 'Failed to conect to MySql '.mysqli_connect_errno();
        }
        $userName = $_POST['firstname'];
        $alias = $_POST['midname'];
        $password = $_POST['pwd'];
        $confirmPass = $_POST['cfpwd'];
        $email = $_POST['email'];
        $avatar = $_POST['avatar'];
        if($password == $confirmPass){
            $query = "INSERT INTO user (userName, password, alias,avatar,email) VALUES ('$userName', '$password','$alias','$avatar','$email')";
            $result = mysqli_query($conn,$query);
            if($result){
                //mysqli_free_result($result);
                $_SESSION["username"] = $userName;
                $_SESSION["password"] = $password;
                $_SESSION["alias"] = $alias;
                $_SESSION["avatar"] = $avatar;
                //header("Location:index1.php");
                echo "<script type='text/javascript'>window.location.href = 'index1.php';</script>";
                exit();
            }else {
                echo "<h1>insert khong thanh cong </h1>";
            }
        }else {
            $message = "mật khẩu không khớp!";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
        mysqli_close($conn);

      }else {
        $message = "bạn cần phải điền tất cả các trường!";
        echo "<script type='text/javascript'>alert('$message');</script>";
      }
  }
?>
</body>
</html>
<!--trnsl.1.1.20181013T203345Z.3b4d582554598341.418d371251b3cc0e32f3264377db18cd929a9779-->