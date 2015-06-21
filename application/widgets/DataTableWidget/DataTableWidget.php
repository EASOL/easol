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

    public $downloadCSV = false;


    /**
     * Run the data table widget codes and display it
     */
    public function run()
    {

        $filterOrderBy=[];


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
                    elseif($field['fieldType']=='dataSort'){
                        if(array_key_exists($this->input->get('filter['.$key.'][column]'),$field['columns']) && array_key_exists($this->input->get('filter['.$key.'][type]'),$field['sortTypes'])){
                            $filterOrderBy[] =$this->input->get('filter['.$key.'][column]').' '.$this->input->get('filter['.$key.'][type]');
                        }
                        //$filterOrderBy[]=
                    }
                }

            }
            if(count($queryAddition)>0) {
                $this->query = "SELECT * FROM (" . $this->query . ") as a WHERE " . implode(' AND ', $queryAddition);
            }

            //$this->query=str_replace('/*@filter*/',$queryAddition,$this->query);

            //die($this->query);


        }
        if($this->pagination!=null && $this->input->get("downloadcsv")!='y'){
            $totalCount=$this->db->query(
                "SELECT  count(*) as tot FROM
            (".$this->query.") as b"
            )->row();

            //die(print_r($totalCount));


            $this->pagination['totalElements']  =   $totalCount->tot;
        }

        if(count($filterOrderBy)>0){
            $this->query .= ' ORDER BY '.implode(" , ",$filterOrderBy).' ';
        }
        else
            $this->query .= ' ORDER BY '.$this->colOrderBy.' ';
        if($this->pagination!=null  && $this->input->get("downloadcsv")!='y'){


            $this->query.='  OFFSET ? ROWS FETCH NEXT ? ROWS ONLY';

            $dbQuery= $this->db->query($this->query,[abs($this->pagination['currentPage']-1)*$this->pagination['pageSize'],$this->pagination['pageSize']]);

        }
        else
            $dbQuery= $this->db->query($this->query);

        if( $this->downloadCSV==true && $this->input->get("downloadcsv")=='y'){
            Easol_Flag::$downloadFile =true;

            ob_clean();

            header("Content-type: text/csv");
            header("Content-Disposition: attachment; filename=".$this->router->fetch_class().'_'.$this->router->fetch_method().'_'.date('Y_m_d_h:i_a').".csv");
            header("Pragma: no-cache");
            header("Expires: 0");

            $this->render("csvdownload",[
                'query'     =>  $dbQuery,
                'columns'   =>  $this->columns,

            ]);
            die();
        }

        $this->render("view",[
            'query'     =>  $dbQuery,
            'columns'   =>  $this->columns,
            'pagination'    =>  $this->pagination,
            'filter'    =>  $this->filter,
            'downloadCSV' => $this->downloadCSV

        ]);
    }
}