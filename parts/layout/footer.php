<script src="//code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="//stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="//use.fontawesome.com/bb08efb11a.js"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
<script src="<?php echo W_ROOT.'/js/bootstrap-datetimepicker.min.js';?>" type="text/javascript"></script>
<script type="text/javascript">
	var wroot = '<?php echo W_ROOT;?>';
</script>
<script src="<?php echo W_ROOT.'/js/app.js';?>" type="text/javascript"></script>
<?php  if(isset($page)){ ?>
	<script src="<?php echo W_ROOT.'/js/'.$page.'.js';?>" type="text/javascript"></script>
<?php } ?>
<script type="text/javascript" src="<?php echo W_ROOT.'/js/comments-data.js';?>"></script>
<!-- Libraries -->
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.textcomplete/1.8.0/jquery.textcomplete.js"></script>
<script type="text/javascript" src="<?php echo W_ROOT.'/js/jquery-comments.js';?>"></script>

<!-- Mopinion Pastea.se  start --><script type="text/javascript">(function(){var id="yjnjrc7zohtd5iwsukdr9awr5kyeg5nhswk";var js=document.createElement("script");js.setAttribute("type","text/javascript");js.setAttribute("src","//deploy.mopinion.com/js/pastease.js");js.async=true;document.getElementsByTagName("head")[0].appendChild(js);var t=setInterval(function(){try{new Pastease.load(id);clearInterval(t)}catch(e){}},50)})();</script><!-- Mopinion Pastea.se end -->

<?php  
 if($datagrid_included=="yes"){   
?>
    <!-- Datagrid Scripts -->
<?php
//Notes from Philipp: I think we don't need this as we already called this before (but other version!)
// <script src="./vendor/jquery/jquery-3.2.1.min.js"></script> 
//Notes from Philipp: removed as it made some problems with the Help icons:
//<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
?>
<script src="./../../datagrid/assets/js/inlineEdit.js"></script>
<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>
<?php  
 }   
?>

</body>
</html>
