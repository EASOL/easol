<?php

namespace Model\Edfi\School;

use \Gas\Core;
use \Gas\ORM;

class Student extends ORM {

	public $primary_key = 'StudentUSI';
	public $table       = "edfi.StudentSchoolAssociation";
	public $foreign_key = [
		'\\model\\edfi\\school' => 'SchoolId',
		'\\model\\edfi\\student' => 'StudentUSI'
	];

	function _init() {

		self::$relationships = [
			'School' => ORM::belongs_to('\\Model\\Edfi\\School'),
			'StudentUSI' => ORM::belongs_to('\\Model\\Edfi\\Student')
		];

		self::$fields = [
			'StudentUSI'                      => ORM::field('int[10]'),
			'SchoolId'                        => ORM::field('int[10]'),
			'ClassPeriodName'                 => ORM::field('char[20]'),
			'ClassroomIdentificationCode'     => ORM::field('char[20]'),
			'LocalCourseCode'                 => ORM::field('char[60]'),
			'TermTypeId'                      => ORM::field('int[10]'),
			'SchoolYear'                      => ORM::field('numeric[5]'),
			'BeginDate'                       => ORM::field('datetime'),
			'EndDate'                         => ORM::field('datetime'),
			'HomeroomIndicator'               => ORM::field('numeric'),
			'RepeatIdentifierTypeId'          => ORM::field('int[10]'),
			'TeacherStudentDataLinkExclusion' => ORM::field('numeric'),
			'Id'                              => ORM::field('char[255]'),
			'LastModifiedDate'                => ORM::field('datetime'),
			'CreateDate'                      => ORM::field('datetime'),
		];
	}
}
