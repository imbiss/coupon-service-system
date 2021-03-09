<?php

// 选中的品牌
if (!isset($br_selected)) {
    $br_selected = array();
}
?>
<!-- Nav tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#basic" data-toggle="tab">基本</a></li>
    <li><a href="#images" data-toggle="tab">图片</a></li>
    <li><a href="#onsale" data-toggle="tab">销售商铺</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <!-- tab basic -->
    <div class="tab-pane active" id="basic">

        <div class="form-group" >
            <input type="hidden" class="form-control" name='uuid' <?=$form->value('uuid', $data);?> readonly />
        </div>


        <div class="form-group" >
            <label for="brand_id">品牌</label>
            <select id="brand_id" class="selectpicker"  data-live-search="true" name="brand_id">
                <?php
                if(isset($brands) && is_array($brands) ) {
                    foreach ($brands as $br) {
                        // 所有品牌
                        ?>
                        <option value="<?=$br['id'];?>" <?=$form->selected('brand_id', $data, $br['id']);?> >
                            <?=$br['name'];?>
                            <?=empty($br['cnames']) ? '' : '(' .$br['cnames'] . ')';?>
                        </option>
                    <?php
                    }
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="name">商品名称</label>
            <input type="text" class="form-control" id="name" placeholder="商品名称" name="name" <?=$form->value('name', $data);?> >
        </div>

        <div class="form-group">
            <label for="name_cn">中文官方名称</label>
            <input type="text" class="form-control" id="name_cn" placeholder="中文官方名称" name="name_cn" <?=$form->value('name_cn', $data);?> >
        </div>


        <div class="form-group">
            <label for="name_cn_alias">中文别名</label>
            <input type="text" class="form-control" id="name_cn_alias" placeholder="中文别名" name="name_cn_alias" <?=$form->value('name_cn_alias', $data);?> >
            <p class="help-block">如果有多个别名，请用;号分割。</p>
        </div>

        <div class="form-group">
            <label for="model">型号</label>
            <input type="text" class="form-control" id="model" placeholder="型号" name="model" <?=$form->value('model', $data);?> >
        </div>

        <div class="form-group">
            <label for="url">官网地址</label>
            <input type="url" class="form-control" id="url" placeholder="官网地址" name="url" <?=$form->value('url', $data);?> >
        </div>

        <div class="form-group">
            <label for="category_id">类别 </label>
            <select id="category_id_elm" class="selectpicker"  data-live-search="true" name="category_id">
                <?php
                if(isset($cats) && is_array($cats) ) {
                    foreach ($cats as $cat) {
                        // 所有类别
                        ?>
                        <option value="<?=$cat['id'];?>" <?=$form->selected('category_id', $data, $cat['id']);?> >
                            <?=$cat['name'];?>
                        </option>
                    <?php
                    }
                }
                ?>
            </select>
        </div>


        <div class="form-group">
            <label for="created">创建/修改时间</label>
            <p class="help-block"><?php
                printf('%s / %s',
                    empty($data['created']) ? '自动' : $data['created'],
                    empty($data['lastmodify']) ? '自动' : $data['lastmodify']
                );
                ?>
            </p>
        </div>




    </div>

    <div class="tab-pane" id="images">
        <span class="help-block">图片</span>

        <div class="form-group">
            <label for="model">产品封面图片地址</label>
            <input type="text" class="form-control" id="model" placeholder="产品封面图片地址" name="model" <?=$form->value('model', $data);?> >
        </div>


    </div>

    <div class="tab-pane" id="onsale">
        <span class="help-block">以下商铺有售</span>
    </div>

</div>

<!-- buttons -->
<div class="form-actions">
    <button type="reset"  class="btn btn-default">重设</button>
    <button type="submit" name="submit" value="submit" class="btn btn-primary">
        <?php
        echo ($controllerActionName == "add") ? "添加" : "修改";
        ?>
    </button>
</div>