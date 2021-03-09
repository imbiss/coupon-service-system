<?php
/**
 *
 * 标准的数据表，
 * 支持隐藏列(hiddenColumns)
 * 支持附加列(extraColumnsTpl)，用于添加操作按钮.
 * 支持列名翻译器(columnsTranslator)
 *
 * User: hongyi
 * Date: 14-8-7
 * Time: 下午9:44
 */
// Data数据列
if (count($data) > 0) {
    $columns = array_keys($data[0]); // 取出第一列的数据的key作为列


    //附加列内的内容模版
    $extraColumnsTpl = isset($extraColumnsTpl) ?  $extraColumnsTpl : null;

    //附加列模版路径
    $extraColumnsPath = "Table/Column/";

    // 隐藏列的名字
    $hiddenColumns = (isset($hiddenColumns) && is_array($hiddenColumns)) ? $hiddenColumns : array();

    // 隐藏列
    $extraColumns = (isset($extraColumns)) ? $extraColumns : array();

    // 列过滤器
    $columnsFilter = isset($columnsFilter) ? $columnsFilter : null;

?>
<div class="table-responsive">
    <div class="dataTables_wrapper form-inline" role="grid">
        <table class="table table-striped table-bordered table-hover dataTable no-footer">
            <thead>
                <tr>
                <?php
                    // print the table header
                    foreach ($columns as $c)
                    {
                        if (!in_array($c, $hiddenColumns)) {
                            // column not in hidden columns array
                ?>
                    <th><?=isset($columnsTranslator) ? $columnsTranslator->translate($c) : $c;?></th>
                <?php
                        }
                    }
                    // 打印附加列标题
                    if (count($extraColumns) > 0) {
                        foreach($extraColumns as $e) {
                    ?>
                        <th><?=$e->title;?></th>
                    <?php
                        }
                    }
                ?>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach($data as $key => $row){
                    // 打印每行
            ?>
            <tr>
                <?php
                    foreach($row as $colName =>  $col) {
                        // 打印每列(每格)
                        if (!in_array($colName, $hiddenColumns)) { // 如果该列无需隐藏
                            ?>
                            <td><?= isset($columnsFilter) ? $columnsFilter->filter($col, $colName, $row) : $col; ?></td>
                        <?php
                        }
                    }
                    // 打印附加列内容
                    if (isset($extraColumns) && count($extraColumns)>0) {
                        // 如果含有额外列
                        foreach($extraColumns as $c){
                 ?>
                 <td>
                     <?=$this->renderElement( $c->getTplFullPath(), array('row'=>$row))?>
                 </td>
                 <?php
                        }
                    }
                ?>
            </tr>
            <?php
                }
            ?>
            </tbody>
        </table>
    </div>
</div>
<?php
    } else {
?>
    <div style="clear:both;">No data</div>
<?php
}
?>