<?php 

namespace Codeception\Module;

class CodeIgniter extends \Codeception\Module
{
	function amLoggedIn() {

		PhpBrowser::haveHttpHeader('X-Test-User', '207220');

		/*session_start();
		$data=[
		    'LoginId'	=>	'1',
		    'StaffUSI'  =>  '207220',
		    'RoleId'  	=> 	1,
		    'logged_in' => TRUE,
		    'SchoolId' => '255901044',
		    'SchoolName' => 'My School'
		];
		
		foreach ($data as $key => &$value) {
			$_SESSION[$key] = $value;
		}

		session_id($session_id);

		$session_data = serialize($data);
		$save_path = rtrim(ini_get('session.save_path'), '/\\');
		$name = 'ci_session';

		$this->_config['save_path'] = $save_path;
		$this->_file_path = $this->_config['save_path'].DIRECTORY_SEPARATOR.$name ;
		
		$this->_file_new = ! file_exists($this->_file_path.$session_id);
		if ( $this->_file_new)
		{
			$this->_file_handle = fopen($this->_file_path.$session_id, 'w+b');
			ftruncate($this->_file_handle, 0);
			rewind($this->_file_handle);
		}
		else {
			$this->_file_handle = fopen($this->_file_path.$session_id, 'r+b');
		}

		if (($length = strlen($session_data)) > 0)
		{
			for ($written = 0; $written < $length; $written += $result)
			{
				if (($result = fwrite($this->_file_handle, substr($session_data, $written))) === FALSE)
				{
					break;
				}
			}

			if ( ! is_int($result))
			{
				$this->_fingerprint = md5(substr($session_data, 0, $written));
				log_message('error', 'Session: Unable to write data.');
				return FALSE;
			}
		}*/
	}
}