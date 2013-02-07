<?php
class Milano_Advertisement_DataWriter_Forum extends XFCP_Milano_Advertisement_DataWriter_Forum
{
	protected function _getFields() 
	{
		$fields = parent::_getFields();
		
		$fields['xf_forum']['advertisement'] = array(
			'type' => self::TYPE_STRING
		);
		
		return $fields;
	}
	
	protected function _preSave()
	{
		if (isset($GLOBALS['Milano_Advertisement_ControllerAdmin_Forum'])) 
		{
			$GLOBALS['Milano_Advertisement_ControllerAdmin_Forum']->Advertisement_actionSave($this);
		}
		
		return parent::_preSave();
	}
}