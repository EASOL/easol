<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
* I wrote this as a config file as per the spec at 
* https://github.com/EASOL/easol/issues/90
* but given the model and url helper calls, this really should be
* located in the calling controller.
*/

$ci =& get_instance();
$ci->load->model('SchoolManagement_M');
$schoolData = $ci->SchoolManagement_M->getSchoolDetails($ci->uri->segment(3));

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

foreach ($schoolData['details'] as $k => $v)
{
  if (isset($config['schoolattributes'][$v->Key]))
    unset($config['schoolattributes'][$v->Key]);
}