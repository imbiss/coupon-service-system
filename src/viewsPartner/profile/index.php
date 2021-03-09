<div id="wrapper">
    <?=$this->renderElement('navigation', array());?>

    <div id="page-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">账户</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <?=$this->renderElement('Notifications');?>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        　账户信息
                    </div>
                    <div class="panel-body">
                        <?=$this->renderElement('List/Table', array('list' => $userData));?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        　修改密码
                    </div>
                    <div class="panel-body">

                        <form role="form" action="/partner/profile/changePassword" method="post" class="form-inline"  >

                            <div class="form-group">
                                <label>当前密码</label>
                                <input type="password" name="password-current" class="form-control"  />
                            </div>


                            <div class="form-group">
                                <label>新密码</label>
                                <input type="password" name="password" class="form-control"  />
                            </div>

                            <div class="form-group">
                                <label>新密码重复</label>
                                <input type="password" name="password-repeat" class="form-control" />
                            </div>

                            <div class="form-group">
                                <button type="submit" name="submit-changePassword" value="submit" class="btn btn-default">更改密码</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?=$this->renderElement('Footer');?>
</div>