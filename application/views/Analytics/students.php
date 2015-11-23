<?php extract($data); ?>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <h1 class="page-header">Analytics. Section:<?=$section->UniqueSectionCode?></h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
               <h2 class="backToH2">Details</h2>
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
                <?php if (isset($students) and !empty($students)): ?>
                  <div class="col-md-12 col-sm-12">
                      <table id="analyzestudents" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>Student Name</th>
                            <th>Pages Visited</th>
                            <th>Videos Watched</th>
                            <th>Total Time - Online</th>
                            <th>Total Time - Videos</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($students as $hash => $student) : ?>
                            <tr>
                              <td><?php echo anchor('analytics/student/'.urlencode($section->id).'/'.base64_encode($hash), $student['name']); ?></td>
                              <td><?php echo $student['page_count_total']; ?></td>
                              <td><?php echo (isset($student['video_count_total'])) ? $student['video_count_total'] : ''; ?></td>
                              <td><?php echo $student['page_time_total']; ?></td>
                              <td><?php echo (isset($student['video_time_total'])) ? $student['video_time_total'] : ''; ?></td>
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