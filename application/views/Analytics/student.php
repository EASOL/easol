<?php extract($data); ?>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <h1 class="page-header">Analytics</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
               <h2 class="backToH2"><?php echo $student->FirstName . ' ' . $student->MiddleName . ' ' . $student->LastSurname; ?></h2>
              <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Educator</th>
                    <th>Course</th>
                    <th>Term</th>
                    <th>Period</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?php echo $section->Educator; ?></td>                                              
                    <td><?php echo $section->LocalCourseCode; ?></td>                             
                    <td><?php echo $section->CodeValue; ?></td>                             
                    <td><?php echo $section->Period; ?></td>
                  </tr>
                </tbody>
              </table>
                <?php if (isset($student->records) and !empty($student->records)): ?>
                  <div class="col-md-12 col-sm-12">
                      <table id="analyzestudents" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>Date Time</th>
                            <th>URL</th>
                            <th>Time Spent</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($student->records as $r) : ?>
                            <tr>
                              <td><?php echo $r[0]; ?></td>
                              <td><?php echo anchor($r[1], $r[3] ? $r[3] : $r[1]); ?></td>
                              <td><?php echo gmdate('H:i:s', $r[2]); ?></td>
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