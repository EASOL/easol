<?php

namespace Model\Edfi;

use \Gas\Core;
use \Gas\ORM;

class StudentParent extends ORM {

	public $table = "edfi.StudentParentAssociation";
	public $primary_key = 'StudentUSI';

	public $foreign_key = [
		'\\model\\edfi\\student' => 'StudentUSI',
		'\\model\\edfi\\parents' => 'ParentUSI',
		'\\model\\edfi\\relationtype' => 'RelationTypeId'
	];

	function _init() {

		self::$relationships = [
			'Student'=> ORM::belongs_to('\\Model\\Edfi\\Student'),
			'Parent'=> ORM::belongs_to('\\Model\\Edfi\\Parents'),
			'RelationType' => ORM::belongs_to('\\Model\\Edfi\\RelationType')
		];

		self::$fields = [
			'StudentUSI'             => ORM::field('int[10]'),
			'ParentUSI'              => ORM::field('int[10]'),
			'RelationTypeId'         => ORM::field('int[10]'),
			'PrimaryContactStatus'   => ORM::field('numeric'),
			'LivesWith'              => ORM::field('numeric'),
			'EmergencyContactStatus' => ORM::field('numeric'),
			'ContactPriority'        => ORM::field('int[10]'),
			'ContactRestrictions'    => ORM::field('char[250]'),
			'Id'                     => ORM::field('char[255]'),
			'LastModifiedDate'       => ORM::field('datetime'),
			'CreateDate'             => ORM::field('datetime'),
		];
	}
}
