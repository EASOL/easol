<?php extract($data); ?> 
<div class="row">
    <div class="col-md-12 col-sm-12">
        <h1 class="page-header"><?php echo $title ?></h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <form method="post">

                  <div class="form-group">
                    <label for="school">Filter by School</label>
                    <select class="form-control" id="schoolFilter" name="school" <?php echo (isset($schools)) ? '' : 'disabled'; ?>>
                    <?php if (isset($schools)) : ?>
                      <option value="all">All Schools</option>
                      <?php foreach($schools as $k => $v): ?>
                        <option value="<?php echo $v->EducationOrganizationId; ?>" <?php if( isset($_POST['school']) and $_POST['school'] == $v->EducationOrganizationId) {echo "selected";} ?> ><?php echo $v->NameOfInstitution ?></option>
                      <?php endforeach; ?>                        
                    <?php else : ?>
                        <option value="<?php echo $data[0]->Institutions[0]->EducationOrganizationId ?>"><?php echo $data[0]->Institutions[0]->NameOfInstitution ?></option>
                    <?php endif; ?> 
                    </select>  
                  </div>

                   <div class="form-group">
                    <label for="staffusi">
                      <?php echo form_error('StaffUSI'); ?>
                      StaffUSI Full Name
                    </label>
                    <select class="form-control" id="staffusi" name="StaffUSI" <?php echo (isset($staff)) ? '' : 'disabled'; ?>>
                      <?php if (isset($staff)) : ?>
                        <option school="reset" value="" selected>Choose a user to add or edit</option>
                        <?php foreach($staff as $k => $v): ?>
                          <option school="<?php echo $v->Institutions[0]->EducationOrganizationId ?>" value="<?php echo $v->StaffUSI ?>" <?php if( isset($_POST['StaffUSI']) and $_POST['StaffUSI'] == $v->StaffUSI) {echo "selected";} ?>><?php echo $v->FirstName .' '. $v->LastSurname .' '. $v->StaffUSI; ?></option>
                        <?php endforeach; ?> 
                      <?php else : ?>
                        <option value="<?php echo $data[0]->StaffUSI ?>"><?php echo $data[0]->FirstName .' '.$data[0]->LastSurname; ?></option>
                      <?php endif; ?>                       
                    </select>   
                  </div>

                  <?php if (!isset($staff)) : ?>
                    <input type="hidden" name="StaffUSI" value="<?php echo $data[0]->StaffUSI ?>" />
                  <?php else: ?>
                    <input type="hidden" name="newuser" value="true" />
                  <?php endif; ?>

                  <?php if (!isset($staff)) : ?>
                    <div class="form-group">
                      <label for="staffEmail">StaffUSI Email</label>
                      <select class="form-control" id="staffEmail" disabled>
                        <option><?php echo $data[0]->ElectronicMailAddress; ?></option>
                      </select>   
                    </div>                  
                  <?php endif; ?>

                   <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" name="RoleId">
                       <?php foreach($roles as $k => $v): ?>
                        <option value="<?php echo $v->RoleTypeId ?>" <?php if( isset($_POST['RoleId']) and $_POST['RoleId'] == $v->RoleTypeId or isset($data[0]->Role) and $data[0]->Role->RoleTypeId == $v->RoleTypeId) {echo "selected";} ?>><?php echo $v->RoleTypeName ?></option>
                        <?php endforeach; ?>                        
                    </select>   
                  </div>

                   <div id="usermanagement-addedit-password" class="form-group">
                    <label for="Password">
                      <?php echo form_error('Password'); ?>
                      Password
                    </label>
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