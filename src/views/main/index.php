<?php
echo $this->renderElement('navi', array());
?>
<div class="container" id="welcome">

    <div class="row">

        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img data-src="/admin/holder.js/300x200" alt="...">
                <div class="caption">
                    <h3>销售终端</h3>
                    <p>管理所有终端</p>
                    <p>
                        <a href="/admin/terminal" class="btn btn-primary" role="button">进入</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img data-src="holder.js/300x200" alt="...">
                <div class="caption">
                    <h3>合作伙伴</h3>
                    <p>管理Partner帐号</p>
                    <p>
                        <a href="/admin/partner" class="btn btn-primary" role="button">进入</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img data-src="holder.js/300x200" alt="...">
                <div class="caption">
                    <h3>代金券</h3>
                    <p>管理代金券及号码</p>
                    <p>
                        <a href="/admin/coupon" class="btn btn-primary" role="button">进入</a>
                    </p>
                </div>
            </div>
        </div>
    </div>


</div>
<?php
echo $this->renderElement('footer', array());
?>