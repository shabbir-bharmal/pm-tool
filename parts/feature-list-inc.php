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
                <th class="table-header" width="8%">Status</th>
                <th class="table-header" width="8%">Jira ID</th>
                <th class="table-header" width="8%">PI</th>
                <th class="table-header" width="10%">Epic</th>
                <th class="table-header" width="8%">Topic</th>
                <th class="table-header" width="8%%">geschätzte Storypoints</th>
                <th class="table-header" >Berschreibung</th>
                <th class="table-header" >WSJF</th>  
             
                <th class="table-header" >f_type</th>    
                <th class="table-header" >f_BV</th>    
                <th class="table-header" >f_TC</th>    
                <th class="table-header" >f_RROE</th>    
                <th class="table-header" >F_JS</th>   
                <th class="table-header" >f_note</th>
                <th class="table-header" >f_benefit</th>     
                <th class="table-header" >f_dependencies</th>      
                <th class="table-header" >f_due_date</th> 
                <th class="table-header" >f_responsible</th>   
                <th class="table-header" >f_mehr_details</th>  
                <th class="table-header" >f_context</th>      
                <th class="table-header" >f_problemdessc</th>     
                <th class="table-header" >f_currentstate</th>     
                <th class="table-header" >f_targetstate</th>     
                <th class="table-header" >f_inscope</th> 
                <th class="table-header" >f_outofscope</th> 
                <th class="table-header" >f_risks</th> 
                <th class="table-header" >created_date</th> 
                <th class="table-header" >edited_timestamp</th> 

                    
                
            
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
                <th class="table-header">geschätzte Storypoints</th>
                <th class="table-header" >Berschreibung</th>
                <th class="table-header" >WSJF</th>    
                
                <th class="table-header" >f_type</th>    
                <th class="table-header" >f_BV</th>    
                <th class="table-header" >f_TC</th>    
                <th class="table-header" >f_RROE</th>    
                <th class="table-header" >F_JS</th>   
                <th class="table-header" >f_note</th>
                <th class="table-header" >f_benefit</th>     
                <th class="table-header" >f_dependencies</th>      
                <th class="table-header" >f_due_date</th> 
                <th class="table-header" >f_responsible</th>   
                <th class="table-header" >f_mehr_details</th>  
                <th class="table-header" >f_context</th>      
                <th class="table-header" >f_problemdessc</th>     
                <th class="table-header" >f_currentstate</th>     
                <th class="table-header" >f_targetstate</th>     
                <th class="table-header" >f_inscope</th> 
                <th class="table-header" >f_outofscope</th> 
                <th class="table-header" >f_risks</th> 
                <th class="table-header" >created_date</th> 
                <th class="table-header" >edited_timestamp</th>                   
                
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
               
                 <td><a style="text-decoration:none" href="https://pm.mastaz.ch/feature-request.php?f_id=<?php echo $myfeatureResult[$k]["f_id"];?>"><?php echo utf8_decode($myfeatureResult[$k]["f_title"]); ?></a>&nbsp;              
                 <span class="manage_feature" data-feature_id="<?php echo $myfeatureResult[$k]["f_id"]; ?>" data-pi_id="13" title="Edit Feature"><i class="fa fa-pencil"></i></span>
                 </td>
                 <td><?php echo utf8_decode($myfeatureResult[$k]["staff_firstname"]); ?>&nbsp;<?php echo utf8_decode($myfeatureResult[$k]["staff_lastname"]); ?></td>
                 <td><?php echo utf8_decode($myfeatureResult[$k]["statusename"]); ?></td>         
                 <td><a style="text-decoration:none" href="https://jira.zhaw.ch/browse/<?php echo $myfeatureResult[$k]["f_id"];?>" target="_blank"><?php echo utf8_decode($myfeatureResult[$k]["j_key"]); ?></a></td>
                 <td><?php echo utf8_decode($myfeatureResult[$k]["piname"]); ?></td> 
                 <td><?php echo utf8_decode($myfeatureResult[$k]["e_title"]); ?></td>
                 <td><?php echo utf8_decode($myfeatureResult[$k]["topicsname"]); ?></td>
                 <td><?php echo $myfeatureResult[$k]["f_storypoints"]; ?></td>
                 <td ><?php echo utf8_decode($myfeatureResult[$k]["f_desc"]); ?></td>
                 <?php
                 $wsjf=($myfeatureResult[$k]["f_BV"]+$myfeatureResult[$k]["f_TC"]+$myfeatureResult[$k]["f_RROE"])/$myfeatureResult[$k]["f_JS"];
                 
                 ?>
                 <td ><?php echo $wsjf; ?></td>    
                 
                 
                <td ><?php echo $myfeatureResult[$k]["ftname"]; ?></td>    
                <td ><?php echo $myfeatureResult[$k]["f_BV"]; ?></td>    
                <td ><?php echo $myfeatureResult[$k]["f_TC"]; ?></td>    
                <td ><?php echo $myfeatureResult[$k]["f_RROE"]; ?></td>    
                <td ><?php echo $myfeatureResult[$k]["f_JS"]; ?></td>   
                <td ><?php echo utf8_decode($myfeatureResult[$k]["f_note"]); ?></td>
                <td ><?php echo utf8_decode($myfeatureResult[$k]["f_benefit"]); ?></td>     
                <td ><?php echo utf8_decode($myfeatureResult[$k]["f_dependencies"]); ?></td>      
                <td ><?php echo $myfeatureResult[$k]["f_due_date"]; ?></td> 
                <td ><?php echo utf8_decode($myfeatureResult[$k]["responsible_firstname"]); ?>&nbsp;<?php echo utf8_decode($myfeatureResult[$k]["responsible_lasttname"]); ?></td>   
                <td ><?php echo utf8_decode($myfeatureResult[$k]["f_mehr_details"]); ?></td>  
                <td ><?php echo utf8_decode($myfeatureResult[$k]["f_context"]); ?></td>      
                <td ><?php echo utf8_decode($myfeatureResult[$k]["f_problemdessc"]); ?></td>     
                <td ><?php echo utf8_decode($myfeatureResult[$k]["f_currentstate"]); ?></td>     
                <td ><?php echo utf8_decode($myfeatureResult[$k]["f_targetstate"]); ?></td>     
                <td ><?php echo utf8_decode($myfeatureResult[$k]["f_inscope"]); ?></td> 
                <td ><?php echo utf8_decode($myfeatureResult[$k]["f_outofscope"]); ?></td> 
                <td ><?php echo utf8_decode($myfeatureResult[$k]["f_risks"]); ?></td> 
                <td ><?php echo $myfeatureResult[$k]["created_date"]; ?></td> 
                <td ><?php echo $myfeatureResult[$k]["edited_timestamp"]; ?></td>                                 
            
		</tr>
    <?php
}
?>

 </tbody>
 </table>

