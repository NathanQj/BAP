<?php

$action = isset($_POST['action']) ? $_POST['action'] : false;
if(!$action && !isset($_GET['showpictures']))
	die("error");

chdir("../../../");
include_once("config/config.php");


if($action == "update")
{
	
}
else if($action == "insert")
{
	
}
else if($action == "like")
{
	include_once("modules/media/class/Video.class.php");
	$video = new Video();
	$video->setId( $_POST[ 'container_id' ] );
	echo json_encode( (int) $video->like() );
}
else if($action == "unlike")
{
	include_once("modules/media/class/Video.class.php");
	$video = new Video();
	$video->setId( $_POST[ 'container_id' ] );
	echo json_encode( (int) $video->unlike() );
}
else if($action== "select")
{

}
else if($action=="removeuser")
{
	
}
elseif( $action == "updatepermission")
{
	
}
elseif($action =="createnewgroup")
{
	
}
else if(isset($_GET['showpictures']))
{
	
}
?>