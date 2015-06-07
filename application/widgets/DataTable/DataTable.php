<?php
/**
 * User: Nahid Hossain
 * Email: mail@akmnahid.com
 * Phone: +880 172 7456 280
 * Date: 6/3/2015
 * Time: 2:58 PM
 */
require_once APPPATH.'/core/Easol_BaseWidget.php';

class DataTable extends Easol_BaseWidget {

    /**
     * Run the widget functionality
     */
    public $query;

    public $pagination=null;

    /*
     *  ['column'    =>  'name',
     *  'type'      =>  'text',
     *  'title'      =>  'title'
     *  ]
     */
    public $columns= [

    ];


    public function run()
    {
        if($this->pagination!=null){

        }

        $dbQuery= $this->db->query($this->query);

        $this->render("view",[
            'query' =>  $dbQuery,
            'columns'   =>    $this->columns,
            'pagination'    => $this->pagination
        ]);
    }
}