<?php
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-2-3
 * Time: 下午8:13
 */
echo $this->renderElement('navi', array('activeItem' => 'partner'));

$editMode = isset($editMode) ? $editMode : null;
switch($editMode)
{
    case 'edit':
        $actionUrl = "/admin/account/edit";
        $headline = "编辑用户";
        break;

    case 'add':
    default:
        $actionUrl = "/admin/account/add";
        $headline = "添加用户";
        break;
}
?>

    <div class="container">
        <?=$this->renderElement('Breadcrumbs', array());?>
        <div class="page-header">
            <h2><?=$headline;?></h2>
        </div>
        <?php
            echo $this->renderElement('messagebox', array('messages'=>isset($messages) ? $messages : null));
        ?>

        <form role="form" action="<?=$actionUrl;?>" method="post">
            <input type="hidden" name="partnerUuid" value="<?=$partnerUuid;?>" />
            <?=$this->renderElement('Editor/User', array('data' => $data));?>
        </form>
    </div>
<?php
echo $this->renderElement('footer', array());
?>