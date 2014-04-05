<?php

require_once 'initBeaconLogger.php';
$log = Logger::getLogger('t.php');
$log->debug("start t.php");

require_once '../common/cookie_utils.php';

$cookie_name = "_i";  // adskom's interest cookie for behavorial targeting, demo, geo, additional frequency caps, etc

// delete cookie
//setcookie ($cookie_name, "", time() - 3600);

// TODO: set real cookie data
$cookie_data = "key1=val1|key2=val2";
handle_user_cookie($cookie_name, $cookie_data);

header( 'Content-type: image/gif' );
# The transparent, beacon image
echo chr(71).chr(73).chr(70).chr(56).chr(57).chr(97).
chr(1).chr(0).chr(1).chr(0).chr(128).chr(0).
chr(0).chr(0).chr(0).chr(0).chr(0).chr(0).chr(0).
chr(33).chr(249).chr(4).chr(1).chr(0).chr(0).
chr(0).chr(0).chr(44).chr(0).chr(0).chr(0).chr(0).
chr(1).chr(0).chr(1).chr(0).chr(0).chr(2).chr(2).
chr(68).chr(1).chr(0).chr(59);
?>

