<?php
namespace Phppot;

use Phppot\Model\epic;
error_reporting(0);
?>

<?php
$datagrid_included="yes";

include_once 'config.php';

if(!$_SESSION['login_user_data']){
	if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") {
		$actual_link = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	} else {
		$actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	}
	$_SESSION['redirect_url'] = $actual_link;
}

// Include header
$page_title = 'Mitarbeitende-Verwaltung';
include_once F_ROOT.'parts/layout/head.php';
$helptexts        = $db->getHelpText();


?>
	<!--Body content-->

	<!-- Auth navigation -->
	<header>
		<?php include_once(F_ROOT.'parts/header-auth.php'); ?>
	</header>

	<div class="container-fluid mt-3 mb-3">

		<div class="row mb-3">
			<div class="col-12">
				<h2 class="m-0"><img src="<?php echo W_ROOT; ?>/favicon.ico" style="height:30px;margin-right:10px">Mitarbeitende-Verwaltung <?php if ($helptexts['title_admin_staff']) {
				              echo "<span class=\"h6\" style=\"display: inline-flex;vertical-align: middle;\"><i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['title_admin_staff'] . "'></i></span>";
			               } ?>  </h2>
        
			</div>
		</div>


		<div class="row">
			<div class="col-12">


            <?php 
                //Philipp: this if we would like to show only the features where the user is SME : $SMEID = $_SESSION['login_user_data']['staff_id'];
                $SMEID="";
                $fStatus="";
                $EPICID="";
                include_once("./datagrid/staff-list-inc.php");
            ?>

 </tbody>
 </table>
 
 
 
 
 
 
 
 
 
 







			</div>
		</div>
	</div>

<?php         
// Include footer
include_once F_ROOT.'parts/layout/footer.php';
?>


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
                text: 'Neu',
                action: function ( e, dt, node, config ) {
                    alert( 'under construction' );
                }
            },



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
                    url:"./datagrid/common-function.php",
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
                    url:"./datagrid/common-function.php",
                    method:"post",
                     data:{'method': 'getTopicsSelectData', 'topicValue':topicValue,'staff_id':staff_id},
                    success: function(response){
                       //alert(response);
                    },
                });
         
        });
</script>