<?php 

require_once 'initWsLogger.php';
$log = Logger::getLogger('get_yield_report_data.php');
$log->debug("start get_yield_report_data");

require_once '../init.php';

// check inputs
$zone_id_input = filter_input(INPUT_GET, 'zone_id');
$charttype_input = filter_input(INPUT_GET, 'charttype');
$startdate_input = filter_input(INPUT_GET, 'startdate');
$enddate_input = filter_input(INPUT_GET, 'enddate');

if (!$zone_id_input) {
    echo "ERROR: missing zone_id!";
}
else {
    $zone_id = $zone_id_input;
}
$log->debug("zone_id=$zone_id");

if (!$charttype_input) {
    $charttype = 'table';
}
else {
    $charttype = $charttype_input;
}
$log->debug("charttype=$charttype");

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
function get_yield_report_data($zone_id, $charttype, $startdate, $enddate) {
    global $log;
    global $maindb;

    $json_data = ''; 
    $result = null;
    if ($charttype == "table") {
        // TODO do derived metrics calculation on the fly -- sum() may not work here (not additive)
        $query = "select yield_type, sum(impressions) sum_impressions, sum(revenue) sum_revenue, avg(cpm) avg_cpm, sum(clicks) sum_clicks, sum(clicks)/sum(impressions) as ctr, sum(impressions_pct) sum_impressions_pct, sum(revenue_pct) sum_revenue_pct, sum(clicks_pct) sum_clicks_pct from ak_yield_report where zone_id = $zone_id and date between '$startdate' and '$enddate' group by yield_type";
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
                        array('type' => 'string', 'label' => 'Yield Type'),
                        array('type' => 'number', 'label' => 'Impressions'),
                        array('type' => 'number', 'label' => 'Revenue'),
                        array('type' => 'number', 'label' => 'Avg eCPM'),
                        array('type' => 'number', 'label' => 'Clicks'),
                        array('type' => 'number', 'label' => 'CTR'),
                        array('type' => 'number', 'label' => 'Impressions (%)'),
                        array('type' => 'number', 'label' => 'Revenue (%)'),
                        array('type' => 'number', 'label' => 'Clicks (%)')
                        )
                    );
            while($row = mysql_fetch_assoc($result)) {
                $data_table['rows'][] = array(
                        'c' => array (
                            array('v' => $row['yield_type']),
                            array('v' => $row['sum_impressions']),
                            array('v' => $row['sum_revenue']),
                            array('v' => $row['avg_cpm']),
                            array('v' => $row['sum_clicks']),
                            array('v' => $row['ctr']),
                            array('v' => $row['sum_impressions_pct']),
                            array('v' => $row['sum_revenue_pct']),
                            array('v' => $row['sum_clicks_pct'])
                            )
                        );
            }
            $json_data = json_encode($data_table);
        }
    }
    else {
        $data_table = array();
        $yield_data = array(); // store multidimensional array $array[date][yield_type][metric]
        $yield_types = array(); // store yield_types
        $query = "select date, yield_type, $charttype from ak_yield_report where zone_id = $zone_id and date between '$startdate' and '$enddate'";
        $log->debug("query=$query");
        $result = mysql_query($query, $maindb);
        if (!$result) {
            $log->error("query failed: ". mysql_error() . "\n");
            die ($mysql_error);
        }
        else {
            $rows = null;
            while($row = mysql_fetch_assoc($result)) {
                $date = $row['date'];
                $yield_type = $row['yield_type'];
                $metric = $row[$charttype];
                $yield_data[$date][$yield_type] = $metric;
                if (!in_array($yield_type, $yield_types)) {
                    array_push($yield_types, $yield_type);
                }
            }

            $yt_cols = array();
            array_push($yt_cols, array('type'=>'string', 'label'=> 'Date'));
            foreach($yield_types as $yt) {
                array_push($yt_cols, array('type'=>'number', 'label'=>$yt)); 
            }

            $data_table['cols'] = $yt_cols;

            $yt_rows = array();
            foreach($yield_data as $yt_date => $yt_data) {
                $tmp = array();
                array_push($tmp, array('v'=> $yt_date));
                foreach($yield_types as $yt_type) {
                    array_push($tmp, array('v'=> $yield_data[$yt_date][$yt_type]));
                }
                $data_table['rows'][] = array( 'c'=> $tmp);
            }

            //print_r($data_table);
            $json_data = json_encode($data_table);
        }

    }
    mysql_free_result($result);
    echo "$json_data";
}

header('Content-Type: application/json');
//get_yield_report_data(10,'impressions','2012-11-01','2012-11-31');
get_yield_report_data($zone_id, $charttype, $startdate, $enddate);
$log->debug("end get_yield_report_data");

?>
