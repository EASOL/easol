<?php
/**
 * Created by PhpStorm.
 * User: Nahid Hossain
 * Email: mail@akmnahid.com
 * Web: www.akmnahid.com
 * Date: 7/31/2015
 * Time: 11:41 AM
 */
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
                        <tr>
                            <td><?= $role->RoleTypeName ?></td>
                            <td><select name="dashboardConf[<?= $role->RoleTypeId ?>][left]"><?= $optionCharts ?></select> </td>
                            <td><select name="dashboardConf[<?= $role->RoleTypeId ?>][right]""><?= $optionCharts ?></select> </td>
                            <td><select name="dashboardConf[<?= $role->RoleTypeId ?>][bottom]""><?= $optionTables ?></select> </td>
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
