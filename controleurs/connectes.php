<?php
require_once("include/PdoMiniChat.php");
require_once ("include/fct.php");

$pdo = PdoMiniChat::getMiniChat();

$date = date_create();
$date2 = date_timestamp_get($date);
$adr = $_SERVER['REMOTE_ADDR'];

$ip = $pdo->getIp($adr);

if($ip == true){
  $pdo->InsertIp($adr,$date2);  
}
else if ($ip == false){
    $pdo->UpdateIp($date2,$adr);
}

$pdo->deleteIp($date2);


?>