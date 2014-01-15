<?php
/*
 * The view class for public contact page
 */
 require_once('viewXhtml.php');
  require_once('tcpdf/tcpdf.php');
 
 
$t_oView = new viewXhtml('PublicContact.phtml');


$t_sPageTest = '<p>test content</p>';
$t_oView->setVar('PageTest', $t_sPageTest);


$t_oView->render();
 
?>