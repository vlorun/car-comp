<?php
/*
 * The Main view
 *	class
 */
 
 abstract class  view 
 {
 	// define properties
 	protected $m_sContent;
    protected $m_aViewVars;
	
	
	public function render()
	{
		print $this->m_sContent;	
	}
	
    public function setVar($p_sVar, $p_sContent)
    {
        if (str_replace("[[$p_sVar]]", $p_sContent, $this->m_sContent))
        {
            $this->m_sContent = str_replace("[[$p_sVar]]", $p_sContent, $this->m_sContent);
        }
        else
        {
          echo 'not found in here '. $p_sVar;
           
        }
    }
 }
 
 ?>
