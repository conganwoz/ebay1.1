<?php
    //show all errors - useful whilst developing
    error_reporting(E_ALL);

    // these keys can be obtained by registering at http://developer.ebay.com

    $production         = false;   // toggle to true if going against production
    $debug              = false;   // toggle to provide debugging info
    $compatabilityLevel = 681;    // eBay API version
    $findingVer = "1.8.0"; //eBay Finding API version

    //SiteID must also be set in the request
    //SiteID = 0  (US) - UK = 3, Canada = 2, Australia = 15, ....
    //SiteID Indicates the eBay site to associate the call with
    $siteID = 0;

    if ($production) {
        $devID = '';   // these prod keys are different from sandbox keys
        $appID = '';
        $certID = '';
        //set the Server to use (Sandbox or Production)
        $serverUrl   = 'https://api.ebay.com/ws/api.dll';      // server URL different for prod and sandbox
        $shoppingURL = 'http://open.api.ebay.com/shopping';
        $findingURL= 'http://svcs.ebay.com/services/search/FindingService/v1';


        // This is used in the Auth and Auth flow

        // This is an initial token, not to be confused with the token that is fetched by the FetchToken call
        $appToken = '';
    } else {
        // sandbox (test) environment
        $devID  = '04bb5c1d-6adb-41c2-b272-7abb62e1b5ed';   // insert your devID for sandbox
        $appID  = 'AnpeLuu-shopdee-SBX-07f960b4b-0d976350';   // different from prod keys
        $certID = 'SBX-7f960b4be56d-9391-477c-9162-b572';   // need three keys and one token
        //set the Server to use (Sandbox or Production)
        $serverUrl = 'https://api.sandbox.ebay.com/ws/api.dll';
        $shoppingURL = 'http://open.api.sandbox.ebay.com/shopping';
        $findingURL= 'http://svcs.sandbox.ebay.com/services/search/FindingService/v1';


        $loginURL = 'https://signin.sandbox.ebay.com/ws/eBayISAPI.dll'; // This is the URL to start the Auth & Auth process
        $feedbackURL = 'http://feedback.sandbox.ebay.com/ws/eBayISAPI.dll'; // This is used to for link to feedback

        $runame = 'Anpe_Luu-AnpeLuu-shopdee-dhhytjou';  // sandbox runame

        // This is the sandbox application token, not to be confused with the sandbox user token that is fetched.
        // This token is a long string - do not insert new lines.
        $appToken = 'AgAAAA**AQAAAA**aAAAAA**u1TeWw**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6wFk4ajD5OHow6dj6x9nY+seQ**ocQEAA**AAMAAA**abppkSHlkZNu3hsZURkkLImjpcZpG4iWM67VttzNrXDVl1ZdNdc34xZ49AqMPU1I7awCiXQkCVz0e/TsUkHhe6V5eCTvE9INw+CmhWlkxGw9Nvywp0QDFlcW6r4vQCmgQjxjNzzZ8b3Bvd7F8Qo4hoJ3UBGcb5XESHAi7067bU6ohPLaNRJJT5rMFq2N0vKS55yX7p3LlyleRmI5tPCLj+inTA+HuIlRQ088HT8GA38+8uSMmw0EXS3PIsyHcpZeWoAhv7Z+BO/s+8034LFu1NwgBQpuA40w2Njmlekhly+MIuNn67FTRlvGf2Y76W8LRc5nloYLFtesHe6KgvpLe2D76KvwJdYVlja+/bsz70giroJnLBHdggm46NTcIpubo+WNsj5lu9d0S3pqx2yyhtHT035oV4u1KeoQn4xvV/16Kd9jOJp5g1wu/CCc/4ekAHIEfWdlC2GHYNAJmKSuz3KYignLmgHdjZ+F1gqxXfCaKbhDGkSltic3IBCK8Bqv11e51H+xOfmmT6wfhGfevMML9lG7u+lRf0MNkW9R4WVHaJIe3s//nOajihJKd29liKgZh6xdSpbn5WCY+frX1O0iofw8t2az0949+JNtA+XwifZRhkxh7zpW8sI/d2/8ciH51lgEB877UoOIJisl5sOiAhMr+kZA5PA9uGzML3SAy/5DxQICZMzt2GEWq7FmExslDpxV6+BjES7e1v2zhPcc3Z6v+lRbg/ErDDoP6OEOrCIirS3ivH304nsDA3O9';
    }


?>