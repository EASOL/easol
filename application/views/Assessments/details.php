<div class="row">
	<div class="col-md-12 col-sm-12">
		<h2 class="page-header">Assessment:  <?php echo $assessment->AssessmentTitle ?></h2>
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
						<th>Subject</th>
						<th>Version</th>
						<th>Grade Level</th>
						<th>Administration Date</th>
						<th>Students</th>
						<th>Average Results</th>

					</tr>
					</thead>
					<tbody>
					<tr>
						<td><?php echo $assessment->Subject ?></td>
						<td><?php echo $assessment->Version ?></td>
						<td><?php echo $assessment->Grade ?></td>
						<td><?php echo easol_date($assessment->AdministrationDate) ?></td>
						<td><?php echo $assessment->StudentCount ?></td>
						<td><?php echo round($assessment->AverageResult) ?></td>

					</tr>
					</tbody>
				</table>
				<?php if (isset($students) and !empty($students)): ?>
					<h2 class="backToH2">Students</h2>

					<table id="students-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>Full Name</th>
							<th>Score</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($students as $row) : ?>
							<tr>
								<td><a href="<?php echo site_url("/student/profile/$row->StudentUSI") ?>"><?php echo $row->FirstName . ' ' . $row->MiddleName . ' ' . $row->LastSurname; ?></a></td>
								<td><?php echo $row->Result ?></td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>

				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
