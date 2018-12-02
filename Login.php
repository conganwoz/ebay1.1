<?php
require_once('./sessionHeader.php');
require_once('./SingleItem.php');
require_once('./keys.php');
require_once('./Token.php');

if ($debug) {
    print "<pre> SESSION = ";
    print_r($_SESSION);
    print "POST = ";
    print_r($_POST);
    print "</pre>";
}


if (isset($_POST['loginPending'])) {
    $_SESSION['loginState'] = 'pending';
} elseif (!isset($_SESSION['loginState'])) {
    $_SESSION['loginState'] = 'unknown';
} elseif (isset($_SESSION['token'])) {
    $_SESSION['loginState'] = 'loggedIn';      // redirect to BidBuy.php
}

if ($debug) {
    print "<pre> SESSION = ";
    print_r($_SESSION);
    print "</pre>";
}

error_reporting(E_ALL);          // useful to see all notices in development
?>

<HTML>
<HEAD>
  <TITLE>Bidding On Items</TITLE>
  <link rel="stylesheet" type="text/css" href="style.css" />

<script type="text/javascript" src="js/JQuery.js"></script>
<script type="text/javascript" src="js/ShowDetails.js"></script>
</HEAD>


<BODY>
<H1>Bidding On Items</H1>

<?php

if ( ($_SESSION['loginState'] == 'pending') || ($_SESSION['loginState'] == 'loggedIn') ) {
    print "<p><a onclick=\"alert('You will be logged out and redirected to the search page')\" href=\"./Logout.php\">Logout</a></p>\n";
}

$results = '';
$results .= "<DIV ALIGN=CENTER> \n";
$results .= "<TABLE><TR><TD> \n";
// If the response was loaded, parse it and build links
$browseItem = new SingleItem($_SESSION['ItemID']);
$results .= $browseItem->getBrowseItemAsHTML_Table();
$results .= "</TD></TR></TABLE>\n";

if ($_SESSION['loginState'] == 'pending') {
    // Note we can only successfully go looking for the token after the user has
    // hit Continue - meaning it's OK to continue and look for the token
    $results .= "<form	name=\"form_auth\" method=\"get\" action=\"./VerifyToken.php\" >";
    $results .= "<INPUT TYPE=\"submit\" NAME=\"ContinueToVerifyToken\" VALUE=\"Continue to verify token\">";
    if (@!$_SESSION['username']) {
        $_SESSION['username'] = $_REQUEST['username'];
    }
    if ($debug) {
        print "<pre> SESSION = ";
        print_r($_SESSION);
        print "</pre>";
    }
} elseif ($_SESSION['loginState'] == 'unknown')  {
    if (@!$_SESSION['sid']) {        // @ to suppress warnings
        $_SESSION['sid'] = md5(uniqid(rand(), true));  // secret ID for FetchToken request
    }
	// Get session ID for the Auth & Auth, save it in session variable for subsequent FetchToken
	// call in Token.php.
	$verb1 = 'GetSessionID';

	///Build the request Xml string
	$requestBody1 = '<?xml version="1.0" encoding="utf-8" ?>';
	$requestBody1 .= '<GetSessionIDRequest xmlns="urn:ebay:apis:eBLBaseComponents">';
	$requestBody1 .= "<Version>$compatabilityLevel</Version>";
	$requestBody1 .= "<RuName>$runame</RuName>";
	$requestBody1 .= '</GetSessionIDRequest>';

	//Create a new eBay session with all details pulled in from included keys.php
	$sessN = new eBaySession($devID, $appID, $certID, $serverUrl, $compatabilityLevel, $siteID, $verb1);
	//send the request and get response
	$responseBody1 = $sessN->sendHttpRequest($requestBody1);

	if(stristr($responseBody1, 'HTTP 404') || $responseBody1 == '')
		die('<P>Error sending request');


	$resp1 = simplexml_load_string($responseBody1);
	$_SESSION['ebSession']  = (string)$resp1->SessionID;

	$sesId = urlencode($_SESSION['ebSession']);
    $results .= "<form	name=\"form_auth\" method=\"post\" action=\"./Login.php\" >";
    $results .= "<table><tr>\n<td>eBay User ID:</td> <td align=\"left\">"
             .  "<input	type=\"text\" name=\"username\" size=\"50\" maxlength=\"50\"></td>\n";
    // loginURL and runame in next line comes from the required keys.php file
    $results .= "<td><INPUT TYPE=\"submit\" NAME=AUTHORIZE VALUE=\"Launch Auth & Auth\" "
            .  "onclick=\"window.open('$loginURL?SignIn&runame=$runame&SessID=$sesId');\">\n";
    $results .= "</td></tr></table>\n";
    // use hidden field to retain fact that we're waiting on outcome of Auth and Auth call
    $results .= "<input type=\"hidden\" name=\"loginPending\" value=\"true\">\n";

}

$results .= "</form>\n";
$results .= "</DIV> \n";

print $results;

?>

</BODY>
</HTML>
