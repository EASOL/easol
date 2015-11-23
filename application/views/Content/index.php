<div class="row">
    <div class="col-md-12 col-sm-12">
        <h1 class="page-header">Learning Lab</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <form class="form-inline undo-overrides">
                  <div id="content-index-query" class="form-group">
                    <label for="query">Keywords</label>
                    <input id="content-query" type="text" class="form-control input-sm" name="query" value="<?php echo (isset($_GET['query']) and !empty($_GET['query'])) ? $_GET['query'] : 'search text'; ?>">
                  </div>
                  <button type="submit" class="btn btn-default" id="content-search">Search</button>
                </form>
                <div class="pull-right">
                  <img src="<?php echo base_url().'/assets/img/learning_tapestry.png' ?>" border="0" />
                </div>
                <?php if (!empty($total_count)): ?>
                  <div>
                    Showing records <?= $start_count ?> to <?= $end_count ?> of <?= $total_count ?>
                  </div>
                <?php endif; ?>
                <?php if (isset($results)): ?>
                 <div class="left content-filters">
                    <?php foreach($filters_active as $k => $v) : ?>
                      <div class="checkbox">
                        <label class="tag tag-<?php echo strtolower($k) ?> button">
                          <input type="checkbox" class="filter_active" value="<?php echo $k ?>" checked><?php echo ucwords($v) ?>
                        </label>
                      </div>
                    <?php endforeach; ?>

                    <?php if (isset($filters->subjects)) { $filter = $filters->subjects; $filtername = 'subjects'; ?>
                    <p><?php echo ucwords(preg_replace('/[^\da-z]/i', ' ', rtrim($filtername, 's'))); ?></p>
                    <?php foreach ($filter as $key => $val) : ?>
                      <a class="content-index-filterlink" href="<?php echo $filter_base_url . '&' . rtrim($filtername, 's') . '=' . urlencode($key); ?>"><?php echo ucwords($key) . ' (' . $val . ')'; ?></a>
                    <?php endforeach; } ?>

                    <?php if (isset($filters->publishers)) { $filter = $filters->publishers; $filtername = 'publishers'; ?>
                    <p><?php echo ucwords(preg_replace('/[^\da-z]/i', ' ', rtrim($filtername, 's'))); ?></p>
                    <div id="publishers-list" class="filter-big-lists">
                        <form class="form-inline undo-overrides default-form-inline">
                            <div class="form-group">
                                <input class="search form-control input-sm" placeholder="Filter.."/>
                                <span class="sort" data-sort="filter-name"><i class="fa fa-lg ea-sort-alpha"></i></span>
                                <span class="sort" data-sort="filter-count"><i class="fa fa-lg ea-sort-numeric"></i></span>
                             </div>
                        </form>
                        <ul class="list list-unstyled">
                            <?php foreach ($filter as $key => $val) : ?>
                            <li>
                                <a class="content-index-filterlink" href="<?php echo $filter_base_url . '&' . rtrim($filtername, 's') . '=' . urlencode($key); ?>">
                                    <span class="filter-name"><?= ucwords($key) ?></span>
                                    <span class="filter-count">(<?= $val ?>)</span>
                                </a>
                            </li>
                            <?php endforeach; } ?>
                        </ul>
                    </div>

                    <?php if (isset($filters->resource_types)) { $filter = $filters->resource_types; $filtername = 'resource_types'; ?>
                    <p><?php echo ucwords(preg_replace('/[^\da-z]/i', ' ', rtrim($filtername, 's'))); ?></p>
                    <?php foreach ($filter as $key => $val) : ?>
                      <a class="content-index-filterlink" href="<?php echo $filter_base_url . '&' . rtrim($filtername, 's') . '=' . urlencode($key); ?>"><?php echo ucwords($key) . ' (' . $val . ')'; ?></a>
                    <?php endforeach; } ?>

                    <?php if (isset($filters->grades)) { $filter = $filters->grades; $filtername = 'grades'; ?>
                    <p><?php echo ucwords(preg_replace('/[^\da-z]/i', ' ', rtrim($filtername, 's'))); ?></p>
                    <?php foreach ($filter as $key => $val) : ?>
                      <a class="content-index-filterlink" href="<?php echo $filter_base_url . '&' . rtrim($filtername, 's') . '=' . urlencode($key); ?>"><?php echo ucwords($key) . ' (' . $val . ')'; ?></a>
                    <?php endforeach; } ?>

                    <?php if (isset($filters->alignments)) { $filter = $filters->alignments; $filtername = 'standards'; ?>
                    <p><?php echo ucwords(preg_replace('/[^\da-z]/i', ' ', rtrim($filtername, 's'))); ?></p>
                    <div id="standards-list" class="filter-big-lists">
                        <form class="form-inline undo-overrides default-form-inline">
                            <div class="form-group">
                                <input class="search form-control input-sm" placeholder="Filter.."/>
                                <span class="sort" data-sort="filter-name"><i class="fa fa-lg ea-sort-alpha"></i></span>
                                <span class="sort" data-sort="filter-count"><i class="fa fa-lg ea-sort-numeric"></i></span>
                             </div>
                        </form>
                        <ul class="list list-unstyled">
                            <?php foreach ($filter as $key => $val) : ?>
                            <li>
                                <a class="content-index-filterlink" href="<?php echo $filter_base_url . '&' . rtrim($filtername, 's') . '=' . urlencode($key); ?>">
                                   <span class="filter-name"><?= ucwords($key) ?></span>
                                   <span class="filter-count">(<?= $val ?>)</span>
                                </a>
                            </li>
                            <?php endforeach; } ?>
                         </ul>
                    </div>
                  </div>
                  <div class="left content-results">
                    <?php foreach ($results as $idx => $obj): ?>
                      <div class="clear">
                        <div class="left content-thumbnail">
                          <?php echo $obj->thumbnail; ?>
                        </div>
                        <div class="left content-desc" style="margin-left: 10px; padding-bottom: 40px">
                          <div class="content-title-publisher">
                            <h5 class="content-title"><a href="<?php echo $obj->resource_locators[0]->url; ?>" target="new"><?php echo $obj->title; ?></a></h5>
                            <div class="content-publisher"><?php if (isset($obj->identities)) { ?><a href="<?php echo $filter_base_url . '&publisher=' . urlencode($obj->identities[0]->name);?>"><?php echo $obj->identities[0]->name; ?></a><?php } ?></div>
                          </div>
                          <div class="well backtowell">
                            <?php echo $obj->description; ?>
                          </div>
                           <div class="btn-group btn-group-xs" role="group">
                          <?php foreach ($footnotes as $key => $value) : $p = key($value); ?>
                              <?php $idxLast = count($obj->$p) - 1; foreach ($obj->$p as $idxTag => $v): ?>
                                <?php if ($idxTag == 6): ?>
                                  <a href="#collapsetag-<?= strtolower($key)?>-<?= $idx ?>" data-toggle="collapse" area-expanded="false" class="btn btn-info tag tag-<?= strtolower($key)?> collapsed tags-toggle" role="button">...</a>
                                  <span id="collapsetag-<?= strtolower($key)?>-<?= $idx ?>" class="collapse tags-collapsed">
                                <?php endif; ?>
                                <a href="<?php echo $filter_base_url . '&' . rtrim(strtolower($key), 's') . '=' . urlencode($v->$value[$p]); ?>" class="btn btn-info tag tag-<?= strtolower($key)?>" role="button"><?= $v->$value[$p]; ?></a>
                                <?php if (($idxTag == $idxLast) && ($idxTag >= 6)) : ?>
                                  </span>
                                <?php endif; ?>
                              <?php endforeach; ?>
                          <?php endforeach; ?>
                           </div>
                        </div>
                      </div>
                    <?php endforeach; ?>
                    <div class="clear">
                    <?php echo $this->pagination->create_links(); ?>
                    </div>
                  </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>