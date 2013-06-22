<?php

class Milano_Advertisement_Install
{
	public static function dbColumn($table, $field, $action = 'drop', $attr = NULL, $after = NULL)
	{
		$exists = self::checkIfFieldExist($table, $field);
		$db = XenForo_Application::get('db');

		$action = strtolower($action);

		if ($action == 'drop') 
		{
			if ($exists)
			{
				return $db->query("ALTER TABLE `" . $table . "` DROP `" . $field);  
			}
		}
		elseif ($action == 'add')
		{
			if (!$exists)
			{
				$afterColumn = !empty($after) ? " AFTER " . $after : '';
				return $db->query("ALTER TABLE `" . $table . "` ADD `" . $field . "` " . $attr . $afterColumn);
			}            
		}
	}

	public static function checkIfFieldExist($table, $field)
	{
		$db = XenForo_Application::get('db');
		return $db->fetchRow('SHOW COLUMNS FROM `' . $table . '` WHERE Field = ?', $field);
	}
	
	public static function checkIfTableExist($table)
	{
		$db = XenForo_Application::get('db');
		return $db->fetchRow('SHOW TABLES LIKE \'' . $table . '\''); 
	}
	
	public static function install()
	{
		self::dbColumn('xf_forum', 'advertisement', 'add', "  MEDIUMTEXT  ");
	}
	
	public static function uninstall()
	{
		self::dbColumn('xf_forum', 'advertisement');
	}	
}