<?php

$messages = isset($messages) ? $messages : array();
$messages = is_array($messages) ? $messages : array($messages);

?>
<div class="container">

    <div class="row">

        <div class="col-md-4 col-md-offset-4">
            <?php
                if (true || isset($messages)) {
                    echo $this->renderElement('messagebox', array('messages'=>$messages));
                }
            ?>
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Partner Sign In</h3>
                </div>

                <div class="panel-body">
                    <form role="form" action="/partner/login" method="post">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="">
                            </div>
                            <!--
                            <div class="checkbox">
                                <label>
                                    <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                </label>
                            </div>
                            -->
                            <button type="submit" class="btn btn-lg btn-success btn-block" name="submit">Login</button>

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?=$this->renderElement('Footer');?>

</div>