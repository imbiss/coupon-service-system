<?php

?>
<div id="wrapper">
    <?=$this->renderElement('navigation', array());?>

    <div id="page-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">错误</h1>
            </div>
            <!-- /.col-lg-12 -->

        </div>

        <?=$this->renderElement('Notifications');?>

        <?php
            if (isset($exception)) {
                print("<pre>");
                print_r($exception);
                print("</pre>");
            }
        ?>

    </div><!-- page-wrapper end -->
    <?=$this->renderElement('Footer');?>

</div>