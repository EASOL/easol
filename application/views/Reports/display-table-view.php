<div class='flex-report-table-wrapper'>

	<table class="flex-report-table table table-striped table-bordered" cellspacing="0" width="100%" data-filter-option='<?php echo $filter_option ?>' data-page-length="<?php echo EASOL_PAGINATION_PAGE_SIZE ?>">
		<thead>
			<?php foreach ($_columns as $key): ?>
				<th><?php echo $key ?></th>
			<?php endforeach; ?>
		</thead>
		<tbody>
			
			<?php foreach ($ReportData->result() as $row): ?>
				<tr>
					<?php foreach ($row as $field=>$value): ?>
						<td><?php echo ($value) ? $value : "&nbsp" ; ?></td>
					<?php endforeach; ?>
				</tr>
			<?php endforeach; ?>
			
		</tbody>
	</table>
	<div class="pull-right form-group" style="padding-top: 0.25em;">
        <div id="csv-button"></div>
    </div>	
</div>