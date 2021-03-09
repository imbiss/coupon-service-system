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
            <p>每个可以使用的代金卷的站点(Web)或者应用程序(App)都称为一个销售终端。每个终端可以绑定多种代金券。
            在一个终端的所有<strong>代金卷号码不能重复</strong>。
            <p>终端的添加和修改由管理员完成。点击<a href="/partner/terminal/request">这里申请新终端</a>。</p>
        </div>

        <?=$this->renderElement('Table/Standard', array('data'=>$results))?>



    </div><!-- page-wrapper end -->
    <?=$this->renderElement('Footer');?>

</div>