<?php

/******************************** 
   DATABASE & FUNCTIONS 
********************************/
require('config/config.php');
require('config/session_admin.php');

if(user_is_admin()){
/******************************** 
      VIEW 
********************************/
include 'view/_header.html';
include 'view/_menu.php';
include 'view/uploads_gestion.html';

}
else
{
  echo 'Accès interdit, vous n\'êtes pas administrateur !';
}