<?php
/**
 *
 */
// The active item id in side
$activeSide = null;

// The active item id in top
$activeTop = null;
?>
<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/partner">coupon-service.com </a>
    </div>
    <!-- /.navbar-header -->
    <?=$this->renderElement('navigation/navbar-top', array('active' => $activeTop));// top navi with dropdown ?>
    <?=$this->renderElement('navigation/navbar-side', array('active' => $activeSide));// top navi with dropdown ?>
</nav>

