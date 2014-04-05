<?php
require_once 'initCpLogger.php';
$log = Logger::getLogger('campaign_perf.php');
$log->debug("start campaign_perf");

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

$startdate_input = filter_input(INPUT_GET, 'startdate');
$enddate_input = filter_input(INPUT_GET, 'enddate');

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


?>

<div id="content">		

<div id="contentHeader">
<h1>Campaign Performance Report</h1>
</div> <!-- #contentHeader -->	

<div class="container">

<div class="grid-24">

<div>select campaign/advertiser/brand</div>
<div>-----------------------</div>
<div>select start and end date</div>
<div>-----------------------</div>

     <!--Load the AJAX API-->
     <script type="text/javascript" src="https://www.google.com/jsapi"></script>
     <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
     <script type="text/javascript">
     
     // Load the Visualization API and the piechart package.
     google.load('visualization', '1', {'packages':['table']});
     
     // table
     google.setOnLoadCallback(drawTable);
     function drawTable() {
         var tableJsonData = $.ajax({
                 url: "/ws/get_campaign_perf_data.php?startdate=<?php echo $startdate; ?>&enddate=<?php echo($enddate);?>",
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
     
     <!--table -->
     <div id="table_div"></div>
</div> <!-- .campaign_perf -->

</div> <!-- .grid -->


</div> <!-- .container -->

</div> <!-- #content -->

<?php
require_once MAD_PATH . '/www/cp/templates/footer.tpl.php';
?>
