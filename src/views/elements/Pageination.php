 <?php
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-2-14
 * Time: 下午8:49
 */
 /* @var $pagination Outlet\Utility\Pagination */

 $clsDisabled = "disabled";
 $clsActive = "active";
 $pageCount = $pagination->getPageCount();
 $currentPage = $pagination->getCurrentPageNum();

 //@var array
 $parms = $_REQUEST;

 // Previous page link
 if ($currentPage <= 1) {
     $pagePrevClassName ='disabled';
     $parms['page']  = 0;
 } else {
     $pagePrevClassName = '';
     $parms['page']  = $currentPage - 1;
 }
 $lnkPre = http_build_query($parms);

 // Next page link
 if ($currentPage >= $pageCount) {
     $pageNextClassName = 'disabled'; // Last page
 } else {
     $pageNextClassName = '';
     $parms['page']  = $currentPage + 1;
 }
 $lnkNext = http_build_query($parms);

?>

<div class="text-center">
    <ul class="pagination">
        <li class='<?=$pagePrevClassName;?>'><a href="?<?=$lnkPre;?>">&laquo;</a></li> <!-- previous -->
        <?php

            for($i=1; $i<=$pageCount; $i++)
            {
                $parms['page'] = $i;
                $link =  http_build_query($parms);
                $className = ($i==$currentPage) ? "active" : '';
        ?>
        <li class="<?=$className;?>"><a href="?<?=$link;?>"><?=$i;?></a></li>
        <?php
            }
        ?>
        <li class="<?=$pageNextClassName;?>"><a href="?<?=$lnkNext;?>">&raquo;</a></li><!-- next -->
    </ul>
</div>
