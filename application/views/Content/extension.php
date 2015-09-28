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
    <div id="extension-header">
        <a href="<?= site_url("/") ?>"><img src="<?= site_url("/assets/img/easol_logo.png") ?>"/></a>
    </div>
    <div id="extension-body" class="panel panel-default">
          <div class="panel-body">
              <form class="form-inline">
                 <div id="content-index-query" class="form-group">
                    <label for="query">Keywords</label>
                    <input id="content-query" type="text" class="form-control input-sm" name="query" value="<?php echo (isset($_GET['query']) and !empty($_GET['query'])) ? $_GET['query'] : 'search text'; ?>">
                  </div>
        <!--         <div class="form-group">
                  <label for="publisher">Publisher</label><br />
                  <input type="text" class="form-control input-sm" name="publisher" value="<?php echo (isset($_GET['publisher']) and !empty($_GET['publisher'])) ? $_GET['publisher'] : ''; ?>" >
                </div>       
                <div class="form-group">
                  <label for="grade-level">Grade Level</label><br />
                  <select name="grade-level">
                      <?php foreach($gradelevels as $v => $k): ?>
                      <option value="<?php echo $v; ?>" <?php if( isset($_GET['grade-level']) and $_GET['grade-level'] == $v) {echo "selected";} ?> ><?php echo $k ?></option>
                      <?php endforeach; ?>                        
                  </select>   
                </div>

                 <div class="form-group">
                  <label for="alignment">Standard</label><br />
                  <select name="alignment">
                     <?php foreach($standards as $k => $v): ?>
                      <option value="<?php echo $v ?>" <?php if( isset($_GET['alignment']) and $_GET['alignment'] == $v) {echo "selected";} ?>><?php echo $k ?></option>
                      <?php endforeach; ?>                        
                  </select>   
                </div> -->
                
                                                             
                <button type="submit" class="btn btn-default" id="content-search">Search</button>
              </form>
              <?php if (isset($results)): ?>
               <div class="left content-filters">
                  <?php foreach($filters_active as $k => $v) : ?>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" class="filter_active" value="<?php echo $k ?>" checked><?php echo ucwords($k) . ' - ' . ucwords($v) ?> 
                      </label>
                    </div>
                  <?php endforeach; ?>
                  <?php foreach ($filters as $filtername => $filter): ?>
                    <p><?php echo ucwords(rtrim($filtername, 's')); ?></p>
                    <?php foreach ($filter as $key => $val) : ?>
                      <a class="content-index-filterlink" href="<?php echo $filter_base_url . '&' . rtrim($filtername, 's') . '=' . urlencode($key); ?>"><?php echo ucwords($key) . ' (' . $val . ')'; ?></a>
                    <?php endforeach; ?>
                  <?php endforeach; ?>
                </div>              
                <div class="left content-results">
                  <?php foreach ($results as $obj): ?>
                    <div class="clear">
                      <div class="left content-desc">
                        <h5 class="content-title"><a href="<?php echo $obj->resource_locators[0]->url; ?>" target="new"><?php echo $obj->title; ?></a></h5>
                        <div class="well backtowell">
                          <?php echo $obj->description; ?>
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
  <script src="<?= site_url('assets/js/jquery-1.10.2.js') ?>"></script>
  <script src="<?= site_url('assets/js/bootstrap.min.js') ?>"></script>
  <script src="<?= site_url('assets/js/custom.js') ?>"></script>
</body>
</html>
