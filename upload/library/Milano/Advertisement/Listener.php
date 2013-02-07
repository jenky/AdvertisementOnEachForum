<?php
class Milano_Advertisement_Listener
{
	public static function loadClassListener($class, &$extend)
	{
		$classes = array(
			'DataWriter_Forum',
			'ControllerAdmin_Forum',
			'ControllerPublic_Forum',
		);

		foreach($classes AS $_class)
		{
			if ($class == 'XenForo_' .$_class)
			{
				$extend[] = 'Milano_Advertisement_' .$_class;
			}
		}
	}
	
	public static function templateCreate($templateName, array &$params, XenForo_Template_Abstract $template) 
	{
		$template->preloadTemplate('advertisement');
		$template->preloadTemplate('admin_advertisement');
	}
	
	public static function templateHook($hookName, &$contents, array $hookParams, XenForo_Template_Abstract $template) 
    {
    	$user = XenForo_Visitor::getInstance();
		$canEditAdvertisement = XenForo_Permission::hasPermission($user['permissions'], 'forum', 'editAdvertisement');
    	
		switch ($hookName)
        {
            case 'forum_edit_basic_information':
                $ourTemplate = $template->create('admin_advertisement', $template->getParams());
                $contents .= $ourTemplate->render();
                break;
                
            case 'ad_forum_view_above_thread_list':
            	$params = $template->getParams();
                $params['canEditAdvertisement'] = $canEditAdvertisement;
                $params += $hookParams;
                $ourTemplate = $template->create('advertisement', $params);
                $contents .= $ourTemplate->render();
                break;
        }
	}
}