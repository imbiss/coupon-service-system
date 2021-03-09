<?php
/**
 *
 * Print a directory list
 * @param: array $list
 * @param: $keyTranslator
 * @param: $$valueFilter
 */

?>
<dl>
        <?php
            foreach ($list as $key=>$value) {
                ?>
                <dt><?=(isset($keyTranslator)) ? $keyTranslator->translate($key) : $key; ?></dt>
                <dd><?=(isset($valueFilter)) ? $valueFilter->filter($value, $key, $list) : $value;?></dd>
            <?php
            }
        ?>
</dl>