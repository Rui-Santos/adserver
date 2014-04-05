<?php
/* 
 * File: cookie_utils.php 
 * Desc: shared library for cookie manipulation
 */

// cookie format is the following
// key1=val1|key2=val2
// returns associative array
function breakup_vars($cookie_string, $delim="=") {
    global $log;
    $array = null;
    if ($cookie_string) {
        $log->debug("cookie_string=$cookie_string");
        $array = explode("|", $cookie_string);
        foreach ($array as $i => $stuff) {
            $stuff= explode($delim, $stuff);
            if (isset($stuff[0]) && isset($stuff[1])) {
                $array[$stuff[0]]=$stuff[1];
            }
            unset($array[$i]);
        }
    }
    return $array;
}

function handle_user_cookie($cookie_name, $cookie_data) {
    global $log;
    $expiration = 86400; // 1 day
    $log->debug("start get_user_cookie $cookie_name");
    if (isset($_COOKIE[$cookie_name]) && !empty($_COOKIE[$cookie_name])) {
        $log->debug("found $cookie_name");
        $user_cookie = breakup_vars(base64_decode($_COOKIE[$cookie_name]));

        if ($user_cookie) {
           // TODO: do something with the user_cookie
           // modify/update values
            while (list($k, $v) = each($user_cookie)) {
                $log->debug("$k => $v");
            }
        }
        else {
            $log->debug("user_cookie is empty");
        }
    } 
    else {
        // set cookie with 1 day expiration time
        setcookie($cookie_name,base64_encode($cookie_data), time() + $expiration, '/', 'adskom.com');
    }
}
