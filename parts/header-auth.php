<?php
$name              = $_SESSION['login_user_data']['staff_firstname'];
$can_edit_roadmap  = $_SESSION['login_user_data']['can_edit_roadmap'];
$can_manage_config = $_SESSION['login_user_data']['can_manage_config'];
$staff_info = $_SESSION['login_user_data'];
$login_id   = $_SESSION['login_user_data']['staff_id'];
$show_cardfooter = $db->getStaffCardPermission($login_id);
$topic_permission = $db->getTopicsPermissionByStaffId($login_id);

if ($name) { ?>
    <nav class="navbar navbar-light bg-light">
        <div class="topnav-left">
            <ul class="nav">
                <li class="nav-item dropdown">
                    <a href="<?php echo W_ROOT . '/'; ?>"><i class="fa fa-home" style="font-size:20px;margin-top:10px;"></i></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Roadmaps
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1">
                        <a class="dropdown-item" href="<?php echo W_ROOT . '/roadmap.php' ?>">nach Topics</a>
                        <a class="dropdown-item" href="<?php echo W_ROOT . '/epic-roadmap.php' ?>">nach Epics</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Epics
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                        <a class="dropdown-item" href="<?php echo W_ROOT . '/epic-request.php'; ?>">Neuer Epic erfassen</a>
                        <a class="dropdown-item" href="<?php echo W_ROOT . '/my-epic.php'; ?>">Meine Epics</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Features
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink3">
                        <a class="dropdown-item" href="<?php echo W_ROOT . '/feature-request.php'; ?>">Neuer Feature erfassen</a>
                        <a class="dropdown-item" href="<?php echo W_ROOT . '/my-feature-request.php'; ?>">Meine Features</a>
                        <a class="dropdown-item" href="<?php echo W_ROOT . '/datagrid/my-features.php'; ?>">Meine Features 2.0 (Alpha Version)</a>
                    </div>
                </li>
				<?php if ($can_manage_config) {
					?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink4" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Admin
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink4">
                            <a class="dropdown-item" href="<?php echo W_ROOT . '/admin-config.php'; ?>">Config</a>
                            <a class="dropdown-item" href="<?php echo W_ROOT . '/datagrid/helptext.php'; ?>">Hilfe-Texte</a>
                            <a class="dropdown-item" href="<?php echo W_ROOT . '/datagrid/product-increments.php'; ?>">Produkt-Inkremente</a>
                            <a class="dropdown-item" href="<?php echo W_ROOT . '/datagrid/staff.php'; ?>">Mitarbeitende</a>
                            <a class="dropdown-item" href="<?php echo W_ROOT . '/datagrid/topics.php'; ?>">Topics</a>
                            <a class="dropdown-item" href="<?php echo W_ROOT . '/datagrid/epics.php'; ?>">Epics</a>
                            <a class="dropdown-item" href="<?php echo W_ROOT . '/datagrid/features.php'; ?>">Features</a>
                            <a class="dropdown-item" href="<?php echo W_ROOT . '/datagrid/featuretypes.php'; ?>">Feature Typen</a>
                        </div>
                    </li>
				<?php } ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink5" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Links
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink5">
                        <a class="dropdown-item" href="https://jira.zhaw.ch" target="_bank">Jira</a>
                        <a class="dropdown-item" href="https://confluence.zhaw.ch" target="_bank">Confluence</a>
                        <a class="dropdown-item" href="https://intra.zhaw.ch/finanzen-services/information-communication-technology/" target="_bank">Intranet (ICT)</a>
                        <a class="dropdown-item" href="https://www.integromat.com/" target="_bank">Integromat</a>
                        <a class="dropdown-item" href="https://www.scaledagileframework.com/" target="_bank">SAFe</a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="topnav-right">

            Hallo <?php echo $name; ?>
            <a href="<?php echo W_ROOT . '/logout.php'; ?>" class="btn btn-primary ml-2"><i class="fa fa-sign-out" aria-hidden="true"></i> Log out</a>
			<?php  include_once(F_ROOT . 'parts/my-account.php'); ?>
        </div>

    </nav>
	<?php
} else {
	include_once F_ROOT.'parts/error-auth.php';
	exit;
}
?>