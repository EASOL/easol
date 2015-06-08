<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Sections</h1>
        <br/><br/>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?php Easol_Widget::show("DataFilterWidget",
            [
                'fields' =>
                    [
                        'NameOfInstitution' =>
                            [
                                'database'  =>  true,
                                'entity'    =>  'entities/edfi/Edfi_School',
                                'query'     =>  "SELECT * FROM edfi.EducationOrganization",
                                'column'    =>  'NameOfInstitution',
                                'label'     =>  'Name of Institution',
                                'type'      =>  'dropdown'
                            ],
                        'Year'  =>
                            [
                                'database'  =>  'false',
                                'range'     =>
                                    [
                                        'type'  =>  'dynamic',
                                        'start' =>  2000,
                                        'end'   =>  date('Y'),
                                        'increament'    =>  1,
                                    ],
                                'default'   =>  date('Y'),
                                'label'     =>  'Year',
                                'type'      =>  'dropdown'

                            ]

                    ]

            ]

        ) ?>
    </div>
</div>