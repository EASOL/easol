<table id="manageschools" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>School ID</th>
            <th>School Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>School ID</th>
            <th>School Name</th>
            <th>Actions</th>
        </tr>
    </tfoot>
    <tbody>
    	<?php foreach ($schools as $key => $school) : ?>
    		<tr>
                <td><?php echo $school->SchoolId ?></td>
                <td><?php echo $school->NameOfInstitution ?></td>
                <td>
                    <a href="<?= site_url("/schoolmanagement/addedit/$school->SchoolId") ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                    <a href="<?= site_url("/schoolmanagement/delete/$school->SchoolId") ?>" class="usermanagement-index-delete"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                </td>                                    
            </tr>
    	<?php endforeach; ?>
    </tbody>
</table>
