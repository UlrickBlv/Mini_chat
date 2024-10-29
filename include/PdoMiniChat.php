<?php

class PdoMiniChat{
    
    private static $serveur = 'mysql:host=localhost';
    private static $bdd = 'dbname=MINI_CHAT';
    private static $user = 'root';
    private static $mdp = 'root';
    private static $monPdo;
    private static $monPdoChat=null;
    
    
    
    private function __construct(){
        PdoMiniChat::$monPdo = new PDO(PdoMiniChat::$serveur.';'.PdoMiniChat::$bdd, PdoMiniChat::$user, PdoMiniChat::$mdp);
                PdoMiniChat::$monPdo->query("SET CHARACTER SET utf8");
    }
    
    public function __destruct(){
        PdoMiniChat::$monPdo = null;
    }
    
    public static function getMiniChat(){
        if(PdoMiniChat::$monPdoChat==null){
            PdoMiniChat::$monPdoChat = new PdoMiniChat();
            
        }
        return PdoMiniChat::$monPdoChat;
    }
    
   
    
 
    public function getInfoUser($pseudo,$mdp){
        $req = "select INSCRIPTION.PSEUDO as PSEUDO , INSCRIPTION.MDP as MDP from INSCRIPTION
                where INSCRIPTION.PSEUDO = '$pseudo' and INSCRIPTION.MDP = '$mdp'";
        $rs = PdoMiniChat::$monPdo->query($req);
        $ligne = $rs->fetch();
        return $ligne;
    }
    
    
    public function getInfoAllUser(){
        $req = "select DISTINCT `IP`,`PSEUDO_USER` from DISCUSSIONS";
        $rs = PdoMiniChat::$monPdo->query($req);
        $ligne = $rs->fetchAll();
        return $ligne;
    }
    
    
    public function insertChat($message,$pseudo,$date,$ip){
        $req = "INSERT INTO DISCUSSIONS VALUES(NULL,'$pseudo','$message','$date','$ip')";
        PdoMiniChat::$monPdo->exec($req);

    }
    
    public function insertUser($pseudo,$mdp,$address){
        $req = "INSERT INTO INSCRIPTION VALUES('$pseudo','$mdp','$address')";
        PdoMiniChat::$monPdo->exec($req);
        
    }
    
    public function SelectUser($user){
        $ok = false;
        $req = "SELECT count(PSEUDO) as PSEUDO FROM INSCRIPTION WHERE PSEUDO = '$user'";
        $rs = PdoMiniChat::$monPdo->query($req);
        $ges = $rs->fetch();
        if($ges['PSEUDO'] == 0) {
            $ok = true;
        }
        return $ok;
    }
    
    public function afficheMsg(){
        $req = "SELECT DISCUSSIONS.PSEUDO_USER as PSEUDO_USER ,DISCUSSIONS.MESSAGE as MESSAGE, DISCUSSIONS.DATE as DATE FROM DISCUSSIONS
                 ORDER BY ID_MESSAGE DESC LIMIT 0,10 ";
       $rs = PdoMiniChat::$monPdo->query($req);
       $mes = $rs->fetchAll();
       return $mes;
    }
    
    public function afficheMsg2(){
        $req = "SELECT DISCUSSIONS.PSEUDO_USER as PSEUDO_USER ,DISCUSSIONS.MESSAGE as MESSAGE, DISCUSSIONS.DATE as DATE FROM DISCUSSIONS
                 ORDER BY ID_MESSAGE DESC ";
        $rs = PdoMiniChat::$monPdo->query($req);
        $mes = $rs->fetchAll(PDO::FETCH_ASSOC);
        return $mes;
    }
    
    
    public function getMessage($message){
        $ok = false;
        $req = "SELECT count(MESSAGE) as MESSAGE FROM DISCUSSIONS WHERE MESSAGE = '$message'";
        $rs = PdoMiniChat::$monPdo->query($req);
        $ges = $rs->fetch();
        if($ges['MESSAGE'] == 0) {
            $ok = true;
        }
        return $ok;
        
    }
    
    public function NbMessage(){
        $req = "SELECT COUNT(MESSAGE) FROM DISCUSSIONS";
        $rs = PdoMiniChat::$monPdo->query($req);
        $msg = $rs->fetchColumn();
        if($msg>100){
            $req2 = "DELETE FROM DISCUSSIONS LIMIT 1";
            PdoMiniChat::$monPdo->exec($req2);
        }
    }
    
    public function NbMessage2(){
        $req = "SELECT COUNT(MESSAGE) as NbMessage FROM DISCUSSIONS";
        $rs = PdoMiniChat::$monPdo->query($req);
        $msg = $rs->fetch();
        return $msg;
        }
        
        
        public function ParPage($premier,$dernier){
           $req = "SELECT * FROM DISCUSSIONS ORDER BY ID_MESSAGE DESC LIMIT $premier,$dernier";
            //$req = "SELECT * FROM DISCUSSIONS ORDER BY ID_MESSAGE DESC LIMIT 1,5";
            //$rs = PdoMiniChat::$monPdo->query($req);
           $rs = PdoMiniChat::$monPdo->prepare($req);
           $rs->execute();
           $mes2 = $rs->fetchAll(PDO::FETCH_ASSOC);
            return $mes2;
        }
        
        
        public function IdConnecter($temps){
            $req = "DELETE FROM CONNECTES WHERE'($temps'-TIMESTAMP)>300";
            PdoMiniChat::$monPdo->exec($req);
        }
    
        public function getIP($ip){
            $ok = false;
            $req = "SELECT count(IP_VISITE) as IP FROM CONNECTES WHERE IP_VISITE ='$ip'";
            $rs = PdoMiniChat::$monPdo->query($req);
            $ges = $rs->fetch();
            if($ges['IP'] == 0) {
                $ok = true;
            }
            return $ok;    
        }
        
        public function InsertIp($adr,$time){
            $req = "INSERT INTO CONNECTES (IP_VISITE,TIME_CO) VALUES('$adr',$time)";
            PdoMiniChat::$monPdo->exec($req); 
        }
        public function UpdateIp($time,$adr){
            $req = "UPDATE CONNECTES SET TIME_CO = '$time' WHERE IP_VISITE='$adr'";
            PdoMiniChat::$monPdo->exec($req);
        }
        
        public function DeleteIp($temps){
            $req = "DELETE FROM CONNECTES WHERE ('$temps'- TIME_CO)>300";
            PdoMiniChat::$monPdo->exec($req);
        }
        
        public function NbConnecter(){
            $req ="SELECT count(*) FROM CONNECTES";
            $rs = PdoMiniChat::$monPdo->query($req);
            $msg = $rs->fetchColumn();
            return $msg;  
        }
    
}
?>

