<?php
session_cache_expire(1);                    // expire session in x minutes
session_cache_limiter('private');           // don't allow proxies to hold session vars
ini_set('session.use_only_cookies', true);  // don't allow session vars in URLs
ini_set('session.gc_maxlifetime', 900);     // max time for session variables in seconds
ini_set('session.cookie_lifetime', 900);    // max time for cookie in seconds 
ini_set('session.gc_probability', 100);     // we want a 100 pct chance of garbage collection
ini_set('session.gc_divisor', 100);         // we want a 100 pct chance of garbage collection
ini_set('session.save_path', 'D:\temp');    // Store sessions in non-default, more protected directory
//ini_set('session.cookie_secure', true);   // only allow cookies thru HTTP
ini_set('session.cookie_httponly', true);   // reduce chance of XSS capture
session_start(); 
?>
