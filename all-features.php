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
    
    
    

    <div class="modal fade" id="feature" role="dialog" tabindex='-1'>
    <div class="modal-dialog modal-xl">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Feature</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?php echo W_ROOT; ?>/form-action.php" id="feature_form" name="feature_form" enctype='multipart/form-data'>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <div class="form-group col-md-4 mr-auto p-0">
                        <select name="print_option" class="print_option form-control" <?php echo $disabled; ?>>
                            <option value="" selected="selected">Drucken</option>
                            <option value="title">Titel-Karte</option>
                            <option value="detail">Detail-Karte</option>
                            <option value="title_nemonic">Titel-Karte (Nemonic)</option>
                            <option value="feature_antrag">Feature-Antrag</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="feature_submit" form="feature_form" value="Submit" class="btn btn-primary" <?php echo $disabled; ?>>Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
    
    
    
    

	<div class="container-fluid mt-3 mb-3">

		<div class="row mb-3">
			<div class="col-12">
				<h2 class="m-0"><img src="<?php echo W_ROOT; ?>/favicon.ico" style="height:30px;margin-right:10px">Alle Features <?php if ($helptexts['title_all_features']) {
				              echo "<span class=\"h6\" style=\"display: inline-flex;vertical-align: middle;\"><i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['title_all_features'] . "'></i></span>";
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
          

 columnDefs: [
    { visible: false, targets: [10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29] }
  ], 

          buttons: [
          {
              extend: 'excelHtml5',
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
          },            

        
            'colvis'
        ]
              } );
} );
</script>   
