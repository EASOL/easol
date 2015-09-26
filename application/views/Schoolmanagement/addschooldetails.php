<div class="row">
    <div class="col-md-12 col-sm-12">
        <h1 class="page-header"><?php echo $school[0]->NameOfInstitution ?></h1>
        <p>Add school configuration values</p>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <form class="form-inline" method="post">
                  <div class="form-group">
                    <label for="key">Key</label><br />
                    <input type="text" class="form-control input-sm" name="key" value="">
                  </div>
                   <div class="form-group">
                    <label for="value">Value</label><br />
                    <input type="text" class="form-control input-sm" name="value" value="" >
                  </div>                                              
                  <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>