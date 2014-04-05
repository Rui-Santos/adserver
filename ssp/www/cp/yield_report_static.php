<?php
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

?>

<div id="content">		

  <div id="contentHeader">
    <h1>Yield Report</h1>
  </div> <!-- #contentHeader -->	

  <div class="container">

    <div class="grid-24">

        <div>select network/publication/placement?</div>
        <div>-----------------------</div>
        <div>put some chart here</div>
        <div>-----------------------</div>
        <div id="yield-report-chart">
           <img src="http://stradasol.com/adskom/img/dfp_yield_report.png"</img>

        </div> <!-- .yield-report-chart -->

        <div id="yield-report">
        <table class="reports-table" style="" aria-hidden="false">
        <colgroup>
        <col />
        </colgroup>
        <tbody>
        <tr class="reports-table-header">
        <td class="reports-table-sort reports-table-sort-up reports-table-sort-header-text reports-table-header-label GDHRQICCL0">
        <div><span class="gwt-InlineLabel">Yield Type</span><span class="help-Helpwidgets-TooltipWidget">?</span></div>
        </td>
        <td class="reports-table-header-label GDHRQICCM0">Impressions</td>
        <td class="reports-table-header-label GDHRQICCM0">Revenue</td>
        <td class="reports-table-header-label GDHRQICCM0">Avg eCPM</td>
        <td class="reports-table-header-label GDHRQICCM0">Clicks</td>
        <td class="reports-table-header-label GDHRQICCM0">CTR</td>
        <td class="reports-table-header-label GDHRQICCM0">Impressions (%)</td>
        <td class="reports-table-header-label GDHRQICCM0">Revenue (%)</td>
        <td class="reports-table-header-label GDHRQICCM0">Clicks (%)</td>
        </tr>
        <tr>
        <td class="reports-table-sort reports-table-sort-up GDHRQICCL0">
        <div><a class="gwt-Anchor reports-table-drillable-cell" href="javascript:;">Unfilled impressions</a><span class="help-Helpwidgets-TooltipWidget">?</span></div>
        </td>
        <td class="GDHRQICCM0"><span class="gwt-InlineLabel">33,306</span></td>
        <td class="GDHRQICCM0"><span class="gwt-InlineLabel">IDR0.00</span></td>
        <td class="GDHRQICCM0"><span class="gwt-InlineLabel">IDR0.00</span></td>
        <td class="GDHRQICCM0"><span class="gwt-InlineLabel">0</span></td>
        <td class="GDHRQICCM0"><span class="gwt-InlineLabel">0%</span></td>
        <td class="GDHRQICCM0"><span class="gwt-InlineLabel">45.93%</span></td>
        <td class="GDHRQICCM0"><span class="gwt-InlineLabel">0%</span></td>
        <td class="GDHRQICCM0"><span class="gwt-InlineLabel">0%</span></td>
        </tr>
        <tr>
        <td class="reports-table-sort reports-table-sort-up GDHRQICCL0"><a class="gwt-Anchor reports-table-drillable-cell" href="javascript:;">House</a></td>
        <td class="GDHRQICCM0"><span class="gwt-InlineLabel">100</span></td>
        <td class="GDHRQICCM0"><span class="gwt-InlineLabel">IDR0.00</span></td>
        <td class="GDHRQICCM0"><span class="gwt-InlineLabel">IDR0.00</span></td>
        <td class="GDHRQICCM0"><span class="gwt-InlineLabel">1</span></td>
        <td class="GDHRQICCM0"><span class="gwt-InlineLabel">1%</span></td>
        <td class="GDHRQICCM0"><span class="gwt-InlineLabel">0.14%</span></td>
        <td class="GDHRQICCM0"><span class="gwt-InlineLabel">0%</span></td>
        <td class="GDHRQICCM0"><span class="gwt-InlineLabel">1.59%</span></td>
        </tr>
        <tr>
        <td class="reports-table-sort reports-table-sort-up GDHRQICCL0">
        <div><span class="gwt-InlineLabel">AdSense</span><span class="help-Helpwidgets-TooltipWidget">?</span></div>
        </td>
        <td class="GDHRQICCM0"><span class="gwt-InlineLabel">29,149</span></td>
        <td class="GDHRQICCM0"><span class="gwt-InlineLabel">IDR179,079.05</span></td>
        <td class="GDHRQICCM0"><span class="gwt-InlineLabel">IDR6,143.57</span></td>
        <td class="GDHRQICCM0"><span class="gwt-InlineLabel">44</span></td>
        <td class="GDHRQICCM0"><span class="gwt-InlineLabel">0.15%</span></td>
        <td class="GDHRQICCM0"><span class="gwt-InlineLabel">40.2%</span></td>
        <td class="GDHRQICCM0"><span class="gwt-InlineLabel">68.02%</span></td>
        <td class="GDHRQICCM0"><span class="gwt-InlineLabel">69.84%</span></td>
        </tr>
        <tr>
        <td class="reports-table-sort reports-table-sort-up GDHRQICCL0"><a class="gwt-Anchor reports-table-drillable-cell" href="javascript:;">Standard</a></td>
        <td class="GDHRQICCM0"><span class="gwt-InlineLabel">9,962</span></td>
        <td class="GDHRQICCM0"><span class="gwt-InlineLabel">IDR84,201.00</span></td>
        <td class="GDHRQICCM0"><span class="gwt-InlineLabel">IDR8,452.22</span></td>
        <td class="GDHRQICCM0"><span class="gwt-InlineLabel">18</span></td>
        <td class="GDHRQICCM0"><span class="gwt-InlineLabel">0.18%</span></td>
        <td class="GDHRQICCM0"><span class="gwt-InlineLabel">13.74%</span></td>
        <td class="GDHRQICCM0"><span class="gwt-InlineLabel">31.98%</span></td>
        <td class="GDHRQICCM0"><span class="gwt-InlineLabel">28.57%</span></td>
        </tr>
        </tbody>
        </table>
        </div> <!-- .yield-report -->

    </div> <!-- .grid -->


  </div> <!-- .container -->

</div> <!-- #content -->

<?php
    require_once MAD_PATH . '/www/cp/templates/footer.tpl.php';
?>
