<?php

/*
 * This is a convenience class whose main purpose is to return a token
 */

error_reporting(E_ALL);          // useful to see all notices in development
require_once('keys.php');
require_once('eBaySession.php');


class Token
{
    public $resp;  // This is the entire response as a Simple XML object
    public $token;
    public $expiration;

	function __construct($username, $theID)
    {
        global  $devID, $appID, $certID, $serverUrl, $compatabilityLevel, $siteID; // defined in keys.php

        $verb = 'FetchToken';

        ///Build the request Xml string
        $requestXmlBody = '<?xml version="1.0" encoding="utf-8" ?>';
        $requestXmlBody .= '<FetchTokenRequest xmlns="urn:ebay:apis:eBLBaseComponents">';
       // $requestXmlBody .= "<RequesterCredentials><Username>$username</Username></RequesterCredentials>";
        $requestXmlBody .= "<SessionID>$theID</SessionID>";
        $requestXmlBody .= '</FetchTokenRequest>';

        //Create a new eBay session with all details pulled in from included keys.php
        $session = new eBaySession($devID, $appID, $certID, $serverUrl, $compatabilityLevel, $siteID, $verb);
        //send the request and get response
        $responseXml = $session->sendHttpRequest($requestXmlBody);

        if(stristr($responseXml, 'HTTP 404') || $responseXml == '')
            die('<P>Error sending request');

        $resp = simplexml_load_string($responseXml);
        $this->token = (string)$resp->eBayAuthToken;  // need to cast to string (not SimpleXML element) to persist in SESSION
        $this->expiration = $resp->HardExpirationTime;


    } // __construct

} // class





?>