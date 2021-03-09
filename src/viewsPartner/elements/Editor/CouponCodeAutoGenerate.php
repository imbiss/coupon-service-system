




<div class="row">
    <form role="form" method="post" action="/partner/couponcode/auto" >

        <input type="hidden" name="couponUuid" value="<?=$couponUuid;?>" />
        <input type="hidden" name="clientUuid" value="<?=$clientUuid;?>" />

        <div class="form-group">
            <label>优惠码格式</label>
            <select class="form-control">
                <option>默认 (7+3格式，7个字母/数字,3个字母/数字, 例如WJ09131-AOH)</option>
            </select>
            <p class="help-block">比如 WJ09131-AOH.</p>
        </div>

        <div class="form-group">
            <label>生成数量</label>
            <select class="form-control" name="amount">
                <option value="10">10</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <p class="help-block"></p>
        </div>

        <button class="btn btn-primary" type="submit" name="submit" value="submit">
            创建
        </button>

    </form>
 </div>