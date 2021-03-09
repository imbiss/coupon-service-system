<?php
/**
 * Render menu
 *
 */
if (isset($level)) {
    $level++;
}

switch($level) {
    case 1:
        break;

    case 2:
        $menu->className .= " nav-second-level ";
        break;

    case 3:
        $menu->className .= " nav-third-level ";
        break;
}

?>

<ul class="<?=$menu->className;?>" id="<?=$menu->id;?>">
        <?php
            foreach($menu->items as $item) {
                ?>
                <li class="<?=$item->styleClassName;?>">
                    <?=$item->content;?>
                    <?php
                    if (Coupon\UI\Menu::hasChild($item) ) {
                        // second level menu
                        echo $this->renderElement('navigation/side-menu/menu', array('menu'=>$item->child, 'level'=>$level++));
                    } else {
                        // do nothing
                    }
                    ?>
                </li>

            <?php
            }
        ?>
</ul>