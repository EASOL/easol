<?php

/**
 * @group models
 */
class Student_model_test extends TestCase {

	public function setUp() 
 {
		$this->resetInstance();
	}

	public function test_find() 
 {

		$expected = [
			'555555' => ['FirstName' => 'Sarah', 'MiddleName' => '', 'LastSurname' => 'Stevens'],
			'604891' => ['FirstName'=>'Ivan', 'MiddleName'=>'Jack', 'LastSurname'=>'Molina'],
			'604941' => ['FirstName'=>'David', 'MiddleName'=>'', 'LastSurname'=>'Dudley'],
		];

		$list = Model\Edfi\Student::find(555555, 604891, 604941);
		foreach ($list as $row) {
			$this->assertEquals($expected[$row->StudentUSI]['FirstName'], $row->FirstName);
		}
	}

	public function test_student_sex_type() 
 {
		$student = Model\Edfi\Student::find(604901);
		$this->assertEquals('Female', $student->SexType()->CodeValue);
	}

	public function test_student_address() 
 {
		$student = Model\Edfi\Student::find(555555);
		$this->assertEquals('123 Simons Way', $student->Address()[0]->StreetNumberName);
	}

	/*public function test_student_grade() {
		$student = Model\Edfi\Student::find(605537);
		$this->assertEquals('10th Grade', $student->School()->GradeLevelDescriptor()->GradeLevelType()->Description);
	}*/
}
