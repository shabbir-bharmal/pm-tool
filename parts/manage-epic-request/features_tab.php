<?php
namespace Phppot;

use Phppot\Model\epic;
error_reporting(0);
?>


<br />
<div class="form-row">
    <div class="form-group col-12">

            <?php 
                //Philipp: this if we would like to show only the features where the user is SME : $SMEID = $_SESSION['login_user_data']['staff_id'];
                $SMEID="";
                $fStatus="";
                $EPICID=$e_id;
                include_once("./datagrid/feature-list-inc.php");
            ?>

    </div>
</div>    