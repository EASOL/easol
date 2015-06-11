<?php
/**
 * User: Nahid Hossain
 * Email: mail@akmnahid.com
 * Phone: +880 172 7456 280
 * Date: 6/3/2015
 * Time: 2:58 PM
 */
require_once APPPATH.'/core/Easol_BaseWidget.php';

class DataTableWidget extends Easol_BaseWidget {

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
    public $colOrderBy=null;
    public $columns= [

    ];

    public $filter=null;


    public function run()
    {

        if($this->filter!=null && array_key_exists('filter',$_GET)){ /*@filter*/
            $queryAddition=[];

            foreach($this->filter['fields'] as $key => $field){
                if( array_key_exists('access',$field) && !Easol_AuthorizationRoles::hasAccess($field['access'])) continue;
                if($field['bindDatabase']==true && $field['type']=='dropdown' && $this->input->get('filter['.$key.']')!=""){
                    $queryAddition[]=$field['searchColumn']."=".$this->db->escape($this->input->get('filter['.$key.']'))." ";

                }
                elseif(array_key_exists('fieldType',$field)){
                    if($field['fieldType']=='pageSize'){
                        $this->pagination['pageSize']   = $field['range']['set'][$this->input->get('filter['.$key.']')];
                    }
                }

            }
            if(count($queryAddition)>0) {
                $this->query = "SELECT * FROM (" . $this->query . ") as a WHERE " . implode(' AND ', $queryAddition);
            }

            //$this->query=str_replace('/*@filter*/',$queryAddition,$this->query);

            //die($this->query);


        }
        if($this->pagination!=null){
            $totalCount=$this->db->query(
                "SELECT  count(*) as tot FROM
            (".$this->query.") as b"
            )->row();

            //die(print_r($totalCount));


            $this->pagination['totalElements']  =   $totalCount->tot;
            $this->query.=' ORDER BY '.$this->colOrderBy.'  OFFSET ? ROWS FETCH NEXT ? ROWS ONLY';

            $dbQuery= $this->db->query($this->query,[abs($this->pagination['currentPage']-1)*$this->pagination['pageSize'],$this->pagination['pageSize']]);

        }
        else
            $dbQuery= $this->db->query($this->query);



        $this->render("view",[
            'query'     =>  $dbQuery,
            'columns'   =>  $this->columns,
            'pagination'    =>  $this->pagination,
            'filter'    =>  $this->filter
        ]);
    }
}