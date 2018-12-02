<?php
require_once('./sessionHeader.php');
require_once('./SingleItem.php');
require_once('./keys.php');
error_reporting(E_ALL);          // useful to see all notices in development
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
      <li><a href="/user/signup"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
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
          <li><a href="/category/11450">Jewelry & Watches</a></li>
          <li><a href="/category/4250">Men's Accessories</a></li>
          <li><a href="/category/4251">Women's Accessories</a></li>
          <li><a href="/category/15724">Women's Clothing</a></li>
        </ul>
    </div>


    <div class="col-sm-1 dropdown">
       <a class="dropdown-toggle" data-toggle="dropdown" style="color:#fff;" href="#">Khỏe và đẹp
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="/category/26395">Health & Beauty</a></li>
          <li><a href="/category/67588">Health Care</a></li>
          <li><a href="/category/31786">Makeup</a></li>
          <li><a href="/category/47945">Nail Care, Manicure & Pedicure</a></li>
          <li><a href="/category/31762">Shaving & Hair Removal</a></li>
        </ul>
    </div>


    <div class="col-sm-1 dropdown">
       <a class="dropdown-toggle" data-toggle="dropdown" style="color:#fff;" href="#">Động cơ
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="/category/6001">Cars & Trucks</a></li>
          <li><a href="/category/6024">Motorcycles</a></li>
          <li><a href="/category/6038">Other Vehicles & Trailers</a></li>
          <li><a href="/category/26429">Boats</a></li>
          <li><a href="/category/33743">Wheels, Tires & Parts</a></li>
          <li><a href="/category/84149">Scooter Parts</a></li>
          <li><a href="/category/7294">Cycling</a></li>
        </ul>
    </div>


    <div class="col-sm-1 dropdown">
       <a class="dropdown-toggle" data-toggle="dropdown" style="color:#fff;" href="#">Sưu tầm
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="/category/165195">Belts & Belt Buckles</a></li>
          <li><a href="/category/165196">Coasters</a></li>
          <li><a href="/category/35630">Hats & Caps</a></li>
          <li><a href="/category/95113">Lighting & Lamps</a></li>
          <li><a href="/category/165199">Posters, Prints & Paintings</a></li>
          <li><a href="/category/156198">Clothing 1950-1979</a></li>
          <li><a href="/category/156201">Clothing 1980-Now</a></li>
          <li><a href="/category/841">Shoes 1950-1979</a></li>
          <li><a href="/category/156202">Shoes 1980-Now</a></li>
          <li><a href="/category/260">Stamps</a></li>
        </ul>
    </div>


    <div class="col-sm-1 dropdown">
       <a class="dropdown-toggle" data-toggle="dropdown" style="color:#fff;" href="#">Thể thao
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="/category/64482">Sports Mem, Cards & Fan Shop</a></li>
          <li><a href="/category/27267">Basketball-NBA</a></li>
          <li><a href="/category/27283">Hockey-NHL</a></li>
          <li><a href="/category/888">Sporting Goods</a></li>
          <li><a href="/category/73980">Clothing, Shoes & Accessories</a></li>
          <li><a href="/category/179792">Martial Arts Weapons</a></li>
          <li><a href="/category/179775">Prot ective Gear</a></li>
          <li><a href="/category/179784">Training Equipment & Supplies</a></li>
          <li><a href="/category/15273">Fitness, Running & Yoga</a></li>
          <li><a href="/category/180091">Youth Clothing</a></li>
        </ul>
    </div>


    <div class="col-sm-1 dropdown">
       <a class="dropdown-toggle" data-toggle="dropdown" style="color:#fff;" href="#">Home & Garden
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="/category/26677">Bath</a></li>
          <li><a href="/category/20444">Bedding</a></li>
          <li><a href="/category/14308">Food & Beverages</a></li>
          <li><a href="/category/38173">Candy, Gum & Chocolate</a></li>
          <li><a href="/category/38178">Coffee</a></li>
          <li><a href="/category/179178">Snack Foods</a></li>
          <li><a href="/category/16086">Greeting Cards & Party Supply</a></li>
          <li><a href="/category/69197">Heating, Cooling & Air</a></li>
          <li><a href="/category/299">Household Supplies & Cleaning</a></li>
          <li><a href="/category/20620">Laundry Supplies</a></li>
          <li><a href="/category/20625">Kitchen, Dining & Bar</a></li>
          <li><a href="/category/3197">Furniture</a></li>
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
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br><br>
<br>
<br>
<H1>Browsing on eBay</H1>


<?php
global $shoppingURL, $appID, $eBayVersion, $findingURL, $compatabilityLevel, $findingVer;    // these come from keys.php
//need to urlencode the user-input keyword for the Finding API
 $safeQuery = urlencode($_POST['QueryString']);
 //construct the URL; we want to get only one returned item to keep things simple so set entriesPerPage to 1
 // (by default, only one page is returned)
 $apicall  = "$findingURL?OPERATION-NAME=findItemsAdvanced&SERVICE-VERSION=$findingVer"
 			. "&GLOBAL-ID=EBAY-US"
 			. "&SECURITY-APPNAME=$appID"
 			. "&keywords=$safeQuery"
 			. "&paginationInput.entriesPerPage=5"
 			. "&outputSelector=SellerInfo";
if ($debug) {
    print "<p>$apicall</p>";    // see what call is if we're debugging - $debug comes from keys.php
}

// Load the call and capture the document returned by the Finding API
$resp = simplexml_load_file($apicall);

// Check to see if the response was loaded, else print an error
echo gettype($resp);
if ($resp) {
    $results = '';
    if ($resp->paginationOutput->totalEntries == 0) {
        $results .= "<BR>Sorry, there were no results found\n";
    } else {
        $results .= "<DIV ALIGN=CENTER> \n";
      		 // If the response was loaded, parse it and build links
        	// To keep things simple, we're showing only the first returned item;
        foreach($resp->searchResult->item as $item) {
        	$browseItem = new SingleItem($resp->searchResult->item->itemId);
            $results .= $browseItem->getBrowseItemAsHTML_Table();
            $results .= "<form	name=\"BidOrBuyIt\" method=\"post\" action=\"./Login.php\" >\n";
            $results .= "<INPUT style='margin-bottom:30px;' TYPE=\"submit\" NAME=\"BidOrBuyIt\" VALUE=\"Bid or Buy It!\"></form>\n";
            $_SESSION['ItemID'] = (string)$browseItem->resp->Item->ItemID;  // cast to string to keep in $_SESSION
          } // for each

         $results .= "</DIV> \n";

    }
} else {
    $results = "<BR>Sorry, did not receive a search result\n";
} // if $resp

print $results;

?>
</div>
</BODY>
</HTML>
