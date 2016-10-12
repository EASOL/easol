<?php extract($data); ?>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <h1 class="page-header">Attendance</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
 
              <form action="" method="get" class="form-inline" name="dataGridFormFilter" id="dataGridFormFilter">
                <div class="row">
                  <div class="col-sm-12 margin-bottom">
                    <input type="text" placeholder="Search..." name="filter[term]" class="form-control" style="width: 100%">
                  </div> 
                </div>
                <div class="form-group">
                    <label for="gradelevel">Grade Level</label>
                    <?php echo form_dropdown('gradelevel', filter_grade_listing($school_id), '', "class='form-control'")?>
                </div>
                <div class="form-group">
                    <label for="year">School Year</label>
                    <?php echo form_dropdown('year', filter_year_listing($school_id), $currentYear_default, "class='form-control'")?>
                </div>
                <div class="form-group">
                    <label for="term">Term</label>
                    <?php echo form_dropdown('term', filter_terms_listing($school_id), $currentTerm_default, "class='form-control'")?>
                </div>
                <div class="form-group">
                   <label for="filter-PageLength">Records Per Page:</label>
                   <?php echo form_dropdown('filter[PageLength]', filter_page_size_listing(), '', "class='form-control'"); ?>
                </div>
              </form>

              <div class="datatablegrid">
                <table id="manageattendance" class="table table-striped table-bordered table-widget" cellspacing="0" width="100%" data-filter-option="no">
                  <thead>
                    <tr>
                      <th>Student Name</th>
                      <th>Grade Level</th>
                      <th>Present</th>
                      <th>Excused</th>
                      <th>Unexcused</th>
                      <th>Year</th>
                      <th data-visible="false">Term</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php if (isset($results) and !empty($results)): ?>
                        <?php foreach ($results as $student => $data) : foreach ($data as $year => $v) : ?>
                          <tr>
                            <td><?php echo anchor('student/attendance/'.$v['StudentUSI'], $v['Name']); ?></td>
                            <td><?php echo $v['GradeLevel'] ?></td>
                            <td><?php echo (isset($v['In Attendance'])) ? $v['In Attendance'] : '-';  ?></td>
                            <td><?php echo (isset($v['Excused Absence'])) ? $v['Excused Absence'] : '-';  ?></td>
                            <td><?php echo (isset($v['Unexcused Absence'])) ? $v['Unexcused Absence'] : '-';  ?></td>
                            <td><?php echo easol_year($year);  ?></td>
                            <td><?php echo implode(', ', $v['Term']); ?></td>
                          </tr>
                        <?php endforeach;

                        endforeach; ?>
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
