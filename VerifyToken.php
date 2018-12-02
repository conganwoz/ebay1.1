<?php
require_once('./sessionHeader.php');
require_once('./SingleItem.php');
require_once('./keys.php');
require_once('./Token.php');


if ($debug) {
    print "<pre> SESSION = ";     // $debug comes from keys.php
print_r($_SESSION);
print "POST = ";
print_r($_POST);
print "</pre>";
}


print "<br>==========Checking loginState and existence of token =============</br>\n";

if (@!$_SESSION['loginState']) {    //  @ to suppress notice of undefined loginState
    $_SESSION['loginState'] = 'unknown';
} elseif (@$_SESSION['token']) {
    $_SESSION['loginState'] = 'loggedIn';      // redirect to BidBuy.php
}

if ($debug) {
print "<pre> SESSION = ";
print_r($_SESSION);
print "REQUEST = ";
print_r($_REQUEST);
print "</pre>";
}



error_reporting(E_ALL);          // useful to see all notices in development
?>

<HTML>
<HEAD>
  <TITLE>Bidding on Items</TITLE>
  <link rel="stylesheet" type="text/css" href="style.css" />

<script type="text/javascript" src="js/JQuery.js"></script>
<script type="text/javascript" src="js/ShowDetails.js"></script>
</HEAD>


<BODY>
<H1>Verify Token</H1>

<p><a onclick="alert('You will be logged out and redirected to the search page')" href="./Logout.php">Logout</a></p>

<?php

// By this stage, we should have the following defined :
// $_SESSION['loginState'] = 'loggedIn'
// $_SESSION['username']  - but not really needed once we have token
// $_SESSION['ebSession'] - the session ID; not needed once we have token
// $_SESSION['token'] = our eBay token

$results = '';
$results .= "<DIV ALIGN=CENTER> \n";
$theID = $_SESSION['ebSession'];

// Get our token which we'll need to call PlaceOffer
$tokenObj = new Token($_SESSION['username'], $theID) ;


// Check for existence of something that looks like a token
// Should be character string of length greater than 500 chars
// This is stronger verification of a token than simply checking for existence
if (strlen($tokenObj->token) > 500) {
    $_SESSION['token'] = $tokenObj->token;
    $_SESSION['loginState'] = 'loggedIn';
    $results .= "<form	name=\"form_auth\" method=\"post\" action=\"./PlaceOffer.php\" >";
    $results .= "<INPUT TYPE=\"submit\" NAME=\"ContinueToBid\" VALUE=\"Continue to Bid / Buy\">";
    print "<p>TOKEN : $tokenObj->token </p>";
} else {
    $results .= "ERROR - We did not get a token";
}

$results .= "</form>\n";
$results .= "</DIV> \n";

print $results;


?>


</BODY>
</HTML>
