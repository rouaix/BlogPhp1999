<?phpinclude("func/func.bdd.php");include("func/func.commentaire.php");include("func/func.formulaire.php");include("func/func.notation.php");include("func/func.rss.php");include("func/func.social.php");include("func/func.theme.php");include("func/func.vote.php");include("func/func.user.php");function trouve_photo($nom,$num){  $y = "";  $images = array("png","jpg","jpeg","gif");  while (list($key, $val) = each($images)){      if($y == ""){       $x = "images/photos/".ucfirst($nom)."_".$num.".".$val;       if(file_exists($x)){$y = $x ;}      }  }  return $y;}function retour_sans_js(){  @header("location:http://".getenv("HTTP_HOST"));  exit();}function retour_js(){  echo "<script>document.location.href = 'http://".getenv("HTTP_HOST")."';</script>";}function date_heure(){   $x = date("d/m/Y H:i");   return($x);}function ajax_popup($lien){  $temps = "javascript:voir('popup');ajaxpage(rootdomain+'inc.pop.formulaire.php?";  $temps .= $lien."','surpopup');loadobjs();";  return $temps;}function alertes(){  if (isset($_SESSION["alerte"])){    if($_SESSION["alerte"]!=""){      echo "<div class=\"marge\">";      echo "<div class=\"alerte\">";      echo "<h3 id=\"centre\">Message d'information.</h3>";      echo $_SESSION["alerte"];      echo "</div>";      echo "</div>\n";    }    $_SESSION["alerte"]="";  }}function cherche_ip(){    if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];}    elseif(isset($_SERVER['HTTP_CLIENT_IP'])){$ip  = $_SERVER['HTTP_CLIENT_IP'];}    else{$ip = $_SERVER['REMOTE_ADDR'];}    return $ip;}function email_validation($x){  //if (filter_var($x,FILTER_VALIDATE_EMAIL)) {    return True;  //}else{    //return False;  //}}function erreur_404($x){  if(!isset($_SESSION["alerte"])){$_SESSION["alerte"]="";}  $_SESSION["alerte"].= "<div class=\"alerte\">";  $_SESSION["alerte"].= "<img class=\"module\" src=\"".@$_SESSION["ico"]["erreur_404"]."\" id=\"i64\">";  $_SESSION["alerte"].= "<br>";  $_SESSION["alerte"].= $x." => Page introuvable !";  //echo "<br>";  //echo "[".$x."]";  $_SESSION["alerte"].= "</div>";}function page_en_construction(){  inclure("inc.page.construction.php");}function repertoire_supprimer($path) {    @$O = @dir($path);    if(!is_object($O))    return false;    while($file = $O -> read()) {        if($file != '.' && $file != '..') {            if(is_file($path.'/'.$file))            unlink($path.'/'.$file);            else              if(is_dir($path.'/'.$file))              repertoire_supprimer($path.'/'.$file);            }        }    $O -> close();    rmdir($path);    return true;}function session_variables(){  if(count($_GET)){    while (list($key, $val) = each($_GET)){      //if($val!=""){$_SESSION[$key]= $val ;}else{unset($_SESSION[$key]);}      if($val!=""){        $_SESSION[$key]= htmlentities($val,ENT_QUOTES,'UTF-8');      }else{        unset($_SESSION[$key]);      }    }  }  if(count($_POST)){    while (list($key, $val) = each($_POST)){      //if($val!=""){$_SESSION[$key]= $val ;}else{unset($_SESSION[$key]);}      if($val!=""){        //$_SESSION[$key]= htmlentities($val,ENT_QUOTES,'UTF-8');        $_SESSION[$key]= $val;      }else{        unset($_SESSION[$key]);      }    }  }  unset($_GET);  unset($_POST);}function email_envoyer(){  if($_SESSION["email"]["email"] == ""){    $_SESSION["email"]["email"] = "daniel@neocratie.fr";    $_SESSION["email"]["titre"] = "Alerte Anomalie";  }  $headers  ="From:\"NeoCratie\"<webmaster@neocratie.net>"."\r\n";  //$headers .="To:<".$_SESSION["email"]["email"].">"."\r\n";  $headers .="Content-Type:text/plain; charset=\"utf-8\""."\r\n";  $headers .="Content-Transfer-Encoding:8bit"."\r\n";  $headers .="X-Priority:3"."\r\n";  $headers .="Reply-To:webmaster@neocratie.net"."\r\n";  //$headers .="Cc:daniel@neocratie.net"."\r\n";  $headers .="Bcc:daniel@rouaix.com"."\r\n";  @mail($_SESSION["email"]["email"],$_SESSION["email"]["titre"], $_SESSION["email"]["message"], $headers);  //$_SESSION["alerte"] .= "Email envoy&eacute; (".$_SESSION["email"]["email"].")";  unset($_SESSION["email"]);  $_SESSION["alerte"] .= "<br />Message envoy&eacute; !";}function photo($nom,$num){   $photo = "";   if($nom == "user"){      $res = @mysql_query("select * from photo where qui='".$num."' and nom='".$nom."' limit 1");     if($lp = @mysql_fetch_array(@$res)){         if($lp["etat"] == "v"){            $photo = trouve_photo($nom,$num);         }      }   }else{      $photo = trouve_photo($nom,$num);   }   return $photo;}function pluriel($x){  if($x > 1){return "s";}}function base64_url_decode($input) {    return base64_decode(strtr($input, '-_', '+/'));}function liste_valeurs($retour,$titre,$valeurs){    $retour .= "<fieldset><legend>".$titre."</legend>";    while (list($key, $val) = each($valeurs)){      if(is_array($val)){        $retour .= liste_valeurs("",$key,$val);      }else{        if($val!=""){          $retour .= "<p class=\"marge\"><b>".$key." =</b> ".$val."</p>";        }      }    }    $retour .= "</fieldset>";  return $retour;}function tronque($chaine, $longueur){  if (empty ($chaine)){return "";}  elseif (strlen ($chaine) < $longueur) {return $chaine;}  elseif (preg_match ("/(.{1,$longueur})\s./ms", $chaine, $match)){return $match [1] . " <b id=\"\">&nbsp;...&nbsp;</b>";}  else {return substr ($chaine, 0, $longueur) . " <b id=\"\">&nbsp;...&nbsp;</b>";}}function longueur_chaine($chaine, $longueur){  if (empty ($chaine)){return "";}  elseif (strlen ($chaine) < $longueur) {return $chaine;}  elseif (preg_match ("/(.{1,$longueur})\s./ms", $chaine, $match)){return $match [1];}  else {return substr ($chaine, 0, $longueur);}}?>