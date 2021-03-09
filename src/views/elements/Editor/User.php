<?php


// Partner信息
if (!isset($data)) {
    $data = array();
}




?>

<!-- Nav tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#basic" data-toggle="tab">基本</a></li>
    <li><a href="#firma" data-toggle="tab">公司</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">


    <!-- Tab  -->
    <div class="tab-pane active" id="basic">
        <span class="help-block">基本</span>

        <?php
            if (isset($data['uuid']) && !empty($data['uuid'])) {
        ?>
        <div class="form-group">
            <label for="email">UUID标示</label>
            <input type="text" class="form-control" id="userUuid" name="userUuid" value="<?=bin2hex($data['uuid']); ?>" readonly>
            <input type="hidden" name="uuid" value="<?=bin2hex($data['uuid']); ?>" >
        </div>
        <?php
            }
        ?>

        <div class="form-group">
            <label for="email">登录名/Email</label>
            <input type="Email" class="form-control" id="email" placeholder="登录邮箱地址" name="email" <?=$form->value('email', $data);?> >
        </div>

        <div class="form-group">
            <label for="password">密码</label>
            <input type="password" class="form-control" id="password" placeholder="登录密码" name="password" >
            <?php
                if ($editMode == "edit") {
                    // edit模式下，显示附加说明
            ?>
                <span class="help-block">如果不打算修改密码，请保持此处空白。</span>
            <?php
                }
            ?>

        </div>

        <div class="form-group">
            <label for="password_repeat">重复密码</label>
            <input type="password" class="form-control" id="password_repeat" placeholder="重复登录密码" name="password-repeat" >
            <?php
            if ($editMode == "edit") {
                // edit模式下，显示附加说明
                ?>
                <span class="help-block">如果不打算修改密码，请保持此处空白。</span>
            <?php
            }
            ?>
        </div>


        <div class="checkbox">
            <label for="active">账户已激活</label>
            <input type="checkbox" name="active" id="active" <?=$form->checked('active', $data);?>  >
        </div>

    </div>

    <!-- Tab -->
    <div class="tab-pane" id="firma">
        <?php
            if (isset($partnerInfo)) {
                var_dump($partnerInfo);
            }
        ?>
    </div>
</div>

<!-- buttons -->
<div class="form-actions">
    <button type="reset"  class="btn btn-default">重设</button>
    <button type="submit" name="submit" value="submit" class="btn btn-primary">
        <?php
           echo ($editMode == "add") ? "添加" : "修改";
        ?>
    </button>
</div>