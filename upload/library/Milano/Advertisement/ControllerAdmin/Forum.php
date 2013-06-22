<?php
class Milano_Advertisement_ControllerAdmin_Forum extends XFCP_Milano_Advertisement_ControllerAdmin_Forum
{
	public function actionSave()
	{
		$GLOBALS['Milano_Advertisement_ControllerAdmin_Forum'] = $this;
		
		return parent::actionSave();
	}

	public function Advertisement_actionSave(Milano_Advertisement_DataWriter_Forum $dw)
	{
		$nodeId = $this->_input->filterSingle('node_id', XenForo_Input::UINT);
		
		$advertisement = $this->getHelper('Editor')->getMessageText('message', $this->_input);
		$advertisement = XenForo_Helper_String::autoLinkBbCode($advertisement);

		if ($nodeId)
		{
			$dw->setExistingData($nodeId);
		}

		$dw->set('advertisement', $advertisement);
	}
}