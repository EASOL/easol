<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content extends Easol_Controller {


    protected function accessRules(){
        return [
            "index"     =>  "@",
        ];
    }

    public function _remap($method, $params = array())
    {
        if (method_exists($this, $method))
        {
            return call_user_func_array(array($this, $method), $params);
        }
        // or else we can use the method uri segment as the view in the index method
        else
        {
            $this->index($method);
        }
    }

    public function filter_name($filter)
    {
        echo $filter;
    }

    /**
     * index action
     * @param null $id
     */
    public function index($view = '')
    {

            // get the values for the html form elements.
            $this->config->load('gradelevels');
            $this->config->load('standards');

            $total_count = 0;

            // show the results if we are processing the html form or parsing url attributes directly.
            if ($data = $this->input->get()) {

                // define the dataset size
                $data['limit'] = EASOL_PAGINATION_PAGE_SIZE;
                // fetch the limited dataset. There will be no page attribute if we are processing the html
                // form and there will be a page attribute if we are following a pagination link.
                // If there is no page param then the api starts with the first record through the limit param.

                if (isset($data['query']) && $data['query'] == "search text") { $data['query'] = ""; }
                $query          = http_build_query($data);
                $site           = $this->config->item('content_api').$query;
                $headers        = get_headers($site, 1);
                $response       = json_decode(file_get_contents($site, true));

                // Get the pagination record metrics for display in the view file(s).
                $page           = ($this->input->get('page')) ? $this->input->get('page') : 1;
                $total_count    = $headers['x-total-count'];
                $start_count    = ((($page - 1) * EASOL_PAGINATION_PAGE_SIZE) + 1);
                $end_count      = (($start_count + EASOL_PAGINATION_PAGE_SIZE) - 1);

                if ($end_count < EASOL_PAGINATION_PAGE_SIZE)   // happens when records less than per page  
                    $end_count = EASOL_PAGINATION_PAGE_SIZE;  
                else if ($end_count > $total_count)  // happens when result end is greater than total records  
                    $end_count = $total_count;                

                // Define a new query string without the page and limit values
                // for use in building the pagination links.
                $base = $data;
                unset($base['limit']);                
                unset($base['page']);
                $base_qs = http_build_query($base);                
            }
           
            // Set the base url for filter links
            $filter_base_url = current_url_full();

            // Build the array of active filters for use in the view for status and defiltering.
            $filters_active = $this->input->get();
            unset($filters_active['query']);
            unset($filters_active['page']);
            unset($filters_active['limit']);


            if (isset($response->aggregations)) {
                // Massage the filter data as required by the spec.
                if (isset($response->aggregations->languages))
                    unset($response->aggregations->languages);

                foreach ($response->aggregations as $filtername => $filter)
                {
                    foreach ($filter as $key => $value) {
                        if ($value < 2) {
                            unset($filter->$key);
                        }
                    }

                    if (!count((array) $filter))
                        unset($response->aggregations->$filtername);
                }
            }
            // Trim the description to 465 chars.
              if(isset($response->results)) {

                $this->load->helper('shrinktheweb');

                foreach ($response->results as $obj)
                {
                    $obj->thumbnail = getThumbnailHTML($obj->resource_locators[0]->url);

                    if(strlen($obj->description) > 465)
                        $obj->description = mb_strimwidth($obj->description, 0, 465, "...");
                }
            }
            
            // build the pagination links.
            $this->load->library('pagination');
            $config['base_url']             = (isset($base_qs))? 'content?'.$base_qs : 'content?';
            $config['page_query_string']    = TRUE; 
            $config['use_page_numbers']     = TRUE;
            $config['per_page']             = EASOL_PAGINATION_PAGE_SIZE;
            $config['query_string_segment'] = 'page';
            $config['total_rows']           = $total_count;
           
            /* This Application Must Be Used With BootStrap 3 *  */
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] ="</ul>";
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
            $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
            $config['next_tag_open'] = "<li>";
            $config['next_tagl_close'] = "</li>";
            $config['prev_tag_open'] = "<li>";
            $config['prev_tagl_close'] = "</li>";
            $config['first_tag_open'] = "<li>";
            $config['first_tagl_close'] = "</li>";
            $config['last_tag_open'] = "<li>";
            $config['last_tagl_close'] = "</li>";

            $this->pagination->initialize($config); 

            $view = (!empty($view)) ? $view : 'index';
            
            if ($view == 'extension')
                $this->layout = null;

            // map the footnotes tags for iteration in the view to keep the code as DRY as possible.
            $footnotes  = array(    'Subjects'  => array('subjects'       => 'name'),
                                    'Standards' => array('alignments'     => 'name'),
                                    'Grades'    => array('grades'         => 'grade'),
                                    'Types'     => array('resource_types' => 'name'),
                               
                            );


            $this->render($view, [
                'gradelevels'       => $this->config->item('gradelevels'),
                'standards'         => $this->config->item('standards'),
                'results'           => (isset($response->results)) ? $response->results : null,
                'filters'           => (isset($response->aggregations)) ? $response->aggregations : null,
                'filters_active'    => $filters_active,
                'filter_base_url'   => $filter_base_url,
                'footnotes'         => $footnotes,
                'total_count'       => isset($total_count) ? $total_count : 0,
                'start_count'       => isset($start_count) ? $start_count : 0,
                'end_count'         => isset($end_count) ? $end_count : 0,                
            ]);
        }

}
