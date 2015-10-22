<?php extract($data); ?>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <h1 class="page-header">Section: <?= $section_id; ?></h1>
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
                    <th>Grade Level</th>
                    <th>Course</th>
                    <th>Term</th>
                    <th>Period</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?php echo $results[0]->Educator; ?></td>                             
                    <td><?php echo $results[0]->Gradelevel; ?></td>                             
                    <td><?php echo $results[0]->LocalCourseCode; ?></td>                             
                    <td><?php echo $results[0]->CodeValue; ?></td>                             
                    <td><?php echo $results[0]->Period; ?></td>
                  </tr>
                </tbody>
              </table>
              <?php if (isset($students) and !empty($students)): ?>
                <h2 class="backToH2">Students</h2>
                <div class="col-md-12 col-sm-12">
                    <table id="managestudents" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Full Name</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($students as $k => $v) : ?>
                          <tr>
                            <td><a href="<?= site_url("/student/profile/$v->StudentUSI") ?>"><?php echo $v->FirstName . ' ' . $v->MiddleName . ' ' . $v->LastSurname; ?></a></td>                             
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