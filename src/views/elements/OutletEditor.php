<?php
/***
 * Outlet editor
 *
 */


if (!isset($piModel)) {
    $piModel = array();
}

?>



<div class="form-group">
    <label for="countrySelId" class="control-label">所在国家/地区</label>
    <select id="countrySelId" class="selectpicker show-tick form-control" data-live-search="true" name="country_code">
        <?php
        // $k: country code, $v: country name
        foreach($country as $k => $v)
        {
            ?>
            <option value="<?=$k?>" <?=$form->selected('country_code', $piModel, $k);?> ><?=$v;?></option>
        <?php
        }
        ?>
    </select>
</div>

<div class="form-group">
    <label for="piNameCn">中文名称</label>
    <input type="text" name="name_cn" class="form-control" id="piNameCn" placeholder="中文名称"  <?=$form->value('name_cn', $piModel);?> >
</div>

<div class="form-group">
    <label for="piNameAlias">中文别名</label>
    <input type="text" name="name_cn_alias" class="form-control" id="piNameAlias" placeholder="中文别名" <?=$form->value('name_cn_alias', $piModel);?>>
</div>

<div class="form-group">
    <label for="piNameLatin">西文名称</label>
    <input type="text" name="name_latin" class="form-control" id="piNameLatin" placeholder="西文名称" <?=$form->value('name_latin', $piModel);?> >
</div>

<div class="form-group">
    <label for="piWebsite">官方网站</label>
    <input type="url" name="website" class="form-control" id="piWebsite" placeholder="http://" <?=$form->value('website', $piModel);?> >
</div>

<div class="form-group">
    <label for="piLocalLng">地理位置/经度(Long) </label>
    <input type="text" name="lng"  class="form-control" id="piLocalLng" placeholder="0.000000000"  <?=$form->value('lng', $piModel);?>  >
</div>

<div class="form-group">
    <label for="piLocalLat">地理位置/纬度(Lat)</label>
    <input type="text" name="lat" class="form-control" id="piLocalLat" placeholder="0.000000000"  <?=$form->value('lat', $piModel);?>  >
</div>
