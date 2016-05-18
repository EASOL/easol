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

              <form class="form-inline" id="dataGridFormFilter">
                <div class="form-group">
                    <label for="gradelevel">Grade Level</label>
                    <select name="gradelevel" class="form-control">
                        <option value="">All Grade Levels</option>                         
                        <?php foreach($gradelevels as $k => $v): ?>
                            <option value="<?php echo $v->CodeValue; ?>"><?php echo $v->CodeValue; ?></option>
                        <?php endforeach; ?>                        
                    </select>   
                </div>
                <div class="form-group">
                    <label for="year">School Year</label>
                    <select name="year" class="form-control">
                        <option value="">All Years</option>                         
                        <?php foreach($years as $k => $v): ?>
                            <option value="<?php echo $v; ?>"<?php if($currentYear == $v) {echo "selected";} ?>>
                              <?php echo $v; ?></option>
                        <?php endforeach; ?>                        
                    </select>   
                </div>
                <div class="form-group">
                    <label for="term">Term</label>
                    <select name="term" class="form-control">
                        <option value="">All Terms</option>                         
                        <?php foreach($terms as $k => $v): ?>
                            <option value="<?php echo $v; ?>">
                              <?php echo $v; ?>
                            </option>
                        <?php endforeach; ?>                        
                    </select>   
                </div>
                <div class="form-group">
                   <label for="filter-PageLength">Records Per Page:</label>
                   <?php echo form_dropdown('filter[PageLength]', ['25'=>'25', '50'=>'50', '100'=>'100'], '', "class='form-control'"); ?>
                </div>
                                                                    
              </form>

             
              <div class="datatablegrid">
                <table id="manageattendance" class="table table-striped table-bordered table-widget" cellspacing="0" width="100%">
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
                            <td><?php echo anchor('student/profile/'.$v['StudentUSI'], $v['Name']); ?></td>
                            <td><?php echo $v['GradeLevel'] ?></td>
                            <td><?php echo (isset($v['In Attendance'])) ? $v['In Attendance'] : '-';  ?></td>
                            <td><?php echo (isset($v['Excused Absence'])) ? $v['Excused Absence'] : '-';  ?></td>
                            <td><?php echo (isset($v['Unexcused Absence'])) ? $v['Unexcused Absence'] : '-';  ?></td>
                            <td><?php echo $year;  ?></td>
                            <td><?php echo implode(', ', $v['Term']); ?></td>
                          </tr>
                        <?php endforeach; endforeach; ?>
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