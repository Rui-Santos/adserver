<?php
require_once 'initCpLogger.php';
$log = Logger::getLogger('yield_report.php');
$log->debug("start yield_report");

global $current_section;
$current_section='yield_management';

require_once '../../init.php';

// Required files
require_once MAD_PATH . '/www/cp/auth.php';
require_once MAD_PATH . '/functions/adminredirect.php';
require_once MAD_PATH . '/www/cp/restricted.php';
require_once MAD_PATH . '/www/cp/admin_functions.php';


if (!check_permission('yield_management', $user_detail['user_id'])){
    exit;
}

if (isset($_POST['update'])){
    if (do_update_data('generalsettings', $_POST, $user_detail['user_id'])){
        global $updated;
        $updated=1;
    }
    else
    {
        global $updated;
        $updated=2;
    }
}


require_once MAD_PATH . '/www/cp/templates/header.tpl.php';

$zone_id_input = filter_input(INPUT_GET, 'zone_id');
$metric_input = filter_input(INPUT_GET, 'metric');
$startdate_input = filter_input(INPUT_GET, 'startdate');
$enddate_input = filter_input(INPUT_GET, 'enddate');

$metric_list = array("impressions"=>"Impressions", 
                     "revenue"=>"Revenue", 
                     "impressions_pct"=>"Impressions (%)", 
                     "revenue_pct"=>"Revenue (%)");

if (!$zone_id_input) {
    // ZZZ remove this later!
    $zone_id = 10;
    //echo "ERROR: missing zone_id!";
}
else {
    $zone_id = $zone_id_input;
}
$log->debug("zone_id=$zone_id");

if (!$metric_input) {
    $metric = 'impressions';
}
else {
    if (!array_key_exists($metric_input, $metric_list)) {
        echo "ERROR metrics $metric_input is not supported";
        exit;
    }
    else {
        $metric = $metric_input;
    }
}

if (!$startdate_input) {
    $startdate = date("Y-m-d",strtotime("-1 month"));
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

function genViewBy($current_metric) {
    global $metric_list;
    global $log;

    $html = "<ul id='metric_list'>";
    $html = "<li>View By:</li>";
    foreach ($metric_list as $key=>$val) {
        $log->debug("key=$key");
        if ($current_metric == $key) {
            $html .= "<li>$val</li>";
        }
        else {
            $html .= "<li><a href='/www/cp/yield_report.php?zone_id=$zone_id&metric=$key'>$val</a></li>";
        }
    }
    $html .= "</ul>";
    echo ($html);
}
?>

<style>
#viewbymenu li {display:inline; margin:20px}
</style>

<div id="content">		

<div id="contentHeader">
<h1>Yield Report</h1>
</div> <!-- #contentHeader -->	

<div class="container">

<div class="grid-24">

<div>select network/publication/placement (zone_id)</div>
<div>-----------------------</div>
<div>select start and end date</div>
<div>-----------------------</div>

     <div id=viewbymenu><?php genViewBy($metric);?> </div>
     <!--Load the AJAX API-->
     <script type="text/javascript" src="https://www.google.com/jsapi"></script>
     <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
     <script type="text/javascript">
     
     // Load the Visualization API and the piechart package.
     google.load('visualization', '1', {'packages':['corechart','table']});
     
     // line chart
     google.setOnLoadCallback(drawLineChart);
     
     function drawLineChart() {
         var lineChartJsonData = $.ajax({
                 url: "/ws/get_yield_report_data.php?zone_id=10&charttype=<?php echo($metric);?>",
                 dataType:"json",
                 async: false
                 }).responseText;
     
         // Create our data table out of JSON data loaded from server.
         var lineChartData = new google.visualization.DataTable(lineChartJsonData);
     
         // Instantiate and draw our chart, passing in some options.
         var chart = new google.visualization.LineChart(document.getElementById('linechart_div'));
         chart.draw(lineChartData, {width: 700, height: 400});
     }
     
     // table
     google.setOnLoadCallback(drawTable);
     function drawTable() {
         var tableJsonData = $.ajax({
                 url: "/ws/get_yield_report_data.php?zone_id=10&charttype=table",
                 dataType:"json",
                 async: false
                 }).responseText;
     
         // Create our data table out of JSON data loaded from server.
         var tableData = new google.visualization.DataTable(tableJsonData);
     
         // Instantiate and draw our chart, passing in some options.
         var table = new google.visualization.Table(document.getElementById('table_div'));
         var options = {'showRowNumber':true};
         options['page'] = 'enable';
         options['pageSize'] = 10;
         options['pagingSymbols'] = {prev: 'prev', next: 'next'};
         options['pagingButtonsConfiguration'] = 'auto';
         table.draw(tableData, options);
     }
     
     </script>
     
     <!--line chart-->
     <div id="linechart_div"></div>
     <!--table -->
     <div id="table_div"></div>
</div> <!-- .yield-report -->

</div> <!-- .grid -->


</div> <!-- .container -->

</div> <!-- #content -->

<?php
require_once MAD_PATH . '/www/cp/templates/footer.tpl.php';
?>
