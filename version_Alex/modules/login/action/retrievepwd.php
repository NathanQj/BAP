<?php
ob_start();
chdir("../../../");

include 'config/config.php';
include("modules/mysql/action/mysqlcon.php");


$query = "SELECT s_email, s_pwd FROM _frontuser WHERE s_email='".addslashes($_POST['email'])."'";
$res 	= mysql_query($query);
$row	= mysql_fetch_assoc($res);


$html = '<table align="center" width="600"><tr><td style="width:100px;height:104px">
<img src="http://root.imaload.com/ww2/logo.png"></td>
<td style="width:500px;background:#333;color:white;padding:30px;font-size:16px">
VOS INFORMATIONS D\'ACCES
</td></tr>';
$html.= '<tr><td colspan="2"><br/><br/>
Voici vos codes d\'accèss à www.custorial.com:<br/><br/>
<b>
Identifiant :</b> '.$row['s_email'].'<br/>
<b>Mot de passe :</b> '.$row['s_pwd'].'

 
';
$html.= '</table>';

include_once("api.util_mail.php");
        
if(strlen($row['s_email'])!=0)
	fastMail("Vos informations d'accès à www.custorial.com", $html,"no-reply@custorial.com",$_POST['email'],false,false);
else {
	fastMail("custo pas inscrit", $html,"no-reply@custorial.com", "xxxx@xxxx.com",false,false);
}		
?>