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
                                'entity'    =>  'entities/edfi/Edfi_School',
                                'query'     =>  $this->db->query("SELECT * FROM edfi.EducationOrganization"),
                                'searchColumn'    =>  'edfi.EducationOrganization.EducationOrganizationId',
                                'textColumn'=>  'NameOfInstitution',
                                'indexColumn'=>  'EducationOrganizationId',
                                'label'     =>  'Name of Institution',
                                'type'      =>  'dropdown',
                                'access'    =>  ['System Administrator','Data Administrator'],
                                'default'   => ''
                            ],
                        'Year'  =>
                            [
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