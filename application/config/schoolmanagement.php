<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$config['schoolattributes'] = array (
       'CURRENT_SCHOOLYEAR' => array (
            'label' => 'Current School Year',
            'type' => 'select',
            'options' => array('2010','2011','2012','2013'),

        ),
       'CURRENT_TERMID' => array (
           'label' => 'Current Term ID',
           'type' => 'select',
           'options' => ('') // we should get all edfi.TermType values here ('1'=>"Fall Semester",'2'=>"Sprint Semester", etc.
       ),
       'PRINCIPAL_FULL_NAME' => array (
            'label' => "Full Principal Name",
            'type'  => 'text' 
       ),
);