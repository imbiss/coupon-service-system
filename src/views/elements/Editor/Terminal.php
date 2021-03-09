<?php
/**
 * 编辑销售终端
 */
$paneHeading = "";
$buttonText = "";
$client =  isset($client) ? $client : array();
$action = "";
if (!isset($FormHelper)) {
    $FormHelper = new Coupon\View\Helper\Form();
}
if (!isset($partners)) {
    $partners = array();
}

switch ($type) {
    case 'add' :
        $paneHeading = "添加";
        $buttonText = "添加";
        $action = '/admin/terminal/add';
        break;

    case 'edit':
        $paneHeading = "编辑";
        $buttonText = "保存";
        $action = '/admin/terminal/edit';
        break;

    default:
        break;
}
?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading"><?=$paneHeading;?></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">

                        <form role="form" method="post" action="<?=$action?>">

                            <?php
                            if ($type=='edit') {
                                $client['uuid'] = bin2hex($client['uuid']);
                            ?>
                                <input type="hidden" name="uuid" <?=$form->value('uuid', $client); ?> />
                                <div class="form-group">

                                </div>
                            <?php
                                }
                            ?>

                            <div class="form-group">
                                <label>所属伙伴</label>
                                <select name="partnerUuid" class="form-control">
                                    <?php
                                        echo $FormHelper->options($partners, null);
                                    ?>
                                </select>
                            </div>


                            <div class="form-group">
                                <label>名称</label>
                                <input class="form-control" name="name" <?=$form->value('name', $client);?>>
                                <p class="help-block">比如 测试online shop</p>
                            </div>

                            <div class="form-group">
                                <label>简短描述</label>
                                <input class="form-control" name="description" <?=$form->value('description', $client);?> >
                            </div>

                            <div class="form-group">
                                <label>状态</label>
                                <select class="form-control" name="status">
                                    <?php
                                        foreach (\Coupon\Model\Client::getStatusPair() as $key => $opt) {
                                            printf("<option  value=\"%s\" %s>%s</option>",
                                                $key,
                                                $form->selected('status' , $client , $key),
                                                $opt
                                            );
                                        }
                                    ?>
                                </select>
                            </div>


                            <button class="btn btn-primary" type="submit" name="submit" value="submit">
                                <?=$buttonText;?>
                            </button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
