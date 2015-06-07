<?php
/**
 * User: Nahid Hossain
 * Email: mail@akmnahid.com
 * Phone: +880 172 7456 280
 * Date: 6/5/2015
 * Time: 10:25 PM
 */
?>
<nav>
    <ul class="pagination">
       <?php /* <li>
            <a href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        */ ?>
        <?php for($i=1;$i<=$noOfPage; $i++){ ?>
            <li <?php if($i==$currentPage) echo 'class="active"'; ?>><a href="<?= site_url(str_replace("@pageNo",$i,$url)) ?>"><?= $i ?></a></li>
        <?php } ?>
        <?php /*
        <li>
            <a href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
        */ ?>
    </ul>
</nav>