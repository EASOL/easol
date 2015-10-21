<div class="row">
    <div class="pagination-dsc col-md-6 col-sm-6">
        <?php if ($total < $pageSize * $currentPage) { ?>
            <p>Showing <?= $pageSize * ($currentPage - 1) + 1 ?>&ndash;<?= $total ?> of <?= $total ?></p>
        <?php } else { ?>
            <p>Showing <?= $pageSize * ($currentPage - 1) + 1 ?>&ndash;<?= $pageSize * $currentPage ?> of <?= $total ?></p>
        <?php } ?>
    </div>
    <div class="col-md-6 col-sm-6">
        <nav class="pull-right">
            <ul class="pagination">
               <?php /* <li>
                    <a href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                */ ?>
                <?php for($i=1;$i<=$noOfPage; $i++){ ?>
                    <li <?php if($i == $currentPage) echo 'class="active"'; ?>><a href="<?= site_url(str_replace("@pageNo",$i,$url)) ?><?= (trim($_SERVER['QUERY_STRING'])!="") ? "?".$_SERVER['QUERY_STRING'] : "" ?>"><?= $i ?></a></li>
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
    </div>
</div>