
<?php extract($data); ?> <div class="row">
    <div class="col-md-12 col-sm-12">
        <h1 class="page-header"><?php echo $title ?></h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
      <?php if (!empty($message)) : ?>
        <div id="flash-message"><?php echo $message ?></div>
      <?php endif; ?>
        <div class="panel panel-default">
            <div class="panel-body">
                <form method="post">

                  <div class="form-group">
                    <label for="school">Filter by School</label>
                    <select class="form-control" id="schoolFilter" name="school">
                    <?php if (isset($schools)) : ?>
                      <option value="">Choose a School to filter staff options</option>
                      <?php foreach($schools as $k => $v): ?>
                        <option value="<?php echo $v->EducationOrganizationId; ?>" <?php if( isset($_GET['school']) and $_GET['school'] == $v->EducationOrganizationId) {echo "selected";} ?> ><?php echo $v->NameOfInstitution ?></option>
                      <?php endforeach; ?>                        
                    <?php else : ?>
                        <option value="<?php echo $data[0]->Institutions[0]->EducationOrganizationId ?>"><?php echo $data[0]->Institutions[0]->NameOfInstitution ?></option>
                    <?php endif; ?> 
                    </select>  
                  </div>

                   <div class="form-group">
                    <label for="staffusi">StaffUSI Full Name</label>
                    <select class="form-control" id="staffusi" name="StaffUSI">
                      <?php if (isset($staff)) : ?>
                        <option school="reset" value="">Choose a user to add or edit</option>
                        <?php foreach($staff as $k => $v): ?>
                          <option school="<?php echo $v->Institutions[0]->EducationOrganizationId ?>" value="<?php echo $v->StaffUSI ?>" <?php if( isset($_GET['staffusi']) and $_GET['staffusi'] == $v->StaffUSI) {echo "selected";} ?>><?php echo $v->FirstName .' '. $v->LastSurname; ?></option>
                        <?php endforeach; ?> 
                      <?php else : ?>
                        <option value="<?php echo $data[0]->StaffUSI ?>"><?php echo $data[0]->FirstName .' '.$data[0]->LastSurname; ?></option>
                      <?php endif; ?>                       
                    </select>   
                  </div>
                  
                   <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" name="RoleId">
                       <?php foreach($roles as $k => $v): ?>
                        <option value="<?php echo $v->RoleTypeId ?>" <?php if( isset($_GET['role']) and $_GET['role'] == $v->RoleTypeId or isset($data[0]->Role) and $data[0]->Role->RoleTypeId == $v->RoleTypeId) {echo "selected";} ?>><?php echo $v->RoleTypeName ?></option>
                        <?php endforeach; ?>                        
                    </select>   
                  </div>

                   <div id="usermanagement-addedit-password" class="form-group">
                    <label for="Password">Password</label>
                    <input type="text" class="form-control input-sm" name="Password" value="" />
                  </div>

                  <div id="usermanagement-addedit-authtype" class="checkbox">
                    <label for="GoogleAuth">
                    <input type="checkbox" name="GoogleAuth" value="1" <?php echo (isset($data[0]->GoogleAuth) and $data[0]->GoogleAuth) ? 'checked' : ''; ?>>Google Authorization
                    </label>
                  </div>                    

                  <button type="submit" class="btn btn-default" id="userAddEdit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>