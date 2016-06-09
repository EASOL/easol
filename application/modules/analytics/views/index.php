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

                    <form class="form-inline" id="dataGridFormFilter" method="get" action="<?php echo site_url('analytics') ?>">
                         <div class="form-group">
                              <label for="term">Term</label>
                              <select name="term" class="form-control">
                                   <option value="">All Terms</option>
                                   <?php foreach($terms as $k => $v): ?>
                                        <option value="<?php echo $v->CodeValue; ?>" <?php if ($filters['term'] == $v->TermTypeId) {echo "selected";} ?> ><?php echo $v->CodeValue; ?></option>
                                   <?php endforeach; ?>
                              </select>
                         </div>
                         <div class="form-group">
                              <label for="year">School Year</label>
                              <select name="year" class="form-control">
                                   <option value="">All Years</option>
                                   <?php foreach($years as $k => $v): ?>
                                        <option value="<?php echo $k; ?>" <?php if($filters['year'] == $k) {echo "selected";} ?> ><?php echo $v; ?></option>
                                   <?php endforeach; ?>
                              </select>
                         </div>
                         <div class="form-group">
                              <label for="course">Course</label>
                              <select name="course" class="form-control">
                                   <option value="">All Courses</option>
                                   <?php foreach($courses as $k => $v): ?>
                                        <option value="<?php echo $v->CourseCode; ?>" <?php if($filters['course'] == $v->CourseCode) {echo "selected";} ?>><?php echo $v->CourseTitle; ?></option>
                                   <?php endforeach; ?>
                              </select>
                         </div>
                         <?php if($userCanFilter){ ?>
                              <div class="form-group">
                                   <label for="educator">Educator</label>
                                   <select name="educator" class="form-control">
                                        <option value="">All Educators</option>
                                        <?php foreach($educators as $k => $v): ?>
                                             <option value="<?php echo $v->StaffUSI; ?>" <?php if($filters['educator'] == $v->StaffUSI) {echo "selected";} ?>><?php echo $v->FullName; ?></option>
                                        <?php endforeach; ?>
                                   </select>
                              </div>
                         <?php } ?>

                         <div class="form-group">
                             <label for="filter-PageLength">Records Per Page:</label>
                             <?php echo form_dropdown('PageLength', ['25' => '25', '50' => '50', '100' => '100'], $filters['PageLength'], "class='form-control'"); ?>
                         </div>

                         <div class="form-group">
                              <button type="button" class="btn btn-default" id="filter-submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                         </div>

                    </form>


                    <div class="datatablegrid">
                         <table id="manageanalytics" class="table table-striped table-bordered table-widget" data-filter-option='no' cellspacing="0" width="100%" data-page-length="<?php echo $filters['PageLength'] ?>" data-paging="false" data-info="false">
                              <thead>
                              <tr>
                                   <th>Term</th>
                                   <th>Year</th>
                                   <th>Course</th>
                                   <th>Section Name</th>
                                   <th>Period</th>
                                   <th>Educator</th>
                                   <th>Students</th>
                                   <th>AVG Time Spent Online</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php foreach ($results as $k => $v) : ?>
                                   <tr>
                                        <td><?php echo $v->CodeValue; ?></td>
                                        <td><?php echo easol_year($v->SchoolYear); ?></td>
                                        <td><?php echo $v->LocalCourseCode; ?></td>
                                        <td><a href="<?= site_url("/analytics/students/$v->id") ?>"><?php echo $v->UniqueSectionCode; ?></a></td>
                                        <td><?php echo $v->Period; ?></td>
                                        <td><?php echo $v->Educator; ?></td>
                                        <td><?php echo $v->StudentCount; ?></td>
                                        <td><?php echo (isset($v->Average)) ? $v->Average : ''; ?></td>
                                   </tr>
                              <?php endforeach; ?>
                              </tbody>
                         </table>

                         <div class="row">

                              <div class="col-md-4">
                                   <div class="pull-left">
                                        Showing <?php echo (count($results) == 0) ? count($results) : $offset + 1 ?> to <?php echo ($limit > count(results)) ? count($results) + ($limit * (max($page - 1, 0))) : $limit + $offset ?> of <?php echo $total_filtered; ?> entries
                                        <?php if ($total > $total_filtered): ?>
                                             (filtered from <?php echo $total; ?> total entries)
                                        <?php endif; ?>
                                   </div>
                              </div>

                              <div class="col-md-8">


                                   <div class="dataTables_paginate paging_simple_numbers pull-right">
                                        <ul class="pagination">
                                             <li class="paginate_button previous <?php if ($page <= 1) echo $previous = "disabled" ?>" aria-controls="manageanalytics" tabindex="0" id="manageanalytics_previous">
                                                  <a href="<?php if (!$previous) { echo site_url('/analytics') . $query_string . "&page=". ($page - 1); } ?>">Previous</a>
                                             </li>
                                             <?php for ($i = 1; $i <= ceil($total_filtered/$limit); $i++): ?>
                                                  <li class="paginate_button <?php if ($page == $i) echo "active" ?>" aria-controls="manageanalytics" tabindex="0"><a href="<?php echo site_url('/analytics').$query_string."&page=$i" ?>"><?php echo $i; ?></a></li>
                                             <?php endfor; ?>
                                             <li class="paginate_button next <?php if (!($i > 1 && $page + 1 < $i)) echo $next = "disabled" ?>" aria-controls="manageanalytics" tabindex="0" id="manageanalytics_next">
                                                  <a href="<?php if (!$next) { echo site_url('/analytics') . $query_string . "&page=" . ($page + 1); } ?>">Next</a>

                                             </li>
                                        </ul>
                                   </div>
                              </div>
                         </div>


                         <div class="pull-right form-group" style="padding-top: 0.25em;">
                              <div id="csv-button"></div>
                         </div>
                    </div>

               </div>
          </div>
     </div>
</div>
