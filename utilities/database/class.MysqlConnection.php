<?php
/* Mysql Database Connection Class
 * Creates a connection with the database
 * ver: 0.1
 */

class MysqlConnection
{
// define the properties	

protected $_m_SDBName;
protected $_m_SDBUser;
protected $_m_SDBPassword;
protected $_m_SDBHost;
protected $_m_aTable;
protected $_m_aField;




public function __construct($p_sUser='',$p_sPassword= '', $p_sDBName, $p_sDBHost = 'localhost')
{
	
	$t_sDsn = 'mysql:host='. $p_sDBHost .';dbname='.$p_sDBName;
	try 
	{
	    $t_oconnection = new PDO($t_sDsn, $p_sUser, $p_sPassword);
	   
	} 
	catch (PDOException $e) 
	{
	    print "Error!: " . $e->getMessage() . "<br/>";
	    return false;
	}
	
}
	
	
	
}





?>