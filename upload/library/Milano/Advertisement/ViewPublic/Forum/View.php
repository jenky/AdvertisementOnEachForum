<?php

class Milano_Advertisement_ViewPublic_Forum_View extends XFCP_Milano_Advertisement_ViewPublic_Forum_View
{
	public function renderHtml()
	{
		parent::renderHtml();

		$bbCodeParser = new XenForo_BbCode_Parser(XenForo_BbCode_Formatter_Base::create('Base', array('view' => $this)));
		$this->_params['forum']['advertisement'] = new XenForo_BbCode_TextWrapper($this->_params['forum']['advertisement'], $bbCodeParser);
	}
}