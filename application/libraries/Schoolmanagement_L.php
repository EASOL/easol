<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Schoolmanagement_L {

  public function __construct()
  {
    $this->ci =& get_instance();
  }

  public function getConfig ($all = false)
  {
    $config = array();
    $this->ci->load->model('SchoolManagement_M');
    $schoolData = $this->ci->SchoolManagement_M->getSchoolDetails($this->ci->uri->segment(3));

    $termTypes = $this->ci->SchoolManagement_M->getTermTypes();
    $termIds = array();
    foreach ($termTypes as $k => $v)
      $termIds[$v->TermTypeId] = $v->ShortDescription;

    $config['schoolattributes'] = array (
           'CURRENT_SCHOOLYEAR' => array (
                'label' => 'Current School Year',
                'type' => 'select',
                'options' => array('2010' => '2010',
                                  '2011'  => '2011',
                                  '2012'  => '2012',
                                  '2013'  => '2013',
                                  )

            ),
           'CURRENT_TERMID' => array (
               'label' => 'Current Term ID',
               'type' => 'select',
               'options' => $termIds,
           ),
           'PRINCIPAL_FULL_NAME' => array (
                'label' => "Full Principal Name",
                'type'  => 'text' 
           ),
    );

    if (!$all) {
      foreach ($schoolData['details'] as $k => $v)
      {
        if (isset($config['schoolattributes'][$v->Key]))
          unset($config['schoolattributes'][$v->Key]);
      }
    }
    
    return $config;
  }

}