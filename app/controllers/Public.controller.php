<?php

$t_aAllowedRequest = array('login','index', 'faq', 'about', 'contact');


if (hasRequestVar('b'))
	$t_sPageRequest = getRequestVar('b');
else
	$t_sPageRequest = 'index';

if (in_array($t_sPageRequest, $t_aAllowedRequest))
{
	//echo 'is an allowed request';
	// switch to appropriate view
	
	$g_aViewVar['AdminMenu'] = '';

	switch ($t_sPageRequest)
	{
		case 'index':
		
            $g_aViewVar['WelcomMessage'] = 'Please do a car search below';
             
			require_once('PublicIndex.view.php');
			
			break;
		case 'about':
		
            $g_aViewVar['WelcomMessage'] = 'Welcome to the about us page!';
             
			require_once('PublicAbout.view.php');
			
			break;
		case 'faq':
		
            $g_aViewVar['WelcomMessage'] = 'Welcome to the faq page!';
             
			require_once('PublicFaq.view.php');
			
			break;
		case 'contact':
		
            $g_aViewVar['WelcomMessage'] = 'Welcome to the contact page!';
             
			require_once('PublicContact.view.php');
			
			break;
		case 'login':
		
            $g_aViewVar['WelcomMessage'] = 'Please login';

            $t_oUser = null;

            if (empty($t_oUser))
            {
            	//
            }
            else
            {
            	$g_aViewVar['AdminMenu'] = '<li><a href="#" title="">Admin</a></li>';
            }
            	
             
			require_once('PublicLogin.view.php');
			
			break;
	
	}
}
else
{
	die('is an dis-allowed request');	
}	


?>