<?php

class Milano_Advertisement_ViewAdmin_Forum_Edit extends XFCP_Milano_Advertisement_ViewAdmin_Forum_Edit
{
	public function renderHtml()
	{
		$advertisement = isset($this->_params['forum']['advertisement']) ? $this->_params['forum']['advertisement'] : '';
		
		$this->_params['editorTemplate'] = XenForo_ViewPublic_Helper_Editor::getEditorTemplate(
			$this, 'message', $advertisement
		);
	}
}