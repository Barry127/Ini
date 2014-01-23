ini
===

A PHP class to handle .ini files

How to use
---------

Include the class file to your PHP file and create a class instance to get and/or set data to an ini file.

Make sure your the destination directory or your ini file is CHMOD properly.

FUNCTIONS
---------

**construct($name)**

Construct class and check independencies

param $name (_string_) Relative path for (new) ini file, empty = random name. (default: _null_)

return (_bool_) Successful


**destruct()**

Desctruct class and clean up.

return (_null_)


**deleteGroup($group)**

Delete a group of settings

param $group (_string_) Name of the group to delete (default: _null_)

return (_bool_) Successful


**deleteSetting($setting, $group)**

Delete a setting

param $setting (_string_) Name of the setting to delete (default: _null_)

param $group (_string_) if setting is in a group, name of the group (default: _null_)

return (_bool_) Successful


**getAllSettings()**

Get array with all settings from ini file

return (_array_) All settings


**getFileName()**

Get name and path of ini file

return (_string_) Ini file name


**getGroup($group)**

Gat array with all settings of a group

param $group (_string_) Name of the group (default: _null_)

return (_array_) All settings from $group


**getSetting($setting, $group)**

Get a setting

param $setting (_string_) Name of the setting (default: _null_)

param $group (_string_) if setting is in a group, name of the group (default: _null_)

return (_string_) Requested setting


**saveIniFile()**

Save settings to ini file

return (_bool_) Successful


**setSetting($setting, $value, $group)**

Set a setting or create setting (and group) if it doesn't exist

param $setting (_string_) Name for the setting

param $value (_string_) Setting value

param $group (_string_) Name of group, empty = no group (default: _null_)

return (_bool_) Successful


**getVersion()**

Get current class version

return (_string_) Current class version
