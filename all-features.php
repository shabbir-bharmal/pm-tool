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
$page_title = 'Alle Features';
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
				<h2 class="m-0"><img src="<?php echo W_ROOT; ?>/favicon.ico" style="height:30px;margin-right:10px">Alle Features <?php if ($helptexts['title_my_features']) {
				              echo "<span class=\"h6\" style=\"display: inline-flex;vertical-align: middle;\"><i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['title_my_features'] . "'></i></span>";
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
                include_once("./datagrid/feature-list-inc.php");
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
            dom: "lBfrtip",   
            
           language: {
             search: "Suchen:"             
          },          
          

          buttons: [
            
            {
                extend: 'excelHtml5',
                 title: '',
                exportOptions: {
                    columns: ':visible'
                    
                }
            },
        
            'colvis'
        ]
              } );
} );
</script>   
