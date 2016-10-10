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
                      <?php echo form_dropdown('term', filter_terms_listing($school_id), $currentTerm_default, "class='form-control'")?>
                  </div>
                  <div class="form-group">
                      <label for="year">School Year</label>
                      <?php echo form_dropdown('year', filter_year_listing($school_id), $currentYear_default, 'class="form-control"')?>
                  </div>
                  <div class="form-group">
                      <label for="course">Course</label>
                      <?php echo form_dropdown('course', filter_courses_listing($school_id), '', 'class="form-control"')?>
                  </div>
                    <?php if($userCanFilter){ ?>
                  <div class="form-group">
                      <label for="educator">Educator</label>
                      <?php echo form_dropdown('educator', filter_educators_listing($school_id), '', 'class="form-control"')?>
                  </div>    
                    <?php } ?>
                    
                    <div class="form-group">
                        <label for="filter-PageLength">Records Per Page:</label>
                        <?php echo form_dropdown('filter[PageLength]', filter_page_size_listing(), '', "class='form-control'"); ?>
                    </div>
                </form>
                
                <div class="datatablegrid">
                    <table id="managesections" class="table table-striped table-bordered table-widget" cellspacing="0" data-filter-option='no'>
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
                        <?php if (isset($results) and !empty($results)): ?> 
                          <?php foreach ($results as $k => $v) : ?>
                            <tr>
                              <td><?php echo $v->CodeValue; ?></td>
                              <td><?php echo easol_year($v->SchoolYear); ?></td>                              
                              <td><?php echo $v->LocalCourseCode; ?></td>
                              <td><a href="<?php echo site_url("/sections/details/$v->id") ?>"><?php echo $v->UniqueSectionCode; ?></a></td>
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
                        <?php endif; ?>
                      </tbody>
                  </table>
                  <div class="pull-right form-group" style="padding-top: 0.25em;">                   
                      <div id="csv-button"></div>
                  </div>
              </div>
             
            </div>
        </div>
    </div>
</div>
