<?php
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-9-26
 * Time: 下午11:27
 */

$data = isset($data) ? $data : array();
$editMode = isset($editMode) ? $editMode : null;
switch($editMode) {
    case 'add':
        $actionUrl = '/admin/partner/add';
        $title = "添加新伙伴";
        $submitValue = "add";
        break;

    case 'edit':
        $actionUrl = '/admin/partner/edit';
        $title = "修改伙伴信息";
        $submitValue = "edit";
        break;

    default:
        throw new \Exception('Unknown edit mode');
        break;
}

    echo $this->renderElement('navi', array('activeItem' => 'partner'));

?>
    <div class="container">
        <?=$this->renderElement('Breadcrumbs', array());?>

        <?php
            echo \Coupon\View\Switcher::toPartner($this)->renderElement('Notifications');
        ?>

        <div class="page-header"><h1><?=$title;?></h1></div>

        <form role="form" action="<?=$actionUrl;?>" method="post">
            <input type="hidden" name="uuid" <?=$form->value('uuid', $data);?> />

            <div class="form-group">
                <label for="name">公司</label>
                <input type="text" class="form-control" id="name" name='name' placeholder="公司名字" <?=$form->value('name', $data);?> >
            </div>

            <div class="form-group">
                <label for="address">地址</label>
                <textarea class="form-control" id="address" placeholder="公司地址" name="address" ><?=$form->text('address', $data);?></textarea>
            </div>

            <div class="form-group">
                <label for="active">是否激活</label>
                <select name="active" id="active" class="form-control" >
                    <?php
                        for($i=0; $i<2; $i++) {
                    ?>
                        <option value="<?=$i;?>" <?=$form->selected('active', $data, $i); ?> >
                            <?=$i;?>
                        </option>
                        <?php
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="created">创建时间</label>
                <input type="text" id="created" <?=$form->value('created', $data)?>" class="form-control" readonly/>
            </div>

            <div class="form-group">
                <label for="lastmodify">最后修改</label>
                <input type="text" id="lastmodify" <?=$form->value('lastmodify', $data)?>" class="form-control" readonly/>
            </div>

            <div class="form-actions">
                <button type="reset"  class="btn btn-default">重设</button>
                <button type="submit" name="submit" value="<?=$submitValue;?>" class="btn btn-primary">
                    <?php
                    echo ($editMode == "add") ? "添加" : "修改";
                    ?>
                </button>
            </div>

        </form>
    </div>
<?php
    echo $this->renderElement('footer', array());
