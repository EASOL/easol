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
	                    <label for="filter['Term']">Term</label><br />
	                    <select name="filter['Term']">
	                        <option value="">All Terms</option>	                    	
	                        <?php foreach($terms as $k => $v): ?>
	                        	<option value="<?php echo $v->TermTypeId; ?>" <?php if( isset($_GET["filter['Term']"]) and $_GET["filter['Term']"] == $v->TermTypeId) {echo "selected";} ?> ><?php echo $v->CodeValue; ?></option>
	                        <?php endforeach; ?>                        
	                    </select>   
                  </div>
 				          <div class="form-group">
	                    <label for="filter['Year']">School Year</label><br />
	                    <select name="filter['Year']">
	                        <option value="">All Years</option>	                    	
	                        <?php foreach($years as $k => $v): ?>
	                        	<option value="<?php echo $v; ?>" <?php if( isset($_GET["filter['Year']"]) and $_GET["filter['Year']"] == $v) {echo "selected";} ?> ><?php echo $v; ?></option>
	                        <?php endforeach; ?>                        
	                    </select>   
                  </div>
 				          <div class="form-group">
	                    <label for="filter['Course']">Course</label><br />
	                    <select name="filter['Course']">
	                        <option value="">All Courses</option>	                    	
	                        <?php foreach($courses as $k => $v): ?>
	                        	<option value="<?php echo $v->CourseCode; ?>" <?php if( isset($_GET["filter['Course']"]) and $_GET["filter['Course']"] == $v->CourseCode) {echo "selected";} ?> ><?php echo $v->CourseTitle; ?></option>
	                        <?php endforeach; ?>                        
	                    </select>   
                  </div>
 				          <div class="form-group">
	                    <label for="filter['Educator']">Educator</label><br />
	                    <select name="filter['Educator']">
	                        <option value="">All Educators</option>	                    	
	                        <?php foreach($educators as $k => $v): ?>
	                        	<option value="<?php echo $v->StaffUSI; ?>" <?php if( isset($_GET["filter['Educator']"]) and $_GET["filter['Educator']"] == $v->StaffUSI) {echo "selected";} ?> ><?php echo $v->FullName; ?></option>
	                        <?php endforeach; ?>                        
	                    </select>   
                  </div>                                       
                  <div class="form-group">
                    <label for="filter['GradeLevel']">Grade Level</label><br />
                    <select name="filter['GradeLevel']">
	                	<option value="">All Grade Levels</option>                    	
                        <?php foreach($gradelevels as $k => $v): ?>
                        <option value="<?php echo $v->GradeLevelTypeId; ?>" <?php if( isset($_GET['Gradelevel']) and $_GET['GradeLevel'] == $v->GradeLevelTypeId) {echo "selected";} ?> ><?php echo $v->Description; ?></option>
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
                              <td><?php echo 'pending'; ?></td>
                              <td><?php echo 'pending'; ?></td>
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