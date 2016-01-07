<div class="row">
    <div class="col-md-12 col-sm-12">
        <h1 class="page-header">Assessments</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
	    <div class="panel panel-default">
		    <div class="panel-body">

			    <form action="" method="get" class="form-inline" name="dataGridFormFilter" id="dataGridFormFilter">

				    <div class="form-group">
					    <label for="filter-Year">Year</label>
					    <?php echo form_dropdown('filter[Year]', $filter['year'], '', "class='form-control'"); ?>
				    </div>

				    <div class="form-group">
					    <label for="filter-GradeLevel">Grade Level</label>

					    <?php echo form_dropdown('filter[GradeLevel]', $filter['grade'], '', "class='form-control'"); ?>
				    </div>

				    <div class="form-group">
					    <label for="filter-Subject">Subject</label>

					    <?php echo form_dropdown('filter[Subject]', $filter['subject'], '', "class='form-control'"); ?>
				    </div>

				    <div class="form-group">
                                        <label for="filter-PageLength">Records Per Page:</label>
					<?php echo form_dropdown('filter[PageLength]', ['25'=>'25', '50'=>'50', '100'=>'100'], '', "class='form-control'"); ?>
				    </div>
			    </form>


				<div class="datatablegrid">
			    		<table id="assessments-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
				    <thead>
				    <tr>
					    <th>Assessment Name</th>
					    <th>Grade</th>
					    <th>Subject</th>
					    <th>Version</th>
					    <th>Administration Date</th>
					    <th>Students</th>
					    <th>Average Results</th>
				    </tr>
				    </thead>
				    <tbody>
				    <?php foreach ($result as $row) : ?>
					    <tr>
						    <td><a href="<?php echo site_url('assessments/details/'.$row->AssessmentTitle.'/'.$row->AcademicSubjectDescriptorId.'/'.$row->AssessedGradeLevelDescriptorId.'/'.$row->Version.'/'.strtotime($row->AdministrationDate)) ?>" ><?php echo $row->AssessmentTitle; ?></a></td>
						    <td><?php echo $row->Grade ?></td>
						    <td><?php echo $row->Subject; ?></td>
						    <td><?php echo $row->Version; ?></td>
						    <td><?php echo easol_date($row->AdministrationDate); ?></td>
						    <td><?php echo $row->StudentCount; ?></td>
						    <td><?php echo round($row->AverageResult); ?></td>
					    </tr>
				    <?php endforeach; ?>
				    </tbody>
			    </table>
                            <div class="pull-right form-group" style="padding-top: 0.25em;">                   
                                <div id="csv-button"></div>
                            </div>
				</div>
		    </div>
	    </div>

    </div>
</div>
