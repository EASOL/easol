<?php extract($data); ?>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <h1 class="page-header">Sections</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <form class="form-inline form-horizontal undo-overrides">
               		<div class="form-group">
	                    <label for="term">Term</label><br />
	                    <select name="term">
	                        <option value="">All Terms</option>	                    	
	                        <?php foreach($terms as $k => $v): ?>
	                        	<option value="<?php echo $v->TermTypeId; ?>" <?php if(isset($filters['term']) and $filters['term'] == $v->TermTypeId) {echo "selected";} ?> ><?php echo $v->CodeValue; ?></option>
	                        <?php endforeach; ?>                        
	                    </select>   
                  </div>
 				          <div class="form-group">
	                    <label for="year">School Year</label><br />
	                    <select name="year">
	                        <option value="">All Years</option>	                    	
	                        <?php foreach($years as $k => $v): ?>
	                        	<option value="<?php echo $v; ?>" <?php if(isset($filters['year']) and $filters['year'] == $v) {echo "selected";} ?> ><?php echo $v; ?></option>
	                        <?php endforeach; ?>                        
	                    </select>   
                  </div>
 				          <div class="form-group">
	                    <label for="course">Course</label><br />
	                    <select name="course">
	                        <option value="">All Courses</option>	                    	
	                        <?php foreach($courses as $k => $v): ?>
	                        	<option value="<?php echo $v->CourseCode; ?>" <?php if(isset($filters['course']) and $filters['course'] == $v->CourseCode) {echo "selected";} ?> ><?php echo $v->CourseTitle; ?></option>
	                        <?php endforeach; ?>                        
	                    </select>   
                  </div>
 				          <div class="form-group">
	                    <label for="educator">Educator</label><br />
	                    <select name="educator">
	                        <option value="">All Educators</option>	                    	
	                        <?php foreach($educators as $k => $v): ?>
	                        	<option value="<?php echo $v->StaffUSI; ?>" <?php if(isset($filters['educator']) and $filters['educator'] == $v->StaffUSI) {echo "selected";} ?> ><?php echo $v->FullName; ?></option>
	                        <?php endforeach; ?>                        
	                    </select>   
                  </div>                                       
                  <div class="form-group">
                    <label for="gradelevel">Grade Level</label><br />
                    <select name="gradelevel">
	                	<option value="">All Grade Levels</option>                    	
                        <?php foreach($gradelevels as $k => $v): ?>
                        <option value="<?php echo $v->GradeLevelTypeId; ?>" <?php if(isset($filters['gradelevel']) and $filters['gradelevel'] == $v->GradeLevelTypeId) {echo "selected";} ?> ><?php echo $v->Description; ?></option>
                        <?php endforeach; ?>                        
                    </select>   
                  </div>

                  <button type="submit" class="btn btn-primary" id="sections-filter">Filter</button>
                </form>
                <?php if (isset($results) and !empty($results)): ?>
                  <div class="col-md-12 col-sm-12">
                      <table id="managesections" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>Course</th>
                            <th>Section Name</th>
                            <th>Period</th>
                            <th>Educator</th>
                            <th>Students</th>
                            <th>Grades</th>
                            <th>Grade Level</th>
                            <th>Term</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($results as $k => $v) : ?>
                            <tr>
                              <td><?php echo $v->LocalCourseCode; ?></td>
                              <td><a href="<?= site_url("/schoolmanagement/details/") ?>"><?php echo $v->UniqueSectionCode; ?></a></td>
                              <td><?php echo $v->Period; ?></td>
                              <td><?php echo $v->Educator; ?></td>
                              <td><?php echo $v->StudentCount; ?></td>
                              <td>
                                <span class="label label-success sections-grade"><?php echo $v->Numeric_A; ?></span>
                                <span class="label label-info sections-grade"><?php echo $v->Numeric_B; ?></span>
                                <span class="label label-primary sections-grade"><?php echo $v->Numeric_C; ?></span>
                                <span class="label label-warning sections-grade"><?php echo $v->Numeric_D; ?></span>
                                <span class="label label-danger sections-grade"><?php echo $v->Numeric_F; ?></span>                                
                              </td>
                              <td><?php echo $v->Gradelevel; ?></td>
                              <td><?php echo $v->CodeValue; ?></td>                                    
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