<?php
header('Content-Type: text/html; charset=ISO-8859-1');
session_start();
error_reporting(0);

define('WROOT', 'http://localhost/pm_tool');

include_once 'database.php';

$db                       = new Database();
$db_connection            = $db->connect();
$topics                   = $db->getTopics();
$selected_topic           = ($_GET && $_GET['topic']) ? $_GET['topic'] : ($topics ? $topics[0]['id'] : 0);
$actual_product_increment = $db->getActualProductIncrement();
$product_increments       = $db->getOtherProductIncrements($actual_product_increment['pi_id']);
$staff_members            = $db->getStaffByTopic($selected_topic);


if(!$_SESSION['login_user_data'] || ($_SESSION['login_user_data'] && $_SESSION['login_user_data']['can_edit_roadmap'] == 0)){
	$error = "You don't have enough permission to view this page.";
}

?>
<!doctype html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PM Tool</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" href="css/app.css"/>
</head>
<body>
<!-- Content here -->
<header>
	<?php include_once('parts/header-auth.php'); ?>
</header>
<div class="container-fluid mt-3">
    
    <div class="row align-items-center mb-3">
        <!-- Topic select box start -->
        <div class="col-md-10">
            <form method="get" name="filter_topic" class="form-horizontal">
                <div class="form-group row p-3 mb-0">
                    <h2 class="m-0"><img src="<?php echo WROOT;?>/favicon.ico" style="height:30px;margin-right:10px">Epic Roadmap Planning</h2>

                    <div class="col-md-3">
                        <select class="form-control" id="topic" name="topic">
							<?php foreach ($topics as $topic) {
								$selected = $topic['id'] == $selected_topic ? "selected='selected'" : ""; ?>
                                <option value="<?php echo $topic['id']; ?>" <?php echo $selected; ?>><?php echo $topic['name']; ?></option>
							<?php } ?>
                        </select>
                    </div>
                    
                </div>
            </form>
            <form method="post" action="<?php echo WROOT; ?>/form-action.php" name="delete_feature" id="delete_feature" class="form-horizontal">
                <input type="hidden" id="f_id" name="f_id" value="">
                <input type="hidden" name="action" class="form-control" id="action" value="feature-delete">
                <input type="hidden" name="topic_id" value="<?php echo $selected_topic; ?>">
            </form>
        </div>
        <div class="col-md-2 text-right">
            <button type="button" id="incpi" class="btn btn-primary">Show +1 PI</button>
        </div>
    </div>
    <div class="row">
        <!-- Topic select box end -->

        <!-- PM tool start -->
		<?php include_once('parts/epic-pm-tool.php'); ?>
        <!-- PM tool end -->
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="//code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="//stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="//use.fontawesome.com/bb08efb11a.js"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
<script src="js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script type="text/javascript">
	var wroot = '<?php echo WROOT;?>';
</script>
<script src="js/app.js" type="text/javascript"></script>
</body>
</html>