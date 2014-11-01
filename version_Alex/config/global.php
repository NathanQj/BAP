<?php
include("../configclient.php");
include("modules/localize/class/localize.php");


define("__DEBUG_MODE", true);
define("__CUSTOMER_NAME", "custorial");
define("__MYSQL_ENCRYPT", false);
define("__MYSQL_ENCRYPT_KEY","xxxxxxx");

define('__PLAYLIST_MATH', 44); // playlist math
define('__PLAYLIST_FRANCAIS', 45); // playlist francais et langues
define('__PLAYLIST_CHIMIE', 42); // playlist chimie / physique / svt / technos




/*
 * GESTION SESSION
 */
ini_set('session.gc_maxlifetime',  60 * 60 * 48); // 48h
//session_id("cloud-imaload-".str_replace("_","-",__CUSTOMER_NAME));
session_start();

/*----------------*/

$__app = explode("/",$_SERVER['PHP_SELF']);
array_pop($__app);
$__app = implode("/",$__app);
define("__BACKURL", "http://");
define("__oBACKURL", str_replace("app","back", __BACKURL));
define("__PERMALINK", "http://www.custorial.com");
define("__EMBED_PLAYER", str_replace("app","embed", __BACKURL));




define("__MEDIA_QTY_PER_PAGE",25);
define("__DEFAULT_LANGUAGE", "fr_FR"); 

define('__FRONT_PATH', dirname(dirname(__FILE__)));
define('AVATAR_DEFAULT', 'https://cdn4.iconfinder.com/data/icons/avatar-and-user/86/Avatar_person_user_character_man_woman_human-04-%s.png');
define('__FRONT_URL', 'http://www.custorial.com/');
define('__PATH_AVATAR', '/media/profiles/');
define('__PATH_AVATAR_TMP', __PATH_AVATAR.'tmp/');
/*
 * FACEBOOK APP ID
 * 
 */ 
define("__FACEBOOOK_APP_ID", '522065584565962');  // Custorial


error_reporting(E_ALL);





function configIsLoaded()
{
	return true;
}


?>