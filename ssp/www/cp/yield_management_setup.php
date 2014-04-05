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
    <h1>Yield Management Setup</h1>
  </div> <!-- #contentHeader -->	

  <div class="container">

    <div class="grid-24">

      <h2> here is where we setup the yield management </h2>
      <h3> adskom score is the magic number based on the effectiveness of the network performance, calculated using a formula, e.g. ad cost, speed, CTR, targeting, etc</h3>
      <table class="table table-bordered">
        <tr>
          <td>network name</td>
          <td>campaign name</td>
          <td>publication name</td>
          <td>placement name</td>
          <td>impressions</td>
          <td>clicks</td>
          <td>CTR</td>
          <td>revenue</td>
          <td>eCPM</td>
          <td>eCPC</td>
          <td>priority</td>
          <td>adskom score</td>
          <td>status</td>
          <td>action</td>
        </tr>
        <tr>
          <td>network 1</td>
          <td>my campaign</td>
          <td>my publication</td>
          <td>my placement name</td>
          <td>1000</td>
          <td>10</td>
          <td>0.01</td>
          <td>500</td>
          <td>20</td>
          <td>30</td>
          <td>1</td>
          <td>10.1</td>
          <td>active</td>
          <td><a href=#>Edit</a> &nbsp; <a href=#>Delete</a></td>
        </tr>
        <tr>
          <td>network 2</td>
          <td>your campaign</td>
          <td>your publication</td>
          <td>your placement name</td>
          <td>2000</td>
          <td>200</td>
          <td>0.1</td>
          <td>700</td>
          <td>30</td>
          <td>40</td>
          <td>1</td>
          <td>11.8</td>
          <td>active</td>
          <td><a href=#>Edit</a> &nbsp; <a href=#>Delete</a></td>
       </tr>
 
      </table>
    </div> <!-- .grid -->


  </div> <!-- .container -->

</div> <!-- #content -->

<?php
    require_once MAD_PATH . '/www/cp/templates/footer.tpl.php';
?>
