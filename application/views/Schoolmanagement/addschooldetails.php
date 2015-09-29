<div class="row">
    <div class="col-md-12 col-sm-12">
        <h1 class="page-header"><?php echo $school[0]->NameOfInstitution ?></h1>
        <p>Add school configuration values</p>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <form class="form-inline" method="post">
                  <div class="form-group">
                    <label for="key">Key</label><br />
                    <select id="schoolmanagement-addschooldetails-key" name="key">  
                      <option value="">Choose an attribute</option>                
                      <?php foreach ($config['schoolattributes'] as $key => $value) : ?>
                        <option value="<?php echo $key ?>"><?php echo $value['label'] ?></option>
                      <?php endforeach; ?>                                             
                    </select>
                  </div>
                  <?php foreach ($config['schoolattributes'] as $key => $value) : ?>
                    <div class="form-group schoolmanagement-addschooldetails-value-container" id="<?php echo $key ?>">
                      <label for="value"><?php echo $value['label'] ?></label><br />
                      <?php if ($value['type'] == 'select') { ?>
                        <select name="value" class="schoolmanagement-addschooldetails-value" disabled> 
                          <option value="">Choose an attribute</option>
                          <?php foreach ($value['options'] as $v => $k) : ?>
                            <option value="<?php echo $v ?>"><?php echo $k ?></option>
                          <?php endforeach; ?>
                        </select>
                      <?php } else if ($value['type'] == 'text') : ?>
                        <input type="text" name="value" value="" class="schoolmanagement-addschooldetails-value" disabled />
                      <?php endif; ?>  
                    </div>
                  <?php endforeach; ?>                                             
                  <button id="schoolmanagement-addschooldetails-submit" type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>