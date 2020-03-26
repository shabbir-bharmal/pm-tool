<?php
$datagrid_included="yes";

include_once 'config.php';

// Include header
$page       = 'epic-request';
$page_title = 'Epic Request';
if(!$_SESSION['login_user_data']){
	if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") {
		$actual_link = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	} else {
		$actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	}
	$_SESSION['redirect_url'] = $actual_link;
}
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
				<h2 class="m-0"><img src="<?php echo W_ROOT; ?>/favicon.ico" style="height:30px;margin-right:10px">Epic Request
                    <span class="h6" style="display: inline-flex;vertical-align: middle;">
        			       <?php if ($helptexts['title_epic_request_form']) {
				              echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['title_epic_request_form'] . "'></i>";
			               } ?>                    
                    </span></h2>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-8 col-sm-8 col-xs-12">
				<?php
				if (isset($_SESSION['epic-request-error'])) {
					$msg = $_SESSION['epic-request-error'];
					unset($_SESSION['epic-request-error']);
					?>
					<div class="alert alert-danger" role="alert">
						<?php echo $msg; ?>
					</div>
					<?php
				}
				if (isset($_SESSION['epic-request-success'])) {
					$msg = $_SESSION['epic-request-success'];
					unset($_SESSION['epic-request-success']);
					?>
					<div class="alert alert-success" role="alert">
						<?php echo $msg; ?>
					</div>
					<?php
				}
				?>
			</div>
		</div>

		<div class="row">
			<div class="col-12"><?php include_once(F_ROOT.'parts/epic-request-form.php'); ?></div>
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
