<script src="//code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="//stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
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
</body>
</html>
