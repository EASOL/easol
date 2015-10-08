<div class="row">
    <div class="col-md-12 col-sm-12">
        <h1 class="page-header">School Management</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <table id="manageschools" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>School ID</th>
                    <th>School Name</th>
                    <th>Web Site</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            	<?php foreach ($schools as $key => $school) : ?>
            		<tr>
                        <td><?php echo $school->SchoolId ?></td>
                        <td><?php echo $school->NameOfInstitution ?></td>
                        <td><?php echo $school->WebSite ?></td>
                        <td>
                            <a href="<?= site_url("/schoolmanagement/details/$school->SchoolId") ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                        </td>                                    
                    </tr>
            	<?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
