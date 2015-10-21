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
                  <!--
                   <div class="form-group">
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
                  </div>
                  -->

                  <button type="submit" class="btn btn-default" id="content-search">Search</button>
                </form>
                <div class="pull-right">
                  <img src="<?php echo base_url().'/assets/img/learning_tapestry.png' ?>" border="0" />
                </div>  
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
                      <p><?php echo ucwords(preg_replace('/[^\da-z]/i', ' ', rtrim($filtername, 's'))); ?></p>
                      <?php foreach ($filter as $key => $val) : ?>
                        <a class="content-index-filterlink" href="<?php echo $filter_base_url . '&' . rtrim($filtername, 's') . '=' . urlencode($key); ?>"><?php echo ucwords($key) . ' (' . $val . ')'; ?></a>
                      <?php endforeach; ?>
                    <?php endforeach; ?>
                  </div>
                  <div class="left content-results">
                    <?php foreach ($results as $obj): ?>
                      <div class="clear">
                        <div class="left content-desc">
                          <div class="content-title-publisher">
                            <h5 class="content-title"><a href="<?php echo $obj->resource_locators[0]->url; ?>" target="new"><?php echo $obj->title; ?></a></h5>
                            <div class="content-publisher"><?php foreach ($obj->identities as $i) { echo $i->name . "<br />"; }  ?></div>
                          </div>
                          <div class="well backtowell">
                            <?php echo $obj->description; ?>
                          </div>
                           <div class="btn-group btn-group-xs" role="group">
                          <?php foreach ($footnotes as $key => $value) : $p = key($value); ?>
                            <?php /* $key*/ ?>
                           
                              <?php $count = 0; foreach ($obj->$p as $k => $v) : $count++;  ?>
                                <?php if ($count <= 5) : ?>
                                  <button type="button" style="border-color:<?= $colors[$key]?>;background-color:<?= $colors[$key]?>" class="btn btn-primary"><?= $v->$value[$p]; ?></button>
                                <?php elseif ($count == 6) : ?>
                                  <button type="button" style="border-color:<?= $colors[$key]?>;background-color:<?= $colors[$key]?>" class="btn btn-primary">...</button>
                                <?php endif; ?>
                              <?php endforeach; ?>
                           
                          <?php endforeach; ?>
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