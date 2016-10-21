<?php
	defined('_JEXEC') or die;
	
	$session = JFactory::getSession();
	$session->set('send_params', $params);
	
	$message_items['name'] = JText::_('MOD_REQUESTCALL_MESSAGEITEM_PHONE');
	$message_items['phone'] = JText::_('MOD_REQUESTCALL_MESSAGEITEM_PHONE');
	$message_items['email'] = JText::_('MOD_REQUESTCALL_MESSAGEITEM_PHONE');
	$message_items['message'] = JText::_('MOD_REQUESTCALL_MESSAGEITEM_PHONE');
	$message_items['file'] = JText::_('MOD_REQUESTCALL_MESSAGEITEM_PHONE');
	if ($params->get('show_send_time'))
		$message_items['send_time'] = JText::_('MOD_REQUESTCALL_MESSAGEITEM_DATETIME');
	
	$session->set('message_items', $message_items);
	require JModuleHelper::getLayoutPath('mod_requestcall', $params->get('layout', 'default'));
?>

