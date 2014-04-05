<?php 

require_once 'initWsLogger.php';
$log = Logger::getLogger('get_campaign_perf_data.php');
$log->debug("start get_campaign_perf_data");

require_once '../init.php';

// check inputs
$startdate_input = filter_input(INPUT_GET, 'startdate');
$enddate_input = filter_input(INPUT_GET, 'enddate');

if (!$startdate_input) {
    $startdate = date("Y-m-d",strtotime("-1 year"));
}
else {
    $startdate = $startdate_input;
}

if (!$enddate_input) {
    $enddate = date("Y-m-d",strtotime("today"));
}
else {
    $enddate = $enddate_input;
}

// TODO refactor to PDO with bind vars
function get_campaign_perf_data($startdate, $enddate) {
    global $log;
    global $maindb;

    $json_data = ''; 
    $result = null;
    // TODO do derived metrics calculation on the fly -- sum() may not work here (not additive)
    $query = "select a.campaign_id, advertiser_name, brand_name, c.campaign_name, c.campaign_rate, c.campaign_rate_type, sum(b.total_requests) impressions, sum(b.total_clicks) clicks, round(sum(b.total_clicks)/sum(b.total_requests) * 100,4) CTR, revenue, budget, eCPM, eCPC, c.campaign_priority, adskom_score, c.campaign_status FROM ak_campaign_perf a, md_reporting b, md_campaigns c WHERE a.campaign_id = c.campaign_id and a.campaign_id = b.campaign_id and b.date between '$startdate' and '$enddate' group by a.campaign_id";
    $log->debug("query=$query");
    $result = mysql_query($query, $maindb);
    if (!$result) {
        $log->error("query failed: ". mysql_error() . "\n");
        die ($mysql_error);
    }
    else {
        // columns
        $data_table = array(
                'cols' => array(
                    // each column needs an entry here, like this:
                    array('type' => 'string', 'label' => 'Advertiser Name'),
                    array('type' => 'number', 'label' => 'Brand Name'),
                    array('type' => 'number', 'label' => 'Campaign Name'),
                    array('type' => 'number', 'label' => 'Rate'),
                    array('type' => 'number', 'label' => 'Rate Type'),
                    array('type' => 'number', 'label' => 'Impressions'),
                    array('type' => 'number', 'label' => 'Clicks'),
                    array('type' => 'number', 'label' => 'CTR'),
                    array('type' => 'number', 'label' => 'Revenue'),
                    array('type' => 'number', 'label' => 'Budget'),
                    array('type' => 'number', 'label' => 'eCPM'),
                    array('type' => 'number', 'label' => 'eCPC'),
                    array('type' => 'number', 'label' => 'Priority'),
                    array('type' => 'number', 'label' => 'Adskom Score'),
                    array('type' => 'number', 'label' => 'Status'),
                    array('type' => 'number', 'label' => 'Action')
                    )
                );
        while($row = mysql_fetch_assoc($result)) {
            $data_table['rows'][] = array(
                    'c' => array (
                        array('v' => $row['advertiser_name']),
                        array('v' => $row['brand_name']),
                        array('v' => $row['campaign_name']),
                        array('v' => $row['campaign_rate']),
                        array('v' => $row['campaign_rate_type']),
                        array('v' => $row['impressions']),
                        array('v' => $row['clicks']),
                        array('v' => $row['CTR']),
                        array('v' => $row['revenue']),
                        array('v' => $row['budget']),
                        array('v' => $row['eCPM']),
                        array('v' => $row['eCPC']),
                        array('v' => $row['campaign_priority']),
                        array('v' => $row['adskom_score']),
                        array('v' => $row['campaign_status']),
                        //array('v' => "Edit", 'f' => "/www/cp/campaign_perf?action=edit&campaign_id=".$row['campaign_id'])
                        array('v' => "Edit | Delete")
                        )
                    );
        }
        $json_data = json_encode($data_table);
    }
    mysql_free_result($result);
    echo "$json_data";
}

header('Content-Type: application/json');
get_campaign_perf_data($startdate, $enddate);
$log->debug("end get_campaign_perf_data");

?>
