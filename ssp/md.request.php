<?php
/* Adskom Ad Request */

require_once 'init.php';

require_once 'initLogger.php';
$log = Logger::getLogger('md.request');
$log->debug("start md.request");

//error_reporting(0);

// cookie handling
require_once '../common/cookie_utils.php';

$cookie_name = "_i";  // adskom's interest cookie for behavorial targeting, demo, geo, additional frequency caps, etc

// delete cookie
//setcookie ($cookie_name, "", time() - 3600);

// TODO: set real cookie data
$cookie_data = "key1=val1|key2=val2";
handle_user_cookie($cookie_name, $cookie_data);



require_once 'functions/r_f.php';

$log->debug("start calling ad_request");
ad_request($_GET);
$log->debug("end calling ad_request");
$log->debug("end md.request");

?>
