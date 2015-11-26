<?php

namespace Model\Edfi;

use \Gas\Core;
use \Gas\ORM;

class Grade extends ORM {

	public $table = "edfi.Grade";
	public $primary_key = 'StudentUSI';

	public $foreign_key = [
		'\\model\\edfi\\student' => 'StudentUSI',
		'\\model\\edfi\\School' => 'SchoolId',
	//	'\\model\\edfi\\GradeType' => 'GradeTypeId'
	];

	function _init() {

		self::$relationships = [
			'Student'=> ORM::belongs_to('\\Model\\Edfi\\Student'),
			'School'=> ORM::belongs_to('\\Model\\Edfi\\School'),
			//'GradeType'=>ORM::belongs_to('\\Model\\Edfi\\GradeType')
		];

		self::$fields = [
			'StudentUSI'                           => ORM::field('int[10]'),
			'SchoolId'                             => ORM::field('int[10]'),
			'ClassPeriodName'                      => ORM::field('char[20]'),
			'ClassroomIdentificationCode'          => ORM::field('char[20]'),
			'LocalCourseCode'                      => ORM::field('char[60]'),
			'TermTypeId'                           => ORM::field('int[10]'),
			'SchoolYear'                           => ORM::field('numeric[5]'),
			'BeginDate'                            => ORM::field('datetime'),
			'GradingPeriodDescriptorId'            => ORM::field('int[10]'),
			'GradingPeriodBeginDate'               => ORM::field('datetime'),
			'GradingPeriodEducationOrganizationId' => ORM::field('int[10]'),
			'LetterGradeEarned'                    => ORM::field('char[20]'),
			'NumericGradeEarned'                   => ORM::field('int[10]'),
			'DiagnosticStatement'                  => ORM::field('char[1024]'),
			'GradeTypeId'                          => ORM::field('int[10]'),
			'PerformanceBaseConversionTypeId'      => ORM::field('int[10]'),
			'Id'                                   => ORM::field('char[255]'),
			'LastModifiedDate'                     => ORM::field('datetime'),
			'CreateDate'                           => ORM::field('datetime'),
		];
	}
}
