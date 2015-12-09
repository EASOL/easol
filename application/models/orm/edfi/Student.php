<?php

namespace Model\Edfi;

use \Gas\Core;
use \Gas\ORM;

class Student extends ORM {

	public $table = "edfi.Student";
	public $primary_key = 'StudentUSI';

	public $foreign_key = [
		'\\model\\edfi\\limitedenglishproficiencytype' => 'LimitedEnglishProficiencyTypeId',
		'\\model\\edfi\\sextype' => 'SexTypeId',
		'\\model\\edfi\\oldethnicitytype' => 'OldEthnicityTypeId',
		'\\model\\edfi\\stateabbreviationtype' => 'BirthStateAbbreviationTypeId',
		'\\model\\edfi\\countrycodetypeid' => 'BirthCountryCodeTypeId',
	];

	function _init() {

		self::$relationships = [
			'LimitedEnglishProficiencyType'=> ORM::belongs_to('\\Model\\Edfi\\LimitedEnglishProficiencyType'),
			'StudentRace' => ORM::has_one('\\Model\\Edfi\\StudentRace'),
			'SexType' => ORM::belongs_to('\\Model\\Edfi\\SexType'),
			'StudentAddress' => ORM::has_many('\\Model\\Edfi\\StudentAddress'),
			'Address' => ORM::has_many('\\Model\\Edfi\\StudentAddress'),
			'OldEthnicityType' => ORM::belongs_to('\\Model\\Edfi\\OldEthnicityType'),
			'BirthStateAbbreviationType' => ORM::belongs_to('\\Model\\Edfi\\StateAbbreviationType'),
			'BirthCountryCodeType' => ORM::belongs_to('\\Model\\Edfi\\CountryCodeType'),
			'Telephone' => ORM::has_many('\\Model\\Edfi\\StudentTelephone'),
			'Parent' => ORM::has_many('\\Model\\Edfi\\StudentParent'),
			'Section' => ORM::has_many('\\Model\\Edfi\\StudentSection'),
			'Grade' => ORM::has_many('\\Model\\Edfi\\Grade'),
			'School' => ORM::has_many('\\Model\\Edfi\\School\\Student => \\Model\\Edfi\\School')
		];

		self::$fields = [
			'StudentUSI'                                => ORM::field('int[10]'),
			'PersonalTitlePrefix'                       => ORM::field('char[75]'),
			'FirstName'                                 => ORM::field('char[75]'),
			'MiddleName'                                => ORM::field('char[75]'),
			'LastSurname'                               => ORM::field('char[75]'),
			'GenerationCodeSuffix'                      => ORM::field('char[75]'),
			'MaidenName'                                => ORM::field('char[75]'),
			'SexTypeId'                                 => ORM::field('int[10]'),
			'BirthDate'                                 => ORM::field('datetime'),
			'CityOfBirth'                               => ORM::field('char[30]'),
			'BirthStateAbbreviationTypeId'              => ORM::field('int[10]'),
			'BirthCountryCodeTypeId'                    => ORM::field('int[10]'),
			'DateEnteredUS'                             => ORM::field('datetime'),
			'MultipleBirthStatus'                       => ORM::field('numeric'),
			'ProfileThumbnail'                          => ORM::field('char[59]'),
			'HispanicLatinoEthnicity'                   => ORM::field('numeric'),
			'OldEthnicityTypeId'                        => ORM::field('int[10]'),
			'EconomicDisadvantaged'                     => ORM::field('numeric'),
			'SchoolFoodServicesEligibilityDescriptorId' => ORM::field('int[10]'),
			'LimitedEnglishProficiencyDescriptorId'     => ORM::field('int[10]'),
			'DisplacementStatus'                        => ORM::field('char[30]'),
			'LoginId'                                   => ORM::field('char[60]'),
			'InternationalProvinceOfBirth'              => ORM::field('char[150]'),
			'CitizenshipStatusTypeId'                   => ORM::field('int[10]'),
			'StudentUniqueId'                           => ORM::field('char[32]'),
			'Id'                                        => ORM::field('char[255]'),
			'LastModifiedDate'                          => ORM::field('datetime'),
			'CreateDate'                                => ORM::field('datetime'),
		];
	}
}
