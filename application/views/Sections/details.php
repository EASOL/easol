<?php extract($data); ?>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <h2 class="page-header">Section:  <?=$results[0]->UniqueSectionCode?></h2>
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
                    <td><?php echo $results[0]->Educator; ?></td>                                              
                    <td><?php echo $results[0]->LocalCourseCode; ?></td>                             
                    <td><?php echo $results[0]->CodeValue; ?></td>                             
                    <td><?php echo $results[0]->Period; ?></td>
                  </tr>
                </tbody>
              </table>
              <?php if (isset($results) and !empty($results)): ?>
                <h2 class="backToH2">Students</h2>
                
                    <table id="managestudents" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Full Name</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($results as $k => $v) : ?>
                          <tr>
                            <td><a href="<?= site_url("/student/profile/$v->StudentUSI") ?>"><?php echo $v->FirstName . ' ' . $v->MiddleName . ' ' . $v->LastSurname; ?></a></td>                             
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                  </table>
               
              <?php endif; ?>
            </div>
        </div>
    </div>
</div>