<?php
$_columns=[];
if (!isset($ReportQuery)) $ReportQuery = $this->db->query($model->getReportQuery());

if (!empty($ReportQuery)) {
    foreach($ReportQuery->list_fields() as $key){
        $_columns[] = $key;
    }
}

$links = $model->getLinks();
?>

<div class='flex-report-table-wrapper'>

	<table class="flex-report-table table table-striped table-bordered" cellspacing="0" data-filter-option='<?php echo $filter_option ?>' data-page-length="<?php echo EASOL_PAGINATION_PAGE_SIZE ?>" data-report-id="<?php echo $model->ReportId ?>">
		<thead>
			<?php foreach ($_columns as $key): ?>
				<th data-variable="<?php echo $key ?>"><?php echo $key ?></th>
			<?php endforeach; ?>
		</thead>
		<tbody>
			
			<?php foreach ($ReportQuery->result() as $row): ?>
				<tr>
					<?php foreach ($_columns as $k=>$column): ?>
						<td>
							<?php if ($link = report_column_link($k + 1, $row, $links)): ?>
	                            <a href="<?php echo $link ?>"><?php echo $row->$column ?></a>
	                        <?php else: ?>
	                            <?php  echo ($row->$column); /* ? $row->$column : "&nbsp" ;*/ ?>
	                        <?php endif; ?>
							
						</td>
					<?php endforeach; ?>
				</tr>
			<?php endforeach; ?>
			
		</tbody>
	</table>
	<div class="pull-right form-group" style="padding-top: 0.25em;">
        <div id="csv-button"></div>
    </div>	
</div>
