<?php

/*
 * This is a convenience class whose main purpose is to return a formatted
 * view of a single item suitable for browsing, and buying/bidding
 * Based on the listingType we get various behavior like buy vs bid etc.
 */
 
error_reporting(E_ALL);          // useful to see all notices in development 
require_once('./keys.php'); 
 

class SingleItem 
{    
    public $resp;               // Entire response to GetSingleItem as a Simple XML object
    public $respShip;           // Entire response to GetShippingCosts
    public $quantityAvailable;  // convenience data member 
    
    function __construct($itemID, $includeDesc = false)  {
        $this->getItemResp($itemID, $includeDesc); 
        $this->getShipResp($itemID);
        
        $this->quantityAvailable = $this->resp->Item->Quantity - $this->resp->Item->QuantitySold;
    } // __construct
     
    private function getItemResp($itemID, $includeDesc) {
        global $shoppingURL, $appID, $compatabilityLevel;         // from keys.php
        
        if ($includeDesc) {
            $includeSelector = "ShippingCosts,Details,Description";
        } else {
            $includeSelector = "ShippingCosts,Details";
        }
        
        // Construct the GetSingleItem REST call         
        $apicall = "$shoppingURL?callname=GetSingleItem&version=$compatabilityLevel"
                 . "&appid=$appID&ItemID=$itemID"
                 . "&responseencoding=XML"
                 . "&IncludeSelector=$includeSelector"; 
        $resp = simplexml_load_file($apicall);
        //print_r($resp);
        
        // Check to see if the response was loaded, else print an error
        if ($resp) {
            $this->resp = $resp;
        } else {
            echo "Response not received in class SingleItem \n";
            die;
        }
    } // function
    
    private function getShipResp($itemID) {
        global $shoppingURL, $appID, $compatabilityLevel;         // from keys.php
        // Construct the REST call 
        
        $apicall = "$shoppingURL?callname=GetShippingCosts&version=$compatabilityLevel"
                 . "&appid=$appID&ItemID=$itemID"
                 . "&responseencoding=XML"
                 . "&IncludeDetails=true"
                 . "&DestinationCountryCode=US"
                 ; 
        $resp = simplexml_load_file($apicall);

        // Check to see if the response was loaded, else print an error
        if ($resp) {
            $this->respShip = $resp;
            //print "<pre>ShippingCosts";
            //print_r($this->respShip);
            //print "</pre>";
        } else {
            echo "Response not received in class SingleItem for GetShippingCosts \n";
            die;
        }
    } // function
    
    
    public function getDetailsAsHTML_Div() {
        global $feedbackURL;    // comes from keys.php
        $retn = '';
        //$retn  = '<div id="box"><a href="#' . $this->resp->Item->ItemID . '" class="close">[x]</a><br />';

        $retn .= sprintf("Current Price : %01.2f<BR>\n", $this->resp->Item->CurrentPrice);
        if (isset($this->resp->Item->Quantity)) {
            $retn .= "Quantity available : " . $this->quantityAvailable . "<BR>\n";
        }
        if ( $this->resp->Item->ListingType == 'Chinese' ) {
            $retn .= 'History : ' . $this->resp->Item->BidCount . " bid" . $this->pluralS($this->resp->Item->BidCount) . "<BR>\n";
        } else {
            $retn .= "Buy it Now - Fixed Price Item<BR>\n";
        }
        $retn .= "Time Left : " . $this->getPrettyTimeFromEbayTime($this->resp->Item->TimeLeft) . "<BR>\n";
        $retn .= "ItemID : " . $this->resp->Item->ItemID . "<BR>\n";
        
        // Launch separate window for description.  Need semi-complex JavaScript to 
        // prevent Firefox 2.x from simply launching in a separate tab
        $aTagHead = '<a href="#'  . $this->resp->Item->ItemID . "\" onclick=\"window.open('";
        $url = "./ShowDescriptionForItem.php?ItemID=" . $this->resp->Item->ItemID . "'";
        $aTagTail = "return false;\">See full description</a>";
        $browserWinOpts = "'toolbar=no,location=yes,directories=no,resizable=yes,scrollbars=yes,height=500,width=700');";
        $retn .= $aTagHead. $url . ", '_blank'," . $browserWinOpts . $aTagTail . "<BR>\n";
        //$retn .= 'Shipping cost : ' . $this->resp->Item->ShippingCostSummary->ShippingServiceCost . "<BR>\n";
        $sellerID = $this->resp->Item->Seller->UserID;
        $retn .= "Seller : <a href=\"" . $feedbackURL. "?ViewFeedback2&userid=" . $sellerID . "&ftab=AllFeedback\">$sellerID</a>" 
              .  ' (' . $this->resp->Item->Seller->FeedbackScore . ")<BR>\n";
        
        $retn .= '<BR><a href="#" id="trigger">Shipping Details</a>' .  "\n";
        $retn .= '<div id="box"><a href="#" class="close">[x]</a><br />';
        $retn .= $this->getShippingInfoAsHTML_Table();
        $retn .= '</div>';
        return $retn;
        
    } // function
    
    public function getBrowseItemAsHTML_Table() {
        $retn =  '';
        $retn .= "<TABLE> <!-- Start of full table for item n --> \n";
        $retn .= "<TR>    <!-- Start of row for item n --> \n";
        if (isset($this->resp->Item->GalleryURL)) {
            $picURL = $this->resp->Item->GalleryURL;
        } else {
            $picURL = "http://pics.ebaystatic.com/aw/pics/express/icons/iconPlaceholder_96x96.gif";
        }
        $retn .= "<TD width=\"30%\" align=right><IMG SRC=\"" . $picURL .   "\"/></TD>  <!-- cell for image --> \n";
        $retn .= "<TD width=\"70%\">     <!-- cell for details including collapsible portion --> \n";
        $retn .= "<table width=\"100%\"> <!-- Start of table for details for item 1.  Need this table since we have collapsible rows --> \n";
        $retn .= "  <tr>  <!-- row for item title --> \n";                 
        $retn .=  '<A HREF="' . $this->resp->Item->ViewItemURLForNaturalSearch 
              . '">' . $this->resp->Item->Title . '</A></p>';
        $retn .= "</tr> \n";
        if ( (string)$this->resp->Item->ReserveMet == 'false') {
            $retn .= "<tr><td><b>Reserve not met</b><BR></td><tr>\n";
        }   
        $retn .= "<tr>  <!-- row for collapsible details --> \n";
        $retn .= "  <td> \n";
        $retn .=  $this->getDetailsAsHTML_Div();
        $retn .= "    </td> \n";
        $retn .= "  </tr> \n";
        $retn .= "<tr>  <!-- row for bid/buy --> \n";
        $retn .= "  <td> \n";
        $retn .= "  </td> \n";
        $retn .= "</tr> \n";         
        $retn .= "  </table> <!-- End of table for details for item n --> \n";
        $retn .= "</TD>   \n";
        $retn .= "</TR> \n";
        $retn .= "</TABLE> <!-- End of table for item n --> \n";
        return $retn;
    } // function
    
    
    public function getShippingInfoAsHTML_Table() {
        $retn  = '';
        $retn .= "<TABLE>\n";
        if ($this->respShip->Ack == 'Failure') {
            $retn .= '<TR><TD>' . $this->respShip->Errors->LongMessage . "</TD></TR>\n";
        } else {
            $retn .= "<TR><TH ALIGN=LEFT>Ships to</TH><TH ALIGN=LEFT>Shipping service</TH><TH ALIGN=LEFT>Cost</TH></TR>\n";
            foreach ($this->respShip->ShippingDetails->InternationalShippingServiceOption as $shipOptXml) {
                // $shipOptXml is a Simple XML object
                $retn .= sprintf('<tr><td>%s</td><td>%s</td><td>%01.2f</td></tr>'
                      , $shipOptXml->ShipsTo, $shipOptXml->ShippingServiceName, $shipOptXml->ShippingServiceCost);
            }
        }
        $retn .= "</TABLE>\n"; 
        return $retn;
    }  // function
    
    
    // example $action value =  "./PlaceOffer.php"
    public function getBiddingFormAsHTML_Table($action) {
        $retn  = '';
        $retn .= "<FORM NAME=\"BidForm\" method=\"post\" action=\"". $action . "\" >";
        $retn .= "<FORM>\n";
        $retn .= "<TABLE>\n";
        $retn .= "<TR><TD>Enter your maximum bid:</TD></TR>\n";
        $retn .= "<TR><TD><INPUT TYPE=\"Text\" NAME=\"MaxBid\" MAXLENGTH=\"6\" SIZE=\"25\"></TD>";
        $retn .= "    <TD><INPUT TYPE=\"Submit\" NAME=\"PlaceOffer\" VALUE=\"Place Bid\"></TD></TR>\n";
        $retn .= sprintf("<TR><TD><font size=\"1\">(Enter %01.2f or higher)</font></TD><TR>\n", $this->resp->Item->MinimumToBid);
        $retn .= "</TABLE>\n";
        $retn .= "</FORM>";
        return $retn;
    } // function
    
    // example $action value =  "./PlaceOffer.php"
    public function getBuyingFormAsHTML_Table($action) {
        $quantityAvailable = $this->resp->Item->Quantity - $this->resp->Item->QuantitySold;
        // Determine BuyItNow price or FixedListingPrice
        if (!empty($this->resp->Item->BuyItNowPrice)) {
            $purchasePrice = $this->resp->Item->BuyItNowPrice;
        } else {
            $purchasePrice = $this->resp->Item->CurrentPrice;
        }
        $retn  = '';
        $retn .= "<FORM NAME=\"BuyForm\" method=\"post\" action=\"". $action . "\" >";
        $retn .= "<FORM>\n";
        $retn .= "<TABLE>\n";
        $retn .= "<INPUT TYPE=\"hidden\" NAME=\"MaxBid\" value=\"" . $purchasePrice . "\"></TD>";
        $retn .= "<TR><TH>Purchase this item :</TH></TR>\n";
        $retn .= sprintf("<TR><TD>Buy at price : %01.2f</TD></TR>\n", $purchasePrice);
        if ($quantityAvailable > 1) {
            $retn .= "<TR><TD>Quantity to buy ($this->quantityAvailable available):";
            $retn .= "<INPUT TYPE=\"Text\" NAME=\"Quantity\" MAXLENGTH=\"6\" SIZE=\"6\"></TD></TR>";
        }
        $retn .= "    <TD ALIGN=CENTER><INPUT TYPE=\"Submit\" NAME=\"PlaceOffer\" VALUE=\"Buy\"></TD></TR>\n";
        $retn .= "</TABLE>\n";
        $retn .= "</FORM>";
        return $retn;
    } // function
    
    private  function getPrettyTimeFromEbayTime($eBayTimeString){
        // Input is of form 'P4DT23H41M34S'
        $matchAry = array(); // initialize array which will be filled in preg_match
        $pattern = "#P([0-9]{0,3}D)?T([0-9]?[0-9]H)?([0-9]?[0-9]M)?([0-9]?[0-9]S)#msiU";
        preg_match($pattern, $eBayTimeString, $matchAry);
        
        $retnStr = '';
                
        if ($matchAry) {
        $days  = (int) $matchAry[1];
        $hours = (int) $matchAry[2];
        $min   = (int) $matchAry[3];    // $matchAry[3] is of form 55M - cast to int 
        $sec   = (int) $matchAry[4];
        }
        if ($days)  { $retnStr .= "$days day"    . $this->pluralS($days);  }
        if ($hours) { $retnStr .= " $hours hour" . $this->pluralS($hours); }
        if ($min)   { $retnStr .= " $min minute" . $this->pluralS($min);   }
        if ($sec)   { $retnStr .= " $sec second" . $this->pluralS($sec);   }
        
        return $retnStr;
    } // function
    
    private function pluralS($intIn) {
        // if $intIn > 1 return an 's', else return null string
        if ( ($intIn > 1) || ($intIn == 0) ) {
            return 's';
        } else {
            return '';
        }
    } // function
    
} // class GetSingleItem





?>