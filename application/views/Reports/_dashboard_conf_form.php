<?php

?>
<?php /* @var $reports Easol_Report[] */ ?>

<div class="row">
    <div class="col-md-12 col-sm-12">
        <form action="" method="post" class="form-horizontal">
            <div class="form-group">
                <div class="col-md-12 col-sm-12">
                    <table class="table table-bordered">
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
                        $optionTables = "";
                        $optionCharts = "";

                        foreach($reports as $report){
                            if($report->ReportDisplayId==1)
                                $optionTables.='<option value="'.$report->ReportId.'">'.$report->ReportName.'</option>';

                            else
                                $optionCharts.='<option value="'.$report->ReportId.'">'.$report->ReportName.'</option>';
                        }

                        ?>

                        <?php foreach($roles as $role){ ?>

                            <?php
                            $leftOptions='';
                            $rightOptions='';
                            $bottomOptions='';
                            /* @var $dashConf Easol_DashboardConfiguration */
                            $dashConf= (new Easol_DashboardConfiguration())->findOne(['RoleTypeId'=>$role->RoleTypeId,'EducationOrganizationId' => Easol_Authentication::userdata('SchoolId')]);

                            ?>

                            <?php  foreach($reports as $report){ ?>
                                <?php
                                //check if table
                               // if($report->ReportDisplayId==1)
                                 //   continue;
                                $flagLeftOptions= false;
                                $flagRightOptions= false;
                                $flagBottomOptions= false;
                                foreach($report->getAccessTypes() as $access){

                                    if($role->RoleTypeId==1 || $role->RoleTypeId==2 || $access->RoleTypeId == $role->RoleTypeId  ){
                                        ?>
                                            <?php
                                        //check if not table
                                            if($report->ReportDisplayId!=1){ ?>
                                                <?php
                                                if($flagLeftOptions==false) {
                                                    $flagLeftOptions = true;
                                                $leftOptions.='<option ';
                                                if($dashConf!=null && $dashConf->LeftChartReportId == $report->ReportId )
                                                    $leftOptions.= 'selected="selected" ';
                                                 $leftOptions.= 'value="'.$report->ReportId.'">'.$report->ReportName.'</option>';

                                                }
                                                ?>
                                                <?php
                                                if($flagRightOptions==false) {
                                                    $flagRightOptions = true;
                                                    $rightOptions.='<option ';
                                                    if($dashConf!=null && $dashConf->RightChartReportId == $report->ReportId )
                                                        $rightOptions.= 'selected="selected" ';
                                                    $rightOptions.= 'value="'.$report->ReportId.'">'.$report->ReportName.'</option>';

                                                }
                                                ?>

                                            <?php } else { ?>
                                                <?php
                                                if($flagBottomOptions==false) {
                                                    $flagBottomOptions = true;
                                                    $bottomOptions.='<option ';
                                                    if($dashConf!=null && $dashConf->BottomTableReportId == $report->ReportId )
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
                            <td><?= $role->RoleTypeName ?></td>
                            <td><select name="dashboardConf[<?= $role->RoleTypeId ?>][left]">
                                    <?= $leftOptions ?>


                                </select> </td>
                            <td><select name="dashboardConf[<?= $role->RoleTypeId ?>][right]"">
                                <?= $rightOptions ?>
                                </select> </td>
                            <td><select name="dashboardConf[<?= $role->RoleTypeId ?>][bottom]"">
                                <?= $bottomOptions ?>
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
