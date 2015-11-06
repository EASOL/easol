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

                <form class="form-inline" id="dataGridFormFilter">
               		<div class="form-group">
	                    <label for="term">Term</label><br />
	                    <select name="term" class="form-control">
	                        <option value="">All Terms</option>	                    	
	                        <?php foreach($terms as $k => $v): ?>
	                        	<option value="<?php echo $v->TermTypeId; ?>" <?php if ($currentTerm_default == $v->TermTypeId) {echo "selected";} ?> ><?php echo $v->CodeValue; ?></option>
	                        <?php endforeach; ?>                        
	                    </select>   
                  </div>
 				          <div class="form-group">
	                    <label for="year">School Year</label><br />
	                    <select name="year" class="form-control">
	                        <option value="">All Years</option>	                    	
	                        <?php foreach($years as $k => $v): ?>
	                        	<option value="<?php echo $v; ?>" <?php if($currentYear_default == $v) {echo "selected";} ?> ><?php echo $v; ?></option>
	                        <?php endforeach; ?>                        
	                    </select>   
                  </div>
 				          <div class="form-group">
	                    <label for="course">Course</label><br />
	                    <select name="course" class="form-control">
	                        <option value="">All Courses</option>	                    	
	                        <?php foreach($courses as $k => $v): ?>
	                        	<option value="<?php echo $v->CourseCode; ?>" <?php if(isset($filters['course']) and $filters['course'] == $v->CourseCode) {echo "selected";} ?> ><?php echo $v->CourseTitle; ?></option>
	                        <?php endforeach; ?>                        
	                    </select>   
                  </div>
                    <?php if($userCanFilter){ ?>
 				          <div class="form-group">
	                    <label for="educator">Educator</label><br />
	                    <select name="educator" class="form-control">
	                        <option value="">All Educators</option>	                    	
	                        <?php foreach($educators as $k => $v): ?>
	                        	<option value="<?php echo $v->StaffUSI; ?>" <?php if(isset($filters['educator']) and $filters['educator'] == $v->StaffUSI) {echo "selected";} ?> ><?php echo $v->FullName; ?></option>
	                        <?php endforeach; ?>                        
	                    </select>   
                  </div>    
                  <?php } ?>                                   
                 

                  <button type="submit" class="btn btn-primary" id="sections-filter">Filter</button>
                </form>
                <?php if (isset($results) and !empty($results)): ?>
                  <div class="col-md-12 col-sm-12">
                      <table id="manageanalytics" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>Course</th>
                            <th>Section Name</th>
                            <th>Period</th>
                            <th>Educator</th>
                            <th>Students</th>
                            <th>Analytics</th>
                            <th>Term</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($results as $k => $v) : ?>
                            <tr>
                              <td><?php echo $v->LocalCourseCode; ?></td>
                              <td><a href="<?= site_url("/analytics/students/$v->id") ?>"><?php echo $v->UniqueSectionCode; ?></a></td>
                              <td><?php echo $v->Period; ?></td>
                              <td><?php echo $v->Educator; ?></td>
                              <td><?php echo $v->StudentCount; ?></td>
                              <td><?php echo $v->Average; ?></td>
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