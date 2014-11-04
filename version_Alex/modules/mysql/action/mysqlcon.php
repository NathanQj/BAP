<?php
include("modules/mysql/class/mysql.php");
$mysql = new mysqlConnection('localhost', 'root', 'root', 'bap_custo');
$mysql->SetMysqlAutocommit(0);
?>
  
