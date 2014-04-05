<?php

// get the adid from query param
$google_ad_id = $_GET['gadid'];

function lookup_google_ad_id($id) {
    // TO-DO lookup ad info in memcache
    // if ad info not found, show some default ads
    $ad_info = array("ad_client" => "ca-pub-7827283540952564",
                     "ad_comment" => "/* 728x90_valetourism */",
                     "ad_slot" => "7880705603",
                     "ad_width" => 728,
                     "ad_height" => 90);
    return $ad_info;
}

$ad_info = lookup_google_ad_id($google_ad_id);
$ad_client = $ad_info['ad_client'];
$ad_slot = $ad_info['ad_slot'];
$ad_comment = $ad_info['ad_comment'];
$ad_width = $ad_info['ad_width'];
$ad_height = $ad_info['ad_height'];

header('Content-Type: application/javascript');
// TO-DO add tracking
echo <<<END
google_ad_client = "$ad_client";
$ad_comment
google_ad_slot = "$ad_slot";
google_ad_width = $ad_width;
google_ad_height = $ad_height;
END;
?>
