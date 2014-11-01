<?php
include("config/global.php");





$m_uAgent   = strtolower($_SERVER['HTTP_USER_AGENT']);
$isMSIE		= strstr($m_uAgent, "msie") !== false;
$isMSIE8    = strstr($m_uAgent,"msie 8") !== false;
$isMSIE7    = strstr($m_uAgent,"msie 7") !== false;
$isMSIE6    = strstr($m_uAgent,"msie 6") !== false;
$isMSIE6    = strstr($m_uAgent,"msie") !== false;
$isFirefox  = strstr($m_uAgent,"firefox") !== false;
$isSafari  = strstr($m_uAgent,"safari") !== false;

$m_mac		= strstr($m_uAgent,"mac")!==false;
$m_windows	= strstr($m_uAgent,"windows")!==false;

?>