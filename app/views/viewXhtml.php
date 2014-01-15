<?php
require_once 'view.php';
class  viewXhtml extends view
{
	
	public function __construct ($p_sTemplate = '')
	{
	    global $g_aViewVar, $g_sSitePath;
	    
        $this->m_aViewVars = $g_aViewVar;
	    $t_sPath = './app/templates/';
		if (file_exists($t_sPath.$p_sTemplate))
		{
			$this->m_sContent = file_get_contents($t_sPath.$p_sTemplate);
		}
		else 
			throw new Exception("template could not be located $p_sTemplate", 1);
        
    preg_match_all('/\[\[([a-z0-9:=_.]+)\]\]/i', $this->m_sContent,$t_hReplaceArgs,PREG_OFFSET_CAPTURE);

    // add the template include files
    foreach ($t_hReplaceArgs[0] as  $t_aMatches)
    {
      $t_sMatch = str_replace(array('[[',']]'), '',$t_aMatches[0]);

      if (preg_match('/[a-z]+[.]([a-z0-9_-]+)/i', $t_sMatch, $t_aIncludes))
      {
          $Include = $t_sPath.$t_aIncludes[1].'.phtml';

        if (file_exists($Include))
        {
          $replace = file_get_contents($Include);

          $this->m_sContent = preg_replace("/\[\[\b$t_aIncludes[0]\b\]\]/i", $replace, $this->m_sContent);
        }
      }

    }

    // create header file if present
    if (preg_match('/\[\[Head:(.+)\]\]/i', $this->m_sContent, $matches1))
    {
      $t_aHeadAttributes = explode(';', $matches1[1]);

      $t_sHeader = '<!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="utf-8">

        <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
        Remove this if you use the .htaccess -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">';
      foreach($t_aHeadAttributes as $attrubute)
      {

        if (preg_match('/title=(.+)/i', $attrubute, $matches2))
        {
          $t_sHeader .='<title>'. $matches2[1] .'</title>';

        }

        if (preg_match('/Description=(.+)/i', $attrubute, $matches2))
        {
          $t_sHeader .='<meta name="description" content="'. $matches2[1] .'" />';

        }

        if (preg_match('/Keywords=(.+)/i', $attrubute, $matches2))
        {
          $t_sHeader .='<meta name="keywords" content="'. $matches2[1] .'" />';

        }

      }

      // replace content for header
      $t_sMatch = str_replace(array('[[',']]'), '',$matches1[0]);
      $this->m_sContent = preg_replace("/\[\[\b$t_sMatch\b\]\]/i", $t_sHeader, $this->m_sContent);

      // close header if end tag found
      if (preg_match('/\[\[EndHead\]\]/i', $this->m_sContent, $matches1))
      {
        
        $this->m_sContent = preg_replace('/\[\[EndHead\]\]/i', '</head>', $this->m_sContent);

      }
      else
        throw new Exception("Missing closing header tag");
        
    }
    
    /*** add css/ scripts ***/
    $ver = '?version=0.0.0.1';
    if (preg_match('/\[\[css=(.+)\]\]/i', $this->m_sContent, $matches1))
    {
      $t_aFile_list = explode(',', $matches1[1]);
      $cssPath = $g_sSitePath.'style/';
      $cssList = '';
      foreach($t_aFile_list as $file)
      {
        $cssList .= '<link rel="stylesheet" type="text/css" href="'. $cssPath . $file .'.css'. $ver .'" />';
      }
      $t_sMatch = str_replace(array('[[',']]'), '',$matches1[0]);
      $this->m_sContent = preg_replace("/\[\[\b$t_sMatch\b\]\]/i", $cssList, $this->m_sContent);

    }

    if (preg_match('/\[\[scripts=(.+)\]\]/i', $this->m_sContent, $matches1))
    {
      $t_aFile_list = explode(',', $matches1[1]);
      $scriptPath = $g_sSitePath.'script/';
      $scriptList = '';
      foreach($t_aFile_list as $file)
      {
        $scriptList .= '<script src="'. $scriptPath . $file .'.js'. $ver .'"></script>';
      }
      $t_sMatch = str_replace(array('[[',']]'), '',$matches1[0]);
      $this->m_sContent = preg_replace("/\[\[\b$t_sMatch\b\]\]/i", $scriptList, $this->m_sContent);

    }
    
        
    preg_match_all('/\[\[([a-z0-9:=_.]+)\]\]/i', $this->m_sContent,$t_hReplaceArgs,PREG_OFFSET_CAPTURE);
    
    foreach ($t_hReplaceArgs[0] as  $t_aMatches)
    {
       
      // echo $t_aMatches[1]. ' '. $t_aMatches[0] .'<br />';
       
       // replace string with variable content
       $t_sMatch = str_replace(array('[[',']]'), '',$t_aMatches[0]);
       //echo $t_sMatch .'<br />';
       switch($t_sMatch)
       {
           case 'Introduction':
               $t_sReplacementString = 'what a lovely start! screw smarty';

               $this->m_sContent = preg_replace("/\[\[\b$t_sMatch\b\]\]/i", $t_sReplacementString, $this->m_sContent);
               break;
          case 'SitePath':
               $t_sReplacementString = $g_sSitePath;

               $this->m_sContent = preg_replace("/\[\[\b$t_sMatch\b\]\]/i", $t_sReplacementString, $this->m_sContent);
               break;
           
       }
        
        // replace the varables within the document
       $t_aVarMatches = explode('=', $t_sMatch);
       
      if ($t_aVarMatches[0] == 'Var')
      {
        $t_sVar = $t_aVarMatches[1];
        

        
        $this->m_sContent = preg_replace("/\[\[\bVar=$t_sVar\b\]\]/i", $this->m_aViewVars[$t_sVar], $this->m_sContent);
      }
        
        
   }

	}
	

}

?>