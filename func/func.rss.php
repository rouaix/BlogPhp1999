<?php function lire_rss($url,$titre,$nbr,$taille){   $i=0;   $flux = "\n<label class=\"rss\">\n";   $flux .= "<h4><img src=\"images/boutons/24/rss.png\" style=\"margin-right:5px;\">".$titre."</h4>\n";   $flux .= "<dl>\n";   $xml = @simplexml_load_file($url) ;   foreach($xml->channel->item as $item) {     $i++;     if($i<=$nbr){       $lien = $item->link;       $titre = $item->title;       $txt = $item->description;       if($taille == "mini"){         $flux .= "<a target=\"Flux Rss\" id=\"mini\" href=\"".$lien."\">".$titre."</a>\n";       }else{         $flux .= "<a href=\"".$lien."\">".$titre."</a>\n";         $flux .= "<dt>\n";         $txt = str_ireplace('CLASS', 'class', $txt);         $txt = str_ireplace('STYLE', 'style', $txt);         $txt = str_ireplace('HREF', 'href', $txt);         //$txt = str_ireplace('BR', 'br', $txt);         //$txt = str_ireplace('', 'style', $txt);         $txt = str_ireplace('href=', 'target="Flux Rss" href=', $txt);             //$txt = str_ireplace('CLASS', 'class', $txt);         //$txt = str_ireplace('STYLE', 'style', $txt);         $txt = preg_replace('#class( )?=( )?"(.*)"#', '',$txt);         $txt = preg_replace('#style( )?=( )?"(.*)"#', '',$txt);         $txt = preg_replace('#(  )?<#', '<',$txt);         $txt = preg_replace('#( )?<#', '<',$txt);         $txt = preg_replace('#>(  )?#', '>',$txt);         $txt = preg_replace('#>( )?#', '>',$txt);         $txt = preg_replace('#(  )#', ' ',$txt);         $txt = preg_replace('#(  )#', ' ',$txt);         if($taille == "maxi"){$flux .= $txt;}         if($taille == "mini"){$flux .= "";}         $flux .= "</dt>\n";       }     }   }   $flux .= "</dl>\n";   $flux .= "</label>\n";   return $flux; }?>