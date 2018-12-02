<?php

/*
 * This file contains the Offer class. The Offer class provides functionality
 * for creating a PlaceOffer request.
*/
 
error_reporting(E_ALL);          // useful to see all notices in development 
require_once('sessionHeader.php');
require_once('keys.php');
require_once('eBaySession.php');
require_once('SingleItem.php');


class Offer 
{    
    public $resp;             // This is the entire response as a Simple XML object
    public $bidderUserID;     // Need to track to see if bidder is high bidder
    public $itemID;           // make public for convenient reading - meant to be read-only
    public $maxBid;
    public $quantity;
    public $action;           // Either 'Bid' or 'Purchase'
    public $itemObj;          // SingleItem 
    public $bidPlacerIsHighBidder = false;  // Just for bidding.  If bidder is not high bidder, re-show bid form
    //public $errorCode = NULL; // This 
 
    function __construct($bidderUserID, $token, $itemID, $maxBid, $quantity = 1, $action = 'Bid', $userConsent = true)  
    {        
        global $devID, $appID, $certID, $serverUrl, $compatabilityLevel, $siteID; // defined in keys.php
        
        // set up instance variables
        $this->bidderUserID = $bidderUserID;
        $this->itemID       = $itemID;
        $this->maxBid       = $maxBid;
        $this->quantity     = $quantity;
        $this->action       = $action;    // Action is either 'Bid' or 'Purchase'
            
        // Could cache item as session variable, but better to re-get for freshest info 
        $this->itemObj = new SingleItem($itemID);  // Get a new item
            
        //the call being made:
        $verb = 'PlaceOffer';       
        
        $myIP   = '000.000.0.0';  // use the client's external IP address          
        
        ///Build the request Xml string
        $requestXmlBody = '<?xml version="1.0" encoding="utf-8" ?>';
        $requestXmlBody .= '<PlaceOfferRequest xmlns="urn:ebay:apis:eBLBaseComponents">';
        $requestXmlBody .= "<RequesterCredentials><eBayAuthToken>$token</eBayAuthToken></RequesterCredentials>";
        $requestXmlBody .= "<EndUserIP>$myIP</EndUserIP>";
        $requestXmlBody .= '<BlockOnWarning>true</BlockOnWarning>';
/* BEGIN AFFILIATE TRACKING - ONLY SUPPORTED IN PRODUCTION - NOT IN SANDBOX
        $requestXmlBody .= '<AffiliateTrackingDetails>';
        $requestXmlBody .= '  <AffiliateUserID>12345</AffiliateUserID>';       
        $requestXmlBody .= '  <ApplicationDeviceType>Browser</ApplicationDeviceType>';
        $requestXmlBody .= '  <TrackingID>Insert your tracking ID here</TrackingID>';                 
        $requestXmlBody .= '  <TrackingPartnerCode>5</TrackingPartnerCode>';   
        $requestXmlBody .= '</AffiliateTrackingDetails>';
   END AFFILIATE TRACKING - ONLY SUPPORTED IN PRODUCTION - NOT IN SANDBOX */
        $requestXmlBody .= "<ItemID>$itemID</ItemID>";
        $requestXmlBody .= '<Offer>';
        $requestXmlBody .= "<Action>$action</Action>";
        $requestXmlBody .= "<MaxBid>$maxBid</MaxBid>";
        $requestXmlBody .= "<Quantity>$quantity</Quantity>";
        $requestXmlBody .= "<UserConsent>$userConsent</UserConsent>";
        $requestXmlBody .= '</Offer>';        
        $requestXmlBody .= '</PlaceOfferRequest>';
        
        //Create a new eBay session with all details pulled in from included keys.php
        $session = new eBaySession($devID, $appID, $certID, $serverUrl, $compatabilityLevel, $siteID, $verb);
        //send the request and get response
        $responseXml = $session->sendHttpRequest($requestXmlBody);
        
        if(stristr($responseXml, 'HTTP 404') || $responseXml == '')
            die('<P>Error sending request');
        
        //print "RESPONSE_XML = \n $responseXml \n\n";  
        $this->resp = simplexml_load_string($responseXml);
        
    } // __construct
    
    
    // Convenience method to tell if offer was successful
    // Note placing an offer does not mean you're the high bidder!
    public function offerPlaced() {
        if ($this->resp->Ack == 'Success') {
            return true;
        } else {
            return false;
        }
    } // function 
    
    // return formatted HTML message after a successful offer
    // Success means more than the bid was successfully entered.  
    // Success means your offer was entered AND you are now the high bidder
    // Note a real application should check input to ensure it's numeric an not holding scripts
    public function getOfferPlacedHTML() {
        $retn = '';
        if ( $this->offerPlaced() ) { 
            if ($this->action == 'Bid') {
                $retn .= $this->getSuccessfulBidPlacedHTML();
            } else {
                $retn .= $this->getSuccessfulPurchaseHTML();
            }
        } else {
            $retn = "<P>Sorry, your offer was not placed.</P>";
        }
        return $retn;     
    } // function
  

    public function getSuccessfulBidPlacedHTML() {
        $retn = '';
        $retn .= "<br>You are user " . $this->bidderUserID . "<br>\n";
        $retn .= sprintf("<p>Your maximum bid of %01.2f was placed. <br>\n", $this->maxBid);
        if ($this->resp->SellingStatus->HighBidder->UserID == $this->bidderUserID) {
            $retn .= "You are the high bidder! <br>\n";
            $this->bidPlacerIsHighBidder = true;
        } else {
            $retn .= "Although your maximum bid was entered, <b>you are not the high bidder</b><br>\n";
            $retn .= "<b>The high bidder is " . $this->resp->SellingStatus->HighBidder->UserID . "</b><br>\n";   
        }
        $retn .= sprintf("The current (winning) bid is %01.2f<br>\n", $this->resp->SellingStatus->CurrentPrice);
        $retn .= sprintf("The next bid level is %01.2f<br>\n", $this->resp->SellingStatus->MinimumToBid);
        return $retn;
    } // function


    function getSuccessfulPurchaseHTML() {
        $retn = '';
        $retn .= "<br>You are user " . $this->bidderUserID . "<br>\n";
        $retn .= sprintf("<br>You purchased %d of this item at a price of %01.2f<br>\n", $this->quantity, $this->maxBid);
        return $retn;   
    } // function
    
    
    
    // return formatted HTML message in case of error
    function getErrorHTML() {
        $retn = '';
        if ($this->resp->Errors) {
            $errorMsg  = $this->resp->Errors->LongMessage;
            $errorCode = (string)$this->resp->Errors->ErrorCode;  // There actually can be an array or errors - just get first
            if ($errorCode == '12210') {
                $retn .= "<br>Sorry, your bid was too low.  Please enter a new bid.";
                $retn .= sprintf("<br><b>Your minimum bid must be at least %01.2f<br>\n", $this->resp->SellingStatus->MinimumToBid);
                $retn .= "<br>High bidder = " . $this->resp->SellingStatus->HighBidder->UserID;
                $retn .= sprintf("<br>Current price = %01.2f<br>\n", $this->resp->SellingStatus->ConvertedCurrentPrice);
            } else {
                $retn .= "<br>There was an error with the offer.  Response to the Offer call :<br>\n";
                $retn .= "<br>" . $errorMsg;
                $retn .= $this->getResponseAsPHP_ArrayHTML(); // uncomment for debugging 
            }
        } // if   
        return $retn;
    } // function
    
    // convenience method to return the response for debugging
    function getResponseAsPHP_ArrayHTML() {
        $retn  = "<pre>";
        $retn .= print_r($this->resp, true);  // true means return as string, don't print to std out
        $retn .= "</pre>";
        return $retn;        
    } // function
     
} // class Offer





?>