<?php
$sections = $student->getSections()->result();
if (empty($sections)) {
    $this->load->view('no_results_found');
} else { ?>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php if (isset($sections) and !empty($sections)): ?>
                      <div class="datatablegrid">
                          <table id="managesections" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th>Section Name</th>
                                <th>Period</th>
                                <th>Educator</th>
                                <th>Grades</th>
                                <th>Term</th>
                                <th>Year</th>
                                <th>Course</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($sections as $k => $v) :
                                list($pCode,$pName) = explode(' - ', $v->ClassPeriodName);
                              ?>
                                <tr>
                                  <td><?php echo anchor('sections/details/'.$v->id, $v->UniqueSectionCode, 'target="_blank"'); ?></td>
                                  <td><?php echo $pCode; ?></td>
                                  <td><?php echo $v->FirstName . ' ' . $v->LastSurname; ?></td>
                                  <td>
                                    <span class="label label-success sections-grade"><?php echo $v->Numeric_A; ?></span>
                                    <span class="label label-info sections-grade"><?php echo $v->Numeric_B; ?></span>
                                    <span class="label label-primary sections-grade"><?php echo $v->Numeric_C; ?></span>
                                    <span class="label label-warning sections-grade"><?php echo $v->Numeric_D; ?></span>
                                    <span class="label label-danger sections-grade"><?php echo $v->Numeric_F; ?></span>                                
                                  </td>                                  
                                  <td><?php echo $v->CodeValue; ?></td>
                                  <td><?php echo $v->SchoolYear; ?></td>                                    
                                  <td><?php echo $v->LocalCourseCode; ?></td>
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
<?php } ?>