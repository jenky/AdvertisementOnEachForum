<?php
class Milano_Advertisement_Listener
{
	public static function templateCreate($templateName, array &$params, XenForo_Template_Abstract $template) 
	{
		$template->preloadTemplate('advertisement');
		$template->preloadTemplate('admin_advertisement');
	}
	
	public static function templateHook($hookName, &$contents, array $hookParams, XenForo_Template_Abstract $template) 
    { 	
		switch ($hookName)
        {
            case 'forum_edit_basic_information':
                $ourTemplate = $template->create('admin_advertisement', $template->getParams());
                $contents .= $ourTemplate->render();
                break;
                
            case 'ad_forum_view_above_thread_list':
                $ourTemplate = $template->create('advertisement', $template->getParams());
                $contents .= $ourTemplate->render();
                break;
        }
	}

	public static function loadClassListener($class, &$extend)
	{
		$classes = array(
			'DataWriter_Forum',

			'ControllerAdmin_Forum',
			'ControllerPublic_Forum',

			'ViewAdmin_Forum_Edit',
			'ViewPublic_Forum_View'
		);

		foreach($classes AS $_class)
		{
			if ($class == 'XenForo_' . $_class)
			{
				$extend[] = 'Milano_Advertisement_' . $_class;
			}
		}
	}
}