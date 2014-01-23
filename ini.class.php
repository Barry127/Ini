<?php

/**
 * ini class
 *
 * A class to read and edit ini files
 * The class doesn't automatically save the file
 * 
 * @author 		Barry de Kleijn (kleijn.barry@gmail.com)
 * @copyright	MIT Licence
 * 
 * @version 	1.3.0
 */

class ini {

	const   VERSION 	= '1.3.0';

	private $iniFile;				//ini file
	private $settings	= array();	//settings from ini file

	/**
	 * Class constructor
	 *
	 * @access 	public
	 * @version 1.3.0
	 * @since   1.0.0
	 * 
	 * @param 	string 	$file 	Ini file to open or create
	 *
	 * @return 	bool 			Successful
	 */
	public function __construct($file = null) {
		if(strlen($file) < 1 || $file == null) {
			$file = uniqid(true) . '.ini';
		}
		if(strtolower(substr($file,-4)) != '.ini') {
			$file .= '.ini';
		}

		if(!file_exists($file)) {
			if($fp = fopen($file,'w+')) {
				fclose($fp);
			} else {
				echo '<strong>Warning</strong> Could not create ' . $file;
				return false;
			}
		}

		$this->iniFile = $file;
		$this->settings = parse_ini_file($this->iniFile,true);
		return true;
	}

	/**
	 * Destruct class
	 * 
	 * @access 	public
	 * @version 1.3.0
	 * @since 	1.0.0
	 *
	 * @return 	null
	 */
	public function __destruct() {

	}

	/**
	 * Delete a group of settings
	 * 
	 * @access 	public
	 * @version 1.3.0
	 * @since 	1.0.0
	 *
	 * @param 	string 	$group 	Name of group to delete
	 * 
	 * @return 	bool 			Successful
	 */
	public function deleteGroup($group = null) {
		if(isset($this->settings[$group])) {
			unset($this->settings[$group]);
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Delete a settings
	 * 
	 * @access 	public
	 * @version 1.3.0
	 * @since 	1.0.0
	 *
	 * @param 	string 	$setting 	Name of setting to delete
	 * @param 	string 	$group 		If in a group, name of group
	 * 
	 * @return 	bool 			Successful
	 */
	public function deleteSetting($setting = null, $group = null) {
		if($group == null && isset($this->settings[$setting])) {
			unset($this->settings[$setting]);
			return true;
		}
		if(isset($this->settings[$group][$setting])) {
			unset($this->settings[$group][$setting]);
			return true;
		}
		return false;
	}

	/**
	 * Get array with all groups and settings
	 *
	 * @access 	public
	 * @version 1.3.0
	 * @since 	1.0.0
	 *
	 * @return 	array 		All settings
	 */
	public function getAllSettings() {
		return $this->settings;
	}

	/**
	 * Get filename of current ini file
	 *
	 * @access 	public
	 * @version 1.3.0
	 * @since 	1.0.0
	 *
	 * @return 	string 		Ini filename
	 */
	public function getFileName() {
		return $this->iniFile;
	}

	/**
	 * Get array with all settings from a given group
	 *
	 * @access 	public
	 * @version 1.3.0
	 * @since 	1.0.0
	 * 
	 * @param 	string 	$group 	Group name
	 * 
	 * @return 	array 			All settings from $group
	 */
	public function getGroup($group = null) {
		if(isset($this->settings[$group])) {
			return $this->settings[$group];
		}
		return false;
	}

	/**
	 * Get a specific setting
	 * 
	 * @access 	public
	 * @version 1.3.0
	 * @since 	1.0.0
	 *
	 * @param 	string 	$setting 	Name of setting
	 * @param 	string 	$group 		If in a group, name of group
	 * 
	 * @return 	string 				Requested setting
	 */
	public function getSetting($setting = null, $group = null) {
		if($group == null && isset($this->settings[$setting])) {
			return $this->settings[$setting];
		}
		if(isset($this->settings[$group][$setting])) {
			return $this->settings[$group][$setting];
		}
		return false;
	}

	/**
	 * Save settings to the ini file
	 *
	 * @access 	public
	 * @version 1.3.0
	 * @since 	1.0.0
	 *
	 * @return 	bool 		Successful
	 */
	public function saveIniFile() {
		if($fp = fopen($this->iniFile,'w')) {
			foreach($this->settings as $name => $setting) {
				if(!is_array($setting)) {
					fwrite($fp,$name . ' = "' . $setting . "\"\r\n");
				}
			}
			fwrite($fp,"\r\n\r\n");
			foreach($this->settings as $groupName => $group) {
				if(is_array($group)) {
					fwrite($fp,'[' . $groupName . ']' . "\r\n\r\n");
					foreach($group as $name => $setting) {
						fwrite($fp,$name . ' = "' . $setting . "\"\r\n");
					}
					fwrite($fp,"\r\n\r\n");
				}
			}
			return true;
		}
		return false;
	}

	/**
	 * Set a setting or create the setting (and group) if it doesn't exist
	 * 
	 * @access 	public
	 * @version 1.3.0
	 * @since 	1.0.0
	 *
	 * @param 	string 	$setting 	Setting name
	 * @param 	string 	$value 		Value of setting
	 * @param 	string 	$group 		Group name for setting. Empty = no group
	 * 
	 * @return 	bool 				Successful
	 */
	public function setSetting($setting, $value, $group = null) {
		if($group == null) {
			$this->settings[$setting] = $value;
		} else {
			$this->settings[$group][$setting] = $value;
		}
		return true;
	}

	/**
     * get current class version
     *
     * @access  public
     * @version 1.3.0
     * @since   1.3.0
     *
     * @return  string  Current version of this class
     */
    public function getVersion() {
        return self::VERSION;
    }
}

?>