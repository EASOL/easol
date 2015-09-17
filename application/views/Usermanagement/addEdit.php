
<?php extract($data); ?> <div class="row">
    <div class="col-md-12 col-sm-12">
        <h1 class="page-header"><?php echo $title ?></h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <form class="form-inline">
                  <div class="form-group">
                    <label for="school">Filter by School</label><br />
                    <select id="schoolFilter" name="school">
                        <option value="">Choose a School to filter staff options</option>
                        <?php foreach($schools as $k => $v): ?>
                        <option value="<?php echo $v->EducationOrganizationId; ?>" <?php if( isset($_GET['school']) and $_GET['school'] == $v->EducationOrganizationId) {echo "selected";} ?> ><?php echo $v->NameOfInstitution ?></option>
                        <?php endforeach; ?>                        
                    </select>   
                  </div>

                   <div class="form-group">
                    <label for="staffusi">StaffUSI Full Name</label><br />
                    <select id="staffusi" name="staffusi">
                        <option school="reset" value="">Choose a user to add or edit</option>
                        <?php foreach($staff as $k => $v): ?>
                        <option school="<?php echo $v->Institutions[0]->EducationOrganizationId ?>" value="<?php echo $v->StaffUSI ?>" <?php if( isset($_GET['staffusi']) and $_GET['staffusi'] == $v->StaffUSI) {echo "selected";} ?>><?php echo $v->FirstName .' '. $v->LastSurname; ?></option>
                        <?php endforeach; ?>                        
                    </select>   
                  </div>
                  
                   <div class="form-group">
                    <label for="role">Role</label><br />
                    <select name="role">
                       <?php foreach($roles as $k => $v): ?>
                        <option value="<?php echo $v->RoleTypeId ?>" <?php if( isset($_GET['role']) and $_GET['role'] == $v->RoleTypeId) {echo "selected";} ?>><?php echo $v->RoleTypeName ?></option>
                        <?php endforeach; ?>                        
                    </select>   
                  </div>

                   <div class="form-group">
                    <label for="password">Password</label><br />
                    <input type="text" class="form-control input-sm" name="password" value="" />
                  </div>                                                    
                  <button type="submit" class="btn btn-default" id="userAddEdit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>