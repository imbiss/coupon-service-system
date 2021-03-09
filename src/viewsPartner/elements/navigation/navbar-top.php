<?php
/**
 * Build a top navbar right with drop down sections in top navigation
 * @parama $sections An array of Coupon\UI\DropdownSection Objects.
 */
$sectionMessages = new Coupon\UI\DropdownSection(array('name' => 'navigation/dropdown/messages', 'icon'=>'envelope'));
$sectionTasks = new Coupon\UI\DropdownSection(array('name' => 'navigation/dropdown/tasks', 'icon'=>'tasks'));
$sectionAlerts = new Coupon\UI\DropdownSection(array('name' => 'navigation/dropdown/alerts', 'icon'=>'bell'));
$sectionUsers = new Coupon\UI\DropdownSection(array('name' => 'navigation/dropdown/users', 'icon'=>'user'));

$sections = array(
    /*$sectionMessages->toArray(),
    $sectionTasks->toArray(),
    $sectionAlerts->toArray(),*/
    $sectionUsers->toArray()
);

?>
<ul class="nav navbar-top-links navbar-right">
    <?php
        foreach($sections as $section)
        {
    ?>
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-<?=$section['icon'];?> fa-fw"></i>
            <i class="fa fa-caret-down"></i>
        </a>
        <?=$this->renderElement($section['name'], array());?>
    </li>
    <?php
        }
    ?>
</ul>
