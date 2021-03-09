<?php
/**
 * @param array $list
 */
/* @var $keyTranslator Coupon\Translator\Columns */


?>
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
    <tbody>
    <?php
    foreach ($list as $key=>$value) {
        ?>
        <tr>
        <th><?=(isset($keyTranslator)) ? $keyTranslator->translate($key) : $key; ?></th>
        <td><?=(isset($valueFilter)) ? $valueFilter->filter($value, $key, $list) : $value;?></td>
        </tr>
    <?php
    }
    ?>
    </tbody>
</table>
</div>