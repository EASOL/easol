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
                    <div id="csv-button"></div>
                  </div>                                                     
                </form>

                <?php if (isset($results) and !empty($results)): ?>
                  <div class="datatablegrid">
                      <table id="manageattendance" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>Student Name</th>
                            <th>Grade Level</th>
                            <th>Present</th>
                            <th>Excused</th>
                            <th>Unexcused</th>
                            <th>Year</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($results as $student => $data) : foreach ($data as $year => $v) : ?>
                            <tr>
                              <td><?php echo anchor('student/profile/'.$v['StudentUSI'], $v['Name']); ?></td>
                              <td><?php echo $v['GradeLevel'] ?></td>
                              <td><?php echo (isset($v['In Attendance'])) ? $v['In Attendance'] : '-';  ?></td>
                              <td><?php echo (isset($v['Excused Absence'])) ? $v['Excused Absence'] : '-';  ?></td>
                              <td><?php echo (isset($v['Unexcused Absence'])) ? $v['Unexcused Absence'] : '-';  ?></td>
                              <td><?php echo $year;  ?></td>
                            </tr>
                          <?php endforeach; endforeach; ?>
                        </tbody>
                    </table>
                </div>
              <?php endif; ?>
            </div>
        </div>
    </div>
</div>