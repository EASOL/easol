<?php extract($data); ?>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <h1 class="page-header">Sections</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">

                <form class="form-inline" id="dataGridFormFilter">
                  <div class="form-group">
                      <label for="term">Term</label>
                      <select name="term" class="form-control">
                          <option value="">All Terms</option>                       
                          <?php foreach($terms as $k => $v): ?>
                            <option value="<?php echo $v->CodeValue; ?>" <?php if ($currentTerm_default == $v->TermTypeId) {echo "selected";} ?> ><?php echo $v->CodeValue; ?></option>
                          <?php endforeach; ?>                        
                      </select>   
                  </div>
                  <div class="form-group">
                      <label for="year">School Year</label>
                      <select name="year" class="form-control">
                          <option value="">All Years</option>                       
                          <?php foreach($years as $k => $v): ?>
                            <option value="<?php echo $v; ?>" <?php if($currentYear_default == $v) {echo "selected";} ?> ><?php echo $v; ?></option>
                          <?php endforeach; ?>                        
                      </select>   
                  </div>
                  <div class="form-group">
                      <label for="course">Course</label>
                      <select name="course" class="form-control">
                          <option value="">All Courses</option>                       
                          <?php foreach($courses as $k => $v): ?>
                            <option value="<?php echo $v->CourseCode; ?>"><?php echo $v->CourseTitle; ?></option>
                          <?php endforeach; ?>                        
                      </select>   
                  </div>
                    <?php if($userCanFilter){ ?>
                  <div class="form-group">
                      <label for="educator">Educator</label>
                      <select name="educator" class="form-control">
                          <option value="">All Educators</option>                       
                          <?php foreach($educators as $k => $v): ?>
                            <option value="<?php echo $v->FullName; ?>"><?php echo $v->FullName; ?></option>
                          <?php endforeach; ?>                        
                      </select>   
                  </div>    
                  <?php } ?>

                  <div class="form-group">                   
                    <div id="csv-button"></div>
                  </div>                                                     
                
                </form>
 
                <?php if (isset($results) and !empty($results)): ?>
                  <div class="datatablegrid">
                      <table id="managesections" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>Term</th>
                            <th>Year</th>                            
                            <th>Course</th>
                            <th>Section Name</th>
                            <th>Period</th>
                            <th>Educator</th>
                            <th>Students</th>
                            <th>A</th>
                            <th>B</th>
                            <th>C</th>
                            <th>D</th>
                            <th>F</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($results as $k => $v) : ?>
                            <tr>
                              <td><?php echo $v->CodeValue; ?></td>
                              <td><?php echo $v->SchoolYear; ?></td>                              
                              <td><?php echo $v->LocalCourseCode; ?></td>
                              <td><a href="<?= site_url("/sections/details/$v->id") ?>"><?php echo $v->UniqueSectionCode; ?></a></td>
                              <td><?php echo $v->Period; ?></td>
                              <td><?php echo $v->Educator; ?></td>
                              <td><?php echo $v->StudentCount; ?></td>
                              <td><span class="label sections-grade sections-a"><?php echo $v->Numeric_A; ?></span></td>
                              <td><span class="label sections-grade sections-b"><?php echo $v->Numeric_B; ?></span></td>
                              <td><span class="label sections-grade sections-c"><?php echo $v->Numeric_C; ?></span></td>
                              <td><span class="label sections-grade sections-d"><?php echo $v->Numeric_D; ?></span></td>
                              <td><span class="label sections-grade sections-f"><?php echo $v->Numeric_F; ?></span></td>                                   
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
              <?php endif; ?>
            </div>
        </div>
    </div>
</div>