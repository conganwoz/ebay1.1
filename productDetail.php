<?php


session_start();
if(ISSET($_SESSION["username"])){
  $userName = $_SESSION["username"];
  $password = $_SESSION["password"];

}
$id = $_GET['id'];
$_SESSION['productId'] = $id;
$productId = $_SESSION['productId'];
//echo "<script type='text/javascript'>alert('$productId');</script>";
$url = "http://open.api.ebay.com/shopping?callname=GetSingleItem&responseencoding=JSON&appid=Benjamin-TrendWat-PRD-f2466ad44-bc17cfa6&siteid=0&version=981&IncludeSelector=Compatibility,Description,Details,ItemSpecifics,TextDescription,HighBidder.FeedbackPrivate,HighBidder.FeedbackScore&ItemID=";
$url .= $id;

$handle = curl_init();
curl_setopt($handle, CURLOPT_URL, $url);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($handle);
curl_close($handle);
$res = json_decode($data);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <title>Shopdee chi tiết sản phẩm</title>
    <style>
    nav {
        padding: 15px;
        background-image: linear-gradient(145deg, #349aed 50%, #34d8ed 100%);
        margin-bottom: 5px;
    }
    .mainImg {
        height: 55vh;
        display: inline-block;
        width: 100%;
        background: red;
        margin-bottom: 5px;
    }
    .subImg {
        height: 13vh;
        display: inline-block;
        width: 24.4%;
        background: green;
    }
    .price {
      color: #ff5722;
    }
    .normal {
      color: #757575;
    }
    #cart {
        border: 1px solid #349aed;
        color: #349aed;
        outline: none;
    }
    #buy {
      background: #349aed;
      color: #fff;
      outline: none;
    }
    .commentArea {
      padding: 10px;
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
    <?php
      if(ISSET($userName) && ISSET($password)){
        $logined = "<li><a style='padding:0;' href='#'><img src='https://i1.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?fit=256%2C256&quality=100&ssl=1' class='img-circle' alt='Cinque Terre' width='50' height='50'> </a><h4 style='text-align:center;margin:0;'>".$userName."</h4></li>";
        $logined .= "<li><a href='logoutS.php' target='_self'>đăng xuất</a></li>";
        print $logined;
      }else {
        $noLogin = "<li><a href='./signup.php'><span class='glyphicon glyphicon-user'></span> Sign Up</a></li>
      <li><a href='./loginS.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>";
      print $noLogin;
      }
      ?>
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
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<div class="conatiner">
<div class="row">
<div class="col-md-1"></div>
<div class="col-md-11">
<?php
$category = "<h4 style='color:#349aed;'>Danh mục | ".$res->Item->PrimaryCategoryName."</h4><br><br>";
print $category;
?>
</div>
</div>
<div class="row">
<div class="col-md-1"></div>
<div class="col-md-4">
<!-- <img src='' alt='image' class='mainImg'>
<img src='' alt='image' class='subImg'>
<img src="" alt="image" class='subImg'>
<img src="" alt="image" class='subImg'>
<img src="" alt="image" class='subImg'> -->

<?php
if($res){
    $result = "";
    $result .= "<img src='".$res->Item->PictureURL[0]."' alt='image' class='mainImg' id='mainIm'>";
    for($i = 0; $i < 4; $i++){
        if(ISSET($res->Item->PictureURL[$i])){
            $result .= "<img src='".$res->Item->PictureURL[$i]."' alt='image' class='subImg'>";
        }
    }
    print $result;
}
?>
</div>
<div class="col-md-6">
<?php
$detail = "";
$detail .= "<h4 class='descript'>".$res->Item->Title."</h4>";
$detail .= "<h3 class='price'>Giá bán: <sup><u>đ</u></sup> ".($res->Item->ConvertedCurrentPrice->Value*23)."</h3>";
//$detail .= "<span>Vận Chuyển tới: </span>";
// foreach($res->Item->ShipToLocations as $location){
//   $detail .= $location.", ";
// }
$detail .= "<br><h4>".($res->Item->Quantity - $res->Item->QuantitySold)."<span class='normal'> sản phẩm có sẵn | đã bán: </span>".$res->Item->QuantitySold."</h4>";
//$detail .= "<br><h4>Phương thức thanh toán: ".."</h4>";
$detail .= "<br><h4><span class='normal'>Phương thức thanh toán: </span></h4>";
foreach($res->Item->PaymentMethods as $paym){
  $detail .= $paym." ";
}

if(ISSET($res->Item->ReturnPolicy->ReturnsWithin)){
  $detail .= "<br><h4><span class='normal'>Đổi trả: </span>".$res->Item->ReturnPolicy->ReturnsWithin."</h4>";
}
$detail .= "<br><h4><span class='normal'>Vận chuyển từ: </span>".$res->Item->Location."</h4>";
$detail .= "<br><h4><span class='normal'>Ngày kết thúc bán: </span>".substr($res->Item->EndTime,0,10)."</h4>";
$detail .= "<button type='button' class='btn' id='cart'><i class='fa fa-cart-plus'></i> Thêm vào giỏ hàng</button><span> </span>";
$detail .= "<button type='button' class='btn' id='buy'>Mua ngay</button>";
$detail .= "<br><h4><span>Phạm vi vận chuyển: </span></h4>";
foreach($res->Item->ShipToLocations as $location){
  $detail .= "<span class='normal'>".$location." </span>";//$location." ";
}
print $detail;
?>
</div>
<div class="col-md-1">
</div>
</div>
<div class="row">
<br>
<br>
<br>
<br>
<br>
<br>
</div>
<div class="row">
<div class="col-md-1"></div>
<div class="col-md-1">
<img src="https://as2.ftcdn.net/jpg/00/79/70/77/500_F_79707791_HxJyQzs3BJDsFBav0OyRi9q2LR45xpR4.jpg" class="img-circle" alt="Cinque Terre" width="100" height="100"> 
</div>
<div class="col-md-3">
<?php
$seller = "<h4>".$res->Item->Storefront->StoreName."</h4>";
$seller .= "<h4><a href='".$res->Item->Storefront->StoreURL."'>Xem Shop</a></h4>";
print $seller;

?>
</div>
<div class="col-md-3">
<?php
$seller = "<h4><span class='normal'>Điểm phản hồi: </span>".$res->Item->Seller->FeedbackScore."</h4>";
$seller .= "<h4><span class='normal'>Tỷ lệ phản hồi: </span>".$res->Item->Seller->PositiveFeedbackPercent." <span class='price'>%</span></h4>";
print $seller;
?>
</div>

<div class="col-md-4">
<?php
$seller = "<h4><span class='normal'>Top seller: </span>".(ISSET($res->Item->Seller->TopRatedSeller)? "có":"không")."</h4>";
print $seller;
?>
</div>

</div>
<div class="row">
<div class="col-md-1"></div>
<div class="col-md-10">
<h3>MÔ TẢ SẢN PHẨM:</h3>
<h4>----------------------------------</h4>
<?php
$desc = "<p style='text-align:justify;' class='descript'>".$res->Item->Description."</p>";
print $desc;
?>

</div>
<div class="col-md-1"></div>
</div>
<div class="row">
<div class="col-md-1"></div>
<div class="col-md-5">
<?php
if(ISSET($res->Item->ItemSpecifics)){
  $spec = "<h3>THÔNG TIN CẤU HÌNH:</h3><h4>----------------------------------</h4>";
  $spec .= "<table class='table table-bordered'>";
  $spec .= "<tr><th>chi tiết</th><th>mô tả</th></tr>";
  foreach($res->Item->ItemSpecifics->NameValueList as $spe){
    $spec .= "<tr><td>".$spe->Name."</td><td>".$spe->Value[0]."</td></tr>";
  }
  $spec .= "</table>";
  print $spec;
}

?>
</div>
<div class="col-md-6"></div>
</div>
<div class="row">
<div class="col-md-1"></div>
<div class="col-md-11">
<h3>ĐÁNH GIÁ SẢN PHẨM:</h3>
</div>
</div>


<!-- <div class='row'>
<div class='col-md-1'></div>
<div class='col-md-11'>
<div class='userArea'>
<img src='https://i1.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?fit=256%2C256&quality=100&ssl=1' class='img-circle' alt='Cinque Terre' width='40' height='40'>
<span>name</span>
</div>
<div class='commentArea'>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet, quibusdam.</p>
</div>
<hr style='background:#ccc;margin:10px;'>
</div>
<div class='col-md-1'></div>
</div> -->



<?php
$conn = mysqli_connect('localhost','root','123456','shopdee');
mysqli_set_charset($conn,'UTF8');
if(mysqli_connect_errno()){
  echo 'Failed to conect to MySql '.mysqli_connect_errno();
}

$query = "SELECT user.userName, comment.content FROM comment,user WHERE comment.userId=user.id AND comment.productId='$id'";

$result = mysqli_query($conn,$query);
//fetch data
$posts = mysqli_fetch_all($result,MYSQLI_ASSOC);
// var_dump($posts);
// free memory
mysqli_free_result($result);
//close connection
mysqli_close($conn);
?>

<?php foreach($posts as $post):?>

<div class='row'>
<div class='col-md-1'></div>
<div class='col-md-11'>
<div class='userArea'>
<img src='https://i1.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?fit=256%2C256&quality=100&ssl=1' class='img-circle' alt='Cinque Terre' width='40' height='40'>
<span><?php echo $post['userName'];?></span>
</div>
<div class='commentArea'>
<p><?php echo $post['content'];?></p>
</div>
<hr style='background:#ccc;margin:10px;'>
</div>
<div class='col-md-1'></div>
</div>

<?php endforeach;?>

<!-- <div class='row'>
<form action=''>
<div class='form-group'>
<div class='col-sm-1'></div>
<div class='col-sm-9'>
<input type='text' name='comment' class='form-control'>
</div>
<div class='col-sm-1'>
<input type='submit' name='submit' value='Đánh giá' class='form-control'>
</div>
<div class='col-sm-1'></div>
</div>

</form>
<br>
<br>
<br>
<br>
</div> -->
<?php
if(ISSET($userName) && ISSET($password)){
  $commentArea = "<div class='row'><form action='productDetail.php?id=$id' method='POST'><div class='form-group'><div class='col-sm-1'></div><div class='col-sm-9'><input type='text' name='comment' class='form-control'></div><div class='col-sm-1'><input type='submit' name='submit' value='Đánh giá' class='form-control btn btn-danger'></div><div class='col-sm-1'></div></div></form><br><br><br><br></div>";
  print $commentArea;

}else {
  $blockComment = "<h3 style='color:red;margin-top:10px;text-align:center;'>hãy đăng nhập để đánh giá sản phẩm</h3>";
  print $blockComment;
}
?>


<?php
if(ISSET($_POST["submit"]) && $_POST["submit"] == "Đánh giá"){
  $productId = $_GET['id'];
  if(ISSET($_POST['comment'])){
    $comment = $_POST['comment'];
    if($comment != null && $comment != ''){
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
          $query = "INSERT INTO comment (userId, productId, content) VALUES ('$userId', '$productId','$comment')";
          $result = mysqli_query($conn,$query);
          mysqli_free_result($result);
          mysqli_close($conn);
          echo "<script type='text/javascript'>window.location.href = 'productDetail.php?id=$productId';</script>";
      }else {
        echo "<div align=center id='arl'>Lỗi xác thực user!<div>";
        mysqli_free_result($result);
        mysqli_close($conn);
    }
    }else {
      $message = "hãy nhập bình luận trước khi gửi!";
      echo "<script type='text/javascript'>alert('$message');</script>";
    }
  }
}
?>
</div>
<script>
var imgs = document.getElementsByClassName('subImg');
for(let img of imgs){
    img.addEventListener('mouseover',(e)=>{
        //console.log(e.target);
        document.getElementById('mainIm').src = e.target.src;
    });
}


var des = document.getElementsByClassName('descript');

async function gett(array){
  for(item of array){
    //console.log(item)
    let data = await delay(item.innerHTML);
    item.innerHTML = data.traslated;
  }
}
gett(des);
//processTrans(des);

function getTranslate(text){
  let url = `https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20181013T203345Z.3b4d582554598341.418d371251b3cc0e32f3264377db18cd929a9779&text=${text}&lang=en-vi&format=plain`;
  url = encodeURI(url);
  return new Promise((resolve, reject)=>{
      axios.get(url)
      .then((res)=>{
          resolve({ traslated: res.data.text[0]});
      })
      .catch((err)=>{
          debug(err);
      });
  });
}

async function delay(text){
  return await getTranslate(text);
}

async function processTrans(array){
  for(const item of array){
  let data = await delay(item.innerHtml);
  // console.log('-------'+data.traslated);
}
}


</script>
</body>
</html>

