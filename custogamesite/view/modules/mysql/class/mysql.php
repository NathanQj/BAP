<?php
class mysqlConnection
{


	
	function mysqlConnection($server, $login, $password, $database)
	{
		
		$link = mysql_connect($server, $login, $password) or die("MySQL connection failed ...<br>". mysql_errno($link));
		mysql_select_db($database) or die(mysql_errno($link) . "<br>" . mysql_error($link));
	}
	
	
	function SetMysqlAutocommit($value)
	{
		$query = "SET AUTOCOMMIT=".$value;
		mysql_query($query);
	}
	function BeginTrans()
	{
		mysql_query("BEGIN");
	}

	function CommitTrans()
	{
		mysql_query("COMMIT");
	}
	
	function RollbackTrans()
	{
		mysql_query("ROLLBACK"); 
	}
	
}
?>