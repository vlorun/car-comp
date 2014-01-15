<?php

$g_aRequestVars = $_REQUEST;

if (!isset($g_aRequestVars['a']))
	$g_aRequestVars['a'] = 'public';

function getRequestVar($p_sVar)
{
	global $g_aRequestVars;
	
	if (isset($g_aRequestVars[$p_sVar]))
		return $g_aRequestVars[$p_sVar];
	else
		return '';
	
}

function hasRequestVar($p_sVar)
{
	global $g_aRequestVars;
	
	if (array_key_exists($p_sVar, $g_aRequestVars))
		return true;
	else
		return false;
	
}
switch($g_aRequestVars['a'])
{
	case 'public':
		require_once('Public.controller.php');
		break;
		
	case 'internal':
		require_once('Internal.controller.php');
		break;
	
	case 'Ajax':
		require_once('Ajax.controller.php');
		break;
	
	default:
		redirect('badRequest.php');
	
	
}




?>