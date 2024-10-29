<?php


$pdo = PdoMiniChat::getMiniChat();
$co =  $pdo->NbConnecter();

if(!isset($_REQUEST['action'])){
    $_REQUEST['action'] = 'verify';
}


$action = $_REQUEST['action'];

if(isset($_GET['page']) && !empty($_GET['page'])){
    $currentPage = (int) strip_tags($_GET['page']);
}else{
    $currentPage = 1;
}

$reponse = $pdo->afficheMsg();
$result = $pdo->NbMessage2();
$nbM = (int)$result['NbMessage'];
$PP = 10;
$pages = ceil($nbM/$PP);
$premier = ($currentPage * $PP) - $PP;
$selectMsg = $pdo->ParPage($premier,$PP);

switch($action){
    
    case'verify':{ 
     include("vues/v_verify.php");
     break;
    }
    
    case'connexion':{
        $pseudo = $_REQUEST['pseudo'];
        $mdp = $_REQUEST['mdp'];
        $user = $pdo->getInfoUser($pseudo,$mdp);
        if(!is_array($user) || empty($pseudo) || empty($mdp) ){
            ajouterErreur("Login ou mdp incorrect");
            include("vues/v_erreur.php");
            include("vues/v_inscription.php");
            break;
        }
        else {
            ob_start();
            connecter($mdp, $pseudo);
            $reponse = $pdo->afficheMsg();
            include ("vues/v_chat.php");
            //$action = "affiche";
            header('Refresh: 0;URL=index.php?uc=mini_chat&action=affiche');
            ob_enf_flush();
            break;
        }
        
    }
    case'affiche':{
        include("vues/v_chat.php");
        break;
    }
    case'demandeCo':{
        include("vues/v_connexion.php");
        break;
        
    }
    case'inscription':{
       include("vues/v_inscription.php"); 
        break;
    }
    
    case 'insertU':{
        
        if (isset($_POST['pseudo']) AND isset($_POST['mdp']) AND  isset($_POST['email']))
        {
            if ($_POST['pseudo'] != NULL AND $_POST['mdp'] != NULL AND $_POST['email'] != NULL)
            {
        $pseu = htmlentities($_POST['pseudo']);
        $mdp = htmlentities($_POST['mdp']);
        $mail = htmlentities($_POST['email']);
        
        $us = $pdo->SelectUser($pseu);
        
        if ($us == true ){
        $pdo->insertUser($pseu,$mdp,$mail);
        include("vues/v_connexion.php");
        }
        else {
           /* ajouterErreur("Login déja pris");
            include("vues/v_erreur.php");*/
            echo("User déja dans la BDD");
            include("vues/v_inscription.php");
           
            
        }
            }
        }
      break;
    }
    
    
    
    case'insertD':{
       
        if (isset($_POST['pseudo']) AND isset($_POST['message'])) 
        {
            if ($_POST['pseudo'] != NULL AND $_POST['message'] != NULL)
            {
                
                $msg =  htmlentities($_POST['message']);
                $psd = htmlentities($_POST['pseudo']);
                
                setlocale(LC_TIME, "fr_FR");
                date_default_timezone_set('Europe/Paris');
                $date = strftime('%Y-%m-%d %H:%M:%S');
                $allmsg = $pdo->getMessage($msg);
                $pdo->NbMessage();
                if($allmsg == true){
                    $pdo->insertChat($msg,$psd,$date,$adr);
                }
                else{
                    echo("message déja dans la BDD");
                }
            }
            
       
    }
    $reponse = $pdo->afficheMsg();
    $selectMsg = $pdo->ParPage($premier,$PP);
     include("vues/v_chat.php");
      break;
    }
    
    
    case'pdf':{
        $adr = $_SERVER['REMOTE_ADDR'];
        $pseu2 =  $_SESSION['PSEUDO'];
        $mdp2 =  $_SESSION['MDP'];
        $ipAll = $pdo->getInfoAllUser();
        //$pdo->getInfoAllUser()
        include('vues/pdf.php');
        
        break;
    }
    
    case'pagination':{
        include("vues/v_chat2.php");
        break;
    }
    
    case'deconnexion':{
            session_destroy();
            include("vues/v_connexion.php");
            break;
        }
    
    
    
}

?>

