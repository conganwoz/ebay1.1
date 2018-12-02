<?php 
require_once('./sessionHeader.php');
require_once('./SingleItem.php');
require_once('./Offer.php');
require_once('./keys.php');
require_once('./Token.php');

error_reporting(E_ALL);          // useful to see all notices in development



if (@!$_SESSION['loginState']) {    //  @ to suppress notice of undefined loginState
    $_SESSION['loginState'] = 'unknown';
} elseif (@$_SESSION['token']) {
    $_SESSION['loginState'] = 'loggedIn';      // redirect to BidBuy.php
}


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

<p><a onclick="alert('You will be logged out and redirected to the search page')" href="./Logout.php">Logout</a></p>

<?php

// By this stage, we should have the following defined :
// $_SESSION['loginState'] = 'loggedIn'
// $_SESSION['username']  - but not really needed once we have token
// $_SESSION['sid'] - secret ID for getting token - but not needed once we have token
// $_SESSION['token'] = our eBay token

$offerItem = new SingleItem($_SESSION['ItemID']);

$results = '';
if ( empty($_REQUEST['MaxBid']) && empty($_REQUEST['Quantity']) ) { 
    $results .= getHTML_ForInitialBidCase($offerItem); // We do not know what MaxBid is yet
} else {
    $results .= getHTML_ForRebidCase($offerItem);
}

print $results;

//================ Convenience functions for this page 

function getHTML_ForInitialBidCase($offerItem) {
    // This is for the normal case where The person hasn't bid yet
    $retn = '';
    $offerItem  = new SingleItem($_SESSION['ItemID'], false);  // false => don't include desc
    $retn .= "<DIV ALIGN=CENTER> \n";
    $retn .= "<TABLE><TR><TD> \n";
    $retn .= $offerItem->getBrowseItemAsHTML_Table();
    $retn .= "</TD></TR></TABLE>\n";
    
    if ( (isset($_SESSION['token']) && $_SESSION['loginState'] == 'loggedIn') ) {                // a bit stronger than a simple token existence check      
        if ($offerItem->resp->Item->ListingType == 'Chinese') {
            //print "Getting Chinese form<br>";
            $retn .= $offerItem->getBiddingFormAsHTML_Table('./PlaceOffer.php');
        } else {
            $retn .= $offerItem->getBuyingFormAsHTML_Table('./PlaceOffer.php');   
        }
    } else {
        $retn .= "ERROR - We don't have a token";
    }
    $retn .= "</DIV> \n";
    return $retn;
} // function


function getHTML_ForRebidCase($offerItem) {
    global $debug;  // from keys.php
    // This is for case where we have a bid submitted
    if ( !(empty($_REQUEST['Quantity']))  && (is_numeric($_REQUEST['Quantity'])) ) { 
        $Quantity = $_REQUEST['Quantity'];
    } else {
        $Quantity = 1;
    }   
    if ( ($offerItem->resp->Item->ListingType == 'FixedPriceItem') ||
         ($offerItem->resp->Item->ListingType == 'StoresFixedPrice') ) {
        $Action = 'Purchase';  // action needed in PlaceOffer call
    } else {
        $Action = 'Bid';
    }    
    $offerObj = new Offer($_SESSION['username'], $_SESSION['token'], $_SESSION['ItemID'], $_REQUEST['MaxBid'], $Quantity, $Action);  // submit offer 
    $retn = '';

    if ($debug) { 
        print "<pre>";       // $debug from keys.php
        print_r($offerObj);
        print "</pre>";
    }
    
    if ($offerObj->resp) {    
        $retn .= "<DIV ALIGN=CENTER> \n";
        // If the response was loaded, parse it and build links   
        $retn .= $offerItem->getBrowseItemAsHTML_Table();
        
        // Special handling for 12210 (bid too low), otherwise generic error handling
        if ($offerObj->resp->Errors) {
            if ($offerObj->resp->Errors->ErrorCode == '12210') {
                $retn .= $offerItem->getBiddingFormAsHTML_Table('./PlaceOffer.php');  // allow bidder to bid again
            } else {
                $retn .= "<b>Some error happened!</b><br>";    
            }
            $retn .= $offerObj->getErrorHTML();
        } else {
            // Provide another bid form so 'successful' (but non-high) bidder can raise bid if desired
            if ( ($offerObj->offerPlaced()) && ($Action == 'Bid') ) {
                $retn .= $offerObj->getOfferPlacedHTML();
                if (!$offerObj->bidPlacerIsHighBidder) {
                    $retn .= $offerItem->getBiddingFormAsHTML_Table('./PlaceOffer.php');  // allow bidder to bid again    
                }
            } elseif ( ($offerObj->offerPlaced()) && ($Action == 'Purchase') ) {
                $retn .= $offerObj->getOfferPlacedHTML();
            } else {
                $retn .= "<BR>You were successful, but we don't know at what!!<BR>\n";
            }   
        }  // if 
    
    } else {
        $retn .= "ERROR - We did not get an offer object back";
    }    
    $retn .=  "</DIV> \n";
    return $retn;
} // function



?>

</BODY>
</HTML>
