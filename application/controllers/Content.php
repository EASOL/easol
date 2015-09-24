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

    /**
     * index action
     * @param null $id
     */
    public function index($view = '')
    {

            // get the values for the html form elements.
            $this->config->load('gradelevels');
            $this->config->load('standards');

            // show the results if we are processing the html form or parsing url attributes directly.
            if ($data = $this->input->get()) {

                // define the dataset size
                $data['limit'] = EASOL_PAGINATION_PAGE_SIZE;
                // fetch the limited dataset. There will be no page attribute if we are processing the html
                // form and there will be a page attribute if we are following a pagination link.
                // If there is no page param then the api starts with the first record through the limit param. 
                $query = http_build_query($data);
                $site = $this->config->item('content_api').$query;
                $response = json_decode(file_get_contents($site, true));
            
                // Define a new query string without the page and limit values and get the full dataset
                // for use in building the pagination links.
                $base = $data;
                unset($base['page']);
                unset($base['limit']);
                $base_qs = http_build_query($base);

                $site = $this->config->item('content_api').$base_qs;
                $unlimited = json_decode(file_get_contents($site, true));
            }

            // build the pagination links.
            $this->load->library('pagination');
            $config['base_url'] = (isset($base_qs))? 'content?'.$base_qs : 'content?';
            $config['page_query_string'] = TRUE; 
            $config['use_page_numbers'] = TRUE;
            $config['per_page'] = 1;
            $config['query_string_segment'] = 'page';
            $config['total_rows'] = (isset($unlimited)) ? (count($unlimited) / EASOL_PAGINATION_PAGE_SIZE) : 0;

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
            $this->render($view, [
                'gradelevels'   => $this->config->item('gradelevels'),
                'standards'     => $this->config->item('standards'),
                'response'      => (isset($response)) ? $response : null,
            ]);
        }

}
