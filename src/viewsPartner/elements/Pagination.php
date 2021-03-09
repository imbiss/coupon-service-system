<?php
/**
 * 分页功能
 * 接收参数包括
 * $pagination

 * $pageVarName 页面变量的名称 默认page
 */

/* @var $pagination Outlet\Utility\Pagination */

$count = $pagination->getRecordCount();
$currentPage = $pagination->getCurrentPageNum();
$proPage = $pagination->getRecordProPage();
$varNamePaging = $pagination->getPageVarName(); //URL Parameter name for page

$path = $_SERVER['REQUEST_URI'];
$lastPageUrlParam = $nextPageUrlParam = $_GET;// Only for no URL Rewrite
$proPage = isset($proPage) ? intval($proPage) : 100;
$pageMax = $pagination->getPageCount();

$params = array(); // Parameter for all _GET parameters (before URL Rewrite)
$path = $_SERVER['REQUEST_URI'];
$pos = strpos($_SERVER['REQUEST_URI'], '?'); // find ?
if ($pos > 0) {
    // found "?"
    $str = substr($path, $pos+1);
    $path = substr($path, 0, $pos);
    parse_str($str, $params);
}


$lastPageUrlParam = $params;
$lastPage = $currentPage - 1;
$lastPage = ($lastPage<1) ? 1 : $lastPage;
$lastPageUrlParam[$varNamePaging]= $lastPage;//add page
$lastPageUrl = sprintf("%s?%s", $path, http_build_query($lastPageUrlParam));


$nextPageUrlParam = $params;
$nextPage = $currentPage + 1;
$nextPage = ($nextPage >= $pageMax)? $pageMax : $nextPage;
$nextPageUrlParam[$varNamePaging] = $nextPage;// add page
$nextPageUrl = sprintf("%s?%s", $path, http_build_query($nextPageUrlParam));


?>
<nav>
    <ul class="pagination">
        <li><a href="<?=$lastPageUrl;?>"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>
        <?php
            for($i=1; $i<=$pageMax; $i++) {
                $params[$varNamePaging] = intval($i);//加入page参数
                //$query=http_build_query($urlArray);
                //$url = sprintf("?%s", $query);
                $url = sprintf("%s%s%s", $path,  '?', http_build_query($params));
                $class = ($i==$currentPage) ? ('active') : '';
        ?>
                <li class="<?=$class;?>"><a href="<?=$url;?>"><?=$i?></a></li>
        <?php
            }
        ?>
        <li><a href="<?=$nextPageUrl;?>"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>
    </ul>
</nav>