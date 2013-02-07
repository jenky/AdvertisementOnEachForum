<?php
class Milano_Advertisement_ControllerPublic_Forum extends XFCP_Milano_Advertisement_ControllerPublic_Forum
{
	public function actionEditAdvertisement()
	{
		$forumId = $this->_input->filterSingle('node_id', XenForo_Input::UINT);
		$forum = $this->_getForumModel()->getForumById($forumId);
		$ftpHelper = $this->getHelper('ForumThreadPost');
		
		$advertisement = $this->_input->filterSingle('advertisement', XenForo_Input::STRING);
		/*
		* To do: maybe support Tiny MCE
		$advertisement = $this->getHelper('Editor')->getMessageText('message', $this->_input);
		$advertisement = XenForo_Helper_String::autoLinkBbCode($advertisement);
		*/
		
		if (!$forumId)
		{
			throw $this->responseException($this->responseError(new XenForo_Phrase('requested_forum_not_found'), 404));
		}
		
		if ($this->_request->isPost())
		{
			if (!$advertisement)
			{
				return $this->responseError(new XenForo_Phrase('please_complete_required_fields'));
			}
			
			$dw = XenForo_DataWriter::create('XenForo_DataWriter_Node');
			$dw->setExistingData($forumId);
			$dw->set('advertisement', $advertisement);
			$dw->save();
			
			return $this->responseRedirect(
				XenForo_ControllerResponse_Redirect::SUCCESS,
				$this->getDynamicRedirect()
			);
			
		} else {
			
			$viewParams = array(
				'forum' => $forum,
				'nodeBreadCrumbs' => $ftpHelper->getNodeBreadCrumbs($forum),
			);
					
			return $this->responseView('Milano_Advertisement_ViewPublic_Edit', 'advertisement_edit', $viewParams); 
		}
	}
	
	protected function _getForumModel()
	{
		return $this->getModelFromCache('XenForo_Model_Forum');
	}
}
