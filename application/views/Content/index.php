<div class="row">
    <div class="col-md-12 col-sm-12">
        <h1 class="page-header">Content</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <form class="form-inline">
                  <div class="form-group">
                    <label for="content-query">Keywords</label><br />
                    <input id="content-query" type="text" class="form-control input-sm" name="query" value="<?php echo (isset($_GET['query']) and !empty($_GET['query'])) ? $_GET['query'] : 'search text'; ?>">
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
                  
                   <div class="form-group">
                    <label for="publisher">Publisher</label><br />
                    <input type="text" class="form-control input-sm" name="publisher" value="<?php echo (isset($_GET['publisher']) and !empty($_GET['publisher'])) ? $_GET['publisher'] : ''; ?>" >
                  </div>                                                    
                  <button type="submit" class="btn btn-default" id="content-search">Search</button>
                </form>
                <?php if (isset($response)): ?>
                  <div class="left content-filters">filters</div>
                  <div class="left content-results">
                    <?php foreach ($response->results as $obj): ?>
                      <div class="clear">
                        <div class="left content-desc">
                          <h5 class="content-title"><a href="<?php echo $obj->resource_locators[0]->url; ?>" target="new"><?php echo $obj->title; ?></a></h5>
                          <div class="well backtowell">
                            <?php echo $obj->description; ?>
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