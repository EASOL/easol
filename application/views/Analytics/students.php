<?php extract($data); ?>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <h1 class="page-header"><?= $section->CourseTitle ?></h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
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
                          <?php foreach ($students as $hash => $name) : ?>
                            <tr>
                              <td><?php echo $name; ?></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>                                    
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