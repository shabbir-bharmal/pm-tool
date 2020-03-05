<div class="row justify-content-center align-items-center" style="height:75vh">
    <div class="col-md-4 center-block mx-auto">
        <div class="card">
            <div class="card-body">
                <form action="<?php echo W_ROOT; ?>/form-action.php" method="post" id="login_form">
                    <input type="hidden" name="action" class="form-control" id="action" value="user-login">
                    <div class="form-group">
                        <label>Benutzername (K&uuml;rzel:</label>
                        <input class="form-control" type="text" name="username">
                    </div>
                    <div class="form-group">
                        <label>Passwort:</label>
                        <input class="form-control" type="password" name="password">
                    </div>
                    <div class="form-group">
                        <p class="text-danger"><?php echo $error; ?></p>
                    </div>
                    <input class="btn btn-primary" type="submit" value=" Login "/>
                    <a href="mailto:wurp@zhaw.ch?subject=PMmastaz:%20Passwort&amp;body=Hallo%20Philipp,%0D%0A%0D%0AIch%20brauche%20ein%20Passwort%20fuer%20pm.mastaz.ch">Passwort vergessen? Kein Login?</a>        
                </form>
            </div>
        </div>
    </div>
</div>