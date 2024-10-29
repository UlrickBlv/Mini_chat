<?php
function estConnecte(){
    return isset($_SESSION['PSEUDO']);
}

function connecter($mdp,$pseudo) {
    $_SESSION['MDP'] = $mdp;
    $_SESSION['PSEUDO'] = $pseudo;
}

function deconnecter(){
    session_destroy();
}

function ajouterErreur($msg){
    if (! isset($_REQUEST['erreurs'])){
        $_REQUEST['erreurs']=array();
    }
    $_REQUEST['erreurs'][]=$msg;
}

?>