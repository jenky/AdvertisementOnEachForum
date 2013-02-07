<?php

class Milano_Advertisement_Install
{
	public static function addColumn($table, $field, $attr)
	{
		if (!self::checkIfFieldExist($table, $field)) 
		{
			$db = XenForo_Application::get('db');
			return $db->query("ALTER TABLE `" . $table . "` ADD `" . $field . "` " . $attr);
		}
	}

	public static function checkIfFieldExist($table, $field)
	{
		$db = XenForo_Application::get('db');
		if ($db->fetchRow('SHOW COLUMNS FROM `' . $table . '` WHERE Field = ?', $field)) 
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
	
	public static function checkIfTableExist($table)
	{
		$db = XenForo_Application::get('db');
		if ($db->fetchRow('SHOW TABLES LIKE \'' . $table . '\'')) 
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
	
	public static function install()
	{
		$db = XenForo_Application::get('db');
		
		if (!self::checkIfFieldExist('xf_node', 'advertisement')) 
		{
			$db->query('
				ALTER TABLE  `xf_node` DROP  `advertisement`
			');
		}
		if (!self::checkIfFieldExist('xf_forum', 'advertisement')) 
		{
			self::addColumn('xf_forum', 'advertisement', "  MEDIUMTEXT  ");
		}
	}
	
	public static function uninstall()
	{
		$db = XenForo_Application::get('db');
		$db->query("
			ALTER TABLE  `xf_forum` DROP  `advertisement`
		");
	}	
}