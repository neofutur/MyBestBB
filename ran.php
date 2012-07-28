<?php
/***********************************************************************

  Caleb Champlin (med_mediator@hotmail.com)

************************************************************************/
session_start();
require_once('ran.class.php');
$im=new ran;

//Get the text and create the image
$_SESSION['text']=$im->createImage();
?>
