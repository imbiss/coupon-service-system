<?php
if(!isset($results)) {
    $results = array();
}



?>
<div id="wrapper">
    <?=$this->renderElement('navigation', array());?>

    <div id="page-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">销售终端</h1>
            </div>
            <!-- /.col-lg-12 -->

        </div>

        <?=$this->renderElement('Notifications');?>

        <div colass="row">
        </div>

        <?php
            if(isset($client) && count($client)>0) {
                echo $this->renderElement('List/Table', array('list'=>$client));
            }
        ?>


    </div><!-- page-wrapper end -->
    <?=$this->renderElement('Footer');?>

</div>