<?php 
$h = date("H")+1;
$min = date("i");
$sec = date("s");
//header("refresh: 3");
?>
<meta charset="UTF-8">
<html>
		<head>
              <title>Mini-Chat</title>
              <meta charset= "utf-8">
              <link type="text/css" rel="stylesheet" href="styles/form.css">  
              
         </head> 

         <body>  
         <h1 class="baba">Mini-Chat</h1>
  	<?php 
           echo "<h3 class='bibi'> Vous êtes $co personne(s) à être connecté(s)</h3>";
    ?>
             <table class="tableau-style">
             
             	<thead>
            		 
            		 <tr>
            		 <th colspan=3><span id="temps-actuel"></span>
            		 <script  src="js/heure.js"></script> </th>
            		 
            		 </tr>
            		 
            		 <tr>
                        <th>PSEUDO</th>
                        <th>MESSAGE</th>
                        <th>DATE</th>
            		 </tr>
           	  </thead>
             <tbody>
                        <?php                 
                        
                        foreach ($selectMsg as $rep) {
                        ?>
              <tr>
                                <td><?= $rep['PSEUDO_USER'] ?></td>
                                <td><?= $rep['MESSAGE'] ?></td>
                                <td><?= $rep['DATE'] ?></td>
                                
            </tr>
            
                        <?php
                        }
                        ?>
                        <th colspan=3> <a href="index.php?uc=mini_chat&action=pdf">PDF</a></th>
                </tbody>
                </table>
                <nav>
                    <ul class="pagination">
                       
                        <?php for($page = 1; $page <= $pages; $page++): ?>
                            <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                                <a href="index.php?uc=mini_chat&action=affiche&page=<?= $page ?>" class="page-link"><?= $page ?></a>
                            </li>
                        <?php endfor ?>
                        
                    </ul>
                </nav>
                
     <form action="index.php?uc=mini_chat&action=insertD" method="POST">
     <input id="pseudo1" type="text" name="pseudo" placeholder="Pseudo" required="required">
     <input id="message1" type="text" name="message" placeholder="Message" required="required">
     <button type="submit"> Envoyer</button> 
     </form>
       <form action="index.php?uc=mini_chat&action=deconnexion" method="POST">
      <button type="submit">Deconnecter</button> 
      </form>
         
      
    
       </body>
</html>

   