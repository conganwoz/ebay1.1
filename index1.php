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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <title>ShopDee | mainpage</title>
    <style>
    nav {
        padding: 10px;
        background-image: linear-gradient(145deg, #349aed 50%, #34d8ed 100%);
        margin-bottom: 5px;
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
<div class="container">
<div class="row">
<div class="col-sm-12">
<h1 style="color:#000;margin-top:180px;" id="desc">Sản phẩm phổ biến:</h1>
</div>
</div>
<div class="row" id='dataRow' style="margin-top:20px;">

<?php
$url = "http://svcs.ebay.com/MerchandisingService?OPERATION-NAME=getMostWatchedItems&SERVICE-VERSION=1.0.0&CONSUMER-ID=AnLuu-itemFin-PRD-6820bcb98-498148e7&RESPONSE-DATA-FORMAT=JSON&maxResults=20&categoryId=293";
// $ch = curl_init($apical);
// curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept:application/json, Content-Type:application/json']);
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

$handle = curl_init();
curl_setopt($handle, CURLOPT_URL, $url);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($handle);
curl_close($handle);
$res = json_decode($data);
$index = -1;
if($res){
  $prods = $res->getMostWatchedItemsResponse->itemRecommendations->item;
  foreach($prods as $item){
    $price = 0;
    foreach($item->buyItNowPrice as $p){
      if($p != 'USD'){
        $price = $p*23;
      }
    }
    $index++;
    $result = "";
    $result .= "<div class='col-md-3' style='height:40vh;'><div class='thumbnail'>";
    $result .= "<a href='productDetail.php?id=".$item->itemId."'>";
    $result .= "<img src='".$item->imageURL."' alt='Lights' style='width:100%;height:25vh;'>";
    $result .= "<div class='caption'>";
    $result .= "<p class='descript' id='a".$index."'>".$item->title."</p>";
    $result .= "<p><span style='color:red;'>Giá:</span> ".$price." VNĐ</p>";
    $result .= "</div></a></div></div>";
    print $result;
  }
  
}
?>
</div>
<script>
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
<!--trnsl.1.1.20181013T203345Z.3b4d582554598341.418d371251b3cc0e32f3264377db18cd929a9779-->