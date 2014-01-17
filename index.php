<?php
/*Don Chap App
 * Auther: Vlorun
 * Url: www.donchop.com
 * Version: 0.1
 * 
 */
 
 
// Global time settings
date_default_timezone_set ('Europe/London');

// includes and configuration settings, definition and Global Vars
include_once('constants.php');
include_once('database/class.MysqlConnection.php');

// create global database connection
//$g_oDb = new MysqlConnection($g_sDBUser,$g_sDBPassword,$g_sDBName);


function redirect($p_sUrl) {
	global $g_sSitePath;
	header('Location: '.$g_sSitePath.$p_sUrl);
	exit();
}

// redirect to first controller
require_once('First.controller.php');
?>