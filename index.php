<meta charset="UTF-8">
<?php
require_once("include/PdoMiniChat.php");
require_once ("include/fct.php");
include ("controleurs/connectes.php");
//include("js/heure.js");

session_start();
$pdo = PdoMiniChat::getMiniChat();
$estConnecte = estConnecte();


if(!isset($_REQUEST['uc']) || !$estConnecte){
    $_REQUEST['uc'] = 'mini_chat';
}
$uc = $_REQUEST['uc'];
switch($uc){
case 'mini_chat':{
        include("controleurs/c_chat.php");break;
      
    }
}
?>