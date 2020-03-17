<a href="" data-toggle="modal" data-target="#accountModal" class="btn btn-primary ml-2"><i class="fa fa-cog" aria-hidden="true"></i></a>
<form action="<?php echo W_ROOT . '/form-action.php'; ?>" method="post" id="my_account_form" name="my_account_form" enctype='multipart/form-data'>
<div class="modal fade" id="accountModal" tabindex="-1" role="dialog" aria-labelledby="accountModallLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">My Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                    <input type="hidden" name="action" id="action" value="manage-account">
                    <input type="hidden" name="staff_id" id="staff_id" value="<?php echo $login_id;?>">
                    <ul class="nav nav-tabs nav-fill" id="accountTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="account-tab" data-toggle="tab" href="#account" role="tab" aria-controls="account" aria-selected="true">Account
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="berechtigungen-tab" data-toggle="tab" href="#berechtigungen" role="tab" aria-controls="berechtigungen" aria-selected="false">Berechtigungen</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="beobachtungen-tab" data-toggle="tab" href="#beobachtungen" role="tab" aria-controls="beobachtungen" aria-selected="false">Beobachtungen</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="ansichtskonfigurationen-tab" data-toggle="tab" href="#ansichtskonfigurationen" role="tab" aria-controls="ansichtskonfigurationen" aria-selected="false">Ansichtskonfigurationen</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="accountTabContent">
                        <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
							<?php include_once(F_ROOT . 'parts/manage-account/account_tab.php'); ?>
                        </div>
                        <div class="tab-pane fade" id="berechtigungen" role="tabpanel" aria-labelledby="berechtigungen-tab">
							<?php include_once(F_ROOT . 'parts/manage-account/berechtigungen_tab.php'); ?>
                        </div>
                        <div class="tab-pane fade" id="beobachtungen" role="tabpanel" aria-labelledby="beobachtungen-tab">
							<?php include_once(F_ROOT . 'parts/manage-account/beobachtungen_tab.php'); ?>
                        </div>
                        <div class="tab-pane fade" id="ansichtskonfigurationen" role="tabpanel" aria-labelledby="ansichtskonfigurationen-tab">
							<?php include_once(F_ROOT . 'parts/manage-account/ansichtskonfigurationen_tab.php'); ?>
                        </div>
                    </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
</form>