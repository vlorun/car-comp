<?php
/*
 * The view class for public login page
 */
 require_once('viewXhtml.php');
 
 
$t_oView = new viewXhtml('PublicLogin.phtml');


$t_sPageTest = '<p>test content</p>';
$t_oView->setVar('PageTest', $t_sPageTest);


$t_oView->render();
 
?>