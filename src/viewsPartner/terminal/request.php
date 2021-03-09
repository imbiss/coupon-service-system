<?php

?>
<div id="wrapper">
    <?=$this->renderElement('navigation', array());?>

    <div id="page-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">申请新的销售终端</h1>
            </div>
            <!-- /.col-lg-12 -->

        </div>

        <?=$this->renderElement('Notifications');?>

        <div colass="row">
            <p>请填写以下表格</p>
            <div class="col-lg-12">
                <form actio="/partner/terminal/request" role="form" method="post">
                    <div class="form-group">
                        <label>名称</label>
                        <input type="text" name="name"  class="form-control" />
                    </div>

                    <div class="form-group">
                        <label>简短描述</label>
                        <textarea name="description"  class="form-control"></textarea>
                    </div>

                    <button class="btn btn-primary" type="submit" name="submit" value="submit">
                       发送
                    </button>
                    <p class="help-block">创建后需要由管理员激活</p>

                </form>
            </div>
        </div>






    </div><!-- page-wrapper end -->
    <?=$this->renderElement('Footer');?>

</div>