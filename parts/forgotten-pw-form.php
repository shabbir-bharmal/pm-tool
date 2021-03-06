<div class="row justify-content-center align-items-center" style="height:75vh">
    <div class="col-md-4 center-block mx-auto">
        <div class="card col-12">
            <div class="card-body col-12">
                <form action="<?php echo W_ROOT; ?>/form-action.php" method="post" id="forgotten_pw_form">
                    <input type="hidden" name="action" class="form-control" value="forgotten-pw">
                    <div class="form-group">
                        <label>Benutzername (4-stelliges K&uuml;rzel):</label>
                        <input class="form-control" type="text" name="username">
                    </div>
                    <div class="form-group">
                        <?php
                        if($success){
                            echo "<p class='text-success'>$success</p>";
                        }else if($error){
                            echo "<p class='text-danger'>$error</p>";
                        }
                        ?>
                    </div>
                    <input class="btn btn-primary" type="submit" value=" Neues Passwort generieren "/>
                    <a href="mailto:wurp@zhaw.ch">Hilfe?</a>   
                </form>
            </div>
        </div>
    </div>
</div>