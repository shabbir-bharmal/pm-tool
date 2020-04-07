<?php
namespace Phppot;

use Phppot\Model\epic;
error_reporting(0);
?>
<html>
<head>
<title>My feature Live data</title>
<meta name="viewport" content="width=device-width">
<meta name="viewport" content="width=device-width, initial-scale=1">
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
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>
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
<div class="container-fluid">  
  <div class="data-main-heading">
    <h2 class="my-feat-h"><img src="<?php echo W_ROOT; ?>/favicon.ico" style="height:30px;margin-right:10px">Meine Features (Alpha Version) <?php if ($helptexts['title_my_features']) {
				              echo "<i class='fa fa-question-circle-o' data-container='body' data-toggle='popover' data-placement='top' data-content='" . $helptexts['title_my_features'] . "'></i>";
			               } ?>  </h2>
  </div>
		</div>      
    <table class="table table-hover display nowrap live-data-table export" style="width:100%" id="UserTable"> 
        <thead>
            <tr>
                <th class="table-header">Title</th>
                <th class="table-header">SME</th>
                <th class="table-header">Status</th>
                <th class="table-header">Epic Name</th>
                <th class="table-header">Topic</th>

            
            </tr>
        </thead>
         <tfoot>
    <tr>
                <th class="table-header">Title</th>
                <th class="table-header">SME</th>
                <th class="table-header">Status</th>
                <th class="table-header">Epic Name</th>
                <th class="table-header">Topic</th>
              
    </tr>
  </tfoot>
        <tbody>
<?php
$SMEID = $_SESSION['login_user_data']['staff_id'];
require_once ("Model/epic.php");
$faq = new epic();
$myfeatureResult = $faq->getmyfeature($SMEID);
foreach ($myfeatureResult as $k => $v) {
    ?>
        <tr class="table-row">
               
               
                 <td><a style="text-decoration:none" href="https://pm.mastaz.ch/feature-request.php?f_id=<?php echo $myfeatureResult[$k]["f_id"];?>"><?php echo $myfeatureResult[$k]["f_title"]; ?></a></td>
                 <td><?php echo $myfeatureResult[$k]["staff_firstname"]; ?>&nbsp; <?php echo $myfeatureResult[$k]["staff_lastname"]; ?></td>
                 <td><?php echo $myfeatureResult[$k]["statusename"]; ?></td>
                 <td><?php echo $myfeatureResult[$k]["e_title"]; ?></td>
                  <td><?php echo $myfeatureResult[$k]["topicsname"]; ?></td>

                  
            
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



