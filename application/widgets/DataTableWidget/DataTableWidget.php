<?php

require_once APPPATH.'/core/Easol_BaseWidget.php';

class DataTableWidget extends Easol_BaseWidget {

    /**
     * Run the widget functionality
     */
    public $query;

    public $dbQuery;

    public $pagination=null;

    /*
     *  ['column'    =>  'name',
     *  'type'      =>  'text',
     *  'title'      =>  'title'
     *  ]
     */
    public $colOrderBy=null;
    public $colGroupBy=null;
    public $columns= [

    ];

    public $filter=null;

    public $downloadCSV = false;


    public $view="view.php";


    /**
     * Run the data table widget codes and display it
     */
    public function run()
    {

        $this->setDbQuery();

        if( $this->downloadCSV==true && $this->input->get("downloadcsv")=='y'){
            Easol_Flag::$downloadFile =true;

            ob_clean();

            header("Content-type: text/csv");
            header("Content-Disposition: attachment; filename=".$this->router->fetch_class().'_'.$this->router->fetch_method().'_'.date('Y_m_d_h:i_a').".csv");
            header("Pragma: no-cache");
            header("Expires: 0");

            $this->render("csvdownload",[
                'query'     =>  $this->dbQuery,
                'columns'   =>  $this->columns,

            ]);
            die();
        }

        $this->render($this->view,[
            'query'     =>  $this->dbQuery,
            'columns'   =>  $this->columns,
            'pagination'    =>  $this->pagination,
            'filter'    =>  $this->filter,
            'downloadCSV' => $this->downloadCSV

        ]);
    }

    public function setDbQuery() {
        $filterOrderBy = [];

        $bindValues = [];
        //die(print_r($this->filter['bindIndex']));

        //$queryBuilder


        if($this->filter!=null && isset($this->filter['dataBind']) && $this->filter['dataBind']==true ){
                $_valI=0;
                foreach($this->filter['bindIndex'] as $index => $options){
                    if($this->filter['fields'][$index]['default']!=''){
                        if($_valI==0 && $this->filter['queryWhere'] == true){
                            $options['glue'] = ' WHERE ';
                        }
                        $this->query .= ' '.$options['glue'].' '.$this->filter['fields'][$index]['queryBuilderColumn'].' = ?';
                        $bindValues[]=$this->filter['fields'][$index]['default'];

                        $_valI++;
                    }
                }

                foreach ($this->filter['fields'] as $key => $field) {
                    if (array_key_exists('fieldType', $field)) {
                        if ($field['fieldType'] == 'pageSize') {
                           //$this->pagination['pageSize'] = $field['range']['set'][($this->input->get('filter[' . $key . ']') && $this->input->get('filter[' . $key . ']') < sizeof($field['range']['set']) && $this->input->get('filter[' . $key . ']') >=0 ) ? $this->input->get('filter[' . $key . ']')  :0];
                           if(array_key_exists($field['default'],$field['range']['set'])){
                            $this->pagination['pageSize'] = $field['range']['set'][$field['default']];
                           }
                        }elseif ($field['fieldType'] == 'dataSort') {
                            if (array_key_exists($this->input->get('filter[' . $key . '][column]'), $field['columns']) && array_key_exists($this->input->get('filter[' . $key . '][type]'), $field['sortTypes'])) {
                                $filterOrderBy[] = $this->input->get('filter[' . $key . '][column]') . ' ' . $this->input->get('filter[' . $key . '][type]');
                            }
                        }
                    }
                }
            }
        elseif($this->filter!=null && array_key_exists('filter',$_GET)){ /*@filter*/ {
                $queryAddition = [];

                foreach ($this->filter['fields'] as $key => $field) {
                    if (array_key_exists('access', $field) && !Easol_AuthorizationRoles::hasAccess($field['access'])) continue;
                    if ($field['bindDatabase'] == true && $field['type'] == 'dropdown' && $this->input->get('filter[' . $key . ']') != "") {
                        $queryAddition[] = $field['searchColumn'] . "=" . $this->db->escape($this->input->get('filter[' . $key . ']')) . " ";

                    } elseif (array_key_exists('fieldType', $field)) {
                        if ($field['fieldType'] == 'pageSize') {
                            $this->pagination['pageSize'] = $field['range']['set'][$this->input->get('filter[' . $key . ']')];
                        } elseif ($field['fieldType'] == 'dataSort') {
                            if (array_key_exists($this->input->get('filter[' . $key . '][column]'), $field['columns']) && array_key_exists($this->input->get('filter[' . $key . '][type]'), $field['sortTypes'])) {
                                $filterOrderBy[] = $this->input->get('filter[' . $key . '][column]') . ' ' . $this->input->get('filter[' . $key . '][type]');
                            }
                        }
                    }

                }
                if (count($queryAddition) > 0) {
                    $this->query = "SELECT * FROM (" . $this->query . ") as a WHERE " . implode(' AND ', $queryAddition);
                }

                //$this->query=str_replace('/*@filter*/',$queryAddition,$this->query);

                //die($this->query);

            }
        }

        if($this->colGroupBy!=null && is_array($this->colGroupBy)){
            $this->query.=' GROUP BY '.implode(",",$this->colGroupBy);

        }
        if($this->pagination!=null && $this->input->get("downloadcsv")!='y'){


            //die(print_r($bindValues));
            $totalCount=$this->db->query(
                "SELECT  count(*) as tot FROM
              (".$this->query.") as b",
                $bindValues
            )->row();



            //die(print_r($totalCount));


            $this->pagination['totalElements']  =   $totalCount->tot;
        }


        if(count($filterOrderBy)>0){
            $this->query .= ' ORDER BY '.implode(" , ",$filterOrderBy).' ';
        }
        else
            $this->query .= ' ORDER BY '.implode(" , ",$this->colOrderBy).' ';
        if($this->pagination!=null  && $this->input->get("downloadcsv")!='y'){



            $this->query.='  OFFSET ? ROWS FETCH NEXT ? ROWS ONLY';
            $bindValues[]= abs($this->pagination['currentPage']-1)*$this->pagination['pageSize'];
            $bindValues[]= $this->pagination['pageSize'];



            $this->dbQuery= $this->db->query($this->query,$bindValues);

           //$dbQuery= $this->db->query($this->query,[abs($this->pagination['currentPage']-1)*$this->pagination['pageSize'],$this->pagination['pageSize']]);

        }
        else
            $this->dbQuery= $this->db->query($this->query,$bindValues);
    }
}