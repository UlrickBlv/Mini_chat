<link rel="stylesheet" href="styles/form.css">
<body>
 <p id="titre_i">INSCRIPTION</p>
<div id="connexion">
<form method="POST" action="index.php?uc=mini_chat&action=insertU" >

  <div class="champ">
    <input id="pseudo3" type="text" name="pseudo" placeholder="Pseudo" required="required">
  </div>
  
  <div class="champ">
   <input id="mdp3" type="password" name="mdp" placeholder="Mot de Passe" required="required">
  </div>
  
  <div class="champ">
   <input id="email3" type="email" name="email" placeholder="Email" required="required">
  </div>
   <input id="inscription" type="submit" name="Inscription" value="Inscription" />
</form>
</div>
</body>
