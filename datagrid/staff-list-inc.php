<?php
namespace Phppot;

use Phppot\Model\epic;
error_reporting(0);
?>


  <table class="table table-hover display nowrap live-data-table export" style="width:100%" id="UserTable"> 
        <thead>
            <tr>
                <th class="table-header">Vorname</th>
                <th class="table-header">Nachbame</th>
                <th class="table-header">Team</th>
                <th class="table-header">Topics</th> 
                <th class="table-header">Email</th>
                <th class="table-header">Benutzername</th>
                <th class="table-header">Roadmap editieren (0/1)</th>
                <th class="table-header">Feature/Epics editieren (0/1)</th>
                <th class="table-header">Administrator (0/1)</th>
            </tr>
        </thead>
         <tfoot>
    <tr>
                <th class="table-header">Vorname</th>
                <th class="table-header">Nachbame</th>
                <th class="table-header">Team</th>
                <th class="table-header">Topics</th> 
                <th class="table-header">Email</th>
                <th class="table-header">Benutzername</th>
                <th class="table-header">Roadmap editieren (0/1)</th>
                <th class="table-header">Feature/Epics editieren (0/1)</th>
                <th class="table-header">Administrator (0/1)</th>
    </tr>
  </tfoot>
        <tbody>
<?php
require_once ("./datagrid/Model/epic.php");      
$faq = new epic();
$faqResult = $faq->getStaff();
$teamResult = $faq->team();
$topicsResult = $faq->topics();
foreach ($faqResult as $k => $v) {
    ?>
        <tr class="table-row">
               
                <td class="title" contenteditable="true"
                    onBlur="staffsaveToDatabase(this,'staff_firstname','<?php echo $faqResult[$k]["staff_id"]; ?>')"
                    onClick="staffhowEdit(this);"><?php echo utf8_decode($faqResult[$k]["staff_firstname"]); ?></td>
                <td contenteditable="true"
                    onBlur="staffsaveToDatabase(this,'staff_lastname','<?php echo $faqResult[$k]["staff_id"]; ?>')"
                    onClick="staffhowEdit(this);"><?php echo utf8_decode($faqResult[$k]["staff_lastname"]); ?></td>
                <td  contenteditable="false" onBlur="staffsaveToDatabase(this,'staff_topic_id','<?php echo $faqResult[$k]["staff_id"]; ?>')" onClick="staffhowEdit(this);">
                  <select name="webste" class="team" id="<?php echo $faqResult[$k]["staff_id"]; ?>">
                  	<option value="">-- bitte wählen --</option>
                        <?php if($faqResult[$k]['staff_topic_id'] > ' '){ ?>
                                <option value="<?php echo $faqResult[$k]["staff_topic_id"]; ?>" selected="selected"><?php echo $faqResult[$k]["teamname"]; ?></option>
                            <?php } ?> 

                                <?php
                               foreach ($teamResult as $v) {
                            ?>
                                <option value="<?php echo $v["id"]; ?>"><?php echo utf8_decode($v["name"]); ?></option>
                            <?php } ?>       
                        </select>
                    </td>
                    <td  contenteditable="false" onBlur="staffsaveToDatabase(this,'staff_topic_id','<?php echo $faqResult[$k]["staff_id"]; ?>')" onClick="staffhowEdit(this);">

                        <select name="webste" class="topic" id="<?php echo $faqResult[$k]["staff_id"]; ?>">
                        	<option value="">-- bitte wählen --</option>
                            <?php if($faqResult[$k]['staff_topic_id'] > ' '){ ?>
                                <option value="<?php echo $faqResult[$k]["staff_topic_id"]; ?>" selected="selected"><?php echo $faqResult[$k]["topicname"]; ?></option>
                            <?php } ?> 
                          
                            <?php   
                           foreach ($topicsResult as $v) {
                            ?>
                                <option value="<?php echo $v["id"]; ?>"><?php echo utf8_decode($v["name"]); ?></option>
                            <?php } ?>     
                        </select>
                      </td>
           <td class="price digits_Only" contenteditable="true"
                    onBlur="staffsaveToDatabase(this,'email','<?php echo $faqResult[$k]["staff_id"]; ?>')"
                    onClick="staffhowEdit(this);"><?php echo utf8_decode($faqResult[$k]["email"]); ?></td>
          <td class="price digits_Only" contenteditable="true"
                    onBlur="staffsaveToDatabase(this,'username','<?php echo $faqResult[$k]["staff_id"]; ?>')"
                    onClick="staffhowEdit(this);"><?php echo utf8_decode($faqResult[$k]["username"]); ?></td>
          <td class="digits_Only" id="demo" contenteditable="true"
                    onBlur="staffsaveToDatabase(this,'can_edit_roadmap','<?php echo $faqResult[$k]["staff_id"]; ?>')"
                    onClick="staffhowEdit(this);"><?php echo $faqResult[$k]["can_edit_roadmap"]; ?></td>
           <td class="digits_Only"contenteditable="true"
                    onBlur="staffsaveToDatabase(this,'can_edit_epic_feature','<?php echo $faqResult[$k]["staff_id"]; ?>')"
                    onClick="staffhowEdit(this);"><?php echo $faqResult[$k]["can_edit_epic_feature"]; ?>
            </td>
           <td class="digits_Only"contenteditable="true"
                    onBlur="staffsaveToDatabase(this,'can_manage_config','<?php echo $faqResult[$k]["staff_id"]; ?>')"
                    onClick="staffhowEdit(this);"><?php echo $faqResult[$k]["can_manage_config"]; ?>
            </td>            
        
					</tr>
    <?php
}
?>
 </tbody>
 </table>

 </tbody>
 </table>

