<?php
namespace Phppot;

use Phppot\Model\epic;
error_reporting(0);
?>


    <table class="table table-hover display nowrap live-data-table export" style="width:100%" id="UserTable"> 
        <thead>
            <tr>
                <th class="table-header" width="40%">Titel</th>
                <th class="table-header" width="10%">Ansprechsperson (Fach)</th>
                <th class="table-header" width="10%">Status</th>
                <th class="table-header" width="10%">Jira ID</th>
                <th class="table-header" width="10%">PI</th>
                <th class="table-header" width="10%">Epic</th>
                <th class="table-header" width="10%">Topic</th>

            
            </tr>
        </thead>
         <tfoot>
    <tr>
                <th class="table-header">Titel</th>
                <th class="table-header">Ansprechsperson (Fach)</th>
                <th class="table-header">Status</th>
                <th class="table-header">Jira ID</th>
                <th class="table-header">PI</th>
                <th class="table-header">Epic</th>
                <th class="table-header">Topic</th>
              
    </tr>
  </tfoot>
        <tbody>
<?php
require_once ("./datagrid/Model/epic.php");      
$features = new epic();    
$myfeatureResult = $features->getfeaturesdynamic($SMEID,$fStatus,$EPICID);
foreach ($myfeatureResult as $k => $v) {

    ?>
  
        <tr class="table-row">
               
               
                 <td><a style="text-decoration:none" href="https://pm.mastaz.ch/feature-request.php?f_id=<?php echo $myfeatureResult[$k]["f_id"];?>"><?php echo utf8_decode($myfeatureResult[$k]["f_title"]); ?></a></td>
                 <td><?php echo utf8_decode($myfeatureResult[$k]["staff_firstname"]); ?>&nbsp;<?php echo utf8_decode($myfeatureResult[$k]["staff_lastname"]); ?></td>
                 <td><?php echo utf8_decode($myfeatureResult[$k]["statusename"]); ?></td>         
                 <td><a style="text-decoration:none" href="https://jira.zhaw.ch/browse/<?php echo $myfeatureResult[$k]["f_id"];?>" target="_blank"><?php echo utf8_decode($myfeatureResult[$k]["jira_id"]); ?></a></td>
                 <td><?php echo utf8_decode($myfeatureResult[$k]["piname"]); ?></td> 
                 <td><?php echo utf8_decode($myfeatureResult[$k]["e_title"]); ?></td>
                 <td><?php echo utf8_decode($myfeatureResult[$k]["topicsname"]); ?></td>

                  
            
					</tr>
    <?php
}
?>

 </tbody>
 </table>

