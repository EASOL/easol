<?php

?>
<?php /* @var $reports Easol_Report[] */ ?>

<div class="row">
    <div class="col-md-12 col-sm-12">
        <form action="" method="post" class="form-horizontal">
            <div class="form-group">
                <div class="col-md-12 col-sm-12">
                    <table class="table table-bordered" data-csv='no' data-column-visibility='no' data-filter-option='no'>
                        <thead>
                        <tr>
                            <th>Role</th>
                            <th>Left Chart</th>
                            <th>Right Chart</th>
                            <th>Bottom Table</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $roles = (new Easol_RoleType())->findAll()->result();
                        ?>

                        <?php foreach($roles as $role){ ?>

                            <?php
                            $leftOptions='';
                            $rightOptions='';
                            $bottomOptions='';
                            /* @var $dashConf Easol_DashboardConfiguration */
                            $dashConf= (new Easol_DashboardConfiguration())->findOne(['RoleTypeId'=>$role->RoleTypeId,'EducationOrganizationId' => Easol_Auth::userdata('SchoolId')]);

                            ?>

                            <?php  foreach($reports as $report){ ?>
                                <?php
                                //check if table
                               // if($report->ReportDisplayId==1)
                                 //   continue;
                                $flagLeftOptions= FALSE;
                                $flagRightOptions= FALSE;
                                $flagBottomOptions= FALSE;
                                foreach($report->getAccessTypes() as $access){

                                    if($role->RoleTypeId==1 || $role->RoleTypeId==2 || $access->RoleTypeId == $role->RoleTypeId  ){
                                        ?>
                                            <?php
                                        //check if not table
                                            if($report->DisplayType != 'table'){ ?>
                                                <?php
                                                if($flagLeftOptions==FALSE) {
                                                    $flagLeftOptions = TRUE;
                                                $leftOptions.='<option ';
                                                if($dashConf!=NULL && $dashConf->LeftChartReportId == $report->ReportId )
                                                    $leftOptions.= 'selected="selected" ';
                                                 $leftOptions.= 'value="'.$report->ReportId.'">'.$report->ReportName.'</option>';

                                                }
                                                ?>
                                                <?php
                                                if($flagRightOptions==FALSE) {
                                                    $flagRightOptions = TRUE;
                                                    $rightOptions.='<option ';
                                                    if($dashConf!=NULL && $dashConf->RightChartReportId == $report->ReportId )
                                                        $rightOptions.= 'selected="selected" ';
                                                    $rightOptions.= 'value="'.$report->ReportId.'">'.$report->ReportName.'</option>';

                                                }
                                                ?>

                                            <?php } else { ?>
                                                <?php
                                                if($flagBottomOptions==FALSE) {
                                                    $flagBottomOptions = TRUE;
                                                    $bottomOptions.='<option ';
                                                    if($dashConf!=NULL && $dashConf->BottomTableReportId == $report->ReportId )
                                                        $bottomOptions.= 'selected="selected" ';
                                                    $bottomOptions.= 'value="'.$report->ReportId.'">'.$report->ReportName.'</option>';

                                                }
                                                ?>
                                            <?php } ?>
                                        <?php

                                    }
                                }
                                ?>

                            <?php } ?>

                        <tr>
                            <td style='width: 150px; vertical-align: middle'><?php echo $role->RoleTypeName ?></td>
                            <td><select name="dashboardConf[<?php echo $role->RoleTypeId ?>][left]" class='form-control'>
                                    <?php echo $leftOptions ?>


                                </select> </td>
                            <td><select name="dashboardConf[<?php echo $role->RoleTypeId ?>][right]" class='form-control'>
                                <?php echo $rightOptions ?>
                                </select> </td>
                            <td><select name="dashboardConf[<?php echo $role->RoleTypeId ?>][bottom]" class='form-control'>
                                <?php echo $bottomOptions ?>
                                </select> </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary pull-right">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
