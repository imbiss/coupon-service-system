<?php
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-2-3
 * Time: 下午8:13
 */
echo $this->renderElement('navi', array());

$cn = "auth"; // controller name
?>
    <div class="container">
        <?=$this->renderElement('Breadcrumbs', array());?>

        <div class="page-header">
            <h2>访问控制</h2>
        </div>

        <?php
        if(count($users) > 0) {
            ?>
            <table class="table table-striped table-bordered table-condensed">
                <thead>
                <tr>
                    <th>id</th>
                    <th>用户名</th>
                    <th>密码Hash</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($users as $user)
                {
                    ?>
                    <tr>
                        <td><?=$user['id'];?></td>
                        <td><?=$user['username'];?></td>
                        <td><?=$user['passwordhash'];?></td>
                        <td>
                            <a href="<?=$url->g($cn,'del', array('id'=>$user['id']));?>">删除</a> </td>
                    </tr>

                <?php
                }
                ?>
                </tbody>
            </table>

        <?php
        }else {
            ?>
            <p>没有记录</p>
        <?php
        }
        ?>

        <h2>添加</h2>
        <form role="form" action="index.php" method="post">
            <input type="hidden" name="controller" value="<?=$cn?>" />
            <input type="hidden" name="action" value="add" />

            <div class="form-group">
                <label for="shopName">用户名</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="勿用中文，切勿重复">
            </div>
            <div class="form-group">
                <label for="shopName">密码</label>
                <input type="password" class="form-control" id="cateName" name="password" placeholder="密码">
            </div>
            <input type="hidden" class="form-control" name="passwordhash" />
            <button type="submit" class="btn btn-default">添加</button>
        </form>

    </div>
<?php
echo $this->renderElement('footer', array());
?>