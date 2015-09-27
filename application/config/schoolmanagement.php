<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$ci =& get_instance();
$ci->load->model('SchoolManagement_M');
$termTypes = $ci->SchoolManagement_M->getTermTypes();
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