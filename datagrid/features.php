<?php
namespace Phppot;

use Phppot\Model\epic;
error_reporting(0);
?>

<html>
<head>
<title>Features Live Inline Update data</title>
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
	</header>
  <!-- Scripts from pm.mastaz.ch Root  STOP-->
  
  
  <div class="data-main-heading">
    <h1 align="center">Features Live Inline Update data</h1>
  </div>
    <table class="table table-hover display nowrap live-data-table export" style="width:100%" id="UserTable"> 
        <thead>
            <tr>
                
                <th class="table-header">Title</th>
                <th class="table-header">Description</th>
                <th class="table-header">Story Points</th>
                <th class="table-header">Topics</th>
                <th class="table-header">PI</th>
                <th class="table-header">Ranking</th>
             
                <th class="table-header">Status </th>
                <th class="table-header">BV</th>
                <th class="table-header">TC</th>
                <th class="table-header">RR/OE</th>
                 <th class="table-header">JS</th>
                 <th class="table-header">WSJF</th>
           <!--      <th class="table-header">Epic</th> -->
            </tr>
        </thead>
         <tfoot>
    <tr>
     
                <th class="table-header">Title</th>
                <th class="table-header">Description</th>
                <th class="table-header">Story Points</th>
                <th class="table-header">Topics</th>
                <th class="table-header">PI</th>
                <th class="table-header">Ranking</th>
          
                <th class="table-header">Status </th>
                <th class="table-header">BV</th>
                <th class="table-header">TC</th>
                <th class="table-header">RR/OE</th>
                 <th class="table-header">JS</th>
                 <th class="table-header">WSJF</th>
                <!-- <th class="table-header">Epic</th> -->
    </tr>
  </tfoot>
        <tbody>
<?php
require_once ("Model/epic.php");
$faq = new epic();
$faqResult = $faq->getFAQ();
$PiResult = $faq->getPI();
$epicsResult = $faq->epics();
$topicsResult = $faq->topics();
$statusResult = $faq->status();


//print_r($status);



 

foreach ($faqResult as $k => $v) {
    ?>
        <tr class="table-row">
               
                <td class="title" contenteditable="true"
                    onBlur="saveToDatabase(this,'f_title','<?php echo $faqResult[$k]["f_id"]; ?>')"
                    onClick="showEdit(this);"><?php echo $faqResult[$k]["f_title"]; ?></td>
                <td contenteditable="true"
                    onBlur="saveToDatabase(this,'f_desc','<?php echo $faqResult[$k]["f_id"]; ?>')"
                    onClick="showEdit(this);"><?php echo $faqResult[$k]["f_desc"]; ?></td>
                <td class="digits_Only" contenteditable="true"
                    onBlur="saveToDatabase(this,'f_storypoints','<?php echo $faqResult[$k]["f_id"]; ?>')"
                    onClick="showEdit(this);"><?php echo $faqResult[$k]["f_storypoints"]; ?></td>

                  <td  contenteditable="false" onBlur="saveToDatabase(this,'f_topic_id','<?php echo $faqResult[$k]["f_id"]; ?>')" onClick="showEdit(this);">

                        <select name="webste" class="topic" id="<?php echo $faqResult[$k]["f_id"];?>">
                          <option value="0">-- bitte wählen --</option>
                            <?php if($faqResult[$k]['f_topic_id'] > ' '){ ?>
                                <option value="<?php echo $faqResult[$k]["f_topic_id"]; ?>" selected="selected"><?php echo $faqResult[$k]["tname"]; ?></option>
                            <?php } ?> 
                          
                            <?php 
                            
                           foreach ($topicsResult as $v) {
                            ?>
                                <option value="<?php echo $v["id"]; ?>"><?php echo $v["name"]; ?></option>
                            <?php } ?>     
                        </select>
                  </td>

                    <td  contenteditable="false" onBlur="saveToDatabase(this,'f_PI','<?php echo $faqResult[$k]["f_id"]; ?>')" onClick="showEdit(this);">

                        <select name="webste" class="sel" id="<?php echo $faqResult[$k]["f_id"];?>">
                          <option value="0">-- bitte wählen --</option>
                            <?php if($faqResult[$k]['f_PI'] > ' '){ ?>
                                <option value="<?php echo $faqResult[$k]["f_PI"]; ?>" selected="selected"><?php echo $faqResult[$k]["ptitle"]; ?></option>
                            <?php } ?> 
                          
                            <?php 
                            
                           foreach ($PiResult as $v) {
                            ?>
                                <option value="<?php echo $v["pi_id"]; ?>"><?php echo $v["pi_title"]; ?></option>
                            <?php } ?>     
                        </select>
                      </td>
     
                     <td><?php echo $faqResult[$k]["f_ranking"]; ?></td>




                     <td  contenteditable="false" onBlur="saveToDatabase(this,'f_status_id','<?php echo $faqResult[$k]["f_id"]; ?>')" onClick="showEdit(this);">

                     <select name="webste" class="status" id="<?php echo $faqResult[$k]["f_id"];?>">
                      <option value="0">-- bitte wählen --</option>
                            <?php if($faqResult[$k]['f_status_id'] > ' '){ ?>
                                    <option value="<?php echo $faqResult[$k]["f_status_id"]; ?>" selected="selected"><?php echo $faqResult[$k]["fname"]; ?></option>
                                <?php } ?> 
                         <?php 
                            
                           foreach ($statusResult as $v) {
                            ?>
                                <option value="<?php echo $v["id"]; ?>"><?php echo $v["name"]; ?></option>
                            <?php } ?>  
                          </select>
                 </td>

 
          <td class="price digits_Only"contenteditable="true"
                    onBlur="saveToDatabase(this,'f_BV','<?php echo $faqResult[$k]["f_id"]; ?>')"
                    onClick="showEdit(this);"><?php echo $faqResult[$k]["f_BV"]; ?>
            </td>
           <td class="price digits_Only" contenteditable="true"
                    onBlur="saveToDatabase(this,'f_TC','<?php echo $faqResult[$k]["f_id"]; ?>')"
                    onClick="showEdit(this);"><?php echo $faqResult[$k]["f_TC"]; ?></td>
          <td class="price digits_Only" contenteditable="true"
                    onBlur="saveToDatabase(this,'f_RROE','<?php echo $faqResult[$k]["f_id"]; ?>')"
                    onClick="showEdit(this);"><?php echo $faqResult[$k]["f_RROE"]; ?></td>
          <td class="digits_Only" id="demo" contenteditable="true"
                    onBlur="saveToDatabase(this,'f_JS','<?php echo $faqResult[$k]["f_id"]; ?>')"
                    onClick="showEdit(this);"><?php echo $js=$faqResult[$k]["f_JS"]; ?></td>
        
          <?php  $sum=$faqResult[$k]["f_BV"]+$faqResult[$k]["f_TC"]+$faqResult[$k]["f_RROE"];?>
          
          <td class="total"> <?php   echo  round("$sum"/"$js",3)  ?></td>
  
          
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


 $("input.filterTopics,input.filterPI,input.filterStatus ").on("keyup", function() {
       var val = $(this).val().toLowerCase();
        $("tbody tr").filter(function() {
          $(this).toggle($(this).find("option:selected").text().toLowerCase().indexOf(val) > -1)
        });
      });

    } );

    
  //  $("select.topic").each(function(){
  //            // var selectxt = $(this).find("#not-selected").remove(); 
  //            // //$(this).toggle()
  //            // console.log(selectxt);
  // });
 
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



<!--   <script >
  

  $(document).ready(function() {
    $('#UserTable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
             'excel'
        ]
    } );
} );
</script> -->  

<script>
// we used jQuery 'keyup' to trigger the computation as the user type
$( document ).ready(function() {

$('.table-row td.price,.table-row td#demo').keyup(function(){
var t_sum = 0;
var t_total = 0;
$(this).parents('.table-row').find('td.price').each(function(){
if($(this).text() != ''){
t_sum += parseInt($(this).text());
}
});
if($(this).parents('.table-row').find('td#demo').text() != ''){
var t_div = parseInt($(this).parents('.table-row').find('td#demo').text());
}else
{
  var t_div = 1;
}
t_total = t_sum / t_div;
console.log(t_total);
$(this).parents('.table-row').find('td.total').text(t_total.toFixed(3));
});

  //called when key is pressed in textbox
  $(".digits_Only").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        //$("#errmsg").html("Digits Only").show().fadeOut("slow");
        alert("Digits Only");
               return false;
    }
   });

});
</script>
<script type="text/javascript">
    $(".topic").change(function(){
        var featuresTopics = $(this).val();
        var f_id = $(this).attr('id');
         $.ajax({
                    url:"common-function.php",
                    method:"post",
                     data:{'method': 'getFeaturesTopicsSelectData', 'featuresTopics':featuresTopics,'f_id':f_id},
                    success: function(response){
                       //alert(response);
                    },
                });
         
        });
</script>

  
<script type="text/javascript">
    $(".sel").change(function(){
        var featuresPi = $(this).val();
         var f_id = $(this).attr("id"); 
          //alert(f_id);
         $.ajax({
                    url:"common-function.php",
                    method:"post",
                    data:{'method': 'getFeaturesPiSelectData', 'featuresPi':featuresPi,'f_id':f_id},
                    success: function(response){
                       //alert(response);
                    },
                });
         
        });
</script>

<script type="text/javascript">
    $(".status").change(function(){
        var featuresStatus = $(this).val();

        var f_id = $(this).attr('id');
        //alert(f_id);
        
         $.ajax({
                    url:"common-function.php",
                    method:"post",
                     data:{'method': 'getFeaturesStatusSelectData', 'featuresStatus':featuresStatus,'f_id':f_id},
                    success: function(response){
                       //alert(response);
                    },
                });
         
        });
</script>
<?php } ?>




