<?php
namespace Phppot;

use Phppot\Model\epic;
error_reporting(0);
?>
<html>
<head>
<title>Live Inline Update data</title>
<meta name="viewport" content="width=device-width">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- <link href="https://grid.mastaz.ch/assets/CSS/style.css" type="text/css" rel="stylesheet" /> -->
<link href="https://pm.mastaz.ch/datagrid/assets/CSS/style.css" type="text/css" rel="stylesheet" />
<script src="./vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="./assets/js/inlineEdit.js"></script>
<link href="https://cdn.datatables.net/1.10.0/css/jquery.dataTables.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.js"></script>
<link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" rel="stylesheet"/>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
</script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>

<!-- Scripts from pm.mastaz.ch Root  START-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="//stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="//use.fontawesome.com/bb08efb11a.js"></script>
<!-- Scripts from pm.mastaz.ch Root  STOP-->
</head>
<body>
  <!-- Scripts from pm.mastaz.ch Root  START-->
	<!-- Auth navigation -->
	<header>
		<?php
    session_start();
    define('W_ROOT', 'https://pm.mastaz.ch');
    //include_once '../parts/header-auth.php'; ?> 
	</header>
  <!-- Scripts from pm.mastaz.ch Root  STOP-->
  <?php 
  if($can_manage_config){
  //if(!$can_manage_config){
    $error = "Sorry, leider hast Du keine Berechtigung daf&uuml;r oder bist nicht angemeldet [7]. <br><a href='".W_ROOT."'>Login-Maske</a>";
      ?>
  <div class="container-fluid mt-3">
      <div class="row">
          <div class="col-12 text-center">
              <h2><?php echo $error;?></h2>
          </div>
      </div>
  </div>
  <?php } else { ?>

 <div class="container-fluid">  
  <div class="data-main-heading">
    <h1 align="center">Live Inline Update data</h1>
  </div>
    <table class="table table-hover display nowrap live-data-table export" style="width:100%" id="UserTable"> 
        <thead>
            <tr>
                <th class="table-header">Firstname</th>
                <th class="table-header">Lasttname</th>
                <th class="table-header">Team</th>
                <th class="table-header">Topics</th> 
                <th class="table-header">Email</th>
                <th class="table-header">User Name</th>
                <th class="table-header">Can edit roadmap</th>
                <th class="table-header">Can edit epic feature</th>
            </tr>
        </thead>
         <tfoot>
    <tr>
                <th class="table-header">Firstname</th>
                <th class="table-header">Lasttname</th>
                <th class="table-header">Team</th>
                <th class="table-header">Topics</th> 
                <th class="table-header">Email</th>
                <th class="table-header">User Name</th>
                <th class="table-header">Can edit roadmap</th>
                <th class="table-header">Can edit epic feature</th>
    </tr>
  </tfoot>
        <tbody>
<?php
require_once ("Model/epic.php");
$faq = new epic();
$faqResult = $faq->getStaff();
$teamResult = $faq->team();
$topicsResult = $faq->topics();
foreach ($faqResult as $k => $v) {
    ?>
        <tr class="table-row">
               
                <td class="title" contenteditable="true"
                    onBlur="staffsaveToDatabase(this,'staff_firstname','<?php echo $faqResult[$k]["staff_id"]; ?>')"
                    onClick="staffhowEdit(this);"><?php echo $faqResult[$k]["staff_firstname"]; ?></td>
                <td contenteditable="true"
                    onBlur="staffsaveToDatabase(this,'staff_lastname','<?php echo $faqResult[$k]["staff_id"]; ?>')"
                    onClick="staffhowEdit(this);"><?php echo $faqResult[$k]["staff_lastname"]; ?></td>
                <td  contenteditable="false" onBlur="staffsaveToDatabase(this,'staff_topic_id','<?php echo $faqResult[$k]["staff_id"]; ?>')" onClick="staffhowEdit(this);">
                  <select name="webste" class="team" id="<?php echo $faqResult[$k]["staff_id"]; ?>">
                  	<option value="">-- bitte wählen --</option>
                        <?php if($faqResult[$k]['staff_topic_id'] > ' '){ ?>
                                <option value="<?php echo $faqResult[$k]["staff_topic_id"]; ?>" selected="selected"><?php echo $faqResult[$k]["teamname"]; ?></option>
                            <?php } ?> 

                                <?php
                               foreach ($teamResult as $v) {
                            ?>
                                <option value="<?php echo $v["id"]; ?>"><?php echo $v["name"]; ?></option>
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
                                <option value="<?php echo $v["id"]; ?>"><?php echo $v["name"]; ?></option>
                            <?php } ?>     
                        </select>
                      </td>
           <td class="price digits_Only" contenteditable="true"
                    onBlur="staffsaveToDatabase(this,'email','<?php echo $faqResult[$k]["staff_id"]; ?>')"
                    onClick="staffhowEdit(this);"><?php echo $faqResult[$k]["email"]; ?></td>
          <td class="price digits_Only" contenteditable="true"
                    onBlur="staffsaveToDatabase(this,'username','<?php echo $faqResult[$k]["staff_id"]; ?>')"
                    onClick="staffhowEdit(this);"><?php echo $faqResult[$k]["username"]; ?></td>
          <td class="digits_Only" id="demo" contenteditable="true"
                    onBlur="staffsaveToDatabase(this,'can_edit_roadmap','<?php echo $faqResult[$k]["staff_id"]; ?>')"
                    onClick="staffhowEdit(this);"><?php echo $faqResult[$k]["can_edit_roadmap"]; ?></td>
           <td class="price digits_Only"contenteditable="true"
                    onBlur="staffsaveToDatabase(this,'can_edit_epic_feature','<?php echo $faqResult[$k]["staff_id"]; ?>')"
                    onClick="staffhowEdit(this);"><?php echo $faqResult[$k]["can_edit_epic_feature"]; ?>
            </td>
        
					</tr>
    <?php
}
?>
 </tbody>
 </table>
 </div>
</body>
</html>
<script type="text/javascript">
  
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#UserTable thead tr').clone(true).appendTo( '#UserTable thead' );
    $('#UserTable thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input class="filter'+title+'" type="text" placeholder="Search '+title+'" />' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );


 $("input.filterTeam,input.filterTopics").on("keyup", function() {
       var val = $(this).val().toLowerCase();
        $("tbody tr").filter(function() {
          $(this).toggle($(this).find("option:selected").text().toLowerCase().indexOf(val) > -1)
        });
      });

    } );
 
    var table = $('#UserTable').DataTable( {
            orderCellsTop: true,
            fixedHeader: true,
            ordering: true,
            bLengthChange: true,
            iDisplayLength: 10,
            bFilter: true,
            pagingType: "full_numbers",
            bInfo: false,
			iDisplayLength: 10,
            aLengthMenu: [[10, 15, 25, 100, -1], [10, 15, 25, 100, "All"]],
            dom: "lBfrtip",
 
          buttons: [
          {
              extend: 'excel',
              title: '',

          exportOptions: {

                      format   : {
                          body : (data, row, col, node) => {
                              let node_text = '';
                              const spacer = node.childNodes.length < 1 ? ' ' : '';
                              node.childNodes.forEach(child_node => {
                                  const temp_text = child_node.nodeName == "SELECT" ? child_node.selectedOptions[0].textContent : child_node.textContent;
                                  node_text += temp_text ? `${temp_text}${spacer}` : '';
                  node_text = $.trim(node_text.replace(/ +/g,' '));
                              });
                              return node_text ;

                          }
                      }
                  },
          }],
              } );
} );
</script>   
<script type="text/javascript">
    $(".team").change(function(){
        var staffteamValue = $(this).val();
        var staff_id = $(this).attr('id');
         $.ajax({
                    url:"common-function.php",
                    method:"post",
                       data:{'method': 'getStaffSelectData', 'staffteamValue':staffteamValue,'staff_id':staff_id},
                    success: function(response){
                       //alert(response);
                    },
                });
         
        });
</script>

<script type="text/javascript">
    $(".topic").change(function(){
        var topicValue = $(this).val();
        var staff_id = $(this).attr('id');
         $.ajax({
                    url:"common-function.php",
                    method:"post",
                     data:{'method': 'getTopicsSelectData', 'topicValue':topicValue,'staff_id':staff_id},
                    success: function(response){
                       //alert(response);
                    },
                });
         
        });
</script>
<?php } ?>

