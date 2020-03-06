<?php
$name = $_SESSION['login_user_data']['staff_firstname'];
$roadmap = $_SESSION['login_user_data']['can_edit_roadmap'];

if($name){ ?>
<nav class="navbar navbar-light bg-light">
    <div class="topnav-left" >
		<ul class="nav">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Roadmap Planning
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
					<a class="dropdown-item" href="<?php echo W_ROOT.'/roadmap.php'?>">Features</a>
					<a class="dropdown-item" href="<?php echo W_ROOT.'/epic-roadmap.php'?>">Epics</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Feature Requests
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
					<a class="dropdown-item" href="<?php echo W_ROOT.'/feature-request.php';?>">Neuer Feature Request erfassen</a>
					<a class="dropdown-item" href="<?php echo W_ROOT.'/my-feature-request.php';?>">Meine Feature Requests</a>
				</div>
			</li>
		</ul>
	</div>
    <div class="topnav-right" >
		
            Hallo <?php echo $name;?>
			<a href="<?php echo W_ROOT.'/logout.php';?>" class="btn btn-primary ml-2"><i class="fa fa-sign-out" aria-hidden="true"></i> Log out</a>
		
	</div>
</nav>
	<?php
}

if($roadmap == 0){ ?>
	<div class="container-fluid mt-3">
		<div class="row">
			<div class="col-12 text-center">
				<h2><?php echo $error;?></h2>
			</div>
		</div>
	</div>
	</body>
	</html>
<?php
exit;
}


?>