<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Learning Lab</title>
    <link href="<?= site_url('assets/css/bootstrap.css') ?>" rel="stylesheet"/>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="<?= site_url('assets/css/custom-styles2.css?v=2') ?>" rel="stylesheet"/>
</head>
<body>
  <div id="extension-wrapper" class="col-md-12 col-sm-12">

    <div id="extension-body" class="panel panel-default">
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
                    <?php foreach ($filter as $key => $val) : ?>
                      <a class="content-index-filterlink" href="<?php echo $filter_base_url . '&' . rtrim($filtername, 's') . '=' . urlencode($key); ?>"><?php echo ucwords($key) . ' (' . $val . ')'; ?></a>
                    <?php endforeach; } ?>

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
                    <?php foreach ($filter as $key => $val) : ?>
                      <a class="content-index-filterlink" href="<?php echo $filter_base_url . '&' . rtrim($filtername, 's') . '=' . urlencode($key); ?>"><?php echo ucwords($key) . ' (' . $val . ')'; ?></a>
                    <?php endforeach; } ?>

                  </div>
                  <div class="left content-results">
                    <?php foreach ($results as $obj): ?>
                      <div class="clear">
                        <div class="left content-desc" style="padding-bottom: 40px">
                          <div class="content-title-publisher">
                            <h5 class="content-title"><a href="<?php echo $obj->resource_locators[0]->url; ?>" target="new"><?php echo $obj->title; ?></a></h5>
                            <div class="content-publisher"><?php if (isset($obj->identities)) { ?><a href="<?php echo $filter_base_url . '&publisher=' . urlencode($obj->identities[0]->name);?>"><?php echo $obj->identities[0]->name; ?></a><?php } ?></div>
                          </div>
                          <div class="well backtowell">
                            <?php echo $obj->description; ?>
                          </div>

                           <div class="btn-group btn-group-xs" role="group">
                          <?php foreach ($footnotes as $key => $value) : $p = key($value); ?>
                              <?php $count = 0; foreach ($obj->$p as $k => $v) : $count++;  ?>
                                <?php if ($count <= 5) : ?>
                                  <a href="<?php echo $filter_base_url . '&' . rtrim(strtolower($key), 's') . '=' . urlencode($v->$value[$p]); ?>" class="btn btn-info tag tag-<?= strtolower($key)?>" role="button"><?= $v->$value[$p]; ?></a>
                                <?php elseif ($count == 6) : ?>
                                  <a href="#" class="btn btn-info tag tag-<?= strtolower($key)?>" role="button">...</a>
                                <?php endif; ?>
                              <?php endforeach; ?>
                    
                          <?php endforeach; ?>
                           </div> 
                            <div class="right">
                            <div class="right content-links"><a href="<?php echo $obj->resource_locators[0]->url; ?>" class="extension" title="<?php echo $obj->title; ?>" description="<?php echo $obj->description; ?>">Add to Assignment</a></div>                              
                            <div class="right content-links"><a href="<?php echo $obj->resource_locators[0]->url; ?>" target="new">Preview</a></div>
                        </div>                     
                        </div>
                      </div>
                    <?php endforeach; ?>
                    <?php echo $this->pagination->create_links(); ?>
                  </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
    </div>
  </div>
  <script src="<?= site_url('assets/js/jquery-1.10.2.js') ?>"></script>
  <script src="<?= site_url('assets/js/bootstrap.min.js') ?>"></script>
  <script src="<?= site_url('assets/js/custom.js') ?>"></script>
</body>
</html>
