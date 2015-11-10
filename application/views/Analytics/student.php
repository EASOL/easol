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
                    <th>Student</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?php echo $section->Educator; ?></td>                                              
                    <td><?php echo $section->LocalCourseCode; ?></td>                             
                    <td><?php echo $section->CodeValue; ?></td>                             
                    <td><?php echo $section->Period; ?></td>
                    <td><?php echo $student->FirstName . ' ' . $student->MiddleName . ' ' . $student->LastSurname; ?></td>
                  </tr>
                </tbody>
              </table>
                <?php if (isset($student->pages) and !empty($student->pages) or isset($student->videos) and !empty($student->videos)): ?>
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
                          <?php if (isset($student->pages) and !empty($student->pages)): ?>
                            <?php foreach ($student->pages as $page) : ?>
                              <tr>
                                <td><?php echo $page->date_visited; ?></td>
                                <td><?php echo anchor($page->page_url); ?></td>
                                <td><?php echo gmdate('H:i:s', $page->total_time); ?></td>
                              </tr>
                            <?php endforeach; ?>
                          <?php endif; ?>
                          <?php if (isset($student->videos) and !empty($student->videos)): ?>
                            <?php foreach ($student->videos as $video) : ?>
                              <tr>
                                <td><?php echo $video->date_visited; ?></td>
                                <td><?php echo anchor($video->video_url); ?></td>
                                <td><?php echo gmdate('H:i:s', $video->total_time); ?></td>
                              </tr>
                            <?php endforeach; ?>
                          <?php endif; ?>                          
                        </tbody>
                    </table>
                </div>
              <?php endif; ?>
            </div>
        </div>
    </div>
</div>