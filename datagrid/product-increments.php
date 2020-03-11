<?php
namespace Phppot;

use Phppot\Model\epic;
error_reporting(0);
?>
<html>
<head>
<title>Product Increments Live Inline Update data</title>
<meta name="viewport" content="width=device-width">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://grid.mastaz.ch/assets/CSS/style.css" type="text/css" rel="stylesheet" />
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
    include_once '../parts/header-auth.php'; ?> 
	</header>
  <!-- Scripts from pm.mastaz.ch Root  STOP-->
  <?php if(!$can_manage_config){
	  $error = "You don't have enough permission to view this page.";
	  ?>
      <div class="container-fluid mt-3">
          <div class="row">
              <div class="col-12 text-center">
                  <h2><?php echo $error;?></h2>
              </div>
          </div>
      </div>
  <?php } else { ?>
  
  <div class="data-main-heading">
    <h1 align="center">Product Increments Live Inline Update data</h1>
  </div>
    <table class="table table-hover display nowrap live-data-table export" style="width:100%" id="UserTable"> 
        <thead>
            <tr>
                <th class="table-header">Name</th>
                <th class="table-header">Start Date</th>
                <th class="table-header">End Date</th>
         
            </tr>
        </thead>
         <tfoot>
    <tr>
                <th class="table-header">Name</th>
                <th class="table-header">Start Date</th>
                <th class="table-header">End Date</th>
             
    </tr>
  </tfoot>
        <tbody>
<?php
require_once ("Model/epic.php");
$faq = new epic();
$ProductIncResult = $faq->getProductInc();

foreach ($ProductIncResult as $k => $v) {
    ?>
        <tr class="table-row">
               
                <td class="title" contenteditable="true"
                    onBlur="productIncsaveToDatabase(this,'pi_title','<?php echo $ProductIncResult[$k]["pi_id"]; ?>')"
                    onClick="productIncShowEdit(this);"><?php echo $ProductIncResult[$k]["pi_title"]; ?></td>
                <td contenteditable="true"
                    onBlur="productIncsaveToDatabase(this,'pi_start','<?php echo $ProductIncResult[$k]["pi_id"]; ?>')"
                    onClick="productIncShowEdit(this);"><?php echo $ProductIncResult[$k]["pi_start"]; ?></td>
         
           <td class="price digits_Only" contenteditable="true"
                    onBlur="productIncsaveToDatabase(this,'pi_end','<?php echo $ProductIncResult[$k]["pi_id"]; ?>')"
                    onClick="productIncShowEdit(this);"><?php echo $ProductIncResult[$k]["pi_end"]; ?></td>
      
        
					</tr>
    <?php
}
?>
 </tbody>
 </table>
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

<?php } ?>


