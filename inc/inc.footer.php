<table class="footer" width="100%"><tr><td id="gauche" width="35%">&copy; 2013 NeoCratie (.com .eu .fr .org .net)</td><td id="centre" width="30%">| <a href="<?php echo $_SESSION["location"];?>?page=accueil">Accueil</a> | <a class="footer" href="#top">Haut de page</a> |</td><td id="droite" width="35%"><a href="mailto:webmaster@neocratie.net" title="Ecrire au concepteur">Ecrire au concepteur</a></td></tr><tr><td id="centre" colspan="3"><img src="images/logos/NeoCratieFF.png" height="50px"></td></tr><tr><td id="centre" colspan="3"><?php      echo "En ligne : ";      echo $_SESSION["visiteur"]["inconnu"]." Visiteur".pluriel($_SESSION["visiteur"]["inconnu"]);      echo " & ";      echo $_SESSION["visiteur"]["connu"]." Membre".pluriel($_SESSION["visiteur"]["connu"]);      if(est_administrateur(@$_SESSION["userid"])){         echo " sur ".$_SESSION["visiteur"]["membre"];         echo "<br />"."IP : ".@$_SESSION["userip"];         echo " - ".sharedcount("http://www.neocratie.net")." Partages";      }?></td></tr></table>